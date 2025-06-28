<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // ✅ tambahkan ini

class SubscriptionController extends Controller
{
    public function indexByUser()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $subscriptions = Subscription::with('plan')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $subscriptions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'plan_id' => 'required|exists:meal_plans,id',
            'meal_types' => 'required|array|min:1',
            'delivery_days' => 'required|array|min:1',
            'allergies' => 'nullable|string',
        ]);

        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'phone' => $request->phone,
            'plan_id' => $request->plan_id,
            'meal_types' => json_encode($request->meal_types),
            'delivery_days' => json_encode($request->delivery_days),
            'allergies' => $request->allergies,
            'status' => 'ACTIVE',
        ]);

        return response()->json([
            'message' => 'Subscription created successfully.',
            'data' => $subscription
        ], 201);
    }
    
    public function pause(Request $request, $id)
    {
        $request->validate([
            'pause_from' => 'required|date|after_or_equal:today',
            'pause_until' => 'required|date|after_or_equal:pause_from',
        ]);

        $subscription = Subscription::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$subscription) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription not found or unauthorized.'
            ], 404);
        }

        $subscription->update([
            'pause_from' => $request->pause_from,
            'pause_until' => $request->pause_until,
            'status' => 'PAUSE'  // ⬅️ Ubah status ke PAUSED
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Subscription paused successfully.',
            'data' => $subscription
        ]);
    }

    public function cancel($id)
{
    $subscription = Subscription::where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

    if (!$subscription) {
        return response()->json([
            'status' => false,
            'message' => 'Subscription not found or unauthorized.'
        ], 404);
    }

    // Update status menjadi CANCELED
    $subscription->update([
        'status' => 'CANCEL'
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Subscription canceled successfully.',
        'data' => $subscription
    ]);
}

public function getByDateRange(Request $request)
{
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');

    // Validasi input
    if (!$startDate || !$endDate) {
        return response()->json([
            'status' => false,
            'message' => 'Start date and end date are required.'
        ], 400);
    }

    $subscriptions = Subscription::with(['user', 'plan']) // eager load
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'status' => true,
        'data' => $subscriptions
    ]);
}

public function indexAll(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $startDate = $request->start_date;
    $endDate = $request->end_date;

    $subscriptions = \App\Models\Subscription::with(['plan', 'user'])
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

    return response()->json([
        'status' => true,
        'data' => $subscriptions
    ]);
}

public function filterByDate(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date'   => 'required|date|after_or_equal:start_date',
    ]);

    $subscriptions = Subscription::whereBetween('created_at', [
        $request->start_date,
        $request->end_date,
    ])->get();

    return response()->json([
        'status' => true,
        'data' => $subscriptions,
        'count' => $subscriptions->count()
    ]);
}

public function getMonthlyRevenue(Request $request)
{
    $month = $request->query('month') ?? Carbon::now()->format('m');
    $year = $request->query('year') ?? Carbon::now()->format('Y');

    $revenue = DB::table('subscriptions')
        ->join('meal_plans', 'subscriptions.plan_id', '=', 'meal_plans.id')
        ->whereMonth('subscriptions.created_at', $month)
        ->whereYear('subscriptions.created_at', $year)
        ->whereIn('subscriptions.status', ['ACTIVE', 'PAUSED'])
        ->select(DB::raw('SUM(meal_plans.price * JSON_LENGTH(subscriptions.meal_types) * JSON_LENGTH(subscriptions.delivery_days) * 4.3) as total_revenue'))
        ->value('total_revenue');

    return response()->json([
        'status' => true,
        'month' => $month,
        'year' => $year,
        'revenue' => round($revenue ?? 0, 2)
    ]);
}

public function getReactivations(Request $request)
{
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');

    if (!$startDate || !$endDate) {
        return response()->json([
            'status' => false,
            'message' => 'Start and end date are required.'
        ], 400);
    }

    // Asumsikan ada kolom `status_history` atau tracking update status via logs
    // Jika tidak, kita bisa mendeteksi reaktivasi dari entri dengan status 'ACTIVE' di periode terpilih yang sebelumnya pernah 'CANCELED'

    $reactivations = DB::table('subscriptions')
        ->whereBetween('updated_at', [$startDate, $endDate])
        ->where('status', 'ACTIVE')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('subscriptions as s2')
                ->whereRaw('s2.user_id = subscriptions.user_id')
                ->where('s2.status', 'CANCELED');
        })
        ->count();

    return response()->json([
        'status' => true,
        'reactivations' => $reactivations
    ]);
}

public function getTotalActiveSubscriptions()
{
    $activeSubscriptions = Subscription::where('status', 'ACTIVE')->count();

    return response()->json([
        'status' => true,
        'active_subscriptions' => $activeSubscriptions
    ]);
}


}

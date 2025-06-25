<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    // POST /api/subscriptions
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string|max:191',
            'plan_id' => 'required|exists:meal_plans,id',
            'mealType' => 'required|string|max:191',
            'delivery_days' => 'nullable|string|max:191',
            'allergies' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $subscription = Subscription::create([
            'user_id' => auth()->id(), // ambil dari login
            'phone_number' => $request->phone_number,
            'plan_id' => $request->plan_id,
            'mealType' => $request->mealType,
            'delivery_days' => $request->delivery_days,
            'allergies' => $request->allergies,
            'status' => 'ACTIVE',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Subscription created successfully.',
            'data' => $subscription
        ], 201);
    }

    // GET /api/subscriptions
    public function index()
    {
        return response()->json(Subscription::all(), 200);
    }

    // GET /api/subscriptions/{id}
    public function show($id)
    {
        $subscription = Subscription::find($id);
        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        return response()->json($subscription, 200);
    }

    // PUT /api/subscriptions/{id}
    public function update(Request $request, $id)
    {
        $subscription = Subscription::find($id);
        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string|max:191',
            'plan_id' => 'required|exists:meal_plans,id',
            'mealType' => 'required|string|max:191',
            'delivery_days' => 'nullable|string|max:191',
            'allergies' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $subscription->update([
            'phone_number' => $request->phone_number,
            'plan_id' => $request->plan_id,
            'mealType' => $request->mealType,
            'delivery_days' => $request->delivery_days,
            'allergies' => $request->allergies,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Subscription updated successfully.',
            'data' => $subscription
        ]);
    }

    // DELETE /api/subscriptions/{id}
    public function destroy($id)
    {
        $subscription = Subscription::find($id);
        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $subscription->delete();

        return response()->json(['message' => 'Subscription deleted successfully.']);
    }
}

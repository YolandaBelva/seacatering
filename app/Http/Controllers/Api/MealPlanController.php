<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\MealPlan;
use Illuminate\Support\Facades\Log;

class MealPlanController extends Controller
{
    public function index()
    {
        return response()->json(MealPlan::all(), 200);
    }

    public function show($id)
    {
        $mealPlan = MealPlan::find($id);
        if ($mealPlan) {
            return response()->json($mealPlan, 200);
        } else {
            return response()->json(['message' => 'Meal plan not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image_url' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        if (!$request->hasFile('image_url')) {
            return response()->json([
                'status' => false,
                'message' => 'The image failed to upload.'
            ], 422);
        }

        $path = $request->file('image_url')->store('mealplans', 'public');

        $mealPlan = MealPlan::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_url' => $path,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Meal plan created successfully.',
            'data' => $mealPlan
        ], 201);
    }

public function update(Request $request, $id)
{
    $mealPlan = MealPlan::findOrFail($id);

    Log::info('🟡 Mulai update meal plan ID ' . $id);

    $request->validate([
        'name' => 'required|string',
        'price' => 'required',
        'description' => 'required|string',
        'image_url' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
    ]);

    if ($request->hasFile('image_url')) {
        Log::info('🟢 File image_url terdeteksi');

        $path = $request->file('image_url')->store('mealplans', 'public');

        if ($mealPlan->image_url && Storage::disk('public')->exists($mealPlan->image_url)) {
            Storage::disk('public')->delete($mealPlan->image_url);
            Log::info('🟠 Gambar lama dihapus: ' . $mealPlan->image_url);
        }

        $mealPlan->image_url = $path;
        Log::info('🟢 Gambar baru disimpan di: ' . $path);
    } else {
        Log::warning('🔴 Tidak ada file image_url dikirim!');
    }

    $mealPlan->name = $request->input('name', $mealPlan->name);
    $mealPlan->price = $request->input('price', $mealPlan->price);
    $mealPlan->description = $request->input('description', $mealPlan->description);

    $mealPlan->save();

    Log::info('✅ Data berhasil diupdate');

    return response()->json([
        'status' => true,
        'message' => 'Meal plan updated successfully.',
        'data' => $mealPlan
    ]);
}

    public function destroy($id)
    {
        $mealPlan = MealPlan::find($id);
        if (!$mealPlan) {
            return response()->json(['message' => 'Meal plan not found'], 404);
        }

        $mealPlan->delete();
        return response()->json(['message' => 'Meal plan deleted'], 200);
    }
}

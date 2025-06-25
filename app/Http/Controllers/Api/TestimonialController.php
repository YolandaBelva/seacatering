<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'review' => 'nullable|string|max:1000',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $testimonial = Testimonial::create([
            'user_id' => $request->user_id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Testimonial submitted successfully.',
            'data' => $testimonial
        ], 201);
    }

    public function index()
    {
        $testimonials = Testimonial::with('user')->latest()->get();
        return response()->json($testimonials);
    }
}

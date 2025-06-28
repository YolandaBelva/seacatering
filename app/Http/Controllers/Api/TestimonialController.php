<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    // Tambah testimonial
    public function store(Request $request)
        {
            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'review' => 'required|string',
            ]);

            $user = auth()->user(); // otomatis dapat dari session
            Testimonial::create([
                'name' => $user->name,
                'rating' => $request->rating,
                'review' => $request->review,
            ]);

            return response()->json(['message' => 'Success']);
        }



    // Tampilkan semua testimonial
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return response()->json($testimonials);
    }

    // Tampilkan berdasarkan nama user
    public function showByName($name)
    {
        $testimonials = Testimonial::where('name', $name)->get();
        return response()->json($testimonials);
    }
}

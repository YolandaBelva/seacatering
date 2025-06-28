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
        return response()->json([
            'status' => true,
            'data' => MealPlan::all()
        ]);
    }

}

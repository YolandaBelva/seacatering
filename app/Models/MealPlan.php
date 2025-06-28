<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = [
        'price',
        'title',
        'description',
        'features',
        'image_url'
    ];

    protected $casts = [
        'features' => 'array',
    ];
}

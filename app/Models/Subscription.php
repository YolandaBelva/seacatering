<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'plan_id',
        'meal_types',
        'delivery_days',
        'allergies',
        'status',
        'pause_from',
        'pause_until',
    ];


    protected $casts = [
        'meal_types' => 'array',
        'delivery_days' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(MealPlan::class, 'plan_id');
    }
}

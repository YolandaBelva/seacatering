<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'phone_number',
        'plan_id',
        'mealType',
        'delivery_days',
        'allergies',
        'status',
    ];
}

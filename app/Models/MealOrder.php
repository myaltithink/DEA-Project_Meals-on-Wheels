<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_order_type',
        'meal_order_status',
        'meal_order_ordered_at',
        'meal_order_delivered_at',
        'prepared_by_id',
        'prepared_by',
        'prepared_by_role',
        'delivered_by_id',
        'delivered_by',
        'meal_plan_id'
    ];
}

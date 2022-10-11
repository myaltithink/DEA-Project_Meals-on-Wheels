<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealOrder extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'meal_order_id';

    protected $fillable = [
        'meal_order_type',
        'meal_order_status',
        'meal_order_ordered_at',
        'meal_order_delivered_at',
        'ordered_by_id',
        'ordered_by',
        'ordered_by_role',
        'ordered_by_address',
        'prepared_by_id',
        'prepared_by',
        'prepared_by_role',
        'prepared_by_address',
        'delivered_by_id',
        'delivered_by',
        'meal_plan_id'
    ];

    public function mealPlan(){
        return $this->belongsTo(MealPlan::class, 'meal_plan_id');
    }
}

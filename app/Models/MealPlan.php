<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    protected $table = 'meal_plan';
    protected $primaryKey ='meal_plan_id';

    protected $fillable = [
        'meal_name',
        'meal_ingredients',
        'meal_image_path',
        'reason_for_rejection',
        'status',
        'proposed_by',
        'proposed_by_role',
        'organization',
        'user_id',
    ];

    public function getRouteKeyName()
    {
        return 'meal_plan_id';
    }

    public function mealOrder(){
        return $this->hasMany(MealOrder::class, 'meal_plan_id');
    }
}

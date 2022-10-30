<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MealPlan;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertSame;

class MealProposalsManagementTest extends TestCase
{
    /**
     * Assessment Module - Food Safety Management
     *
     * DO NOT DELETE ANYTHING HERE EVEN THE COMMENTS AS THERE ARE FOR UNIT TESTING.
     *
     */

    public function test_view_all_meal_proposals(){

        //get an administrator from database
        $admin = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_ADMIN');
        })->first();

        //this acting as then use the get method
        $response = $this->actingAs($admin)->get('/food-safety-management');

        //response assert
        $response->assertStatus(200);
    }

    // public function test_view_meal_proposal(){

    //     //get an administrator from database
    //     $admin = User::whereHas('roles', function(Builder $query){
    //         $query->where('role_name','ROLE_ADMIN');
    //     })->first();

    //     //get a partner from database
    //     $partner = User::whereHas('roles', function(Builder $query){
    //         $query->where('role_name','ROLE_PARTNER');
    //     })->first();

    //     //create meal proposal
    //     $mealPlan = MealPlan::create([
    //         'meal_name' => 'Ginisang Munggo',
    //         'meal_ingredients' => 'Onion, Pork, Munggo Beans',
    //         'meal_image_path' => "munggo.jpg",
    //         'reason_for_rejection' => null,
    //         'status' => 'Pending',
    //         'proposed_by' => 'Aling Marites',
    //         'proposed_by_role' => str_replace('ROLE_', '',  $partner->roles()->where('role_name', 'role_partner')->first()->role_name),
    //         'organization' =>  $partner->partner_details->partner_name,
    //         'user_id' => $partner->user_id,
    //     ]);

    //     //this acting as then use the get method
    //     $response = $this->actingAs($admin)->get(route('meal-proposal-approval', $mealPlan));

    //     //response assert
    //     $response->assertStatus(200);
    // }

    // public function test_approve_meal_proposal(){

    //     //get an administrator from database
    //     $admin = User::whereHas('roles', function(Builder $query){
    //         $query->where('role_name','ROLE_ADMIN');
    //     })->first();

    //     //get a partner from database
    //     $partner = User::whereHas('roles', function(Builder $query){
    //         $query->where('role_name','ROLE_PARTNER');
    //     })->first();

    //     //create meal proposal
    //     $mealPlan = MealPlan::create([
    //         'meal_name' => 'Sauteed Mung Beans',
    //         'meal_ingredients' => 'Onion, Pork, Munggo Beans',
    //         'meal_image_path' => "munggo.jpg",
    //         'reason_for_rejection' => null,
    //         'status' => 'Pending',
    //         'proposed_by' => 'Aling Marites',
    //         'proposed_by_role' => str_replace('ROLE_', '',  $partner->roles()->where('role_name', 'role_partner')->first()->role_name),
    //         'organization' =>  $partner->partner_details->partner_name,
    //         'user_id' => $partner->user_id,
    //     ]);

    //     //this acting as then use the post method
    //     $response = $this->actingAs($admin)->post('approve-meal-proposal',
    //     [
    //         'meal-id' => $mealPlan->meal_plan_id
    //     ]);

    //     //response assert
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/food-safety-management');

    // }

    public function test_reject_meal_proposal(){

        //get an administrator from database
        $admin = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_ADMIN');
        })->first();

        //get a partner from database
        $partner = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_PARTNER');
        })->first();

        //create meal proposal
        $mealPlan = MealPlan::create([
            'meal_name' => 'Sauteed Mung Beans with Pork Crakling',
            'meal_ingredients' => 'Onion, Pork, Munggo Beans',
            'meal_image_path' => "munggo.jpg",
            'reason_for_rejection' => null,
            'status' => 'Pending',
            'proposed_by' => 'Aling Marites',
            'proposed_by_role' => str_replace('ROLE_', '',  $partner->roles()->where('role_name', 'role_partner')->first()->role_name),
            'organization' =>  $partner->partner_details->partner_name,
            'user_id' => $partner->user_id,
        ]);

        $reason = 'The reason of meal rejection';

        //this acting as then use the post method
        $response = $this->actingAs($admin)->post('reject-meal-proposal',
        [
            'meal-id' => $mealPlan->meal_plan_id,
            'reason' => $reason
        ]);

        //response assert
        $response->assertStatus(302);
        $response->assertRedirect('/food-safety-management');

    }
}

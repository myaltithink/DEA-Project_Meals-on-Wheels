<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\MealPlan;
use App\Models\MealOrder;
use App\Models\VolunteerDetails;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Builder;

class MealManagementTest extends TestCase
{

    /*
    Meal Proposal Module
    **/
    //test new meal proposal
    public function test_create_meal_proposal(){

        //getting volunteer user
        $volunteer = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_VOLUNTEER_COOK');
        })->first();

        //this acting as then use the post method
        $response = $this->actingAs($volunteer)->post('/create-meal-proposal',
            [
                'meal_image' => UploadedFile::fake()->image('meal.jpg'),
                'meal_name' => 'Sample Meal',
                'ingredients' => 'sample ingredient, sample ingredient2',
            ]
        );

        //response assert
        $response->assertStatus(302);
        $response->assertRedirect(route('my-proposal-list'));

    }

    //test edit meal proposal
    public function test_edit_existing_meal_proposal(){

        //retrieve volunteer user from database
        $volunteer = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_VOLUNTEER_COOK');
        })->first();

        //create meal proposal
        $mealPlan = MealPlan::create([
            'meal_name' => 'sample Meal name',
            'meal_ingredients' => 'ingredient1, ingredient2, ingredient3',
            'meal_image_path' => "some directory.jpg",
            'reason_for_rejection' => null,
            'status' => 'Pending',
            'proposed_by' => $volunteer->volunteer_details->volunteer_name,
            'proposed_by_role' => str_replace('ROLE_', '',  $volunteer->roles()->where('role_name', 'role_volunteer')->first()->role_name),
            'organization' =>  $volunteer->volunteer_details->organization_name,
            'user_id' => $volunteer->user_id,
        ]);

        //this acting as then use the post method
        $response = $this->actingAs($volunteer)->put(route('edit-meal', $mealPlan),
                [
                    'meal_image' => UploadedFile::fake()->image('updatedmeal.jpg'),
                    'meal_name' => 'Updated Sample Meal',
                    'ingredients' => 'sample ingredient, sample ingredient2',
                ]
        );

        //response assert
        $response->assertStatus(302);
        $response->assertRedirect(route('my-proposal-list'));

    }

    /*
    * Delivery Management Module
    **/

    //test add new meal order
    public function test_add_new_meal_order(){
        //retrieve a member user
        $member = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_MEMBER');
        })->first();

        $mealPlan = MealPlan::where('status', 'Approved')->first();

        $response = $this->actingAs($member)->post(route('new-order'), [
            'select-meal' => $mealPlan->meal_plan_id
        ]);

        //response assert
        $response->assertStatus(302);
        $response->assertRedirect(route('mc-orders'));
    }

    //test assign meal to volunteer/partner by admin
    public function test_assign_meal_to_partner_or_volunteer(){
         //retrieve a member user
         $member = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_MEMBER');
        })->first();

        //retrieve admin user
        $admin = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_ADMIN');
        })->first();

        //order
        $data = array(
            'meal_plan_id' => 16,
            'meal_order_status' => 'pending',
            'ordered_by_id' => $member->user_id,
            'meal_order_ordered_at' => date('Y-m-d H:i:s'),
            'ordered_by' => $member->member_details->profile->first_name." ".$member->member_details->profile->last_name,
            'ordered_by_role' => 'ROLE_MEMBER',
            'ordered_by_address' => $member->member_details->profile->address,
        );

        $meal = new MealOrder();
        $meal->fill($data)->save();

        //retrieve volunteer
        $volunteer = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_VOLUNTEER_COOK');
        })->first();

        //this acting as admin
        $response = $this->actingAs($admin)->put(route('assign-meal-preparation'),
            [
                'selected-order' => $meal->meal_order_id,
                'selected-person' => $volunteer->user_id
            ]
        );

        //response assert
        $response->assertStatus(302);
        $response->assertRedirect(route('a-prep-orders'));

    }

    //test assign meal to rider
    public function test_assign_meal_to_rider(){
        //create a member user
         $member = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_MEMBER');
        })->first();

        //retrieve volunteer user from database
        $volunteer = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_VOLUNTEER_COOK');
        })->first();
        $volunteer_details = VolunteerDetails::where('user_id', $volunteer->user_id)->first();
        $volunteer_profile = Profile::whereHas('volunteer_details', function(Builder $query) use ($volunteer_details){
            $query->where('volunteer_id', $volunteer_details->volunteer_id);
        })->first();

        //create a meal proposal or plan with approved user status
        $data = array(
            'meal_plan_id' => 16,
            'meal_order_status' => 'Packed',
            'ordered_by_id' => $member->user_id,
            'meal_order_ordered_at' => date('Y-m-d H:i:s'),
            'ordered_by' => $member->member_details->profile->first_name." ".$member->member_details->profile->last_name,
            'ordered_by_role' => 'ROLE_MEMBER',
            'ordered_by_address' => $member->member_details->profile->address,
            'prepared_by_id' => $volunteer->user_id,
            'prepared_by' => $volunteer->volunteer_details->volunteer_name,
            'prepared_by_role' => ($volunteer->hasPermission('ROLE_VOLUNTEER_COOK') ? 'ROLE_VOLUNTEER' : 'ROLE_PARTNER'),
            'prepared_by_address' => $volunteer_profile->address
        );

        $meal = new MealOrder();
        $meal->fill($data)->save();

        //retrieve volunteer rider user
        $volunteer_rider = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_VOLUNTEER_RIDER');
        })->first();

        //retrieve an admin user
        $admin = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_ADMIN');
        })->first();

        //this acting as admin
        $response = $this->actingAs($admin)->put(route('assign-meal-delivery'),
            [
                'selected-order' => $meal->meal_order_id,
                'selected-person' => $volunteer_rider->user_id
            ]
        );

        //response assert
        $response->assertStatus(302);
        $response->assertRedirect(route('a-del-orders'));

    }


}

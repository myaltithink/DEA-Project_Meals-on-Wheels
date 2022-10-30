<?php

namespace Tests\Feature;

use App\Http\Controllers\UserAssesmentController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class UserAssessmentTest extends TestCase
{
    /**
     * Assessment Module - Users Eligibility Assessment
     *
     * DO NOT DELETE ANYTHING HERE EVEN THE COMMENTS AS THERE ARE FOR UNIT TESTING.
     *
     */

    public function test_view_all_pending_members(){

        //get an administrator from database
        $admin = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_ADMIN');
        })->first();

        //this acting as then use the get method
        $response = $this->actingAs($admin)->get(route('member-assessment'));

        //response assert
        $response->assertStatus(200);
    }

    // public function test_view_pending_member(){

    //     //get an administrator from database
    //     $admin = User::whereHas('roles', function(Builder $query){
    //         $query->where('role_name','ROLE_ADMIN');
    //     })->first();

    //     //get a member from database that is only email verified
    //     $member = User::where([['email_verified', '=', true], ['authenticatable', '=', false]])
    //     ->whereHas('roles', function(Builder $query){
    //         $query->where('role_name','ROLE_MEMBER');
    //     })->first();

    //     //this acting as then use the get method
    //     $response = $this->actingAs($admin)->get(route('member-assessment', $member));

    //     //response assert
    //     $response->assertStatus(200);
    //     $this->assertEquals('member@gmail.com', $member['email']);
    // }

    // public function test_approve_pending_member(){

    //     //get an administrator from database
    //     $admin = User::whereHas('roles', function(Builder $query){
    //         $query->where('role_name','ROLE_ADMIN');
    //     })->first();

    //     //get a member from database that is email verified
    //     $member = User::where([['email_verified', '=', true], ['authenticatable', '=', false]])
    //     ->whereHas('roles', function(Builder $query){
    //         $query->where('role_name','ROLE_MEMBER');
    //     })->first();

    //     //this acting as then use the get method
    //     $response = $this->actingAs($admin)->post('approve-member',
    //     [
    //         'user-id' => $member->user_id
    //     ]);

    //     //response assert
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/member-eligibility-assessment');
    // }

    // public function test_reject_pending_member(){

    //     //get an administrator from database
    //     $admin = User::whereHas('roles', function(Builder $query){
    //         $query->where('role_name','ROLE_ADMIN');
    //     })->first();

    //     //get a member from database that is only email verified
    //     $member = User::where([['email_verified', '=', true], ['authenticatable', '=', false]])
    //     ->whereHas('roles', function(Builder $query){
    //         $query->where('role_name','ROLE_MEMBER');
    //     })->first();

    //     $reason = 'Reason of member rejection';

    //     //this acting as then use the get method
    //     $response = $this->actingAs($admin)->post('reject-member',
    //     [
    //         'user-id' => $member->user_id,
    //         'reason' => $reason
    //     ]);

    //     //response assert
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/member-eligibility-assessment');
    // }

}

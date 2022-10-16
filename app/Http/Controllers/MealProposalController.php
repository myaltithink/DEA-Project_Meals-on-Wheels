<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MealPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\user_roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MealProposalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('anyrole:ROLE_VOLUNTEER_COOK,ROLE_PARTNER,ROLE_ADMIN');
    }
    //viewing meal proposal lists page
    public function index(){
        $proposals = MealPlan::where('user_id', Auth::id())->latest('updated_at')->paginate(3);
        return view('MealManagement.MealProposal.MealProposalContents.meal-proposal-list')->with('plans', $proposals);
    }

    //viewing meal proposal add page
    public function create(){
        return view('MealManagement.MealProposal.MealProposalContents.add-meal-proposal');
    }

    //for viewing meal proposal information
    public function show(MealPlan $mealPlan){
        return $mealPlan->user_id != Auth::id() ? abort(403) : view('MealManagement.MealProposal.MealProposalContents.view-meal-proposal')->with('plan', $mealPlan);
    }

    //viewing edit page for meal proposal.
    public function edit(MealPlan $mealPlan){
        return $mealPlan->user_id != Auth::id() ? abort(403) : view('MealManagement.MealProposal.MealProposalContents.edit-meal-proposal')->with('plan', $mealPlan);
    }

    //post mappings
    //create sample data
    public function testMealPlanData(){

        //userid 6 is partner
        $partner = User::where('user_id', 6)->first();

        //userid 4 is volunteer cook
        $volunteer = User::where('user_id', 4)->first();

        $meal_plan_1_test_data = array(
            'meal_name' => 'wasdwasd',
            'meal_ingredients' => 'wasdwasd',
            'meal_image_path' => 'wasdwasd',
            'reason_for_rejection' => null,
            'status' => 'Pending',
            'proposed_by' => $volunteer->volunteer_details->volunteer_name,
            'proposed_by_role' => str_replace('ROLE_', '', $volunteer->roles()->where('role_name', 'role_volunteer')->first()->role_name),
            'organization' => $volunteer->volunteer_details->organization_name,
            'user_id' => $volunteer->user_id,
        );

        $meal_plan_2_test_data = array(
            'meal_name' => 'isdaaa',
            'meal_ingredients' => 'wasdwasd, tonila daw tangina, tite',
            'meal_image_path' => 'somewhere',
            'reason_for_rejection' => null,
            'status' => 'Pending',
            'proposed_by' => $volunteer->volunteer_details->volunteer_name,
            'proposed_by_role' => str_replace('ROLE_', '', $volunteer->roles()->where('role_name', 'role_volunteer')->first()->role_name),
            'organization' => $volunteer->volunteer_details->organization_name,
            'user_id' => $volunteer->user_id,
        );

        $meal_plan_3_test_data = array(
            'meal_name' => 'tite',
            'meal_ingredients' => 'titeee',
            'meal_image_path' => 'tite',
            'reason_for_rejection' => null,
            'status' => 'Pending',
            'proposed_by' => $volunteer->volunteer_details->volunteer_name,
            'proposed_by_role' => str_replace('ROLE_', '', $volunteer->roles()->where('role_name', 'role_volunteer')->first()->role_name),
            'organization' => $volunteer->volunteer_details->organization_name,
            'user_id' => $volunteer->user_id,
        );

        $meal_plan_4_test_data = array(
            'meal_name' => 'titeee',
            'meal_ingredients' => 'etites',
            'meal_image_path' =>'titeee',
            'reason_for_rejection' => null,
            'status' => 'Pending',
            'proposed_by' => 'some employee',
            'proposed_by_role' => str_replace('ROLE_', '', $partner->roles()->where('role_name', 'role_partner')->first()->role_name),
            'organization' => $partner->partner_details->partner_name,
            'user_id' => $partner->user_id,
        );

        $meal_plan_5_test_data = array(
            'meal_name' => 'eitits',
            'meal_ingredients' => 'titee',
            'meal_image_path' =>'eeeeirt',
            'reason_for_rejection' => null,
            'status' => 'Pending',
            'proposed_by' => 'some employee',
            'proposed_by_role' => str_replace('ROLE_', '', $partner->roles()->where('role_name', 'role_partner')->first()->role_name),
            'organization' => $partner->partner_details->partner_name,
            'user_id' => $partner->user_id,
        );

        $meal_plan_6_test_data = array(
            'meal_name' => 'aaaa',
            'meal_ingredients' => 'aaaa',
            'meal_image_path' =>'aaaaa',
            'reason_for_rejection' => null,
            'status' => 'Pending',
            'proposed_by' => 'some employee',
            'proposed_by_role' => str_replace('ROLE_', '', $partner->roles()->where('role_name', 'role_partner')->first()->role_name),
            'organization' => $partner->partner_details->partner_name,
            'user_id' => $partner->user_id,
        );

        $mealplan1 = new MealPlan();
        $mealplan2 = new MealPlan();
        $mealplan3 = new MealPlan();
        $mealplan4 = new MealPlan();
        $mealplan5 = new MealPlan();
        $mealplan6 = new MealPlan();

        $mealplan1->fill($meal_plan_1_test_data)->save();
        $mealplan2->fill($meal_plan_2_test_data)->save();
        $mealplan3->fill($meal_plan_3_test_data)->save();
        $mealplan4->fill($meal_plan_4_test_data)->save();
        $mealplan5->fill($meal_plan_5_test_data)->save();
        $mealplan6->fill($meal_plan_6_test_data)->save();

        dd(MealPlan::all());
    }

    //adding new meal proposal information
    public function store(Request $request){
        if($request->user()->hasAnyRole('ROLE_VOLUNTEER')){

            //validator
            Validator::make($request->all(),
                [
                    'meal_name' => ['required','string','max:255'],
                    'meal_image' =>['required','image','mimes:jpg,png,gif,jpeg,svg'],
                    'ingredients' => ['required','string']
                ]
            )->validate();

            //file upload
            $destination = 'public';
            $file = Storage::disk($destination)->put('foods', $request->file('meal_image'));
            #dd(basename($file));

            //crud
            MealPlan::create([
                'meal_name' => $request['meal_name'],
                'meal_ingredients' => $request['ingredients'],
                'meal_image_path' => basename($file),
                'reason_for_rejection' => null,
                'status' => 'Pending',
                'proposed_by' => $request->user()->volunteer_details->volunteer_name,
                'proposed_by_role' => str_replace('ROLE_', '', $request->user()->roles()->where('role_name', 'role_volunteer')->first()->role_name),
                'organization' => $request->user()->volunteer_details->organization_name,
                'user_id' => $request->user()->user_id,
            ]);

            //redirect
            return redirect(route('my-proposal-list'))->with('success','your meal proposal is submitted for review');
        }elseif($request->user()->hasAnyRole('ROLE_PARTNER')){
            //validator
            Validator::make($request->all(),
                [
                    'meal_name' => ['required','string','max:255'],
                    'meal_image' =>['required','image','mimes:jpg,png,gif,jpeg,svg'],
                    'ingredients' => ['required','string'],
                    'employee_name' => ['required','string','max:255'],
                ]
            )->validate();

            //file upload
            $destination = 'public';
            $file = Storage::disk($destination)->put('foods', $request->file('meal_image'));
            #dd(basename($file));

            //crud
            MealPlan::create([
                'meal_name' => $request['meal_name'],
                'meal_ingredients' => $request['ingredients'],
                'meal_image_path' => basename($file),
                'reason_for_rejection' => null,
                'status' => 'Pending',
                'proposed_by' => $request['employee_name'],
                'proposed_by_role' => str_replace('ROLE_', '', $request->user()->roles()->where('role_name', 'role_partner')->first()->role_name),
                'organization' => $request->user()->partner_details->partner_name,
                'user_id' => $request->user()->user_id,
            ]);

            //redirect
            return redirect(route('my-proposal-list'))->with('success','your meal proposal is submitted for review');
        }
        return redirect(route('home'));
    }

    public function update(Request $request, MealPlan $mealPlan){

        if ($mealPlan->user_id != Auth::id()) return abort(403);
        if($request->user()->hasAnyRole('ROLE_VOLUNTEER')){

            //validator
            Validator::make($request->all(),
                [
                    'meal_name' => ['required','string','max:255'],
                    'meal_image' =>['required','image','mimes:jpg,png,gif,jpeg,svg'],
                    'ingredients' => ['required','string']
                ]
            )->validate();

            //file upload
            $destination = 'public';
            $file = Storage::disk($destination)->put('foods', $request->file('meal_image'));
            #dd(basename($file));

            //crud
            $mealPlan->update([
                'meal_name' => $request['meal_name'],
                'meal_ingredients' => $request['ingredients'],
                'meal_image_path' => basename($file),
                'status' => 'Pending',
            ]);

            //redirect
            return redirect(route('my-proposal-list'))->with('success','your meal proposal is submitted for review');
        }elseif($request->user()->hasAnyRole('ROLE_PARTNER')){

            Validator::make($request->all(),
                [
                    'meal_name' => ['required','string','max:255'],
                    'meal_image' =>['required','image','mimes:jpg,png,gif,jpeg,svg'],
                    'ingredients' => ['required','string'],
                    'employee_name' => ['required','string','max:255'],
                ]
            )->validate();

            //file upload
            $destination = 'public';
            $file = Storage::disk($destination)->put('foods', $request->file('meal_image'));

            $mealPlan->update([
                'meal_name' => $request['meal_name'],
                'meal_ingredients' => $request['ingredients'],
                'meal_image_path' => basename($file),
                'proposed_by' => $request['employee_name'],
                'status' => 'Pending',
            ]);

            return redirect(route('my-proposal-list'))->with('success','your meal proposal is submitted for review');
        }
        return redirect(route('home'));
    }

    //delete mapping
    public function destroy(MealPlan $mealPlan){

        if(Auth::id() != $mealPlan->user_id){
            return abort(403);
        }

        $mealPlan->delete();
        return redirect(route('my-proposal-list'));
    }

    //viewing of all pending meal proposals
    public function pendingProposals(){
        $pending_proposals = MealPlan::where('status', "Pending")->get();
        return view('MealManagement.FoodSafetyManagement.food-safety')->with('proposals', $pending_proposals);
    }

    //viewing of a specific meal proposal to approve or reject
    public function showProposal($mealPlan){
        Log::info(print_r($mealPlan, true));
        $meal = MealPlan::find($mealPlan);
        return $meal->meal_plan_id = null ? abort(404) : view('MealManagement.FoodSafetyManagement.view-meal-approval')
        ->with('proposal', $meal)
        ->with('meal_id', $meal->meal_plan_id);
    }

    //approving meal proposal
    public function approveMealProposal(Request $mealPlan){

        // if(Auth::id() != $user_role->role_id = 1){
        //     return abort(403);
        // }
        
        //$mealPlan->update(['status' => "Approve"]);
        $meal = MealPlan::find($mealPlan['meal-id']);

        $meal->status = "Approved";
        $meal->save();
        return redirect('/food-safety-management');
    }

    //rejecting meal proposal
    public function rejectMealProposal(Request $mealPlan){
        // if(Auth::id() != $user_role->role_id = 1){
        //     return abort(403);
        // }

        $meal = MealPlan::find($mealPlan['meal-id']);
        //$reason = MealPlan::find($mealPlan['reason']);
        $meal->reason_for_rejection = $mealPlan['reason'];
        $meal->status = "Rejected";
        $meal->save();
        return redirect('/food-safety-management');
    }

}


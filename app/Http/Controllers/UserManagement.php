<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class UserManagement extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','anyrole:ROLE_ADMIN']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('UserManagement.usermanagement');
    }

    /**
     * Returns a json object of users based on query.
     *
     * @return Response
     */
    public function retrieveUserInformation(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'selected' => ['required'],
        ]);

        if ($validate->fails()) return response()->json([['status' => 'bad request']], 401);

        if($request->selected == "Members"){
            $user = User::whereHas('roles', function(Builder $query){
                $query->where('role_name','ROLE_MEMBER');
            })->with(['member_details' => function($query){
                $query->with('profile')->get();
            }])->get();

            return response()->json($user);
        }else if($request->selected == "Caregivers"){
            $user = User::whereHas('roles', function(Builder $query){
                $query->where('role_name','ROLE_CAREGIVER');
            })->with(['caregiver_details' => function ($query){
                $query->with('profile')->get();
            }])->get();

            return response()->json($user);
        }else if ($request->selected == "Volunteers"){
            $user = User::whereHas('roles', function(Builder $query){
                $query->where('role_name','=','ROLE_VOLUNTEER');
            })->with(['volunteer_details' => function($query){
                $query->with('profile')->get();
            }])->get();

            return response()->json($user);
        }else if($request->selected == "Partner"){
            $user = User::whereHas('roles', function(Builder $query){
                $query->where('role_name','ROLE_PARTNER');
            })->with('partner_details')->get();

            return response()->json($user);
        }else{
            return response()->json([['status' => 'entity does not exist']], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $fields = [
            'user_id' => $user->user_id, //this is required, an initial value inside the field to determine the user
        ]; //this is a dynamic field, we manually set the fields for uniform values

        if($user->hasPermission('ROLE_MEMBER')){
            $fields['first_name'] = $user->member_details->profile->first_name;
            $fields['last_name'] = $user->member_details->profile->last_name;
            $fields['email'] = $user->email;
            $fields['birthday'] = $user->member_details->profile->birthday;
            $fields['address'] = $user->member_details->profile->address;
            $fields['gender'] = $user->member_details->profile->gender;
            $fields['contact'] = $user->member_details->profile->contact_number;

        }else if($user->hasPermission('ROLE_CAREGIVER')){
            $fields['first_name'] = $user->caregiver_details->profile->first_name;
            $fields['last_name'] = $user->caregiver_details->profile->last_name;
            $fields['email'] = $user->email;
            $fields['birthday'] = $user->caregiver_details->profile->birthday;
            $fields['address'] = $user->caregiver_details->profile->address;
            $fields['gender'] = $user->caregiver_details->profile->gender;
            $fields['contact'] = $user->caregiver_details->profile->contact_number;

        }else if ($user->hasPermission('ROLE_VOLUNTEER')){
            $fields['first_name'] = $user->volunteer_details->profile->first_name;
            $fields['last_name'] = $user->volunteer_details->profile->last_name;
            $fields['email'] = $user->email;
            $fields['birthday'] = $user->volunteer_details->profile->birthday;
            $fields['address'] = $user->volunteer_details->profile->address;
            $fields['gender'] = $user->volunteer_details->profile->gender;
            $fields['contact'] = $user->volunteer_details->profile->contact_number;

        }else if ($user->hasPermission('ROLE_PARTNER')){
            $fields['partner_name'] = $user->partner_details->partner_name;
            $fields['partner_address'] = $user->partner_details->partner_address;
            $fields['registered_by'] = $user->partner_details->partner_registered_by;
            return view('UserManagement.update_partner_profile')->with('fields', $fields);
        }else{
            return abort(403);
        }

        return view('UserManagement.update_user_profile')->with('fields', $fields);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $target = null;

        if ($user->hasPermission('ROLE_PARTNER')){
            Validator::make($request->all(), [
                'partner_name' => ['required','string'],
                'registered_by' => ['required','string'],
                'partner_address' => ['required','string'],
            ])->validate();
            $user->partner_details->update([
                'partner_name' => $request->partner_name,
                'partner_registered_by' => $request->registered_by,
                'partner_address' => $request->partner_address,
            ]);

            $user->save();
            $target = 'Partner';
        }else{
            Validator::make($request->all(), [
                'first_name' => ['required','string'],
                'last_name' => ['required','string'],
                'email' => ['required','string','email'],
                'birthday' => ['required'],
                'address' => ['required','string'],
                'gender' => ['required','string'],
                'contact' => ['required','string'],
            ])->validate();

            //update proccess
            $user->update([
                'email' => $request["email"],
            ]);

            $user->save();

            //retrieve the profile part
            if($user->hasPermission('ROLE_MEMBER')){
                $profile = $user->member_details->profile;
                $profile->update([
                    'first_name' => $request["first_name"],
                    'last_name' => $request["last_name"],
                    'email' => $request["email"],
                    'birthday' => $request["birthday"],
                    'contact_number' => $request["contact"],
                ]);
                $profile->save();
                $target = 'Members';
            }else if($user->hasPermission('ROLE_CAREGIVER')){
                $profile = $user->caregiver_details->profile;
                $profile->update([
                    'first_name' => $request["first_name"],
                    'last_name' => $request["last_name"],
                    'email' => $request["email"],
                    'birthday' => $request["birthday"],
                    'contact_number' => $request["contact"],
                ]);
                $profile->save();
                $target = 'Caregivers';
            }else if($user->hasPermission('ROLE_VOLUNTEER')){
                $profile = $user->volunteer_details->profile;
                $profile->update([
                    'first_name' => $request["first_name"],
                    'last_name' => $request["last_name"],
                    'email' => $request["email"],
                    'birthday' => $request["birthday"],
                    'contact_number' => $request["contact"],
                ]);
                $profile->save();
                $target = 'Volunteers';
            }
        }
        return redirect('/user-management?view='.$target);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->hasPermission('ROLE_MEMBER')){
            $user->delete();
            return redirect("/user-management?view=Members");
        }else if($user->hasPermission('ROLE_CAREGIVER')){
            $user->delete();
            return redirect("/user-management?view=Caregivers");
        }else if ($user->hasPermission('ROLE_VOLUNTEER')){
            $user->delete();
            return redirect("/user-management?view=Volunteers");
        }else{
            $user->delete();
            return redirect("/user-management?view=Partner");
        }
    }
}

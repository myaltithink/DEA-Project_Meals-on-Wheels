<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class UserManagement extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

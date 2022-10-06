<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MealProposalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('anyrole:ROLE_VOLUNTEER_COOK,ROLE_PARTNER');
    }
    //viewing meal proposal lists page
    public function index(){
        return view('MealManagement.MealProposal.MealProposalContents.meal-proposal-list');
    }

    //for viewing meal proposal information
    public function show(){

    }

    //viewing meal proposal add page
    public function create(){
        return view('MealManagement.MealProposal.MealProposalContents.add-meal-proposal');
    }

    public function store(){

    }

    //viewing edit page for meal proposal.
    public function edit(){
        return view('MealManagement.MealProposal.MealProposalContents.edit-meal-proposal');
    }

}


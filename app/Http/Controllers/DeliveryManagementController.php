<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller for
 */
class DeliveryManagementController extends Controller
{

    //rendering meals list all roles GET
    public function meals(){
        return view('MealManagement.DeliveryManagement.meals-available');
    }

    //rendering order page all roles GET
    public function index(){
        return view('');
    }


    //for members/caregivers to order food POST
    public function orderForMeal(){

    }

    //for volunteers/parnters to update status to prepared PATCH
    public function updateOrderToPrepared(){

    }

    //for volunteers/partners to update status to packed PATCH
    public function updateOrderToPacked(){

    }

    //for partners to assign delivery personel to meal PUT
    public function assignDeliverToMeal(){

    }

    //for volunteers with rider role/partners to update status to delivered PATCH
    public function updateOrderToDelivered(){

    }

    //admin assigns partner/volunteer to prepare meal PUT
    public function assignMealToPrepare(){


    }

    //admin assigns volunteer_rider to deliver meal PUT
    public function assignDeliverMealTo(){

    }
}

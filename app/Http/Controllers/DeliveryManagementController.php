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

    //rendering order page for member and caretaker GET
    public function ordersForMemberCareTaker(){
        return view('MealManagement.DeliveryManagement.OrdersListContents.mc-order');
    }

    //rendering order page for member and caretaker GET
    public function ordersForVolunteerPartnerForPreparation(){
        return view('MealManagement.DeliveryManagement.OrdersListContents.vp-order-prepare');
    }

    //rendering order page for volunteer and partner for packing GET
    public function ordersForVolunteerPartnerForPacking(){
        return view('MealManagement.DeliveryManagement.OrdersListContents.vp-order-pack');
    }

    //render order page for rider, partner for delivery GET
    public function ordersForRiderPartnerDelivery(){
        return view('MealManagement.DeliveryManagement.OrdersListContents.rp-order');
    }

    //rendering order page for admin for assigning orders to partner and volunteer GET
    public function ordersForAdminAssignVP(){
        return view('MealManagement.DeliveryManagement.OrdersListContents.a-order-prep');
    }

    //rendering order page for admin assigning orders to riders GET
    public function ordersForAdminAssignR(){
        return view('MealManagement.DeliveryManagement.OrdersListContents.a-order-deliver');
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

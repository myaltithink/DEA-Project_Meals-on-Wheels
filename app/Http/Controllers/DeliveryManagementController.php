<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MealPlan;
use App\Models\MealOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PartnerDetails;
use App\Models\Profile;
use App\Models\VolunteerDetails;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

/**
 * Controller for
 */
class DeliveryManagementController extends Controller
{

    //rendering meals list all roles GET
    public function meals(Request $request){
        $plans = MealPlan::where('status','Approved')->get();
        $hasOrdered = $request->user()->hasAnyRole(['ROLE_CARETAKER', 'ROLE_MEMBER']) ? MealOrder::where('ordered_by_id', $request->user()->user_id)
            ->whereDate('meal_order_ordered_at', date('Y-m-d'))->first() != null : null;
        return view('MealManagement.DeliveryManagement.meals-available')->with('plans', $plans)->with('hasOrdered', $hasOrdered);
    }

    //rendering order page for member and caretaker GET
    public function ordersForMemberCareTaker(Request $request){
        $mealOrders = MealOrder::where('ordered_by_id', $request->user()->user_id)->latest('meal_order_ordered_at')->get();
        return view('MealManagement.DeliveryManagement.OrdersListContents.mc-order')->with('orders', $mealOrders);
    }

    //rendering order page for member and caretaker GET
    public function ordersForVolunteerPartnerForPreparation(Request $request){
        $mealOrders = MealOrder::where('prepared_by_id', $request->user()->user_id)->where('meal_order_status','Preparing')->get();
        return view('MealManagement.DeliveryManagement.OrdersListContents.vp-order-prepare')->with('orders', $mealOrders);
    }

    //rendering order page for volunteer and partner for packing GET
    public function ordersForVolunteerPartnerForPacking(Request $request){
        $mealOrders = MealOrder::where('prepared_by_id', $request->user()->user_id)->where('meal_order_status','Packing')->get();
        return view('MealManagement.DeliveryManagement.OrdersListContents.vp-order-pack')->with('orders', $mealOrders);
    }

    //render order page for rider, partner for delivery GET
    public function ordersForRiderPartnerDelivery(Request $request){

        $mealOrders = MealOrder::where('delivered_by_id', $request->user()->user_id)->where('meal_order_status', 'Delivering')->get();

        return view('MealManagement.DeliveryManagement.OrdersListContents.rp-order')->with('orders', $mealOrders);
    }

    //rendering order page for admin for assigning orders to partner and volunteer GET
    public function ordersForAdminAssignVP(){
        $pendingOrders = MealOrder::where('meal_order_status', 'pending')->get();

        return view('MealManagement.DeliveryManagement.OrdersListContents.a-order-prep')
            ->with('pendingOrders', $pendingOrders);
    }

    //rendering order page for admin assigning orders to riders GET
    public function ordersForAdminAssignR(){
        $pendingOrders = MealOrder::where('meal_order_status', 'packed')->where('prepared_by_role','ROLE_VOLUNTEER')->get();
        $assignTo = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_VOLUNTEER_RIDER');
        })->get();

        return view('MealManagement.DeliveryManagement.OrdersListContents.a-order-deliver')
        ->with('pendingOrders', $pendingOrders)
        ->with('personels', $assignTo);
    }

    //for members/caregivers to order food POST
    public function orderForMeal(Request $request){
        Validator::make($request->all(), [
            'select-meal' => ['required']
        ])->validate();

        $user = $request->user();
        $userHadOrdered = MealOrder::where('ordered_by_id', $user->user_id)->whereDate('meal_order_ordered_at', date('Y-m-d'))->first() != null;
        $userProfile = $user->hasPermission('ROLE_CARETAKER') ? $user->caregiver_details->profile : $user->member_details->profile;

        if($userHadOrdered) return abort(403, 'The user can only order meal once per day');

        $data = array(
            'meal_plan_id' => $request['select-meal'],
            'meal_order_status' => 'pending',
            'ordered_by_id' => $user->user_id,
            'meal_order_ordered_at' => date('Y-m-d H:i:s'),
            'ordered_by' => $userProfile->first_name." ".$userProfile->last_name,
            'ordered_by_role' => $user->hasPermission('ROLE_CARETAKER') ? 'ROLE_CARETAKER' : 'ROLE_MEMBER',
            'ordered_by_address' => $userProfile->address,
        );

        $meal = new MealOrder();
        $meal->fill($data)->save();

        return redirect(route('mc-orders'));
    }

    //for volunteers/parnters to update status to prepared PATCH
    public function updateOrderToPrepared(MealOrder $mealOrder){

        $distance = calculateDistance($mealOrder->ordered_by_id, $mealOrder->prepared_by_id);
        $mealOrder->update([
            'meal_order_status' => 'Packing',
            'meal_order_type' =>  date('N') < 5 ? 'FROZEN' : ($distance > 10 ? 'FROZEN' :'HOT'),
        ]);

        return redirect(route('vp-pack-orders'));
    }

    //for volunteers/partners to update status to packed PATCH
    public function updateOrderToPacked(Request $request, MealOrder $mealOrder){

        if ($request->user()->hasPermission('ROLE_VOLUNTEER_COOK')){
            $mealOrder->update([
                'meal_order_status' => 'Packed',
            ]);
        }

        return redirect(route('vp-pack-orders'));
    }

    //for partners to assign delivery personel to meal PUT
    public function assignDeliverToMeal(Request $request){
        Validator::make($request->all(), [
            'selected-person' => ['required', 'string'],
            'selected-order' => ['required']
        ])->validate();

        $order = MealOrder::find((int) $request['selected-order']);

        $order->update([
            'delivered_by_id' => $request->user()->user_id,
            'delivered_by' => $request['selected-person'],
            'meal_order_status' => 'Delivering',
        ]);

        return redirect(route('rp-del-orders'));
    }

    //for volunteers with rider role/partners to update status to delivered PATCH
    public function updateOrderToDelivered(MealOrder $mealOrder){
        $mealOrder->update([
            'meal_order_delivered_at' => date('Y-m-d H:i:s'),
            'meal_order_status' => 'Delivered',
        ]);

        return redirect(route('rp-del-orders'));
    }

    //admin assigns partner/volunteer to prepare meal PUT
    public function assignMealToPrepare(Request $request){
        Validator::make($request->all(), [
            'selected-order' => ['required'],
            'selected-person' => ['required']
        ])->validate();

        $assignToUser = User::find((int) $request['selected-person']);
        $userDetails = $assignToUser->hasPermission('ROLE_VOLUNTEER') ? VolunteerDetails::where('user_id', $assignToUser->user_id)->first() : PartnerDetails::where('user_id', $assignToUser->user_id)->first();
        $volunteerProfile = $assignToUser->hasPermission('ROLE_VOLUNTEER') ? Profile::whereHas('volunteer_details', function(Builder $query) use ($userDetails){
            $query->where('volunteer_id', $userDetails->volunteer_id);
        })->first() : null;


        $order = MealOrder::find((int) $request['selected-order']);

        $order->update([
            'meal_order_status' => 'Preparing',
            'prepared_by_id' => $assignToUser->user_id,
            'prepared_by' => ($assignToUser->hasPermission('ROLE_VOLUNTEER') ? $assignToUser->volunteer_details->volunteer_name : $assignToUser->partner_details->partner_name),
            'prepared_by_role' => ($assignToUser->hasPermission('ROLE_VOLUNTEER_COOK') ? 'ROLE_VOLUNTEER' : 'ROLE_PARTNER'),
            'prepared_by_address' => $volunteerProfile != null ? $volunteerProfile->address : $assignToUser->partner_details->partner_address,
            #'meal_order_distance' => calculateDistance($orderedBy->longtitude, $orderedBy->latitude, $assignToUser->longtitude, $assignToUser->latitude),
        ]);

        return redirect(route('a-prep-orders'));
    }

    //admin assigns volunteer_rider to deliver meal PUT
    public function assignDeliverMealTo(Request $request){

        Validator::make($request->all(), [
            'selected-order' => ['required'],
            'selected-person' => ['required']
        ])->validate();

        $assignToUser = User::find((int) $request['selected-person']);
        $order = MealOrder::find((int) $request['selected-order']);

        $order->update([
            'delivered_by_id' => $assignToUser->user_id,
            'delivered_by' => $assignToUser->volunteer_details->volunteer_name,
            'meal_order_status' => 'Delivering',
        ]);

        return redirect(route('a-del-orders'));
    }

    //return a json response for list of volunteer/partner available with the calculated distance
    public function availableVolunteerAndPartner(MealOrder $mealOrder){
        #$orderedBy = User::find($mealOrder->ordered_by_id);
        $assignTo = User::whereHas('roles', function(Builder $query){
            $query->where('role_name','ROLE_PARTNER')->orWhere('role_name','ROLE_VOLUNTEER_COOK');
        })->get();

        foreach ($assignTo as $user){
            $user['role'] = $user->hasPermission('ROLE_VOLUNTEER') ? 'ROLE_VOLUNTEER' : 'ROLE_PARTNER';
            $user['details'] = $user->hasPermission('ROLE_VOLUNTEER') ? $user->volunteer_details : $user->partner_details ;
            $user['distance'] = calculateDistance($mealOrder->ordered_by_id, $user->user_id);
        }

        return response()->json($assignTo, 200);
    }
}

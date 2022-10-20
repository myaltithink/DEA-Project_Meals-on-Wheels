<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DeliveryManagementController;
use App\Http\Controllers\MealProposalController;
use App\Http\Controllers\UserAssesmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('index');
    })->name('home');

    Route::get('register-member', function () {
        return view('registration.member');
    })->name('registration.member');

    Route::get('register-volunteer', function () {
        return view('registration.volunteer');
    })->name('registration.volunteer');

    Route::get('register-partner', function () {
        return view('registration.partner');
    })->name('registration.partner');

    Route::get('register-caregiver', function () {
        return view('registration.caregiver');
    })->name('registration.caregiver');

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/email-verification', function () {
        return view('registration.email_verification');
    })->name('email_verification');

    Route::get('/forgot-password', function () {
        return view('registration.forgot_pass');
    })->name('forgot_password');

    Route::get('/new-password', function () {
        return view('registration.new_password');
    })->name('new_password');

    Route::get('/registered', function () {
        return view('registration.action_done');
    })->name('registered');

    Route::get('/password-changed', function () {
        return view('registration.action_done');
    })->name('password_changed');

    Route::post('/reset-password', [AuthenticationController::class, 'reset_password'])->name('reset.password');

    Route::get('/resend-code/{to}', [AuthenticationController::class, 'resend_code'])->name('resend.code');

    Route::post('/create-forgot-pass', [AuthenticationController::class, 'create_forgot_pass'])->name('create.forgot.pass');

    Route::post('/perform-login', [AuthenticationController::class, 'login'])->name('login.user');

    Route::post('/member-registration', [AuthenticationController::class, 'member_registration'])->name('register.member');

    Route::post('/caregiver-registration', [AuthenticationController::class, 'caregiver_registration'])->name('register.caregiver');

    Route::post('/partner-registration', [AuthenticationController::class, 'partner_registration'])->name('register.partner');

    Route::post('/volunteer-registration', [AuthenticationController::class, 'volunteer_registration'])->name('register.volunteer');

    Route::post('/verify-registration', [AuthenticationController::class, 'register_verification'])->name('verify.register');

    Route::post('/verify-forgot-pass', [AuthenticationController::class, 'forgot_pass_verification'])->name('verify.forgot_pass');
});

Route::get('/terms-and-condition', function () {
    return view('terms_and_condition');
})->name('terms_and_condition');

Route::get('/contact-us', function () {
    return view('contact_us');
})->name('contact_us');

Route::post('/send-message', function (Request $request) {
    $message =
        '====================
' .
        $request['email'] . ' sent a message


MESSAGE:
' . $request['message'] .
        '
====================';

    $data = [
        'text' => $message
    ];

    $url = 'https://hooks.slack.com/services/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';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: application/json']);

    curl_exec($curl);

    return redirect(route('contact_us'));
})->name('send.message');


Route::get('/logout', ['middleware' => 'auth', AuthenticationController::class, 'logout']);

Route::get('/dashboard', ['middleware' => 'auth', function () {
    return view('dashboard');
}])->name('dashboard');

Route::get('/create-test-data', [AuthenticationController::class, 'create_auth_test_data']);

//meal management module for meal proposal
Route::group(
    [],
    function () {

        //get mappings
        Route::get('/proposal-list', [MealProposalController::class, 'index'])
            ->name('my-proposal-list');

        Route::get('/create-proposal', [MealProposalController::class, 'create'])
            ->name('add-meal-proposal');

        Route::get('/edit-proposal/{mealPlan}', [MealProposalController::class, 'edit'])
            ->name('edit-meal-proposal');

        Route::get('/view-proposal/{mealPlan}', [MealProposalController::class, 'show'])
            ->name('view-meal-proposal');

        //post mapping
        Route::post('/create-meal-proposal', [MealProposalController::class, 'store'])
            ->name('add-meal');

        //put mapping
        Route::put('/edit-meal/{mealPlan}', [MealProposalController::class, 'update'])
            ->name('edit-meal');

        //delete mapping
        Route::delete('/delete-meal-proposal/{mealPlan}', [MealProposalController::class, 'destroy'])
            ->name('delete-meal');
    }
);

//delivery management system
Route::group(
    [
        'middleware' =>
        [
            'auth'
        ],
    ],
    function () {

        //rendering meals list for all roles
        Route::get('/meals', [DeliveryManagementController::class, 'meals'])
            ->name('meals-list');

        //rendering order page for member and caretaker
        Route::get('/my-orders', [DeliveryManagementController::class, 'ordersForMemberCareTaker'])
            ->name('mc-orders')
            ->middleware(['anyrole:ROLE_CAREGIVER,ROLE_MEMBER']);

        //rendering order page for partner and volunteer for preparation
        Route::get('/to-prepare-orders', [DeliveryManagementController::class, 'ordersForVolunteerPartnerForPreparation'])
            ->name('vp-prep-orders')
            ->middleware(['anyrole:ROLE_VOLUNTEER_COOK,ROLE_PARTNER']);

        //rendering order page for partner and volunteer for packing
        Route::get('/to-pack-orders', [DeliveryManagementController::class, 'ordersForVolunteerPartnerForPacking'])
            ->name('vp-pack-orders')
            ->middleware(['anyrole:ROLE_VOLUNTEER_COOK,ROLE_PARTNER']);

        //rendering order page for riders and parnters for delivery
        Route::get('/to-deliver-orders', [DeliveryManagementController::class, 'ordersForRiderPartnerDelivery'])
            ->name('rp-del-orders')
            ->middleware(['anyrole:ROLE_VOLUNTEER_RIDER,ROLE_PARTNER']);

        //rendering order page for assigning meal to partner/volunteer for admin
        Route::get('/assign-orders', [DeliveryManagementController::class, 'ordersForAdminAssignVP'])
            ->name('a-prep-orders')
            ->middleware(['authorizerole:ROLE_ADMIN']);

        //rendering order page for assigning meal to partner/volunteer for admin
        Route::get('/assign-orders-delivery', [DeliveryManagementController::class, 'ordersForAdminAssignR'])
            ->name('a-del-orders')
            ->middleware(['authorizerole:ROLE_ADMIN']);

        //post process for creating new meal post
        Route::post('/new-order', [DeliveryManagementController::class, 'orderForMeal'])
            ->name('new-order')
            ->middleware(['anyrole:ROLE_CAREGIVER,ROLE_MEMBER']);

        //patch process for updating status from preparing to packing
        Route::patch('/update-order-prepared/{mealOrder}', [DeliveryManagementController::class, 'updateOrderToPrepared'])
            ->name('prepared')
            ->middleware(['anyrole:ROLE_VOLUNTEER_COOK,ROLE_PARTNER']);

        //patch process to update status from packing to delivering
        Route::patch('/update-order-packed/{mealOrder}', [DeliveryManagementController::class, 'updateOrderToPacked'])
            ->name('packed')
            ->middleware(['authorizerole:ROLE_VOLUNTEER_COOK']);

        //patch process to assing
        Route::patch('/update-order-packed', [DeliveryManagementController::class, 'assignDeliverToMeal'])
            ->name('packed-and-assign-delivery')
            ->middleware(['authorizerole:ROLE_PARTNER']);

        //put process to assign partner or volunteer for preparing the order (pending to preparing)
        Route::put('/assign-meal', [DeliveryManagementController::class, 'assignMealToPrepare'])
            ->name('assign-meal-preparation')
            ->middleware(['authorizerole:ROLE_ADMIN']);

        //put process for assigning meal delivery (admin assign for volunteer if volunteer prepares, otherwise partner assign their own personnels)
        Route::put('/assign-meal-delivery', [DeliveryManagementController::class, 'assignDeliverMealTo'])
            ->name('assign-meal-delivery')
            ->middleware(['anyrole:ROLE_ADMIN,ROLE_PARNTER']);

        //patch method to update status from delivering to delivered.
        Route::patch('/update-order-delivered/{mealOrder}', [DeliveryManagementController::class, 'updateOrderToDelivered'])
            ->name('delivered')
            ->middleware(['anyrole:ROLE_VOLUNTEER_RIDER,ROLE_PARTNER']);

        //for ajax call retrieving list of available users
        Route::get('/get-available-users/{mealOrder}', [DeliveryManagementController::class, 'availableVolunteerAndPartner'])
            ->name('partners-and-volunteers')
            ->middleware(['authorizerole:ROLE_ADMIN']);
    }
);

//Food Safety Management Page - list of all pending meal plan proposals
Route::get('/food-safety-management', [MealProposalController::class, 'pendingProposals'])
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Page for viewing a specific meal proposal to approve or reject
Route::get('/view-meal-proposal/{mealPlan}', [MealProposalController::class, 'showProposal'])
    ->name('meal-proposal-approval')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Approve meal
Route::post('/approve-meal-proposal', [MealProposalController::class, 'approveMealProposal'])
    ->name('approve-meal-proposal')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Reject meal
Route::post('/reject-meal-proposal', [MealProposalController::class, 'rejectMealProposal'])
    ->name('reject-meal-proposal')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//List of all pending members to approve or reject with verified email
Route::get('/member-eligibility-assessment', [UserAssesmentController::class, 'pendingMembers'])
    ->name('member-assessment')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Page for viewing a specific member to approve or reject
Route::get('/view-member/{email}', [UserAssesmentController::class, 'viewPendingMember'])
    ->name('view-member')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Approve member
Route::post('/approve-member', [UserAssesmentController::class, 'approvePendingMember'])
    ->name('approve-member')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Reject member
Route::post('/reject-member', [UserAssesmentController::class, 'rejectPendingMember'])
    ->name('reject-member')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//List of all pending caregivers to approve or reject with verified email
Route::get('/caregiver-eligibility-assessment', [UserAssesmentController::class, 'pendingCaregivers'])
    ->name('caregiver-assessment')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Page for viewing a specific caregiver to approve or reject
Route::get('/view-caregiver/{email}', [UserAssesmentController::class, 'viewPendingCaregiver'])
    ->name('view-caregiver')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Approve caregiver
Route::post('/approve-caregiver', [UserAssesmentController::class, 'approvePendingCaregiver'])
    ->name('approve-caregiver')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Reject caregiver
Route::post('/reject-caregiver', [UserAssesmentController::class, 'rejectPendingCaregiver'])
    ->name('reject-caregiver')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//List of all pending partners to approve or reject with verified email
Route::get('/partner-eligibility-assessment', [UserAssesmentController::class, 'pendingPartners'])
    ->name('partner-assessment')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Page for viewing a specific partner to approve or reject
Route::get('/view-partner/{email}', [UserAssesmentController::class, 'viewPendingPartner'])
    ->name('view-partner')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Approve partner
Route::post('/approve-partner', [UserAssesmentController::class, 'approvePendingPartner'])
    ->name('approve-partner')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Reject partner
Route::post('/reject-partner', [UserAssesmentController::class, 'rejectPendingPartner'])
    ->name('reject-partner')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//List of all pending volunteers to approve or reject with verified email
Route::get('/volunteer-eligibility-assessment', [UserAssesmentController::class, 'pendingVolunteers'])
    ->name('volunteer-assessment')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Page for viewing a specific volunteer to approve or reject
Route::get('/view-volunteer/{email}', [UserAssesmentController::class, 'viewPendingVolunteer'])
    ->name('view-volunteer')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Approve volunteer
Route::post('/approve-volunteer', [UserAssesmentController::class, 'approvePendingVolunteer'])
    ->name('approve-volunteer')
    ->middleware(['authorizerole:ROLE_ADMIN']);

//Reject volunteer
Route::post('/reject-volunteer', [UserAssesmentController::class, 'rejectPendingVolunteer'])
    ->name('reject-volunteer')
    ->middleware(['authorizerole:ROLE_ADMIN']);

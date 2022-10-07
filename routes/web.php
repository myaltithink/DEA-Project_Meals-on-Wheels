<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DeliveryManagementController;
use App\Http\Controllers\MealProposalController;
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

Route::get('/', function () {
    return view('index');
})->name('home');

// Route::get('/register', function () {
//     return view('register');
// });

//better if closure is assigned to controllers even the get method
Route::group(['prefix' => '/register', 'middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('registration.member');
    });
    Route::get('member', function () {
        return view('registration.member');
    });
    Route::get('volunteer', function () {
        return view('registration.volunteer');
    });
    Route::get('partner', function () {
        return view('registration.partner');
    });
    Route::get('caregiver', function () {
        return view('registration.caregiver');
    });
});

Route::get('/login', function () {
    return view('login');
})->middleware(['guest'])->name('login');

Route::get('/logout', ['middleware' => 'auth', AuthenticationController::class, 'logout']);

Route::get('/dashboard', ['middleware' => 'auth', function () {
    return view('dashboard');
}])->name('dashboard');

Route::get('/create-test-data', [AuthenticationController::class, 'create_auth_test_data']);

Route::post('/perform-login', [AuthenticationController::class, 'login'])->name('login.user')->middleware(['guest']);

Route::post('/register-user', [AuthenticationController::class, 'register'])->name('register.member')->middleware(['guest']);

//meal management module for meal proposal
Route::group(
    [],
    function() {

        //get mappings
        Route::get('/proposal-list', [MealProposalController::class, 'index'])
            ->name('my-proposal-list');
        Route::get('/create-proposal', [MealProposalController::class, 'create'])
            ->name('add-meal-proposal');
        Route::get('/edit-proposal/{mealPlan}', [MealProposalController::class, 'edit'])
            ->name('edit-meal-proposal');
        Route::get('/view-proposal/{mealPlan}',[MealProposalController::class, 'show'])
            ->name('view-meal-proposal');
        //sample data
        Route::get('/sample-meal-data',[MealProposalController::class, 'testMealPlanData']);

        //post mapping
        Route::post('/create-meal-proposal', [MealProposalController::class, 'store'])
            ->name('add-meal');
        //put mapping
        Route::put('/edit-meal/{mealPlan}',[MealProposalController::class, 'update'])
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
    function(){

        //rendering meals list for all roles
        Route::get('/meals', [DeliveryManagementController::class, 'meals'])
            ->name('meals-list');

        //rendering order page for all roles
        Route::get('/orders', [DeliveryManagementController::class, 'index'])
               ->name('orders');

        //patch process for updating status from preparing to packing
        Route::patch('/update-order-prepared', [DeliveryManagementController::class, 'updateOrderToPrepared'])
            ->name('prepared')
            ->middleware(['anyrole:ROLE_VOLUNTEER_COOK,ROLE_PARTNER']);

        //patch process to update status from packing to delivering
        Route::patch('/update-order-packed', [DeliveryManagementController::class, 'updateOrderToPacked'])
            ->name('packed')
            ->middleware(['anyrole:ROLE_VOLUNTEER_COOK,ROLE_PARTNER']);

        //put process to assign partner or volunteer for preparing the order (pending to preparing)
        Route::put('/assign-meal', [DeliveryManagementController::class, 'assignMealToPrepare'])
            ->name('assign-meal-preparation')
            ->middleware(['authorizerole:ROLE_ADMIN']);

        //put process for assigning meal delivery (admin assign for volunteer if volunteer prepares, otherwise partner assign their own personnels)
        Route::put('/assign-meal-delivery', [DeliveryManagementController::class, 'assignDeliverMealTo'])
            ->name('assign-meal-delivery')
            ->middleware(['anyrole:ROLE_ADMIN,ROLE_PARNTER']);

        //patch method to update status from delivering to delivered.
        Route::patch('/update-order-delivered', [DeliveryManagementController::class, 'updateOrderToDeliver'])
            ->name('delivered')
            ->middleware(['anyrole:ROLE_VOLUNTEER_RIDER,ROLE_PARTNER']);
    }
);

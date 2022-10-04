<?php

use App\Http\Controllers\AuthenticationController;
use App\Models\RegistrationData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/logout', ['middleware' => 'auth', AuthenticationController::class, 'logout']);

Route::get('/dashboard', ['middleware' => 'auth', function () {
    return view('dashboard');
}]);

Route::get('/create-test-data', [AuthenticationController::class, 'create_auth_test_data']);

Route::post('/perform-login', [AuthenticationController::class, 'login'])->name('login.user');

Route::post('/register-user', [AuthenticationController::class, 'register'])->name('register.member');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::middleware('auth:api')->get('/test', function (Request $request) {
    return 'test';
});

Route::group(['middleware' => 'auth:api'], function () {


    Route::get('/recalculate_all_user_periods', [App\Http\Controllers\Admin\PeriodsController::class, 'recalculate_all_user_periods'])->name('recalculate_all_user_periods');


    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\UsersController::class, 'index']);
        Route::post('/add', [\App\Http\Controllers\Admin\UsersController::class, 'add']);
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\UsersController::class, 'edit']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Admin\UsersController::class, 'delete']);
    });

    Route::get('/get_start_periods_data', [App\Http\Controllers\Admin\PeriodsController::class, 'get_start_periods_data'])->name('get_start_periods_data');

    Route::post('/create_periods/{user_id}', [App\Http\Controllers\Admin\PeriodsController::class, 'create_periods_for_users'])->name('create_periods_for_users');


    Route::get('/get_user_periods/{user_id}', [App\Http\Controllers\Admin\PeriodsController::class, 'get_user_periods'])->name('get_user_periods');

    Route::delete('/delete_user_period/{period_id}', [App\Http\Controllers\Admin\PeriodsController::class, 'delete_user_period'])->name('delete_user_period');


    Route::get('/get_all_payments', [App\Http\Controllers\Admin\UserPaymentsController::class, 'get_all_payments'])->name('get_all_payments');
    Route::post('/create_user_payment/{user_id}', [App\Http\Controllers\Admin\UserPaymentsController::class, 'create_user_payment'])->name('create_user_payment');
    Route::post('/update_user_payment/{payment_id}', [App\Http\Controllers\Admin\UserPaymentsController::class, 'update_user_payment'])->name('update_user_payment');
    Route::delete('/delete_user_payment/{payment_id}', [App\Http\Controllers\Admin\UserPaymentsController::class, 'delete_user_payment'])->name('delete_user_payment');



});



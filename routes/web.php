<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// set password
//Route::get('/set', [App\Http\Controllers\AdminController::class, 'set'])->name('set');

Route::get('/login', function () {
    return view('welcome');
})->name('login');


Route::group(['middleware' => 'auth:web'], function () {

    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/{any}', [App\Http\Controllers\AdminController::class, 'index'])->name('admin_any ')
    ->where('any', '.*');

    Route::get('/create_periods', [App\Http\Controllers\HomeController::class, 'create_periods'])->name('create_periods');

    Route::get('/recalculate_all_user_periods', [App\Http\Controllers\Admin\PeriodsController::class, 'recalculate_all_user_periods'])->name('recalculate_all_user_periods');

    Route::get('/user_admin', [App\Http\Controllers\UserAdmin\UserAdminController::class, 'index'])->name('user_admin');


//    Route::get('/', [App\Http\Controllers\UserAdmin\UserAdminController::class, 'index'])->name('user_admin');


    Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');;

});





Route::get('/', function () {
    return view('home');
});

Route::get('/{any}', function () {
    return view('home');
});



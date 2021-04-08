<?php

use Illuminate\Support\Facades\Route;


// FrontEnd Controller
use App\Http\Controllers\frontEnd\homeController;
use App\Http\Controllers\frontEnd\roomController;
use App\Http\Controllers\frontEnd\serviceController;
use App\Http\Controllers\frontEnd\blogController;
use App\Http\Controllers\frontEnd\contactController;
use App\Http\Controllers\frontEnd\bookingController;


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
// FrontEnd Controller
Route::prefix('')->group(function() {
    Route::resource('/',homeController::class)->only(['index', 'show']);;
   Route::resource('/room-list',roomController::class)->only(['index', 'show']);
    Route::resource('/service',serviceController::class)->only(['index', 'show']);
    Route::resource('/blog',blogController::class)->only(['index','show']);
    Route::resource('/contact',contactController::class)->only(['index', 'show']);
    Route::resource('/booking',bookingController::class)->only(['index','store', 'destroy'])->middleware('auth:web');
    Route::get('booking/add',[bookingController::class,'add'])->name('booking.add');

});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
//Admin



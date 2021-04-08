<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\serviceController;
use App\Http\Controllers\admin\blogController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\roomController;
use App\Http\Controllers\admin\tagController;
use App\Http\Controllers\admin\facilityController;
use App\Http\Controllers\admin\imagesController;
use App\Http\Controllers\admin\priceController;
use App\Http\Controllers\admin\facility_roomController;
use App\Http\Controllers\admin\tag_roomController;
use App\Http\Controllers\admin\bookingController;



// Admin Controller
Route::prefix('admin')->name('admin.')->group(function () {
         Route::view('/login','admins.login')->name('login');
         Route::post('/login',[AdminController::class,'store']);
         Route::middleware(['auth:admin'])->group(function (){
                Route::post('/logout',[AdminController::class,'destroy'])->name('logout');
                Route::get('/home',[AdminController::class,'index']);
                Route::resource('/category',categoryController::class);
                Route::resource('/room',roomController::class);
                Route::resource('/tag',tagController::class);
                Route::resource('/facility',facilityController::class);
                Route::resource('/image',imagesController::class);
                Route::resource('/price',priceController::class);
                Route::resource('/facility_room',facility_roomController::class);
                Route::resource('/tag_room',tag_roomController::class);
                Route::resource('/blog',blogController::class);
                Route::resource('/service',serviceController::class);
                Route::resource('/booking',bookingController::class)->only('index','show');

     });

});

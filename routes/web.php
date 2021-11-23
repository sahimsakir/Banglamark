<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\SubDivisionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubServiceController;
use App\Http\Controllers\PassChangeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DownloadController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('site.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::resource('/divisions',DivisionController::class);
    Route::resource('/sub-divisions',SubDivisionController::class);
    Route::resource('/services',ServiceController::class);
    Route::resource('/products',ProductController::class);
    Route::resource('/sub-services',SubServiceController::class);
    Route::resource('/partners',PartnerController::class);
    Route::get('/get_type',[SliderController::class,'get_type'])->name('get_type');
    Route::resource('/sliders',SliderController::class);
    Route::resource('/pages',PageController::class);
    Route::resource('/users',UserController::class)->middleware('admin');
    Route::resource('/change_password',PassChangeController::class);
    Route::resource('/videos',VideoController::class);
    Route::resource('/downloads',DownloadController::class);

    
});

Route::get('/',[SiteController::class,'index'])->name('index');
Route::get('/{division}',[SiteController::class,'division'])->name('division');
Route::get('/{division}/{sub_div}',[SiteController::class,'sub_div'])->name('sub.division');
Route::get('/{division}/{sub_div}/{id}',[SiteController::class,'product'])->name('product');





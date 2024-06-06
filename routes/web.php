<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\Service_CategoryController;
use App\Http\Controllers\Service_Sub_CategoryController;
use App\Http\Controllers\ServiceSubSubCategoryController;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DraftsController;
use App\Http\Controllers\StateController;
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

//Route::get('/home', function () {
//    return view('index');
//})->middleware('auth')->name('home');

//Route::get('/test', function () {
//    return view('test');
//});

Route::get('', function () {
    return view('customer');
})->name('customer-welcome');

require __DIR__ . '/auth.php';


Route::get('admin-login', function () {
    return view('auth.login');
})->name('admin-welcome');


Route::get('/get-states/{country_id}', [StateController::class, 'getStates']);
Route::get('/get-cities/{state_id}', [CityController::class, 'getCities']);


Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/home', fn()=>view('customer.index'))->name('customer-home');
    Route::resource('serviceCategories', Service_CategoryController::class);
    Route::resource('service_sub_categories', Service_Sub_CategoryController::class);
    Route::resource('serviceSubSubCategories', ServiceSubSubCategoryController::class);
    Route::resource('banks', BanksController::class);
    Route::resource('drafts', DraftsController::class);
    // Route::get('/customer', [CustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('/get-sub-categories/{categoryId}', [Service_Sub_CategoryController::class, 'getSubCategories']);
    Route::get('/get-subsub-categories/{subCategoryId}', [ServiceSubSubCategoryController::class, 'getSubSubCategories']);
    Route::get('/get-bank-data/{subCategoryId}',[BanksController::class, 'getBanksData']);

    // Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    // Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    // Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
    Route::get('profile',[AdminController::class, 'index'])->name('profile');
    // Route::get('/home', fn()=>view('index'))->name('home');
    Route::resource('serviceCategories', Service_CategoryController::class);
    Route::resource('service_sub_categories', Service_Sub_CategoryController::class);
    Route::resource('serviceSubSubCategories', ServiceSubSubCategoryController::class);
    Route::resource('banks', BanksController::class);
    Route::resource('drafts', DraftsController::class);
});
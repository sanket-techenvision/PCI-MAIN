<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\Service_CategoryController;
use App\Http\Controllers\Service_Sub_CategoryController;
use App\Http\Controllers\ServiceSubSubCategoryController;
use App\Http\Controllers\DraftsController;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CustomerDraftsController;
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

//*****************=============================================************************//
//**************************  Common Routes  **********************************************//
Route::get('', function () {
    return view('customer');
})->name('customer-welcome');
Route::get('aboutus', function () {
    return view('aboutus');
})->name('/');
Route::get('/get-states/{country_id}', [StateController::class, 'getStates']);
Route::get('/get-cities/{state_id}', [CityController::class, 'getCities']);


//*****************=============================================************************//
//**************************  Auth Routes  **********************************************//

require __DIR__ . '/auth.php';


//*****************=============================================************************//
//************************  Customer Routes  **********************************************//

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/customer-dashboard', [CustomerController::class, 'index'])->name('customer-dashboard');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('customer-profile');

    Route::resource('customer-drafts', CustomerDraftsController::class);
    Route::get('/get-sub-categories/{categoryId}', [Service_Sub_CategoryController::class, 'getSubCategories']);
    Route::get('/get-subsub-categories/{subCategoryId}', [ServiceSubSubCategoryController::class, 'getSubSubCategories']);
    Route::get('/get-bank-data/{subCategoryId}', [BanksController::class, 'getBanksData']);
    Route::post('/get-dynamic-form', [CustomerDraftsController::class, 'getDynamicForm']);
});


//****************************  Super Admin Routes  **********************************************//
//*****************=============================================************************//
Route::get('super-admin-login', function () {
    return redirect()->route('login');
})->name('super-admin-login');

Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/super-admin-dashboard', [SuperAdminController::class, 'index'])->name('super-admin-dashboard');
    Route::get('/super-admin-profile', [SuperAdminController::class, 'index'])->name('super-admin-profile');

    Route::resource('serviceCategories', Service_CategoryController::class);
    Route::resource('service_sub_categories', Service_Sub_CategoryController::class);
    Route::resource('serviceSubSubCategories', ServiceSubSubCategoryController::class);
    Route::resource('banks', BanksController::class);
    Route::resource('drafts', DraftsController::class);
});

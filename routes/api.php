<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\AuthController;

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
// route for api
Route::group(['middleware'=>['api','checkpassword','apilang']],function (){

    Route::post('index',[ CategoriesController::class, 'index'])->name('admin.languages.create');
    Route::post('getCategorybyId',[ CategoriesController::class, 'getCategorybyId']);

    /////////
    Route::group(['prefix'=>'admin'],function()
    {
        Route::get('login',[ AuthController::class, 'login']);

        Route::get('logout',[ AuthController::class, 'logout'])->middleware(['auth.guard:admin-api']);

    });

});


Route::group(['middleware'=>['api','checkpassword','apilang','CheckAdminToken:admin-api']],function (){

    Route::post('index',[ CategoriesController::class, 'index'])->name('admin.languages.create');
    Route::post('getCategorybyId',[ CategoriesController::class, 'getCategorybyId']);

});

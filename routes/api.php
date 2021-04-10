<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\User\UserController;

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

        Route::get('logout',[ AuthController::class, 'logout'])->middleware(['auth.guard:admin-api']); // معني يجب استخدام هذا الجارد انه هيبحث في تيبل معين

    });
    ///////////
    Route::group(['prefix'=>'user'],function()
    {
        Route::get('login',[ UserController::class, 'login']);

        Route::get('logout',[ UserController::class, 'logout'])->middleware(['auth.guard:admin-api']); // معني يجب استخدام هذا الجارد انه هيبحث في تيبل معين

    });
    // route for user

    route::group(['prefix'=>'user','middleware'=>'auth.guard:user-api'],function() // the middleware & guard here for user only can do this
    {
        route::post('profile',function()
        {return 'user can only ';}) ;
    });

});


Route::group(['middleware'=>['api','checkpassword','apilang','CheckAdminToken:admin-api']],function (){

    Route::post('index',[ CategoriesController::class, 'index'])->name('admin.languages.create');
    Route::post('getCategorybyId',[ CategoriesController::class, 'getCategorybyId']);

});

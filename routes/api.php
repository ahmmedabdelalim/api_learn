<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\AuthAdminController;
use App\Http\Controllers\Api\Admin\AgencysController;

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


Route::group(['middleware'=>['api','checkpassword']],function (){
    Route::group(['prefix'=>'admin'],function()
    {
        Route::post('login',[ AuthAdminController::class, 'login']);
        Route::post('register',[ AuthAdminController::class, 'register']);


         // معني يجب استخدام هذا الجارد انه هيبحث في تيبل معين
        Route::post('logout',[ AuthAdminController::class, 'logout']);//->middleware('auth.guard:admin-api');

        /////////

        Route::post('create',[AgencysController::class, 'create']);
    });

});

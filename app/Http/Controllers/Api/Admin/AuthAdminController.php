<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Traits\GeneralTraits;
use App\Models\Admin;
use App\Models\Agency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthAdminController extends Controller
{
    use GeneralTraits;

    public function login(Request $request)
    {
        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('admin-api')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $admin = Auth::guard('admin-api')->user();
            $admin->api_token = $token;
            //return token
            return $this->returnData('admin', $admin);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }



    }
    public function register(Request $request)
    {
        Admin::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request['password']),


        ]);
        return $this->login(request());
    }

    public function logout(Request $request)
    {
        $token = $request ->api_token ;
        if($token){
            try {

                JWTAuth::setToken($token)->invalidate(); //logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError('','some thing went wrongs');
            }
            return $this->returnSuccessMessage('Logged out successfully');
        }else{
            $this -> returnError('','some thing went wrongs');
        }

    }


    public function create(Request $request)
    {
        try{
       $agency= Agency::create([

            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request['password']),
        ]);
        return $this->returnData('Agancy', $agency);
        }
        catch(\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

}

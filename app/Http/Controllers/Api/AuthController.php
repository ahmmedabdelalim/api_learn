<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    use GeneralTraits;

    public function login (Request $request)
    {
        try{
            $rules = ['email'=>'required|exists:admins,email',
            'password'=>'required',
                        ];

    $validator = Validator::make($request->all(),$rules);

    if($validator ->fails())
    {
    $code = $this->returnCodeAccordingToInput($validator);
    return $this->returnValidationError($code, $validator);
    }

    $cardi = $request->only(['email','password']);

    $token=Auth::guard('admin-api')->attempt($cardi);

    if(!$token)
    {
    return $this->returnError('E001','the token is faild');
    }

    $admin = Auth::guard('admin-api')->user();
    $admin->api_token = $token;
    //return token
    return $this->returnData('admin', $admin,'operation successd');

    }
    catch(\Exception $ex)
    {
        return $this->returnError($ex->getCode(), $ex->getMessage());

    }


    }


    ////////// logout method

    public function logout(Request $request)
    {
        $token = $request ->auth_token ;
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

}

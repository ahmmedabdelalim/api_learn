<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgencyRequest;
use Illuminate\Http\Request;

use App\Http\Traits\GeneralTraits;
use App\Models\Admin;
use App\Models\Agency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AgencysController extends Controller
{
    use GeneralTraits;




    public function create(AgencyRequest $request)
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

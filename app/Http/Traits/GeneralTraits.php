<?php

namespace App\Http\Traits;

trait GeneralTraits
{
    //////// if not found item return errpr
    public function returnError($errNum, $msg)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'message' => $msg
        ]);
    }

    /////////// to return date in one form

    public function returnData($key, $value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => "S000",
            'messag' => $msg,
            $key => $value
        ]);
    }

    ///////// success message
    public function returnSuccessMessage($msg = "", $errNum = "S000")
    {
        return [
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg
        ];
    }
}

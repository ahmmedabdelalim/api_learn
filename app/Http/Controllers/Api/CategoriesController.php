<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTraits;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    use GeneralTraits;
    //
    public function index()
    {
        $categories=Category::selection() ->get();

        return $this->returnData('category',$categories);
    }

    public function getCategorybyId(Request $request)
    {
        $category=Category::selection() ->find($request->id);

        if (! $category)
        {
           return $this -> returnError('001','this item not exist');
        }

        else {
            return $this->returnData('category',$category,'the process is succssed');
        }

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function byCategory($categoryId){
       $category = Category::find($categoryId);
       if($category!=null)
       return $category->products()->where('available',1)->with('pictures')->with('colors')->with('sizes')->get();
       else return 0;
    }
}

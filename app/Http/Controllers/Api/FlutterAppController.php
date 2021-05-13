<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class FlutterAppController extends Controller
{

    public function categories(){
        return Category::all();
    }

    public function sizes(){
        return Size::all();
    }

    public function colors(){
        return Color::all();
    }
}

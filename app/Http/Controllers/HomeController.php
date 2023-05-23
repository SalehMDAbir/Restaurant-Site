<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index(){
        // $slider = Slider::all();
        $sliders = Slider::all();
        return view('welcome',compact("sliders"));
    }
}

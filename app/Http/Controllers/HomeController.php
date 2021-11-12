<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{

    public function index(Request $request){

        $sliders = Slider::latest()->get(); 
        $categories = Category::where('parent_id',0)->get();
        $products = Product::latest()->take(6)->get();
        $productRecommend = Product::latest('views_count','desc')->take(12)->get();
        $categoriesLimit = Category::where('parent_id',0)->take(3)->get();
        if($request->status == 'success'){
            $request->session()->forget('cart');
        }
            
        return view('home.homepage',compact('sliders','categories','products','productRecommend','categoriesLimit'));
    }
    
}

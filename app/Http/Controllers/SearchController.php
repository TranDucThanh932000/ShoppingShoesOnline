<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use App\Traits\FullTextSearch;



class SearchController extends Controller
{

    public function searchProduct(Request $request){
        $text = $request->text;
        $categories = Category::where('parent_id',0)->get();
        $products = Product::where('name','like','%'.$text.'%')->latest()->paginate(6);
        $sliders = Slider::latest()->get(); 
        $categoriesLimit = Category::where('parent_id',0)->take(3)->get();

        return view('home.searchpage',compact('products','categories','sliders','categoriesLimit')); 
    }
}

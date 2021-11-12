<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Slider;
use App\Models\User;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function addToCart(Request $request){
        $cart = session()->get('cart');
        $product = Product::find($request->id);
        $size = 0;
        if($request->size == 0){
            $size = $product->productSizes()->where('quantity','!=', 0)->first()->size;
        }else{
            $size = $request->size;
        }
        if(isset($cart[$request->id.'-'.$size])){
            $cart[$request->id.'-'.$size]['quantity'] = $cart[$request->id.'-'.$size]['quantity'] + 1;
        }else{
            $cart[$request->id.'-'.$size] = [
                'name' => $product->name,
                'price' => $product->price,
                'image'=> $product->feature_image_path,
                'size' => $size,
                'quantity' => 1
            ];
        }
        session()->put('cart',$cart);
        return response()->json([
            'code'=>200,
            'message'=>'success'
        ],200);
    }

    public function showCart(){
        
        $categoriesLimit = Category::where('parent_id',0)->take(3)->get();
        $carts = session()->get('cart');
        return view('product.category.cart',compact('carts','categoriesLimit'));
    }
    public function deleteProductFromCart(Request $request){
        if($request->id){
            $carts = session()->get('cart');
            unset($carts[$request->id]);
            session()->put('cart',$carts);
            $carts = session()->get('cart');
            $cartComponent = view('product.components.cart_component',compact('carts'))->render();
            return response()->json([
                'cart_component' => $cartComponent,
                'code'=>200
            ],200);
        }
    }

    public function updateProductCart(Request $request){
        if($request->id && $request->quantity){
            $carts = session()->get('cart');
            $carts[$request->id]['quantity'] = $request->quantity;
            session()->put('cart',$carts);
            $carts = session()->get('cart');
            $cartComponent = view('product.components.cart_component',compact('carts'))->render();
            return response()->json([
                'cart_component' => $cartComponent,
                'code'=>200
            ],200);
        }
    }

    public function showProduct(Request $request){
        $id = $request->id;
        $product = Product::find($id);
        $product->update(['views_count' => $product->views_count + 1]);
        if($product){
            $sliders = Slider::latest()->get(); 
            $categories = Category::where('parent_id',0)->get();
            $categoriesLimit = Category::where('parent_id',0)->take(3)->get();
            $sizes = $product->productSizes()->select('size')->get();

            $product_image = $product->images()->get();
            return view('home.showproduct',compact('categories','categoriesLimit','product_image','product','sizes'));
        }else{
            echo '<h1>Không có sản phẩm này</h1>';
        }
    }

    public function getImages(Request $request){
        $product = Product::find($request->id);
        $images = [];
        $images[0] = $product->feature_image_path;
        $obj = $product->images()->get();
        for($i = 0;$i < count($obj) ; $i++){
            array_push($images,$obj[$i]->image_path);            
        }
        return response()->json($images);
    }

    public function addFeedback(Request $request){
        if(auth()->check()){
            $feedback = [
                'product_id' => $request->product_id,
                'user_id' => auth()->user()->id,
                'feedback' => $request->feedback,
                'star' => $request->star
            ];
            $data = Feedback::create($feedback);
            $user = auth()->user();
            
            DB::table('feedbacks')->where('user_id',$user->id)->where('product_id',$request->product_id)->update(['star' => $request->star]);

            $data['avatar'] = $user->avatar;
            $data['name'] = $user->name;
            return response()->json($data);
        }else{
            return redirect()->route('login');
        }
    }

    public function getFeedback(Request $request){
        $product = Product::find($request->id);
        $feedbacks = $product->feedbacks()->latest()->get();
        foreach($feedbacks as $fb){
            $user = User::find($fb['user_id']);
            $fb['name'] = $user->name;
            $fb['avatar'] = $user->avatar;
        }
        return response()->json($feedbacks);
    }

    public function getStar(Request $request){
        if(auth()->check()){
            $getStar =1;
            try{
                $getStar = DB::table('feedbacks')->where('user_id',auth()->user()->id)->where('product_id',$request->product_id)->first()->star;
            }catch(Exception $e){
                $getStar =1;
            }

            return $data = [
                'user' => auth()->user()->id,
                'star' => $getStar
            ];
        }
        return $data = [
            'user' => '',
            'star' => 1
        ];
    }
}

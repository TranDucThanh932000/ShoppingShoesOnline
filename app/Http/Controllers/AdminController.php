<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginAdmin(){
        if(auth()->check()){
            return redirect()->to('homeadmin'); 
        }else{
            $mess="";
            $id_product = null;
            return view('loginadmin',compact("mess","id_product"));
        }
    }

    public function postLoginAdmin(Request $request){
        $remember = $request->has('remember_me')? true : false;
        
        //su dung helper auth()
        if(auth()->attempt([
            'email'=> $request->email,
            'password' => $request->password,
        ],$remember)){
            $user = $request->email;
            $manage = auth()->user()->manage;
            session()->put('user',$user);
            if($request->id){
                return redirect()->route('showProduct',['id' => $request->id]); 
            }
            if($manage == 0){
                return redirect()->route('home.homepage');
            }else{
                return redirect()->to('homeadmin');
            }
        }else{
            $mess="Sai tài khoản hoặc mật khẩu";
            //
            $id_product = null;
            return view('loginadmin',compact("mess","id_product"));
        }
    }

    public function postLogoutAdmin(Request $request){
        auth()->logout();
        session()->forget('user');
        return redirect()->route('login');
    }

    public function loginShowCart(Request $request){
        if(auth()->check()){
            return redirect()->to('homeadmin'); 
        }else{
            $mess="";
            $id_product = null;
            return view('loginadmin',compact("mess","id_product"));
        }
    }

    public function postLoginShowCart(Request $request){
        $remember = $request->has('remember_me')? true : false;
        
        //su dung helper auth()
        if(auth()->attempt([
            'email'=> $request->email,
            'password' => $request->password,
        ],$remember)){
            $user = $request->email;
            $manage = auth()->user()->manage;
            session()->put('user',$user);
            return redirect()->route('showCart');
        }else{
            $mess="Sai tài khoản hoặc mật khẩu";
            $id_product = null;
            return view('loginadmin',compact("mess","id_product"));
        }
    }

    public function register(Request $request){
        return view('register')->with('mess','');
    }

    public function postRegister(Request $request){
        $user = [
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => 'https://icon-library.com/images/user-icon/user-icon-14.jpg'
        ];
        User::create($user);
        auth()->attempt([
            'email'=> $request->email,
            'password' => $request->password
        ],false);

        session()->put('user',$request->email);
        return redirect()->route('home.homepage');
    }

    public function checkEmail(Request $request){
        $email = User::whereEmail($request->email)->first();
        if($email){
            return response()->json([
                'status'=>'fail',
                'code' => 400
            ],200);
        }else{
            return response()->json([
                'status'=>'success',
                'code' => 200
            ],200);
        }
    }

    public function forgotPassword(){
        return view('forgot_password')->with('mess','');
    }
    
    public function postForgotPassword(){
        return view('forgot_password')->with('mess','Mật khẩu mới đã được gửi vào email của bạn');
    }

}

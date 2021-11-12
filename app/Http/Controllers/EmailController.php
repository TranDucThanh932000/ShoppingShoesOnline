<?php

namespace App\Http\Controllers;

use App\Mail\EmailShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Province;
use HoangPhi\VietnamMap\Models\Ward;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $email = $request->email;
        $user = User::where('email',$email)->first();
        $name = $user->name;
        $password = rand(100,999);
        Mail::to($email)->send(new MailNotify($name,$password));

        if (Mail::failures()) {
            dd('Error');
        } else {
            $user->update([
                'password' => Hash::make($password)
            ]);
            return redirect()->route('login');
        }
    }

    public function sendMailCart(Request $request){
        if(auth()->check()){
            $carts = session()->get('cart');
            $user = auth()->user();
            $name = $user->name;
            $address = [
                'province_id' => Province::find($request->province_id)->name,
                'district_id' => District::find($request->district_id)->name,
                'ward_id' => Ward::find($request->ward_id)->name,
                'detail' => $request->detail
            ];
            Mail::to($user->email)->send(new EmailShoppingCart($name,$carts,$address));
            if (Mail::failures()) {
                dd('Error');
            } else {
                return redirect()->route('home.homepage');
            }
        }else{
            return redirect()->route('login');
        }
    }
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\product;
use App\Models\Cart;
use Auth;

class HomeController extends Controller
{

    // product control in home page

    public function index()
    {
        $product = product::paginate(9);
        return view('Front.userpage', compact('product'));
    }

    // control to the user & the admin

    public function redirect()
    {
        $user_type = Auth::user()->usertype;

        if ($user_type == '1') {

            return view('Admin.home');
        } else {

            $product = product::paginate(9);
            return view('Front.userpage', compact('product'));
        }
    }


    // product detail methods

    public function detail($id)
    {
        $product = product::where('id', $id)->first();
        return view('Front.product_detail', compact('product'));
    }


    // cart methods

    public function add_cart(Request $request, $id)
    {

        if (Auth::id()) {

            // to check the user logged in

            $user = Auth::user();
            //dd($user);

            $product = product::where('id', $id)->first();
            //dd($product);

            $cart = new Cart();
            // user part
            $cart->name =  $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            // product part
            $cart->product_title = $product->title;

            // If there is a discount, it will come at the discount price, and if it is not at the original price
            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity ;
            }else{
                $cart->price = $product->price * $request->quantity;
            } // end if condition

            $cart->image = $product->image;
            $cart->product_id = $product->id;
            // cart part
            $cart->quantity = $request->quantity;
            $cart->save();

            return redirect()->back()->with('success', 'تم إضافة الصنف الي العربه بنجاح');
        } else {

            // In case he did not register
            return redirect()->route('login');
        }
    }
}

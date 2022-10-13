<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\product;
use App\Models\Cart;
use App\Models\Order;
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
                $cart->price = $product->discount_price * $request->quantity;
            } else {
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


    public function show_cart()
    { 
        if(Auth::id()){
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', $id)->get();
    
            return view('Front.show_cart', compact('cart'));
        }else{
            return redirect()->route('login');
        }
   
    }

    public function remove_cart($id)
    {
        $cart = Cart::where('id', $id)->first();
        $cart->delete();

        return redirect()->route('show_cart')->with('success', 'تم حذف الصنف من العربه بنجاح');
    }

     // order methods
    
     public function cash_order()
     {
        $user = Auth::user();
        $user_id = $user->id;
        $data = Cart::where('user_id', $user_id)->get();
        //dd($data);

        foreach($data as $data){
           $order = new Order();

           $order->name = $data->name;
           $order->email = $data->email;
           $order->phone = $data->phone;
           $order->address = $data->address;
           $order->product_title = $data->product_title;
           $order->quantity = $data->quantity;
           $order->price = $data->price;
           $order->image = $data->image;
           $order->product_id = $data->product_id;
           $order->user_id = $data->user_id;
           $order->payment_status = 'الدفع عند الاستلام';
           $order->delivery_status = 'يتم المعالجة';
           $order->save();
 
           // delete data from cart page after click cash on delivery button
           $cart_id = $data->id;
           $cart = Cart::find($cart_id);
           $cart->delete();
        }

        return redirect()->back()->with('success', '...سوف نتلقى طلبك. سنتواصل معك قريبا');

     }
}

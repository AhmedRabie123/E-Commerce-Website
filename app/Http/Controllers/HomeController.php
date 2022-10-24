<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\About;
use App\Models\Slider;
use Session;
use Stripe;
use Auth;


class HomeController extends Controller
{

    // product control in home page

    public function index()
    {
        $product = product::paginate(9);
        $comment = Comment::orderBy('id', 'desc')->get();
        $reply = Reply::all();
        return view('Front.userpage', compact('product', 'comment', 'reply'));
    }

    // control to the user & the admin

    public function redirect()
    {
        $user_type = Auth::user()->usertype;

        if ($user_type == '1') {
            $total_product = product::count();
            $total_order = Order::count();
            $total_user = User::count();
            $order = Order::all();
            $total_revenue = 0;

            foreach ($order as $order) {
                $total_revenue = $total_revenue + $order->price;
            }

            $total_delivery_status = Order::where('delivery_status', 'تم التوصيل')->get()->count();
            $total_processing_status = Order::where('delivery_status', 'يتم المعالجة')->get()->count();

            return view('Admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivery_status', 'total_processing_status'));
        } else {

            $product = product::paginate(9);
            $comment = Comment::orderBy('id', 'desc')->get();
            $reply = Reply::all();
            return view('Front.userpage', compact('product', 'comment', 'reply'));
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

            $user_id = $user->id;
            //dd($user_id);

            $product = product::where('id', $id)->first();
            //dd($product);

            $product_exiting_id = Cart::where('product_id', $id)->where('user_id', $user_id)->get('id')->first();
            //dd($product_exiting_id);

            if ($product_exiting_id) {

                $cart = Cart::find($product_exiting_id)->first();

                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;

                // If there is a discount, it will come at the discount price, and if it is not at the original price
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $cart->quantity;
                } else {
                    $cart->price = $product->price * $cart->quantity;
                } // end if condition

                $cart->save();
                
                Alert::success('تمت إضافة المنتج بنجاح','لقد أضفنا المنتج إلى عربة التسوق');
                // Alert::info('تمت إضافة المنتج بنجاح','لقد أضفنا المنتج إلى عربة التسوق');
                // Alert::warning('تمت إضافة المنتج بنجاح','لقد أضفنا المنتج إلى عربة التسوق');

                return redirect()->back();
            } else {
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
            }
        } else {

            // In case he did not register
            return redirect()->route('login');
        }
    }


    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', $id)->get();

            return view('Front.show_cart', compact('cart'));
        } else {
            return redirect()->route('login');
        }
    }


    public function remove_cart($id)
    {
        $cart = Cart::where('id', $id)->first();
        $cart->delete();

        Alert::success('تم حذف المنتج بنجاح','لقد حذفنا المنتج من عربة التسوق');

        return redirect()->back();
    }

    // order methods

    public function cash_order()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data = Cart::where('user_id', $user_id)->get();
        //dd($data);

        foreach ($data as $data) {
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

    // stripe methods

    public function stripe($total_price)
    {
        return view('Front.stripe', compact('total_price'));
    }

    public function stripePost(Request $request, $total_price)
    {
        // dd($total_price);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $total_price * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks For Payment."
        ]);


        $user = Auth::user();
        $user_id = $user->id;
        $data = Cart::where('user_id', $user_id)->get();
        //dd($data);

        foreach ($data as $data) {
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
            $order->payment_status = 'تم الدفع عن طريق البطاقة';
            $order->delivery_status = 'يتم المعالجة';
            $order->save();

            // delete data from cart page after click cash on delivery button
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }


        Session::flash('success', 'Payment successful!');

        return back();
    }


    // show order && cancel order method

    public function show_user_order()
    {
        if (Auth::id()) {


            $user = Auth::user();
            $user_id = $user->id;
            $order = Order::where('user_id', $user_id)->get();

            return view('Front.order', compact('order'));
        } else {
            return redirect()->route('login');
        }
    }

    public function cancel_order($id)
    {
        $order = Order::where('id', $id)->first();
        $order->delivery_status = 'قمت بإلغاء الطلب';
        $order->save();

        return redirect()->back()->with('success', 'قمت بإلغاء الطلب بنجاح');
    }

    // Comment && Reply method

    public function add_comment(Request $request)
    {
        if (Auth::id()) {

            $comment = new Comment();

            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();

            return redirect()->back()->with('success', 'قمت بأضافة التعليق بنجاح');
        } else {
            return redirect()->route('login');
        }
    }

    public function add_reply(Request $request)
    {
        if (Auth::id()) {

            $reply = new Reply();

            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();

            return redirect()->back()->with('success', 'قمت بأضافة الرد بنجاح');
        } else {
            return redirect()->route('login');
        }
    }

    public function search_product(Request $request)
    {

        $comment = Comment::orderBy('id', 'desc')->get();
        $reply = Reply::all();

        $search_text = $request->search;
        $product = product::where('title', 'LIKE' . "%$search_text%")->orWhere('description', 'LIKE', "%$search_text%")->orWhere('price', 'LIKE', "%$search_text%")->paginate(6);

        return view('Front.userpage', compact('product', 'comment', 'reply'));
    }

    public function all_product()
    {
        $product = product::paginate(9);
        $comment = Comment::orderBy('id', 'desc')->get();
        $reply = Reply::all();

        return view('Front.all_product', compact('product', 'comment', 'reply'));
    }

    public function product_search(Request $request)
    {

        $comment = Comment::orderBy('id', 'desc')->get();
        $reply = Reply::all();

        $search_text = $request->search;
        $product = product::where('title', 'LIKE' . "%$search_text%")->orWhere('description', 'LIKE', '%'. $search_text .'%')->orWhere('price', 'LIKE', "%$search_text%")->paginate(6);

        return view('Front.all_product', compact('product', 'comment', 'reply'));
    }


    public function about()
    {
        $about = About::where('id', '1')->first();
        return view('Front.about', compact('about'));
    }

    public function slider()
    {
        $slider = Slider::orderBy('id', 'desc')->get();
        return view('Front.userpage', compact('slider'));
    }

}

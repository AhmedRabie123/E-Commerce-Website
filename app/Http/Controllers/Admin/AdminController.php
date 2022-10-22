<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Order;
use App\Models\product;
use App\Models\User;
use App\Notifications\SendEmailNotification;
use Notification;
use PDF;
use Auth;

class AdminController extends Controller
{

    // admin home (dashboard)

    public function index()
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

    //category function

    public function show_category()
    {
        if (Auth::id()) {
            $categories = category::orderBy('id', 'desc')->get();
            return view('Admin.category', compact('categories'));
        } else {
            return redirect()->route('login');
        }
    }

    public function category_create()
    {
        if (Auth::id()) {
            return view('Admin.category_create');
        } else {
            return redirect()->route('login');
        }
    }

    public function category_store(Request $request)
    {
        if (Auth::id()) {
            $request->validate([
                'category_name' => 'required'
            ]);

            $category = new category();
            $category->category_name = $request->category_name;
            $category->save();

            return redirect()->route('category')->with('success', 'تم إضافة صنف جديد بنجاح');
        } else {
            return redirect()->route('login');
        }
    }

    public function category_edit($id)
    {
        if (Auth::id()) {
            $category_single = category::where('id', $id)->first();
            return view('Admin.category_edit', compact('category_single'));
        } else {
            return redirect()->route('login');
        }
    }

    public function category_update(Request $request, $id)
    {
        if (Auth::id()) {
            $request->validate([
                'category_name' => 'required'
            ]);

            $category = category::where('id', $id)->first();
            $category->category_name = $request->category_name;
            $category->update();

            return redirect()->route('category')->with('success', 'تم تعديل الصنف بنجاح');
        } else {
            return redirect()->route('login');
        }
    }

    public function category_delete($id)
    {

        if (Auth::id()) {
            $category_single = category::where('id', $id)->first();
            $category_single->delete();

            return redirect()->route('category')->with('success', 'تم حذف الصنف بنجاح');
        } else {
            return redirect()->route('login');
        }
    }

    public function show_product()
    {

        if (Auth::id()) {
            //product function

            $products = product::orderBy('id', 'desc')->get();
            return view('Admin.product', compact('products'));
        } else {
            return redirect()->route('login');
        }
    }

    public function product_create()
    {

        if (Auth::id()) {
            $categories = category::get();
            // $products = product::with('rCategory')->get();
            return view('Admin.product_create', compact('categories'));
        } else {
            return redirect()->route('login');
        }
    }

    public function product_store(Request $request)
    {

        if (Auth::id()) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes:jpg,png,gif,svg,jpeg',
                'category_id' => 'required',
                'quantity' => 'required',
                'price' => 'required'

            ]);

            $products = new product();

            $now = time();
            $ext = $request->file('image')->extension();
            $final_name = 'product_' . '.' . $now . '.' . $ext;
            $request->file('image')->move(public_path('images/'), $final_name);

            $products->image = $final_name;


            $products->title = $request->title;
            $products->description = $request->description;
            $products->category_id = $request->category_id;
            $products->quantity = $request->quantity;
            $products->price = $request->price;
            $products->discount_price = $request->discount_price;
            $products->save();

            return redirect()->route('product')->with('success', 'تم إضافة منتج جديد بنجاح');
        } else {
            return redirect()->route('login');
        }
    }

    public function product_edit($id)
    {
        if (Auth::id()) {
            $product_single = product::where('id', $id)->first();
            $categories = category::get();
            return view('Admin.product_edit', compact('product_single', 'categories'));
        } else {
            return redirect()->route('login');
        }
    }

    public function product_update(Request $request, $id)
    {

        if (Auth::id()) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'quantity' => 'required',
                'price' => 'required'

            ]);

            $product = product::where('id', $id)->first();


            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'image|mimes:jpg,png,gif,svg,jpeg',
                ]);

                unlink(public_path('images/' . $product->image));

                $now = time();
                $ext = $request->file('image')->extension();
                $final_name = 'product_' . '.' . $now . '.' . $ext;
                $request->file('image')->move(public_path('images/'), $final_name);

                $product->image = $final_name;
            }


            $product->title = $request->title;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->update();

            return redirect()->route('product')->with('success', 'تم تعديل المنتج بنجاح');
        } else {
            return redirect()->route('login');
        }
    }

    public function product_delete($id)
    {
        if (Auth::id()) {
            $product_single = product::where('id', $id)->first();
            unlink(public_path('images/' . $product_single->image));
            $product_single->delete();

            return redirect()->route('product')->with('success', 'تم حذف المنتج بنجاح');
        } else {
            return redirect()->route('login');
        }
    }

    // order method

    public function show_order()
    {
        if (Auth::id()) {
            $order = Order::orderBy('id', 'desc')->get();
            return view('Admin.order', compact('order'));
        } else {
            return redirect()->route('login');
        }
    }

    public function delivered($id)
    {
        if (Auth::id()) {
            $order = Order::where('id', $id)->first();
            $order->delivery_status = 'تم التوصيل';
            $order->payment_status = 'مدفوع';

            $order->save();

            return redirect()->back()->with('success', 'تم تعديل وضع التسليم بنجاح');
        } else {
            return redirect()->route('login');
        }
    }

    // order pdf method

    public function print_pdf($id)
    {
        if (Auth::id()) {
            $order = Order::where('id', $id)->first();
            $pdf = PDF::loadview('Admin.pdf', compact('order'));
            return $pdf->download('order_details.pdf');
        } else {
            return redirect()->route('login');
        }
    }

    public function send_email($id)
    {
        if (Auth::id()) {
            $order = Order::where('id', $id)->first();
            return view('Admin.email_info', compact('order'));
        } else {
            return redirect()->route('login');
        }
    }

    public function email_submit(Request $request, $id)
    {
        if (Auth::id()) {
            $order = Order::where('id', $id)->first();
            $details = [

                'greeting' => $request->subject,
                'firstline' => $request->firstline,
                'body' => $request->body,
                'button' => $request->button,
                'url' => $request->url,
                'lastline' => $request->lastline,

            ];

            Notification::Send($order, new SendEmailNotification($details));

            return redirect()->back()->with('success', 'تم إرسال البريد الالكتروني بنجاح');
        } else {
            return redirect()->route('login');
        }
    }

    public function search_order(Request $request)
    {
        if (Auth::id()) {
            $searchtext = $request->search;
            $order = Order::where('name', 'LIKE', '%' . $searchtext . '%')->orWhere('email', 'LIKE', "%$searchtext%")->orWhere('phone', 'LIKE', "%$searchtext%")->orWhere('address', 'LIKE', "%$searchtext%")->orWhere('product_title', 'LIKE', "%$searchtext%")->get();

            return view('Admin.order', compact('order'));
        } else {
            return redirect()->route('login');
        }
    }
}

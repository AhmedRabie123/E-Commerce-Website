<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Order;
use App\Models\product;
use App\Notifications\SendEmailNotification;
use Notification;
use PDF;

class AdminController extends Controller
{
  
    // admin home (dashboard)

    public function index()
    {
        return view('Admin.home');
    }

    //category function

    public function show_category()
    {
        $categories = category::orderBy('id', 'desc')->get();
        return view('Admin.category', compact('categories'));
    }

    public function category_create()
    {
        return view('Admin.category_create');
    }

    public function category_store(Request $request)
    { 
        $request->validate([
          'category_name' => 'required'
        ]);

        $category = new category();
        $category->category_name = $request->category_name;
        $category->save();

        return redirect()->route('category')->with('success', 'تم إضافة صنف جديد بنجاح');
    }

    public function category_edit($id)
    {
        $category_single = category::where('id', $id)->first();
        return view('Admin.category_edit', compact('category_single'));
    }

    public function category_update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required'
          ]);

        $category = category::where('id', $id)->first();
        $category->category_name = $request->category_name;
        $category->update();

        return redirect()->route('category')->with('success', 'تم تعديل الصنف بنجاح');
    }

    public function category_delete($id)
    {
        $category_single = category::where('id', $id)->first();
        $category_single->delete();

        return redirect()->route('category')->with('success', 'تم حذف الصنف بنجاح');
    }

    public function show_product()
    {
         //product function
  
        $products = product::orderBy('id', 'desc')->get();
        return view('Admin.product', compact('products'));
    }

    public function product_create()
    { 

        $categories = category::get();
       // $products = product::with('rCategory')->get();
        return view('Admin.product_create', compact('categories'));
    }

    public function product_store(Request $request)
    {
 
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
        $final_name = 'product_'. '.' .$now. '.' .$ext;
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
    }

    public function product_edit($id)
    {
        $product_single = product::where('id', $id)->first();
        $categories = category::get();
        return view('Admin.product_edit', compact('product_single','categories'));
    }

    public function product_update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required'
           
          ]);

          $product = product::where('id', $id)->first();


          if($request->hasFile('image')){

            $request->validate([
                'image' => 'image|mimes:jpg,png,gif,svg,jpeg',
            ]);

             unlink(public_path('images/'. $product->image));

             $now = time();
             $ext = $request->file('image')->extension();
             $final_name = 'product_'. '.' .$now. '.' .$ext;
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
    }

    public function product_delete($id)
    {
        $product_single = product::where('id', $id)->first();
        unlink(public_path('images/'. $product_single->image));
        $product_single->delete();

        return redirect()->route('product')->with('success', 'تم حذف المنتج بنجاح');
    }

    // order method

    public function show_order()
    {
        $order = Order::get();
        return view('Admin.order', compact('order'));
    }

    public function delivered($id)
    {
        $order = Order::where('id', $id)->first();
        $order->delivery_status = 'تم التوصيل';
        $order->payment_status = 'مدفوع';

        $order->save();

        return redirect()->back()->with('success', 'تم تعديل وضع التسليم بنجاح');
    }
 
     // order pdf method

    public function print_pdf($id)
    {
        $order = Order::where('id', $id)->first();
        $pdf = PDF::loadview('Admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function send_email($id)
    {
        $order = Order::where('id', $id)->first();
        return view('Admin.email_info', compact('order'));

    }

    public function email_submit(Request $request, $id)
    {
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

    }
}

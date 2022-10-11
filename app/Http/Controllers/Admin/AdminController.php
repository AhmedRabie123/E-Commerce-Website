<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;

class AdminController extends Controller
{

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
        //$products = product::with('rCategory')->get();
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
        return view('Admin.product_edit', compact('product_single'));
    }

    public function product_update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,png,gif,svg,jpeg',
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required'
           
          ]);

        $product = product::where('id', $id)->first();
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
        $product_single->delete();

        return redirect()->route('product')->with('success', 'تم حذف المنتج بنجاح');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tax;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        
        $data->categories = Category::latest()->get();
        $data->taxes = Tax::latest()->get();
        $data->products = Product::latest()->get();

        return view('system.companies.inventories.products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.inventories.products.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {           

        request()->validate([
            'product_name'=>'required',
            'sale_price'=>'required',
            'purchase_price'     => 'required',
        ]);

        Product::create($request->all()); 

        return back()->with('success', 'Product Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(equest $data)
    {
        return view('system.companies.inventories.products.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('system.companies.inventories.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'product_name'=>'required',
            'sale_price'=>'required',
            'purchase_price'     => 'required',
        ]); 

        $product = Product::find($id);    

        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $product->image = $path;
        }
        $product->product_name = $request->get('product_name');
        $product->tax_id = $request->get('tax_id');
        $product->description = $request->get('description');
        $product->sale_price = $request->get('sale_price');
        $product->purchase_price = $request->get('purchase_price');
        $product->category_id = $request->get('category_id');
        $product->status = $request->get('status');
        $product->save();

        return back()->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();        

        return back()->with('success', 'Product Deleted!');
    }
}

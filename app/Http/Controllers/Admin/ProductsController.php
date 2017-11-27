<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Http\Requests\ProductRequest;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::Paginate(10);
        $products->each(function($products){
            $products->category;
        });

        return view('admin.products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all('id','name');
        return view('admin.products.create',compact('categories'));//->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $producto = (new Product)->fill($request->all());

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('public');
        }
        $producto->save();

        $message = $producto ? 'Producto agregado correctamente' : 'El producto NO pudo agregase';
        return redirect()->route('products.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $product=Product::find($id);
        dd($product);
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all('id', 'name');
        return view('admin.products.edit')
            ->with('product', $product)
            ->with('categories', $categories);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('public');
        }
        $product->update($request->only('name', 'description', 'extract','points','category_id','visible'));
        $message = $product ? 'Producto actualizado correctamente' : 'El producto NO pudo actualizarse';
        return redirect()->route('products.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        $message = $product ? 'Producto eliminado correctamente' : 'El producto NO pudo eliminarse';
        return redirect()->route('products.index')->with('message', $message);
    }
}

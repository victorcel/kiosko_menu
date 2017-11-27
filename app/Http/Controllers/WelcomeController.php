<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\Category;
use App\Http\Controllers\CartController;

class WelcomeController extends Controller
{
	public function index(){
		$products = Product::where('visible',1)->SimplePaginate(4);
		$cart=CartController::totalCart();
		return view('welcome.index')
		->with('totalCart', $cart)
		->with('products', $products);
	}
	public function show($slug){
		$product = Product::findBySlugOrFail($slug);
		return view('welcome.show-product')->with('product', $product);
	}

	public function searchCategory($slug){
		$category = Category::findBySlugOrFail($slug);
		$products = $category->products()->where('visible',1)->paginate(4);
        //return dd($products->where('active',1));
		$products->each(function($products){
			$products->category;
		});
		return view('welcome.index')->with('products', $products);
	}
    public function category(){
        $category = Category::where('visible',1)->paginate(4);
        return view('welcome.cate')->with('category', $category);
    }

}

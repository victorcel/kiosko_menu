<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        if (!\Session::has('cart')) \Session::put('cart', array());
    }

    public function show()
    {

        $cart = \Session::get('cart');
        $total = $this->total();
        return view('cart.show')
            ->with('cart', $cart)
            ->with('total', $total)
            ->with('totalCart', $this->totalCart());
    }

    public function add(Product $product)
    {
        //return view('welcome.confir');
//return Auth::user()->points.'>'.$this->total() ;//.'--'. Auth::user()->points.' <'.$product->points;
        if ($product->points > Auth::user()->points) {
            return \Redirect::route('welcome.index')->with('message', ' No tiene saldo disponibles para redimir este producto');
        }
        $cart = \Session::get('cart');
        $product->quantity = 1;
        //   $product->;
        $cart[$product->slug] = $product;
        \Session::put('cart', $cart);
        return redirect()->route('cart.show');
    }

    public function delete(Product $product)
    {
        $cart = \Session::get('cart');
        unset($cart[$product->slug]);
        \Session::put('cart', $cart);
        return redirect()->route('cart.show');
    }

    public function trash()
    {
        \Session::forget('cart');
        return redirect()->route('cart.show');
    }

    public function confir(Product $product)
    {
        //dd($product);

        $cart = \Session::get('cart');

        $product->quantity = 1;
        $product->points = $product->points * 10;
        $cart[$product->slug] = $product;
        $cart[$product->slug]->price = 1;
        if ($product->points > Auth::user()->points) {
            return \Redirect::route('welcome.cate')->with('message', ' No tiene saldo disponibles para redimir este producto');
        }
        \Session::put('cart', $cart);

        return redirect()->route('cart.show');
    }

    public function update(Product $product, $quantity)
    {
        $cart = \Session::get('cart');
        $cart[$product->slug]->quantity = $quantity;
        //return dd($cart);
        \Session::put('cart', $cart);
        return redirect()->route('cart.show');
    }

    private function total()
    {
        $cart = \Session::get('cart');
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->points * $item->quantity;
        }
        return $total;
    }

    public function orderDetail()
    {
        if ($this->total() > Auth::user()->points) {
            return \Redirect::route('cart.show')->with('message', ' Puntos insuficientes verifique los productos');;
        }
        if (count(\Session::get('cart')) <= 0) return redirect()->route('welcome.index');
        $cart = \Session::get('cart');
        $total = $this->total();

        return view('cart.order-detail')
            ->with('cart', $cart)
            ->with('total', $total);
    }

    public static function totalCart()
    {
        return count(\Session::get('cart'));
    }
}

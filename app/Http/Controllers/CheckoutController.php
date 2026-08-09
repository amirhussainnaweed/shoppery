<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function Index(){
    $cartItems = CartItem::where('cart_id', auth()->id())->first();

    if (!$cartItems){
    return Inertia::render('Checkout/Index', [
    'cartItems' => []
    ]);
    }

    $cartItems = CartItem::where('cart_id', $cart->id)
    ->with('product')
    ->get();

    return Inertia::render('Cart/Index', [
    'cartItems' => $cartItems
    ]);

    }



    public function addToCheckout(Request $request){
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);
    
    $cartItems = CartItem::where('cart_id', $cart->id)
        ->where('product_id', $request->product_id)
        ->first();


    return redirect()->route('checkout.index');
    }
    
}

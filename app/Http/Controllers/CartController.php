<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    public function index(){
    $cart = Cart::where('user_id', auth()->id())->first();

    if (!$cart) {
        return Inertia::render('Cart/Index', [
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


    public function addToCart(Request $request){
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $cart = Cart::firstOrCreate([
        'user_id' => auth()->id(),
    ]);

    
    $cartItems = CartItem::where('cart_id', $cart->id)
        ->where('product_id', $request->product_id)
        ->first();

    if ($cartItems) {
        $cartItems->increment('quantity');
    } else {
        CartItem::create([
            'cart_id'    => $cart->id,
            'product_id' => $request->product_id,
            'quantity'   => 1,
        ]);
    }

    return redirect()->route('cart.index');
    }



    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItems = CartItem::findOrFail($id);
        
        $cartItems->update([
            'quantity' => $request->quantity
        ]);

        return back(); 
    }


    public function destroy($id)
    {
        $cartItems = CartItem::findOrFail($id);
        $cartItems->delete();

        return back();
    }


}

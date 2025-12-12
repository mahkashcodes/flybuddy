<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\TravelPackage;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart.index', compact('cart', 'total'));
    }
    
    public function add(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|in:destination,package',
            'quantity' => 'integer|min:1'
        ]);
        
        $cart = session()->get('cart', []);
        $key = $request->item_type . '_' . $request->item_id;
        
        if ($request->item_type == 'destination') {
            $item = Destination::findOrFail($request->item_id);
            $price = $item->starting_price;
            $image = $item->featured_image;
        } else {
            $item = TravelPackage::findOrFail($request->item_id);
            $price = $item->price;
            $image = $item->image_url ?? $item->destination->featured_image;
        }
        
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$key] = [
                'id' => $item->id,
                'type' => $request->item_type,
                'name' => $item->name,
                'price' => $price,
                'quantity' => $request->quantity ?? 1,
                'image' => $image,
                'description' => Str::limit($item->description, 50)
            ];
        }
        
        session()->put('cart', $cart);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Added to cart!',
                'cart_count' => count($cart)
            ]);
        }
        
        return redirect()->route('cart.index')->with('success', 'Added to cart!');
    }
    
    public function remove($key)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            
            return back()->with('success', 'Item removed from cart.');
        }
        
        return back()->with('error', 'Item not found in cart.');
    }
    
    public function update(Request $request, $key)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = max(1, $request->quantity);
            session()->put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Cart updated!'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Item not found in cart.'
        ], 404);
    }
    
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart.checkout', compact('cart', 'total'));
    }
    
    public function processCheckout(Request $request)
    {
        // Simple checkout - in real app, integrate with payment gateway
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }
        
        // Clear cart after checkout
        session()->forget('cart');
        
        return view('cart.success')->with('success', 'Order placed successfully!');
    }
}
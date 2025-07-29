<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
          $cartItems = session()->get('cart', []);
    $products = [];
    $subtotal = 0;
    foreach ($cartItems as $bookId => $item) {
        $book = Product::where('id',$bookId)->first();
        if ($book) {
            $book->quantity = $item['quantity'];
            $products[] = $book;
            $subtotal += ($book->discount > 0 ? $book->discount : $book->price) * $item['quantity'];
        }
    }
    
    $total = $subtotal; // Bisa ditambahkan tax/discount jika ada
    
        return view('contents.guest.cart', compact('products', 'total', 'subtotal'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $bookId = $request->book_id;
        $quantity = $request->quantity;
        $book = Product::findOrFail($bookId);
        
        // Check stock availability
        if ($book->getCountStock() < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available'
            ], 400);
        }
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$bookId])) {
            $newQuantity = $cart[$bookId]['quantity'] + $quantity;
            if ($newQuantity > $book->getCountStock()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more than available stock'
                ], 400);
            }
            $cart[$bookId]['quantity'] = $newQuantity;
        } else {
            $cart[$bookId] = [
                "quantity" => $quantity
            ];
        }
        
        session()->put('cart', $cart);
        
        // Calculate total items in cart
        $cartCount = 0;
        foreach ($cart as $item) {
            $cartCount += $item['quantity'];
        }
        
        return response()->json([
            'success' => true,
            'cart_count' => $cartCount,
            'message' => 'Book added to cart successfully'
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }

    public function update(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $bookId = $request->book_id;
        $quantity = $request->quantity;
        $book = Product::findOrFail($bookId);
        
        // Check stock availability
        if ($book->stock < $quantity) {
            return back()->with('error', 'Not enough stock available');
        }
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
    }
}

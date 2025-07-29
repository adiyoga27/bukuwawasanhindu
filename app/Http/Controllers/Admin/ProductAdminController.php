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
    
    foreach ($cartItems as $productId => $item) {
        $product = Product::with('category')->find($productId);
        if ($product) {
            $product->quantity = $item['quantity'];
            $product->current_stock = $product->getCountStock();
            $products[] = $product;
            $subtotal += ($product->discount > 0 ? $product->discount : $product->price) * $item['quantity'];
        }
    }
    
    $total = $subtotal;
    
    // Pastikan $products selalu berupa array, bahkan jika kosong
    $products = $products ?? [];
    
    return view('contents.guest.cart', compact('products', 'subtotal', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $productId = $request->book_id;
        $quantity = $request->quantity;
        $product = Product::findOrFail($productId);
        $currentStock = $product->getCountStock();
        
        // Check stock availability
        if ($currentStock < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $currentStock
            ], 400);
        }
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $quantity;
            if ($newQuantity > $currentStock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak bisa menambahkan melebihi stok. Stok tersedia: ' . $currentStock
                ], 400);
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                "quantity" => $quantity
            ];
        }
        
        session()->put('cart', $cart);
        
        $cartCount = array_sum(array_column($cart, 'quantity'));
        
        return response()->json([
            'success' => true,
            'cart_count' => $cartCount,
            'message' => 'Produk berhasil ditambahkan ke keranjang'
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang');
        }
        
        return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang');
    }

    public function update(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $productId = $request->book_id;
        $quantity = $request->quantity;
        $product = Product::findOrFail($productId);
        $currentStock = $product->getCountStock();
        
        if ($currentStock < $quantity) {
            return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $currentStock);
        }
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui');
        }
        
        return back()->with('error', 'Produk tidak ditemukan di keranjang');
    }
}
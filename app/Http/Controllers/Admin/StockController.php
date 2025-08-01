<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::withSum('stocks as total_in', 'in')
                    ->withSum('stocks as total_out', 'out')
                    ->get();
        
        return view('contents.admin.products.stocks', compact( 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'product_id' => 'required|exists:products,id',
        'adjustment_type' => 'required|in:in,out',
        'quantity' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'reference' => 'nullable|string'
    ]);

    $stockData = [
        'product_id' => $request->product_id,
        'description' => $request->description,
        'reference' => $request->reference
    ];

    if ($request->adjustment_type === 'in') {
        $stockData['in'] = $request->quantity;
        $stockData['out'] = 0;
    } else {
        $stockData['out'] = $request->quantity;
        $stockData['in'] = 0;
    }

    Stock::create($stockData);

    return redirect()->back()
        ->with('success', 'Stock adjustment recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $stocks = $product->stocks()->latest()->get();
        return view('contents.admin.products.stock-details', compact('product', 'stocks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

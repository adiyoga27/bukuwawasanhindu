<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $categories = Category::orderBy('name', 'ASC')->get();
        $datas = Product::orderBy('id', 'DESC')->get();
        return view('contents.admin.products.index', compact('categories', 'datas'));
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

    public function store(ProductRequest $request)
    {
        try {

            $slug = Str::slug($request->title);
$originalSlug = $slug;
$counter = 1;

// cek apakah slug sudah ada di database
while (Product::where('slug', $slug)->exists()) {
    $slug = $originalSlug . '-' . $counter;
    $counter++;
}

            Product::create([
                'title'       => $request->title,
                'author'      => $request->author,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price'       => $request->price,
                'discount'    => $request->discount,
                'rating'      => $request->rating,
                'lazada'      => $request->lazada,
                'tokopedia'   => $request->tokopedia,
                'shopee'      => $request->shopee,
                'keyword'     => $request->keyword,
                'thumbnail'   => $request->file('thumbnail')
                                    ? $request->file('thumbnail')->store('products', 'public')
                                    : null,
                'is_active'   => $request->boolean('is_active'),
                'slug'        => $slug,
            ]);

            // Kalau requestnya via AJAX (expects JSON)
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Produk berhasil ditambahkan!',
                ]);
            }

            // Kalau request normal (via form biasa)
            return redirect('admin/products')->with('success', 'Produk berhasil ditambahkan.');
            
        } catch (\Throwable $th) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan produk: ' . $th->getMessage(),
                ], 500);
            }

            return redirect()->back()->with('error', 'Gagal menambahkan produk: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'rating' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active' => 'boolean',
              'tokopedia' => 'string',
              'lazada' => 'string',
                'shopee' => 'string',
                'keyword' => 'string|nullable',
        ]);
$slug = Str::slug($request->title);
$originalSlug = $slug;
$counter = rand(1,100);

// cek apakah slug sudah ada di database
while (Product::where('slug', $slug)->exists()) {
    $slug = $originalSlug . '-' . $counter;
    $counter++;
}
        try {
            $product = Product::where('id',$id)->first();
            $product->update([
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'rating' => $request->rating,
                'tokopedia'=> $request->tokopedia,
                'shopee'=> $request->shopee,
                'lazada' => $request->lazada,
                'keyword'=> $request->keyword,

                'discount' => $request->discount,
                'thumbnail' => $request->file('thumbnail') ? $request->file('thumbnail')->store('products', 'public') : $product->thumbnail,
                'is_active' => $request->is_active ? true : false,
                'slug' => $slug,
            ]);
            return redirect('admin/products')->with('success', 'Product updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update product: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect('admin/products')->with('success', 'Product deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete product: ' . $th->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Website;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Product::with('category'); // eager load category

        // ✅ Filter kategori berdasarkan slug
        if ($request->filled('category')) {
            $categorySlug = $request->query('category');
            $books->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }



        // ✅ Sorting berdasarkan query string ?sort=...
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $books->orderBy('price', 'asc')
                        ->orderBy('discount', 'asc'); // tambahin orderBy kedua
                    break;

                case 'price_desc':
                    $books->orderBy('price', 'desc')
                        ->orderBy('discount', 'desc');
                    break;

                case 'discount_asc':
                    $books->orderBy('discount', 'asc')
                        ->orderBy('price', 'asc');
                    break;

                case 'discount_desc':
                    $books->orderBy('discount', 'desc')
                        ->orderBy('price', 'desc');
                    break;

                case 'rating':
                    $books->orderBy('stars', 'desc');
                    break;
            }
        } else {
            // ✅ Default order by terbaru
            $books->orderBy('id', 'DESC');
        }

        // ✅ Pagination
        $books = $books->paginate(10)->withQueryString();

        // ✅ Ambil konfigurasi & kategori
        $configs = Website::first();
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('contents.guest.book', compact('categories', 'books', 'configs'));
    }


    public function showByCategory($slug)
    {

        $configs = Website::first();
        $categories = Category::orderBy('name', 'ASC')->get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $books = $category->products()->get();

        return view('contents.guest.book', compact('category', 'books', 'categories', 'configs'));
    }

    public function show($slug)
    {
        $book = Product::where('slug', $slug)->firstOrFail();

        $configs = Website::first();
        $relatedBooks = Product::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(3)
            ->get();



        return view('contents.guest.book-detail', compact('book', 'relatedBooks', 'configs'));
    }
}

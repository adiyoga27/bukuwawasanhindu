<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $categories  = Category::orderBy('name', 'ASC')->get();
        $books = Product::all();
 
        return view('contents.guest.book', compact('categories', 'books'));
    }

    public function showByCategory($slug)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $books = $category->products()->get();

        return view('contents.guest.book', compact('category', 'books','categories'));
    }

    public function show($slug)
    {
        $book = Product::where('slug', $slug)->firstOrFail();
       
        $relatedBooks = Product::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(3)
            ->get();



        return view('contents.guest.book-detail', compact('book', 'relatedBooks'));
    }
}

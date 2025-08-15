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
                $books = Product::orderBy('id', 'DESC');

        if(isset($request->sort)){
            $sort = $request->sort;
            if($sort == 'price_asc'){
                       $books = Product::orderBy('price', 'asc');


            }else if($sort == 'price_desc'){
                          $books = Product::orderBy('price', 'desc');


            }else if($sort == 'rating'){
                       $books = Product::orderBy('stars', 'desc');


            }
        }

        $books = $books->paginate(10);
        $configs = Website::first();
        $categories  = Category::orderBy('name', 'ASC')->get();
        // $books = Product::paginate(10);
 
        return view('contents.guest.book', compact('categories', 'books', 'configs'));
    }

    public function showByCategory($slug)
    {
        
        $configs = Website::first();
        $categories = Category::orderBy('name', 'ASC')->get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $books = $category->products()->get();

        return view('contents.guest.book', compact('category', 'books','categories', 'configs'));
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

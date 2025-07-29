<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $categories  = Category::orderBy('name', 'ASC')->get();
        $books = Product::take(6)
            ->get();
        $featuredBooks = Product::take(3)
            ->get();
            $articles = [];
        return view('contents.guest.home', compact('categories', 'books','featuredBooks','articles'));
    }

    
}

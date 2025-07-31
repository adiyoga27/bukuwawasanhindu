<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\CategoryArticle;
use App\Models\Product;
use App\Models\Website;
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
            $articles = Article::with('category')->take(10)->get();
            $configs = Website::first();
        return view('contents.guest.home', compact('categories', 'books','featuredBooks','articles','configs'));
    }

    public function contact(){
        $configs = Website::first();
         return view('contents.guest.contact', compact('configs'));
    }
    public function articles(){
        $articles = Article::paginate(10);
        $categories = CategoryArticle::get();
        $configs = Website::first();
         return view('contents.guest.articles', compact('articles','configs','categories'));
    }

    public function articlesDetail(Request $request, $slug){
        $configs = Website::first();
        $article = Article::where('slug', $slug)->first();
        $relatedArticles = Article::paginate(10);
        return view('contents.guest.article-detail', compact('article','relatedArticles','configs'));
    }

    
}

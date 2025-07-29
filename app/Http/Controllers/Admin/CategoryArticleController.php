<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryArticleController extends Controller
{
     public function index()
    {
        $datas = CategoryArticle::paginate();
        return view('contents.admin.articles.categories.index', compact('datas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:category_articles',
            'is_active'=>'required|boolean'
        ]);

        CategoryArticle::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => $request->is_active
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active'=>'required|boolean'
        ]);

        CategoryArticle::where('id', $id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => $request->is_active
        ]);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(CategoryArticle $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}

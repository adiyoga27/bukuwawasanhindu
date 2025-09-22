<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{
    public function index()
    {
        $datas = Testimoni::paginate(10);

        return view('contents.admin.testimonies.index', compact('datas'));
    }

    public function show($slug)
    {
        $article = Testimoni::with('category', 'tags', 'user')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Tambah view count
        $article->incrementViews();

        return view('testimonies.show', compact('article'));
    }

    public function create(){
        return view('testimonies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'role' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
           
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonies', 'public');
        }

       Testimoni::create($data);

      
        return redirect()->back()
            ->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit(Testimoni $testimoni)
    {
        
        return view('testimonies.edit', compact('article'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
             'name' => 'required|max:255',
            'role' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
        ]);


        if ($request->hasFile('photo')) {
            // Hapus gambar lama jika ada
            if ($testimoni->featured_image) {
                Storage::disk('public')->delete($testimoni->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $testimoni->update($data);

       

        return redirect()->back()
            ->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function destroy(Testimoni $testimoni)
    {
        if ($testimoni->featured_image) {
            Storage::disk('public')->delete($testimoni->featured_image);
        }

        $testimoni->delete();

        return redirect()->route('testimonies.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}

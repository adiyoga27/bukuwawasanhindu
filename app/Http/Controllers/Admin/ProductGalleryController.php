<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductGalleryController extends Controller
{
   public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $path = $image->store('products-gallery', 'public');
                
                $gallery = ProductGallery::create([
                    'product_id' => $request->product_id,
                    'image_path' => $path,
                ]);
                
                $uploadedImages[] = [
                    'id' => $gallery->id,
                    'path' => Storage::url($path),
                ];
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diupload',
            'images' => $uploadedImages,
            'product_id' => $request->product_id,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'image_id' => 'required|exists:product_galleries,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $gallery = ProductGallery::where('id', $request->image_id)
                    ->where('product_id', $request->product_id)
                    ->first();

        if ($gallery) {
            Storage::delete($gallery->image_path);
            $gallery->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil dihapus',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gambar tidak ditemukan',
        ], 404);
    }
}

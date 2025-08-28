<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Tentukan apakah user berhak menggunakan request ini.
     */
    public function authorize(): bool
    {
        return true; // ubah sesuai kebutuhan (misalnya pakai Gate/Policy)
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255|unique:products,title',
            'author'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'discount'    => 'nullable|numeric|min:0',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active'   => 'boolean',
            'rating'      => 'required|numeric|min:0',
            'tokopedia'   => 'nullable|string',
            'lazada'      => 'nullable|string',
            'shopee'      => 'nullable|string',
            'keyword'     => 'nullable',
        ];
    }

    /**
     * Pesan error dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul produk wajib diisi.',
            'title.string'   => 'Judul produk harus berupa teks.',
            'title.max'      => 'Judul produk maksimal 255 karakter.',
            'title.unique'   => 'Judul produk sudah terdaftar, silakan gunakan judul lain.',

            'author.required' => 'Nama penulis wajib diisi.',
            'author.string'   => 'Nama penulis harus berupa teks.',
            'author.max'      => 'Nama penulis maksimal 255 karakter.',

            'description.string' => 'Deskripsi harus berupa teks.',

            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',

            'price.required' => 'Harga wajib diisi.',
            'price.numeric'  => 'Harga harus berupa angka.',
            'price.min'      => 'Harga tidak boleh kurang dari 0.',

            'discount.numeric' => 'Diskon harus berupa angka.',
            'discount.min'     => 'Diskon tidak boleh kurang dari 0.',

            'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berformat jpeg, png, jpg, gif, svg, atau webp.',
            'thumbnail.max'   => 'Ukuran thumbnail tidak boleh lebih dari 2MB.',

            'is_active.boolean' => 'Status aktif tidak valid.',

            'rating.required' => 'Rating wajib diisi.',
            'rating.numeric'  => 'Rating harus berupa angka.',
            'rating.min'      => 'Rating tidak boleh kurang dari 0.',

            'tokopedia.string' => 'Link Tokopedia harus berupa teks.',
            'lazada.string'    => 'Link Lazada harus berupa teks.',
            'shopee.string'    => 'Link Shopee harus berupa teks.',
        ];
    }
}

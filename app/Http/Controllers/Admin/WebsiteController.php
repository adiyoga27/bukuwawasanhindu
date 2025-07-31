<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $config = Website::first();
        return view('contents.admin.configs.index', compact('config'));
    }
    public function store(Request $request){
        try {
           Website::firstOrCreate([
                'app_name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'tiktok' => $request->tiktok,
                'youtube' => $request->youtube
            ]);
               Website::first()->update([
                'app_name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'tiktok' => $request->tiktok,
                'youtube' => $request->youtube
            ]);
               return redirect()->back()->with('success', 'Berhasil merubah config !.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

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
    public function store(Request $request)
    {
        try {
            Website::firstOrCreate([
                'app_name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'tiktok' => $request->tiktok,
                'youtube' => $request->youtube,
                'shopee' => $request->shopee,
                'tokopedia' => $request->tokopedia
            ]);
            Website::first()->update([
                'app_name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'tiktok' => $request->tiktok,
                'youtube' => $request->youtube,
                'shopee' => $request->shopee,
                'tokopedia' => $request->tokopedia
            ]);
            return redirect()->back()->with('success', 'Berhasil merubah Website');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function about()
    {
          $configs = Website::first();
        return view('contents.admin.configs.about',compact('configs'));
    }
    public function aboutStore(Request $request)
    {
        Website::first()->update([

            'about' => $request->about
        ]);
        return redirect()->back()->with('success', 'Berhasil merubah Website');
    }
     public function howToPurchase()
    {
          $configs = Website::first();
        return view('contents.admin.configs.how-to-purchase',compact('configs'));
    }
    public function howToPurchaseStore(Request $request)
    {
        Website::first()->update([

            'how_to_purchase' => $request->how_to_purchase
        ]);
        return redirect()->back()->with('success', 'Berhasil merubah Website');
    }

    public function uploadImage(Request $request){
        if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('uploads/images', 'public');

        return response()->json([
            'location' => asset('storage/' . $path)
        ]);
    }

    return response()->json(['error' => 'Tidak ada file yang dikirim'], 400);
    }
}

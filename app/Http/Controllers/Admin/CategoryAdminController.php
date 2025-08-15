<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

     
        $datas = Category::all();

        
        // Logic to display categories
        return view('contents.admin.categories.index', compact('datas')); // Assuming you have a view for listing categories
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'is_active' => 'boolean',
            ]);
        try {
            // Validate the request data
         Category::create([
                'name' => $request->name,
                'slug' =>  Str::slug($request->name),
                'is_active' => $request->is_active,
            ]);

            return redirect('admin/categories')->with('success', 'Category created successfully.');
        } catch (\Throwable $th) {
            // Handle any errors that occur during the creation process
            return redirect()->back()->with('error', 'Failed to create category: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'is_active' => 'boolean',
        ]);

        try {
            // Find the category by ID and update it
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'is_active' => $request->is_active,
            ]);

            return redirect('admin/categories')->with('success', 'Category updated successfully.');
        } catch (\Throwable $th) {
            // Handle any errors that occur during the update process
            return redirect()->back()->with('error', 'Failed to update category: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the category by ID and delete it
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect('admin/categories')->with('success', 'Category deleted successfully.');
        } catch (\Throwable $th) {
            // Handle any errors that occur during the deletion process
            return redirect()->back()->with('error', 'Failed to delete category: ' . $th->getMessage());
        }
    }
}

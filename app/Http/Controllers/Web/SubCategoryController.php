<?php

namespace App\Http\Controllers\Web;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Subcategory::query();
        if ($request->filled("category_id"))
            $query->where("category_id", $request->category_id);
        $subcategories = $query->with(["category:id,name"])->orderBy("id", "DESC")->get();
        $categories = Category::orderBy("id", "DESC")->get();
        return view("subcategory.index")
            ->with("subcategories", $subcategories)
            ->with("categories", $categories)
        ;
    }
    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "image" => "required",
        ]);
        Subcategory::create([
            "name" => $request->name,
            'image' => Helpers::upload_files($request->image),
            "category_id" => $request->category_id
        ]);
        session()->flash("success", "Added Successfully");
        return back();
    }
    public function edit($id)
    {
        $category = Subcategory::with(['features'])->find($id);
        return view('categories.edit')
            ->with("category", $category);
    }
    public function update(Request $request)
    {
        $request->validate([
            "name" => "required",
            "id" => "required"
        ]);
        $category = Subcategory::find($request->id);
        if (! $category)
            return back();
        if ($request->hasFile("image")) {
            Helpers::delete_file($category->image);
            $category->update([
                'image' => Helpers::upload_files($request->image),
            ]);
        }
        $category->update([
            "name" => $request->name,
            "category_id" => $request->category_id

        ]);
        session()->flash("success", "Updated Successfully");
        return back();
    }
    public function destroy(Request $request)
    {
        $request->validate([
            "id" => "required"
        ]);
        $category = Subcategory::find($request->id);
        if (! $category)
            return back();
        Helpers::delete_file($category->image);

        $category->delete();
        session()->flash("success", "Deleted Successfully");
        return back();
    }
}

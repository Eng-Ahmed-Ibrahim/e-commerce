<?php

namespace App\Http\Controllers\Web;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\CategoriesFeatures;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $categories=Category::orderBy("position")->get();

        return view("categories.index")
        ->with("categories",$categories)
        
        ;
    }
    public function store(Request $request){
        $request->validate([
            "name"=>"required",
            "image"=>"required",
        ]);
        Category::create([
            "name"=>$request->name,
            "description"=>$request->description,
            'image'=>Helpers::upload_files($request->image),
        ]);
        session()->flash("success","Added Successfully");
        return back();
    }
    public function edit($id){
        $category=Category::with(['features'])->find($id);
        return view('categories.edit')
        ->with("category",$category)
        ;
    }
    public function update(Request $request){
        $request->validate([
            "name"=>"required",
            "category_id"=>"required"
        ]);
        $category=Category::find($request->category_id);
        if(! $category)
            return back();
        if($request->hasFile("image")){
            Helpers::delete_file($category->image);
            $category->update([
                'image'=>Helpers::upload_files($request->image),
            ]);
        }
        $category->update([
            "description"=>$request->description,
            "name"=>$request->name,
        ]);
        session()->flash("success","Updated Successfully");
        return back();
    }
    public function destroy(Request $request){
        $request->validate([
            "category_id"=>"required"
        ]);
        $category=Category::find($request->category_id);
        if(! $category)
            return back();
        Helpers::delete_file($category->image);

        $category->delete();
        session()->flash("success","Deleted Successfully");
        return back();
    }

    public function add_feature_to_category(Request $request){
        $request->validate([
            "category_id"=>"required",
            "name"=>"required",
            "image"=>"required",
        ]);
        CategoriesFeatures::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            "image"=>Helpers::upload_files($request->image),
        ]);
        session()->flash("success","Added Successfully");
        return back();
    }
    public function delete_feature_from_category(Request $request){
        $request->validate([
            "id"=>"required",
        ]);
        $feature=CategoriesFeatures::find($request->id);
        Helpers::delete_file($feature->image);
        $feature->delete();

        session()->flash("success","Deleted Successfully");
        return back();
    }
    public function updatePosition(Request $request)
    {
        $positions = $request->input('positions');
        $page = $request->input('page', 1); // Get current page, default to 1 if not provided
        $itemsPerPage = $request->input('itemPerPage', 25); // Get items per page, default to 25 if not provided
        if($itemsPerPage=="all")
            $itemsPerPage=0;
        // Loop through the positions and update the product positions
        foreach ($positions as $index => $id) {
            // Calculate the correct position for this product
            $position = ($page - 1) * $itemsPerPage + ($index + 1);
    
            // Update the position of the product
            Category::where('id', $id)->update(['position' => $position]);
        }
    
        return response()->json(['success' => true]);
    }

}

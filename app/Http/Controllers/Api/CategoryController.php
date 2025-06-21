<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ResponseTrait;
    public function index($category_id=null){
        $category= Category::withCount('sub_categories')->orderBy('position')->get();
        if($category_id > 0){
            $category=Subcategory::orderBy("id","DESC")->where("category_id",$category_id)->get();
        }
        $data=[
            "categories"=>$category,
        ];
            $message="Categories";
        return $this->Response($data,$message,200);
    }
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            "name"=>"required",
            "image"=>"required",
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);
        Category::create([
            "name"=>$request->name,
            "image"=>Helpers::upload_files($request->image),
        ]);
        return $this->index("Added Succesfully");
    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "category_id"=>"required",
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);
        $category=Category::find($request->category_id);
        if($request->hasFile("image"))
            Helpers::delete_file($category->image);
        $category->update([
            "name"=>$request->name??$category->name,
            "image"=> $request->hasFile("image") ?  Helpers::upload_files($request->image) : $category->image,
        ]);
        return $this->index("Updated Successfully");
    }
    public function destroy(Request $request){
        $validator=Validator::make($request->all(),[
            "category_id"=>"required",
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);
        $category=Category::find($request->category_id);
        if($category==null)
            return $this->index("Category Not Found");
        
        Helpers::delete_file($category->image);
        $category->delete();
        return $this->index("Deleted Successfully");
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\Products;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\ProductColors;
use App\Models\ProductImages;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index(Request $request){
        $query=Products::query();
        if($request->filled('search'))
            $query->where("name","LIKE","%{$request->search}%");
        if($request->filled("category_id"))
            $query->where("category_id",$request->category_id);
        $pagination=25;
        if($request->has("pagination") && $request->pagination !="all")
            $pagination=$request->pagination;
        if($request->pagination =="all"){

            $products= $query->with(['category'])->orderBy("position")->get();
        }else
            $products= $query->with(['category'])->orderBy("position")->paginate($pagination);

        $categories=Category::orderBy("id","DESC")->get();
        return view("products.index")
        ->with("products",$products)
        ->with("categories",$categories)
        ->with("search",$request->search)
        
        ;
    }
    public function create(){
        $categories=Category::orderBy("id","DESC")->get();
        return view('products.create')
        ->with("categories",$categories);
    }
    public function store(Request $request){
        $request->validate([
            "name"=>"required",
            "image"=>"required",
            "description"=>"required",
            "price"=>"required",
            "category_id"=>"required",
        ]);
        $last_position=Products::max('position');

        $product=Products::create([
            "sub_category_id"=>$request->sub_category_id,
            "color"=>$request->color,
            "position"=>$last_position ? $last_position+1 : 1,

            "name"=>$request->name,
            "description"=>$request->description,
            "stock"=>$request->stock,
            "sku"=>$request->sku,
            "price"=>$request->price,
            "discount"=>$request->discount,
            "category_id"=>$request->category_id,
            'image'=>Helpers::upload_files($request->image),
        ]);
        if($request->hasFile("images")){
            foreach($request->images as $image){

                ProductImages::create([
                    "image" => Helpers::upload_files($image),
                    "product_id" => $product->id,
                ]);
            }
        }
        session()->flash("success","Added Successfully");
        return back();
    }
    public function edit($product_id)  {
        $product=Products::where("id",$product_id)->with(["images"])->first();

        if(! $product)
            return back();
        $categories=Category::orderBy("id","DESC")->get();
        $subategories=Subcategory::where("category_id",$product->category_id)->orderBy("id","DESC")->get();
        return view('products.edit')
            ->with("product",$product)
            ->with("subategories",$subategories)
            ->with("categories",$categories);
    }
    public function update(Request $request){
        $request->validate([
            "name"=>"required",
            "description"=>"required",
            "price"=>"required",
            "category_id"=>"required",
            "product_id"=>"required",
        ]);
        $product=Products::find($request->product_id);
        if(! $product)
            return back();
        if($request->hasFile('image')){
            Helpers::delete_file($product->image);
            $product->update([
                "image"=>Helpers::upload_files($request->image),
            ]);
        }
        $product->update([
            "name"=>$request->name,
            "sub_category_id"=>$request->sub_category_id,
            "description"=>$request->description,
            "price"=>$request->price,
            "category_id"=>$request->category_id,
            "discount"=>$request->discount,
            "stock"=>$request->stock,
            "sku"=>$request->sku,
            "color"=>$request->color,
        ]);
        if($request->hasFile("images")){
            foreach($request->images as $image){

                ProductImages::create([
                    "image" => Helpers::upload_files($image),
                    "product_id" => $product->id,
                ]);
            }
        }
        session()->flash("success","Updated Successfully");
        return back();
    }
    public function destroy(Request $request){
        $request->validate([
            "product_id"=>"required"
        ]);
        $product=Products::find($request->product_id);
        if(! $product)
            return back();
        Helpers::delete_file($product->image);

        $product->delete();
        session()->flash("success","Deleted Successfully");
        return back();
    }
    public function change_home_status(Request $request){
        $product=Products::find($request->product_id);
        $product->update([
            "home_status"=>$product->home_status == 1 ? 0 : 1,
        ]);
        session()->flash("success","Status Updated successfuly");
        return back();
    }
    public function delete_product_image(Request $request){
        $image=ProductImages::find($request->id);
        if(!$image )
            return back();
        Helpers::delete_file($image->image);
        $image->delete();
        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }
    public function delete_all_image_product(Request $request){
        $images=ProductImages::where("product_id",$request->id)->get();
        foreach($images as $image){
            Helpers::delete_file($image->image);
            $image->delete();
        }
        return response()->json(['success' => true, 'message' => 'Images deleted successfully']);
    }
    public function get_product_colors(Request $request){
        $colors=ProductColors::where("product_id",$request->product_id)->orderBy("id","DESC")->get();
        return response()->json($colors);
    }
    public function add_product_color(Request $request)
    {
        $request->validate([
            'color_name' => 'required|string|max:255',
            'image' => 'required',
            'product_id' => 'required',
            'price' => 'required|numeric',
        ]);

            $color=ProductColors::create([
                "product_id"=>$request->product_id,
                "price"=>$request->price,
                "color_name"=>$request->color_name,
                "image"=>Helpers::upload_files($request->image),
            ]);

        return response()->json([
            'success' => true,
            'color' => $color,
        ]);
    }
    public function update_product_color(Request $request)
    {
        $request->validate([
            'color_name' => 'required|string|max:255',
            'product_id' => 'required',
            'price' => 'required|numeric',
            "colorId"=>"required",
        ]);

            $color=ProductColors::find($request->colorId);
            if($request->hasFile("image")){
                Helpers::delete_file($color->image);
                $color->update([
                    "image"=>Helpers::upload_files($request->image),
                ]);
            }
            $color->update([
                "price"=>$request->price,
                "color_name"=>$request->color_name,
            ]);

        return response()->json([
            'success' => true,
            'color' => $color,
        ]);
    }
    public function delete_product_color(Request $request)
    {
        $request->validate([
            "colorId"=>"required",
        ]);

            $color=ProductColors::find($request->colorId);
            if($request->hasFile("image")){
                Helpers::delete_file($color->image);
            }
            $color->delete();

        return response()->json([
            'success' => true,
            'color' => $color,
        ]);
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
            Products::where('id', $id)->update(['position' => $position]);
        }
    
        return response()->json(['success' => true]);
    }
    
    
    
}

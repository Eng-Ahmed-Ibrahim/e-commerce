<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\Products;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    use ResponseTrait;
    public function index(Request $request)
    {
        $query=Products::query();



        $categories = Category::orderBy("id", "DESC")->get();
        if ($request->has("category_id")){
            
            $query = $query->whereIn("category_id", $request->category_id);
        }
        if ($request->has("sub_category_id")){
            
            $query = $query->whereIn("sub_category_id", $request->sub_category_id);
            $categories = Subcategory::orderBy("id", "DESC")->get();

        }
        $products = $query->orderBy("position")->with(["images","category:id,description",'category.features'])->get();
        $data = [
            "products" => $products,
            "categories" => $categories,
        ];

        return $this->Response($data, "Products", 200);
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "product_id" => "required",
        ]);
    
        if ($validator->fails()) {
            return $this->Response($validator->errors(), "Data Not Valid", 404);
        }
    
        // Try fetching the product data from cache first
        $cacheKey = "product_details_{$request->product_id}";
        $productData = Cache::get($cacheKey);
    
        if (!$productData) {
            // If not found in cache, query the database
            $product = Products::where("id", $request->product_id)
                ->with(["images", "category:id,description", 'category.features', 'colors'])
                ->first();
    
            if (!$product) {
                return $this->Response([], "Product not found", 404);
            }
    
            // Fetch three random products from the same category
            $products = Products::where("category_id", $product->category_id)
                ->inRandomOrder()
                ->take(3)
                ->get();
    
            $data = [
                "product" => $product,
                "products" => $products,
            ];
    
            // Cache the product details for 10 minutes
            Cache::put($cacheKey, $data, now()->addMinutes(10));
    
            $productData = $data;
        }
    
        return $this->Response($productData, "Product Details", 201);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "category_id" => "required",
            "image" => "required",
            "name" => "required",
            "description" => "required",
            "price" => "required",
            "discount" => "required",
        ]);
        if ($validator->fails()) {
            return $this->Response($validator->errors(), "Data not Valid ", 404);
        }
        $last_position=Products::max('position');
        Products::create([
            "name" => $request->name,
            "position"=>$last_position ? $last_position+1 : 1,
            "image" => Helpers::upload_files($request->image),
            "description" => $request->description,
            "price" => $request->price,
            "category_id" => $request->category_id,
            "discount" => $request->discount,
            "sku"=>Str::upper(Str::random(6)),
        ]);
        return $this->index($request, "Added Successfully");
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "product_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->Response($validator->errors(), "Data not Valid ", 404);
        }
        $product = Products::find($request->product_id);
        if ($request->hasFile("image")) {
            Helpers::delete_file($product->image);
            $product->update([
                "image" => Helpers::upload_files($request->image),
            ]);
        }

        $product->update([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "category_id" => $request->category_id,
            "discount" => $request->discount,

        ]);
        return $this->index($request, "Updated Successfully");
    }
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "product_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->Response($validator->errors(), "Data not Valid ", 404);
        }
        $product = Products::find($request->product_id);
        Helpers::delete_file($product->image);
        $product->delete();
        return $this->index($request, "deleted Successfully");
    }
    public function addImageToProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "image" => "required",
            "product_id" => "required",
        ]);
        if ($validator->fails())
            return $this->Response($validator->errors(), "Data Not Valid", 404);
        ProductImages::create([
            "image" => Helpers::upload_files($request->image),
            "product_id" => $request->product_id,
        ]);
        $product = Products::where("id", $request->product_id)
            ->with(["images"])->first();
        $data = [
            "product" => $product,
        ];
        return $this->Response($data, "Product Details", 201);
    }
    public function deleteImageFromProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "image_id" => "required",
        ]);
        if ($validator->fails())
            return $this->Response($validator->errors(), "Data Not Valid", 404);
        $image = ProductImages::find($request->image_id);
        $product_id = $image->product_id;
        Helpers::delete_file($request->image_id);
        $image->delete();

        $product = Products::where("id", $product_id)
            ->with(["images"])->first();
        $data = [
            "product" => $product,
        ];
        return $this->Response($data, "Product Details", 201);
    }
}

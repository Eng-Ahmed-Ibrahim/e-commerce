<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use Illuminate\Http\Request;
use App\Models\Sliders;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pages;
use App\Models\Products;
use App\Models\Subscribe;
use Illuminate\Support\Facades\Validator;

class HomepageController extends Controller
{
    use ResponseTrait;
    public function index(){
        $sliders=Sliders::orderBy("id","DESC")->where("section","home")->get();
        $icons=Sliders::orderBy("id","DESC")->where("section","home_icons")->get();
        $categories=Category::orderBy("position")->withCount('sub_categories')->get();
        $products=Products::where("home_status",1)->get();
        $repair_section=Pages::find(4);
        $deal_of_the_day=Pages::find(5);
        $data=[
            "sliders"=>$sliders,
            "icons"=>$icons,
            "categories"=>$categories,
            "products"=>$products,
            "repair_section"=>$repair_section,
            "deal_of_the_day"=>$deal_of_the_day,
        ];
        return $this->Response($data,"Home Page",201);

    }
    public function add_slider(Request $request){
        $validator=Validator::make($request->all(),[
            "title"=>"required",
            "text"=>"required",
            "image"=>"required",

        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);
        $data=Sliders::create([
            "title"=>$request->title,
            "text"=>$request->text,
            "image"=>Helpers::upload_files($request->image),
        ]);
        return $this->Response($data,"Added Successfully",201);
    }
    public function update_slider(Request $request){
        $validator=Validator::make($request->all(),[
            "slider_id"=>"required",
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);
        $data=Sliders::find($request->slider_id);
        if($request->hasFile("image")){
            Helpers::delete_file($data->image);
            $data->update([
                "image"=>Helpers::upload_files($request->image),
            ]);
        }
        $data->update([
            "title"=>$request->title ?? $data->title,
            "text"=>$request->text ?? $data->text,
        ]);
        return $this->Response($data,"updated Successfully",201);
    }
    public function delete_slider(Request $request){
        $validator=Validator::make($request->all(),[
            "slider_id"=>"required",
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);
        $data=Sliders::find($request->slider_id);
        Helpers::delete_file($data->image);
        
        $data->delete();


        return $this->Response(null,"deleted Successfully",201);
    }
    public function update_icons(Request $request){
        $validator=Validator::make($request->all(),[
            "section_id"=>"required",
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);
        $page=Pages::find($request->section_id);
        if($request->hasFile("image")){
            Helpers::delete_file($page->image);
            $page->update([
                "image"=>Helpers::upload_files($request->image),
            ]);
        }
        $page->update([
            "title"=>$request->title ?? $page->title,
            "text"=>$request->text ?? $page->text,
        ]);
        return $this->Response($page,"Updated Successfully",201);
    }
    public function update_repair(Request $request){

        $page=Pages::find(4);
        if($request->hasFile("image")){
            Helpers::delete_file($page->image);
            $page->update([
                "image"=>Helpers::upload_files($request->image),
            ]);
        }
        $page->update([
            "title"=>$request->title ?? $page->title,
            "text"=>$request->text ?? $page->text,
        ]);
        return $this->Response($page,"Updated Successfully",201);
    }
    public function subscribe(Request $request){
        $validator=Validator::make($request->all(),[
            "email"=>"required",
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);
        if(Subscribe::where("email",$request->email)->first() != null  )
            return $this->Response(null,"This email already exists",404);
        $data=Subscribe::create([
            "email"=>$request->email,
        ]);
        return $this->Response($data,"Sent Successfully",201);
    }
    
}

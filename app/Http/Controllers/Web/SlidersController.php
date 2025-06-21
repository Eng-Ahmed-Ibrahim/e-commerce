<?php

namespace App\Http\Controllers\Web;

use App\CPU\Helpers;
use Illuminate\Http\Request;
use App\Models\Sliders;
use App\Http\Controllers\Controller;

class SlidersController extends Controller
{
    public function index(Request $request){
        $sliders=Sliders::where("section",$request->section)->orderBy("id","DESC")->get();
        return view("pages.sliders")
        ->with("sliders",$sliders)
        ;

    }
    public function add_slider(Request $request){

        $request->validate([
            "title"=>"required",
            "text"=>"required",
            "image"=>"required",
        ]);

        Sliders::create([
            "title"=>$request->title,
            "text"=>$request->text,
            "image"=>Helpers::upload_files($request->image),
            "section"=>$request->section,
        ]);
        session()->flash("success","Added Successfully" );
        return back();
    }
    public function update_slider(Request $request){
        
 
        $request->validate([
            "slider_id"=>"required",
        ]);
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
        session()->flash("success","Updated Successfully" );
        return back();
    }
    public function delete_slider(Request $request){
        $request->validate([
            "slider_id"=>"required",
        ]);
        $data=Sliders::find($request->slider_id);
        Helpers::delete_file($data->image);
        
        $data->delete();


        session()->flash("success","Deleted Successfully" );
        return back();
    }

}

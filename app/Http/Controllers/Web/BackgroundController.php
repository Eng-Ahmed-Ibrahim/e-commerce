<?php

namespace App\Http\Controllers\Web;

use App\CPU\Helpers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\Background;

class BackgroundController extends Controller
{
    public function index(Request $request){
        $request->validate([
            "section"=>"required",
        ]);
        $background=Background::where("section",$request->section)->first();
        if(! $background )
            return back();
        return view("pages.background")->with("background",$background);
    }
    public function update(Request $request){
        $request->validate([
            "title"=>"required",
            "text"=>"required",
            "section"=>"required",
        ]);
        $background=Background::where("section",$request->section)->first();
        if(! $background )
            return back();
        if($request->hasFile("image")){
            Helpers::delete_file($request->image);
            $background->update([
                "image"=>Helpers::upload_files($request->image)
            ]);
        }
        $background->update([
            "title"=>$request->title,
            "text"=>$request->text,
        ]);
        session()->flash("success","Updated Successfully");
        return back();
    }

}

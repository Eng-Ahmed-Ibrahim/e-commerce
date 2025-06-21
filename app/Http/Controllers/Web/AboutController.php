<?php

namespace App\Http\Controllers\Web;

use App\CPU\Helpers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;

class AboutController extends Controller
{

    public function index(){
        $about=AboutPage::find(1);
        return view("pages.about.index")
        ->with("about",$about)
        ;
    }
    public function update_section(Request $request){
        $request->validate([
            "hero_title"=>"required",
            "hero_text"=>"required",
            "text"=>"required",
        ]);
        $about=AboutPage::find(1);
        $about->update([
            "hero_title"=>$request->hero_title,
            "hero_text"=>$request->hero_text,
            "text"=>$request->text,
        ]);
        if($request->hasFile("hero_image")){
            Helpers::delete_file($about->hero_image);
            $about->update([
                "hero_image"=>Helpers::upload_files($request->hero_image),
            ]);
        }
        if($request->hasFile("logo")){
            Helpers::delete_file($about->logo);
            $about->update([
                "logo"=>Helpers::upload_files($request->logo),
            ]);
        }
        if($request->hasFile("image")){
            Helpers::delete_file($about->image);
            $about->update([
                "image"=>Helpers::upload_files($request->image),
            ]);
        }
        session()->flash("success","Updated Successfully");
        return back();
    }
}

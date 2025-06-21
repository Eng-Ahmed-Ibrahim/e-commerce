<?php

namespace App\Http\Controllers\Web;

use DateTime;
use App\CPU\Helpers;
use App\Models\Pages;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function repair_section()
    {
        $section=Pages::find(4);
        return view('pages.home.repair')
        ->with("section",$section)
        
        ;
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
        session()->flash("success","Updated Successfully");
        return back();
    }
    public function deal_section()
    {
        $section=Pages::find(5);
        return view('pages.home.deal')
        ->with("section",$section)
        
        ;
        
    }
    public function update_deal(Request $request){

        $page=Pages::find(5);

        if($request->hasFile("image")){
            Helpers::delete_file($page->image);
            $page->update([
                "image"=>Helpers::upload_files($request->image),
            ]);
        }
        if($request->hasFile("background")){
            Helpers::delete_file($page->background);
            $page->update([
                "background"=>Helpers::upload_files($request->background),
            ]);
        }
        $page->update([
            "title"=>$request->title ,
            "text"=>$request->text ,
            "link"=>$request->link,
        ]);
        session()->flash("success","Updated Successfully");
        return back();
    }
}

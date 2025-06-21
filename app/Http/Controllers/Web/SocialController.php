<?php

namespace App\Http\Controllers\Web;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index(){
        $socials=Social::orderBy("id","DESC")->get();
        return view("social.index")
        ->with("socials",$socials)
        
        ;
    }
    public function store(Request $request){
        $request->validate([
            "link"=>"required",
            "icon"=>"required",
        ]);
        Social::create([
            "link"=>$request->link,
            'icon'=>Helpers::upload_files($request->icon),
        ]);
        session()->flash("success","Added Successfully");
        return back();
    }
    public function edit($id){
        $social=Social::with(['features'])->find($id);
        return view('categories.edit')
        ->with("social",$social)
        ;
    }
    public function update(Request $request){
        $request->validate([
            "link"=>"required",
            "social_id"=>"required"
        ]);
        $social=Social::find($request->social_id);
        if(! $social)
            return back();
        if($request->hasFile("icon")){
            Helpers::delete_file($social->icon);
            $social->update([
                'icon'=>Helpers::upload_files($request->icon),
            ]);
        }
        $social->update([
            "link"=>$request->link,
        ]);
        session()->flash("success","Updated Successfully");
        return back();
    }
    public function destroy(Request $request){
        $request->validate([
            "social_id"=>"required"
        ]);
        $social=Social::find($request->social_id);
        if(! $social)
            return back();
        Helpers::delete_file($social->icon);

        $social->delete();
        session()->flash("success","Deleted Successfully");
        return back();
    }
    public function change_social_status($social_id){

        $social=Social::find($social_id);
        if(! $social)
            return back();
        $social->update([
            "status"=>$social->status == true ? false : true,
        ]);
        session()->flash("success","Updated Successfully");
        return back();
    }



}

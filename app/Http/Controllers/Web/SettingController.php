<?php

namespace App\Http\Controllers\Web;

use App\CPU\Helpers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingController extends Controller
{

    public function index(){
        $setting=Settings::find(1);
        return view("settings.index")
        ->with("setting",$setting)
        ;
    }
    public function update_section(Request $request){
        $request->validate([
            "address"=>"required",
            "description"=>"required",
            "phone"=>"required",
            "fax"=>"required",
            "box"=>"required",
        ]);
        $setting=Settings::find(1);
        $setting->update([
            "address"=>$request->address,
            "description"=>$request->description,
            "phone"=>$request->phone,
            "fax"=>$request->fax,
            "box"=>$request->box,
        ]);
        if($request->hasFile("logo_light")){
            Helpers::delete_file($setting->logo_light);
            $setting->update([
                "logo_light"=>Helpers::upload_files($request->logo_light),
            ]);
        }
        if($request->hasFile("logo_black")){
            Helpers::delete_file($setting->logo_black);
            $setting->update([
                "logo_black"=>Helpers::upload_files($request->logo_black),
            ]);
        }

        session()->flash("success","Updated Successfully");
        return back();
    }
    public function advertisement(){
        $advertisement = Settings::select('advertisement', 'advertisement_status')->where('id', 1)->first();
        return view('settings.advertisement')->with('advertisement', $advertisement);
        
        
    }
    public function update_advertisement_status(){
        $advertisement = Settings::find(1);
        $advertisement->update([
        ]);
        session()->flash("success","Updated Successfully");
        return back();

    }
    public function update_advertisement(Request $request){
        $advertisement = Settings::find(1);
        $advertisement->update([
            "advertisement"=>$request->advertisement ,
            "advertisement_status"=>$request->has('advertisement_status')  ? true: false,

        ]);
        session()->flash("success","Updated Successfully");
        return back();

    }
}

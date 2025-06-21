<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use App\Models\Social;
use App\Models\Sliders;
use App\Models\Settings;
use App\Models\AboutPage;
use App\Models\Background;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\CustomerServiceSurvey;
use Illuminate\Support\Facades\Validator;
use App\Mail\New_survey;

class ApiController extends Controller
{
    use ResponseTrait;
    public function about(){
        $about=AboutPage::find(1);
        $countries = Sliders::where("section","about_contries")->get();
        $data=[
            "about"=>$about,
            "countries"=>$countries,
        ];
        return $this->Response($data,"about page",201);
    }
    public function update_about(Request $request){
        $about=AboutPage::find(1);
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
        $about->update([
            "hero_title"=>$request->hero_title ?? $about->hero_title,
            "hero_text"=>$request->hero_text ?? $about->hero_text,
            "text"=>$request->text ?? $about->text,
        ]);
        return $this->about();
    }
    public function customer_service_surveys(Request $request){
        $validator=Validator::make($request->all(),[
            "name"=>"required",
            "phone"=>"required",
            "call_center_rate"=>"required",
            "service_rate"=>"required",
            "issue_resolved"=>"required",
            "recommend"=>"required",
            "after_sale_rate"=>"required",
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",422);
        $survey=CustomerServiceSurvey::create([
            "name"=>$request->name,
            "phone"=>$request->phone,
            "call_center_rate"=>$request->call_center_rate,
            "service_rate"=>$request->service_rate,
            "issue_resolved"=>$request->issue_resolved,
            "recommend"=>$request->recommend,
            "paid_amount"=>$request->paid_amount,
            "after_sale_rate"=>$request->after_sale_rate,
            "notes"=>$request->notes,
        ]);
        $data = [
            "survey"=>$survey,
            "company_information" => Settings::find(1),
        ];
        Mail::to("bassamhafez11@gmail.com")
        ->send(new New_survey($data));
        return $this->Response(null,"Sent Successfully",201);
    }
    public function background(Request $request){
        $validator=Validator::make($request->all(),[
            "section"=>"required"
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",422);
        $background=Background::where("section",$request->section)->first();
        $data=[
            "background"=>$background,
        ];
        return  $this->Response($data,"Background " ,201);
    }
    public function settings(){
        $socials=Social::orderBy("id","DESC")->where("status",true)->get();
        $settings=Settings::where("id",1)->first();
        $data=[
            "settings"=>$settings,
            "socials"=>$socials,
        ];
        return $this->Response($data,"Settings",201);
    }
}

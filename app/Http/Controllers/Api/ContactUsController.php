<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    use ResponseTrait;
    public function index(){
        $messages=ContactUs::orderBy("id","DESC")->get();
        $data=[
            "messages"=>$messages,
        ];
        return $this->Response($data,"Messages",201);
    }
    public function message_detail(Request $request){
        $validator=Validator::make($request->all(),[
            "message_id"=>"required",

        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);

        $message=ContactUs::find($request->message_id);
        $message->update([
            "status"=>1,
        ]);
        $data=[
            "message"=>$message,
        ];
        return $this->Response($data,"Message Details",201);
    }
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            "name"=>"required",
            "email"=>"required",
            "message"=>"required",
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);

        $data=ContactUs::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "message"=>$request->message,
            "phone"=>$request->phone,
        ]);
        return $this->Response($data,"Sent Successfully",201);
    }
}

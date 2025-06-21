<?php

namespace App\Http\Controllers\Api;

use App\Mail\Test;
use App\Models\User;
use App\Models\Repair;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\New_Repair;

class RepairController extends Controller
{
    use ResponseTrait;
    public function index(Request $request){
        if( $request->has("status")){
            $repairs=Repair::where("status",$request->status)->get();
        }else{
            $repairs=Repair::orderBy("status","ASC")->get();
        }
        $data=[
            "repair"=>$repairs,
        ];
        return $this->Response($data,"Repair", 201);

    }
    public function show(Request $request){
        $validator=Validator::make($request->all(),[
            "message_id"=>"required",

        ]);
        if($validator->errors())
            return $this->Response($validator->errors(),"Data Not Valid",404);

        $message=Repair::find($request->message_id);
        $message->update([
            "status"=>1,
        ]);
        $data=[
            "message"=>$message,
        ];
        return $this->Response($data,"Message Details",201);

    }
    public function store(Request $request){
        // $validator=Validator::make($request->all(),[
        //     "name"=>"required",
        //     "whatsapp"=>"required",
        //     "phone"=>"required",
        //     "city"=>"required",
        //     "serial_number"=>"required",
        //     "address"=>"required",
        //     "product"=>"required",
        //     "problem"=>"required",
        // ]);
        // if($validator->fails()){
        //     return $this->Response($validator->errors(),"Data not Valid ", 404);
        // }
        $users=User::where("role",1)->get();
        foreach($users as $user)
            $user->update([
                "notification_need_repair"=>$user->notification_need_repair+1,
            ]);
        $repair=Repair::create([
            "name"=>$request->name,
            "whatsapp"=>$request->whatsapp,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "serial_number"=>$request->serial_number,
            "address"=>$request->address,
            "city"=>$request->city,
            "product"=>$request->product,
            "problem"=>$request->problem,
        ]);
        $data = [
            "repair"=>$repair,
            "company_information" => Settings::find(1),
        ];
        Mail::to("bassamhafez11@gmail.com")
        ->send(new New_Repair($data));

        return $this->Response($repair,"Sent Successfully",201);
    }
    public function change_repair_status(Request $request){
        $validator=Validator::make($request->all(),[
            "repair_id"=>"required",
            "status"=>"required",
        ]);
        if($validator->fails())
            return $this->Response($validator->errors(),"Data Not Valid",404);
        

        $order=Repair::find($request->repair_id)->update([
            "status"=>$request->status,
        ]);
        return $this->Response($order,"Changed Successfully",201);
    }
}

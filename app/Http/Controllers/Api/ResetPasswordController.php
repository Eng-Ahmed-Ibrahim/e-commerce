<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    use ResponseTrait;
    public function sendCode(Request $request){
        $validator=Validator::make($request->all(),[
            "email"=>"required",
        ]);
        if($validator->fails()){
            return $this->Response($validator->errors(),"Data Not Valid",404);
        }
        $user=User::where("email",$request->email)->first();
        if($user==null){
            return $this->Response(null,"  Email not found",404);
        }

        $code= rand(1000,9999);
        while($user->reset_password_code == $code){
            $code=rand(1000,9999);
        }
        $user->update([
            "reset_password_code"=>$code,
        ]);


        Mail::to($user->email)
        ->send(new ResetPassword($code));
        return $this->Response(null,"A code has been sent to your email",201);

    }
    public function checkCode(Request $request){
        $validator=Validator::make($request->all(),[
            "code"=>"required",
        ]);
        if($validator->fails()){
            return $this->Response($validator->errors(),"Data Not Valid",404);
        }
        $user=User::where("reset_password_code",$request->code)->first();
        if($user==null){
            return $this->Response(null,"The code is wrong",404);
        }else{
            return $this->Response(null,"The code has been found. You can change the password",201);
        }
    }
    public function changePassword(Request $request){
        $validator=Validator::make($request->all(),[
            "new_password"=>"required",
            "confirm_password"=>"required",
            "code"=>"required",
            "email"=>"required",
        ]);
        if($validator->fails()){
            return $this->Response($validator->errors(),"Data Not Valid",404);
        }
        if($request->new_password != $request->confirm_password){
            return $this->Response(null,"password not match",404);
        }
        $user=User::where("email",$request->email)->update([
            'password' => Hash::make($request->new_password),

        ]);
        return $this->Response($user,"Password successfully changed",201);
    }

}

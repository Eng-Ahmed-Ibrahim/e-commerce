<?php

namespace App\Http\Controllers\Web;

use App\CPU\Helpers;
use App\Models\User;

use App\Models\AboutPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function index(){
        $user=User::find(auth()->user()->id);
        return view("profile.index")
        ->with("user",$user)
        ;
    }
    public function update(Request $request){
        $request->validate([
            "name"=>"required",
            "email"=>"required",
        ]);
        $user=User::find(auth()->user()->id);
        if($request->hasFile("image")){
            Helpers::delete_file($user->image);
            $user->update([
                "image"=>Helpers::upload_files($request->image),
            ]);
        }
        $user->update([
            "name"=>$request->name,
            "email"=>$request->email,
        ]);

        session()->flash("success","Updated Successfully");
        return back();
    }
}

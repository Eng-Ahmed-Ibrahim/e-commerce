<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Contracts\Providers\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    use ResponseTrait;
    
    public function users(Request $request)
    {

        $users=User::orderBy("id","DESC")->get();

        return $this->Response($users, "All Users", 201);
    }
    public function AddUser(Request $request)
    {


        $validator = Validator::make($request->all(), [
            "name" => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            "password" => 'required',
            "password_confirmation" => 'required',
            "role"=>"required",
        ]);
        if ($validator->fails()) {
            return $this->Response($validator->errors(), "Data Not Valid", 201);
        }

        if ($request->password_confirmation != $request->password) {
            return $this->Response(null, "The password does not match", 201);
        }


        $user = User::create([
            'name' => $request->name,
            "role"=>$request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);




        return $this->Response($user, "Added Successfully", 201);
    }
    public function UpdateUser(Request $request)
    {

        $user = User::find($request->selected_user_id);


        if ($request->has("new_password")) {
            if ($request->password_confirmation != $request->new_password) {
                return $this->Response(null, "The password does not match", 201);
            }
            $user->update([

                'password' => Hash::make($request->new_password),
            ]);
        }
        if ($request->hasFile("image")) {
            $extension = $request->extension();
            $image_name = time() . "." . $extension;
            $request->image->move(public_path("images/"), $image_name);
            $user->update([
                "profile_photo_path" => "https://gloriaapi.mass-fluence.com/images/$image_name",
            ]);
        }

        $user->update([
            'name' => $request->has("name") ?  $request->name : $user->name,
            'role' => $request->has("role") ?  $request->role : $user->role,
            'email' => $request->has("email") ?  $request->email : $user->email,
        ]);




        return $this->Response($user, "Updated  Successfully", 201);
    }
    public function DeleteUser(Request $request)
    {
        User::destroy($request->selected_user_id);
        return $this->Response(null, "Deleted Successfully", 201);
    }
}

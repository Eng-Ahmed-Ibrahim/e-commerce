<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(){
        $messages=ContactUs::orderBy("id",'DESC')->get();

        return view('messages.index')
        ->with("messages",$messages)
        ;
    }
    public function show($id){
        $message=ContactUs::find($id);
        $message->update([
            "status"=>1,
        ]);
        return view('messages.show')
        ->with("message",$message)
        ;
    }
    public function destroy($id){
        $order=ContactUs::find($id);
        if(! $order )
            return back();
        $order->delete();
        session()->flash("success","Message Deleted  Successfully");

        return back();
    }
}

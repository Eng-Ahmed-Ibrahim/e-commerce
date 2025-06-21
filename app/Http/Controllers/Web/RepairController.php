<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index(){
        $repairs=Repair::orderBy("id",'DESC')->get();

        return view('repair.index')
        ->with("repairs",$repairs)
        ;
    }
    public function show($id){
        $repair=Repair::find($id);
        $repair->update([
            "status"=>1,
        ]);
        return view('repair.show')
        ->with("repair",$repair)
        ;
    }
    public function destroy($id){
        $order=Repair::find($id);
        if(! $order )
            return back();
        $order->delete();
        session()->flash("success","Order Deleted  Successfully");

        return back();
    }
}

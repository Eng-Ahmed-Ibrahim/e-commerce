<?php

namespace App\Http\Controllers\Web;

use App\Models\Cart;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index(Request $request){
        $query=Orders::query();
        if($request->filled("status") && $request->status != "all")
            $query->where("status",$request->status);
        $orders=$query->orderBy("id","DESC")->paginate(15);
        return view('orders.index')
        ->with("orders",$orders)
        ;
    }
    public function show($order_id){
        $carts=Cart::where("group_id",$order_id)->orWhere("failed_group",$order_id)->with(["product"])->get();
        $order=Orders::find($order_id);
        return view('orders.show')
        ->with("carts",$carts)
        ->with("order",$order);

    }
    public function change_status($order_id,$status){
        $order=Orders::find($order_id);
        $order->update([
            "status"=>$status,
        ]);
        session()->flash("success","Status Updated Successfully");
        return back();
    }
    public function destroy($order_id){
        $order=Orders::find($order_id);
        if(! $order )
            return back();
        $order->delete();
        session()->flash("success","Order Deleted  Successfully");

        return back();
    }
}

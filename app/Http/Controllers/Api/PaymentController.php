<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use App\Models\Cart;
use App\Models\Orders;
use App\Mail\New_order;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Mail\ConfirmOrderCustomer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    use ResponseTrait;
    public $domain_ = "https://concordonlinestore.com";
    public function callback(Request $request)
    {

        $apiUrl = 'https://checkout.montypay.com/api/v1/payment/status';
        $merchantKey = env('MERCHANT_KEY');
        $merchant_password = env('MERCHANT_PASSWORD');
        $payment_id = $request->payment_id;
        $order_id = $request->order_id;
        $concatenated_string = $payment_id . $merchant_password;
        $md5_hash = md5(strtoupper($concatenated_string));
        $signature = sha1($md5_hash);

        $data = [
            'merchant_key' => $merchantKey,
            'payment_id' => $payment_id,
            "hash" => $signature,
        ];

        $response = Http::post($apiUrl, $data);

        // response return 
        if ($response->successful()) {
            $payment_status = json_decode($response->body(), true)["status"];
            $order=Orders::find($order_id);
            if(!$order){
                return redirect()->away($this->domain_ .'/payment-error');
            }
            if($payment_status=="settled"){
                $order->update([
                    "status"=>"confirmed",
                    "payment_id"=>$payment_id,
                ]);
                $carts = $order->user_id != null
                ? Cart::where("user_id", $order->user_id)->where("group_id", null)->with(["product"])->get()   
                : Cart::where("guest_id", $order->guest_id)->where("group_id", null)->with(["product"])->get();

                foreach ($carts as $cart) {
                    $cart->update([
                        "group_id" => $order->id,
                        "failed_group"=>null,
                    ]);
                }

                $data = [
                    "order" => $order,
                    "company_information" => Settings::find(1),
                    "carts"=>$carts,
                ];
                Mail::to("bassamhafez11@gmail.com")
                ->send(new New_order($data));
        
                Mail::to($order->email)
                    ->send(new ConfirmOrderCustomer($data));
                Helpers::push_orders_notification();
                return redirect()->away($this->domain_ .'/payment-success');

            }else{
                $order->delete();
                return redirect()->away($this->domain_ .'/payment-failed');
            }


            // return response()->json([$payment_status]);
        } else {
            return response()->json(['message' => 'Test Integration Failed', 'error' => $response->body()]);
        }
    }
    public function callback_cancel(Request $request)
    {
        $order_id = $request->order_id;
        // Orders::destroy($order_id);
  
        return redirect()->away($this->domain_ .'/payment-cancelled');

    }
}

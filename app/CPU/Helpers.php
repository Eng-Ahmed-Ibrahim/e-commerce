<?php

namespace App\CPU;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Notifications\pushNotification;

class Helpers
{
    public static function upload_files($file){
        $domain="https://admin.concordonlinestore.com/";
        $extension=$file->extension();
        $name=time() .str_replace([" ","-"],"_",$file->getClientOriginalName()) ;
        $file->move(public_path("files/"),$name);
        return $domain . "files/$name";

    }
    public static function delete_file($path){

        $file= str_replace("https://admin.concordonlinestore.com/files/","",$path) ;
        
        File::delete(public_path("files/$file"));


        return ;

    }
    public static function push_orders_notification(){
        $admins=User::where("role","admin")->get();
        $data=[
            "title"=>"New Order",
            "body"=>"New order check it out!",
            "url"=>route('orders'),
        ];
        foreach($admins as $admin){
            $admin->notify(new pushNotification($data));
        }
    }
    public static function push_message_notification(){
        $admins=User::where("role","admin")->get();
        $data=[
            "title"=>"New Message",
            "body"=>"A new message has been sent to you.!",
            "url"=>route('messages'),
        ];
        foreach($admins as $admin){
            $admin->notify(new pushNotification($data));
        }
    }
    public static function push_repairs_notification(){
        $admins=User::where("role","admin")->get();
        $data=[
            "title"=>"New Repair",
            "body"=>"There is a new repair request, check it out.!",
            "url"=>route('repair'),
        ];
        foreach($admins as $admin){
            $admin->notify(new pushNotification($data));
        }
    }
    public static function push_customer_surveys_notification(){
        $admins=User::where("role","admin")->get();
        $data=[
            "title"=>"New Customer Surveys",
            "body"=>"A customer has filled out a review. Check it out.!",
            "url"=>route('customer_surveys'),
        ];
        foreach($admins as $admin){
            $admin->notify(new pushNotification($data));
        }
    }

    public static function pay_with_montypay($data){
        $merchant_key = env('MERCHANT_KEY');
        $merchant_password =env('MERCHANT_PASSWORD');
        $apiUrl = 'https://checkout.montypay.com/api/v1/session';
        
        $customer_name = $data["customer_name"];
        $customer_email = $data["customer_email"];
        $order_number = $data["order_number"];
        $order_amount = $data["order_amount"]; // formate 0:00
        $order_currency = "USD";
        $order_description = "payment";
    
        $concatenated_string = $order_number . $order_amount . $order_currency . $order_description . $merchant_password;
        $md5_hash = md5(strtoupper($concatenated_string));
        $signature = sha1($md5_hash);
    
        $data = [
            'merchant_key' => $merchant_key,
            'operation' => "purchase",  
            'success_url' => "https://admin.concordonlinestore.com/payment/callback", 
            'cancel_url' => "https://admin.concordonlinestore.com/payment/callback/cancel",
            "hash" => $signature,
            "order" => [
                "number" => $order_number,
                "amount" => $order_amount,
                "currency" => "USD",
                "description" => "payment"
            ],
    
            "customer" => [
                "name" => $customer_name,
                "email" => $customer_email,
            ],
    
        ];
    
        $response = Http::post($apiUrl, $data);
    
        if ($response->successful()) {
            $redirect_url= json_decode($response->body(), true)["redirect_url"];
            return response()->json([
                'redirect_url' => $redirect_url,
            ]);
        } else {
            return response()->json(['message' => 'Integration Failed', 'error' => [
                "error"=>$response->body(),
                "data"=>$data,
            ]]);
        }
    }
}

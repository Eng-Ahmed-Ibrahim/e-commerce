<?php

namespace App\Http\Controllers\Api;

use Log;
use App\CPU\Helpers;
use App\Models\Cart;
use App\Models\User;
use App\Models\Orders;
use App\Mail\New_order;
use App\Models\Products;
use App\Models\Settings;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductColors;
use App\Mail\ConfirmOrderCustomer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    use ResponseTrait;
    public function index(Request $request, $message = null)
    {
        // Check if the user is authenticated
        if ($request->user()) {
            $user_id = $request->user()->id;

            $carts = Cart::where("user_id", $request->user()->id)->where("group_id", null)->with(["product"])->get();
        } else {
            $guest_id = $request->guest_id;
            $carts = Cart::where("guest_id", $guest_id)->where("group_id", null)->with(["product"])->get();
        }
        $data = [
            "cart" => $carts
        ];
        if ($message == null)
            $message = "Cart";
        return $this->Response($data, $message, 201);
    }
    public function add_to_cart(Request $request)
    {

        // Validate the request input
        $validator = Validator::make($request->all(), [
            "product_id" => "required|exists:products,id",  // Ensure product exists
            "quantity" => "required|integer|min:1",  // Ensure quantity is positive integer

        ]);

        if ($validator->fails()) {
            return $this->Response($validator->errors(), "Data Not Valid", 404);
        }

        // Initialize user and guest IDs
        $user_id = null;
        $guest_id = null;

        // Check if the user is authenticated
        if ($request->user()) {
            $user_id = $request->user()->id;
        } else {
            $guest_id =  $request->guest_id;
        }

        // Check if the product is already in the cart
        $check = Cart::where(function ($query) use ($user_id, $guest_id) {
            if ($user_id) {
                $query->where("user_id", $user_id);
            } else {
                $query->where("guest_id", $guest_id);
            }
        })
            ->where("group_id", null)
            ->where("color_name", $request->color_name)
            ->where("type", $request->type)
            ->where("product_id", $request->product_id)
            ->first();

        // If the product is already in the cart, return an error message
        if ($check) {
            return $this->Response(null, "Already Added to cart", 422);
        }

        // Retrieve product details for price and discount calculations
        $product = Products::find($request->product_id);
        $product_price = 0;
        $image = 0;
        if ($request->type == null || $request->type == "main_color") {
            $product_price = $product->price;
            $image = $product->image;
            $color = $product->color;
        } else {
            $product_color = ProductColors::where("color_name", $request->color_name)->first();
            $product_price = $product_color->price;
            $image = $product_color->image;
            $color = $product_color->color_name;
        }
        $price = $product_price * $request->quantity;
        // $discount = (($product_price * $product->discount) / 100) * $request->quantity;
        $discount = ($product->discount) * $request->quantity;
        $total = $price - $discount;

        // Create a new cart entry
        Cart::create([
            "user_id" => $user_id,  // Null for guest users
            "guest_id" => $guest_id,  // Null for authenticated users
            "product_id" => $request->product_id,
            "quantity" => $request->quantity,
            "price" => number_format($price, 2, '.', ''),
            "discount" => number_format($discount, 2, '.', ''),
            "total" => number_format($total, 2, '.', ''),
            "color_name" => $color,
            "image" => $image,
            "type" => $request->type,

        ]);

        // Return the updated cart
        return $this->index($request, "Added to Cart Successfully");
    }



    public function delete_From_cart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "cart_id" => "required",
        ]);
        if ($validator->fails())
            return $this->Response($validator->errors(), "Data Not Valid", 422);
        Cart::find($request->cart_id)->delete();
        return $this->index($request, "Deleted Successfully");
    }
    public function update_quantity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "cart_id" => "required",
            "quantity" => "required",
        ]);
        if ($validator->fails())
            return $this->Response($validator->errors(), "Data Not Valid", 422);

        $cart = Cart::where("id", $request->cart_id)
            ->first();
        if (! $cart)
            return $this->Response(null, "Not Found", 422);
        if ($request->quantity <= 0)
            return $this->Response(null, "The quantity must be greater than zero ", 422);


        $product = Products::find($cart->product_id);
        if ($cart->type == "main_color") {
            $product_price = $product->price;
        } else {
            $product_price = ProductColors::where("color_name", $cart->color_name)->first()->price;
        }

        $price = $product_price * $request->quantity;
        // $discount = (($product_price * $product->discount) / 100) * $request->quantity;
        $discount = ($product->discount) * $request->quantity;
        $total = $price - $discount;



        $cart->update([
            "quantity" => $request->quantity,
            "price" => number_format($price, 2, '.', ''),
            "discount" => number_format($discount, 2, '.', ''),
            "total" => number_format($total, 2, '.', ''),
        ]);
        return $this->Response(null, "Updated Successfully", 201);
    }


    public function orders(Request $request)
    {
        if ($request->has('status')) {
            $orders = Orders::where("status", $request->status)->with(["user"])->get();
        } else {
            $orders = Orders::orderBy("status", "ASC")->with(["user"])->get();
        }
        $data = [
            "orders" => $orders,
        ];
        return $this->Response($data, "Orders", 201);
    }
    public function orders_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "order_id" => "required",
        ]);
        if ($validator->fails())
            return $this->Response($validator->errors(), "Data Not Valid", 404);

        $orders = Cart::where("user_id", $request->user()->id)->get();
        $data = [
            "orders" => $orders,
        ];
        return $this->Response($data, "Order Details", 201);
    }
    public function confirm_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            "address" => "required",
            "apartment" => "required",
            "city" => "required",
            "phone" => "required",
            "email" => "required",
            "payment_method" => "nullable|string|in:cash_on_delivery,montypay",
        ]);
        if ($validator->fails())
            return $this->Response($validator->errors(), "Data Not Valid", 404);

        $user_id = null;
        $guest_id = null;

        if ($request->user()) {
            $user_id = $request->user()->id;
            $cartExists = Cart::where("user_id", $user_id)
                ->where("group_id", null)
                ->exists();
        } else {
            $guest_id = $request->guest_id;

            if (!$guest_id) {
                return $this->Response(null, "Guest ID is required", 422);
            }

            $cartExists = Cart::where("guest_id", $guest_id)
                ->where("group_id", null)
                ->exists();
        }

        if (!$cartExists) {
            return $this->Response(null, "Cart is Empty", 422);
        }

        $carts = $user_id
            ? Cart::where("user_id", $user_id)->where("group_id", null)->with(["product"])->get()
            : Cart::where("guest_id", $guest_id)->where("group_id", null)->with(["product"])->get();



        $price = 0;
        $discount = 0;
        foreach ($carts as $cart) {
            $price += $cart->price;
            $discount += $cart->discount;
        }
        $total = $price - $discount;

        $order = Orders::create([
            "name" => $request->first_name . " " . $request->last_name,
            "address" => $request->address,
            "apartment" => $request->apartment,
            "city" => $request->city,
            "phone" => $request->phone,
            "email" => $request->email,
            "user_id" => $user_id,
            "guest_id" => $guest_id,
            "products" => count($carts),
            "status" => $request->payment_method == "montypay" ? "failed" : "pending",
            "price" => number_format((float)$price, 2, '.', ''),
            "discount" => number_format($discount, 2, '.', ''),
            "total" => number_format((float)$total, 2, '.', ''),
            "payment_method" => $request->payment_method ?? "cash_on_delivery",
        ]);

        if ($request->payment_method == "montypay") {
            foreach ($carts as $cart) {
                $cart->update([
                    "failed_group" => $order->id,
                ]);
            }
            return Helpers::pay_with_montypay([
                "customer_name" => $request->first_name . " " . $request->last_name,
                "customer_email" => $request->email,
                "order_number" => $order->id,
                "order_amount" => number_format((float)$total, 2, '.', ''),
            ]);
        }
        foreach ($carts as $cart) {
            $cart->update([
                "group_id" => $order->id,
            ]);
        }
        $users = User::where("role", 1)->get();
        foreach ($users as $user)
            $user->update([
                "notification_order" => $user->notification_order + 1,
            ]);

        $data = [
            "order" => $order,
            "carts" => $carts,
            "company_information" => Settings::find(1),
        ];
        Mail::to("bassamhafez11@gmail.com")
        ->send(new New_order($data));

        Mail::to($request->email)
            ->send(new ConfirmOrderCustomer($data));
        Helpers::push_orders_notification();
        return $this->Response($order, "Confrimed", 201);
    }
    public function change_order_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "order_id" => "required",
            "status" => "required",
        ]);
        if ($validator->fails())
            return $this->Response($validator->errors(), "Data Not Valid", 404);


        $order = Orders::find($request->order_id)->update([
            "status" => $request->status,
        ]);
        return $this->Response($order, "Changed Successfully", 201);
    }
}

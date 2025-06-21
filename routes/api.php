<?php

use Spatie\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\RepairController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\HomepageController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\ResetPasswordController;


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::post("/send-email", [ResetPasswordController::class, "sendCode"]);
Route::post("/send-code", [ResetPasswordController::class, "checkCode"]);
Route::post("/reset-password", [ResetPasswordController::class, "changePassword"]);




Route::get("/home-page", [HomepageController::class, "index"]);
// Route::post("/add-slider",[HomepageController::class,"add_slider"]);
// Route::post("/update-slider",[HomepageController::class,"update_slider"]);
// Route::post("/delete-slider",[HomepageController::class,"delete_slider"]);
// Route::post("/update-icons",[HomepageController::class,"update_icons"]);
// Route::post("/update-repair",[HomepageController::class,"update_repair"]);
// Route::post("/subscribe",[HomepageController::class,"subscribe"]);


Route::get("/categories", [CategoryController::class, "index"]);
Route::get("/categories/{category_id}", [CategoryController::class, "index"]);
// Route::post("/add-category",[CategoryController::class,"store"]);
// Route::post("/update-category",[CategoryController::class,"update"]);
// Route::post("/delete-category",[CategoryController::class,"destroy"]);

Route::get("/products", [ProductsController::class, "index"]);
Route::get("/product-details", [ProductsController::class, "show"]);
// Route::post("/add-product",[ProductsController::class,"store"]);
// Route::post("/update-product",[ProductsController::class,"update"]);
// Route::post("/delete-product",[ProductsController::class,"destroy"]);
// Route::post("/add-image-to-product",[ProductsController::class,"addImageToProduct"]);
// Route::post("/delete-image-from-product",[ProductsController::class,"deleteImageFromProduct"]);


// Route::get("/orders",[CartController::class,"orders"]);
// Route::middleware("auth")->get("/order-details",[CartController::class,"orders_details"]);
// Route::post("/change-order-status",[CartController::class,"change_order_status"]);

// Route::get("/messages",[ContactUsController::class,"index"]);
// Route::get("/message-details",[ContactUsController::class,"message_detail"]);
// Route::post("/sent-message",[ContactUsController::class,"store"]);

// Route::get("/repairs",[RepairController::class,"index"]);
// Route::get("/repairs-details",[RepairController::class,"show"]);
Route::post("/need-repair", [RepairController::class, "store"]);
// Route::post("/change-repair-status",[RepairController::class,"change_repair_status"]);


// Route::get('/users',[UsersController::class , 'users']);
// Route::post('/add-user',[UsersController::class , 'AddUser']);
// Route::post('/update-user',[UsersController::class , 'UpdateUser']);
// Route::post('/delete-user',[UsersController::class , 'DeleteUser']);

Route::get('/settings', [ApiController::class, "settings"]);
Route::get('/background', [ApiController::class, "background"]);
Route::get('/about', [ApiController::class, "about"]);
// Route::post('/update-about',[ApiController::class,"update_about"]);

Route::post("/customer-service-survey", [ApiController::class, "customer_service_surveys"]);




Route::get('montypay', function () {    

    
    $merchantKey = '34937ecc-03f7-11f0-8052-66dac523b78c';

    $apiUrl = 'https://checkout.montypay.com/api/v1/session';
    
    $order_number = "2";
    $order_amount = "0.10";
    $order_currency = "USD";
    $order_description = "payment";
    $merchant_password = "04daa1d14377a9b9621824adc0287199";

    $concatenated_string = $order_number . $order_amount . $order_currency . $order_description . $merchant_password;
    $md5_hash = md5(strtoupper($concatenated_string));
    $signature = sha1($md5_hash);

    $data = [
        'merchant_key' => $merchantKey,
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
            "name" => "test test",
            "email" => "test@gmail.com",
        ],

    ];

    $response = Http::post($apiUrl, $data);

    if ($response->successful()) {
        $redirect_url= json_decode($response->body(), true)["redirect_url"];
        return redirect()->away($redirect_url);
    } else {
        return response()->json(['message' => 'Test Integration Failed', 'error' => $response->body()]);
    }
});

Route::middleware('jwt.verify')->group(function () {
    // Apply the `jwt.verify` middleware
    Route::post("/add-to-cart", [CartController::class, "add_to_cart"]);
    Route::get("/carts", [CartController::class, "index"]);
    Route::post("/delete-from-cart", [CartController::class, "delete_from_cart"]);
    Route::post("/add-order", [CartController::class, "confirm_order"]);
    Route::post("/update-quantity", [CartController::class, "update_quantity"]);
});

// Route::post("/add-to-cart", [CartController::class, "add_to_cart"]);

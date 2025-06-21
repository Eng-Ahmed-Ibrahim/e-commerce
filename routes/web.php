<?php

use App\Mail\Test;
use App\Models\Cart;
use App\Models\User;
use App\Models\Pages;
use App\Models\Repair;
use App\Models\Social;
use App\Models\Sliders;
use App\Models\Category;
use App\Models\Products;
use App\Models\Settings;
use App\Models\AboutPage;
use App\Models\Background;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\ProductColors;
use App\Models\ProductImages;
use App\Models\CategoriesFeatures;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\OrdersController;
use App\Http\Controllers\Web\RepairController;
use App\Http\Controllers\Web\SocialController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Web\SlidersController;
use App\Http\Controllers\Web\MessagesController;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\BackgroundController;
use App\Http\Controllers\Web\CategoriesController;
use App\Http\Controllers\Web\SubCategoryController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\CustomerSurveysController;


Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'login')->name('login');
    Route::view('/', 'login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/order', function () {
        $carts = Cart::where("group_id", 23)->with(["product"])->get();
        return $carts;
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/categories', [CategoriesController::class, "index"])->name("categories");
    Route::get('/category/edit/{id}', [CategoriesController::class, "edit"])->name("category.edit");
    Route::post('/category/add-feature', [CategoriesController::class, "add_feature_to_category"])->name("category.add_feature");
    Route::post('/category/delete-feature', [CategoriesController::class, "delete_feature_from_category"])->name("category.delete_feature");
    Route::post('/add-category', [CategoriesController::class, "store"])->name("category.store");
    Route::post('/update-category', [CategoriesController::class, "update"])->name("category.update");
    Route::post('/delete-category', [CategoriesController::class, "destroy"])->name("category.delete");
    Route::post('/update-categories-position', [CategoriesController::class, "updatePosition"])->name("categories.update-position");

    Route::get('/subcategory', [SubCategoryController::class, "index"])->name("subcategory");

    Route::get('/subcategories/{category_id}', [SubCategoryController::class, 'getSubcategories']);

    Route::post('/add-subcategory', [SubCategoryController::class, "store"])->name("subcategory.store");
    Route::post('/update-subcategory', [SubCategoryController::class, "update"])->name("subcategory.update");
    Route::post('/delete-subcategory', [SubCategoryController::class, "destroy"])->name("subcategory.delete");

    Route::get('/products', [ProductsController::class, "index"])->name("products");
    Route::get('/add-product', [ProductsController::class, "create"])->name("product.create");
    Route::get('/eidt-product/{product_id}', [ProductsController::class, "edit"])->name("product.edit");
    Route::post('/add-product', [ProductsController::class, "store"])->name("product.store");
    Route::post('/update-product', [ProductsController::class, "update"])->name("product.update");
    Route::post('/delete-product', [ProductsController::class, "destroy"])->name("product.delete");
    Route::post('/update-home-status-product', [ProductsController::class, "change_home_status"])->name("product.change_home_status");
    Route::post('/delete-product-image', [ProductsController::class, "delete_product_image"])->name("product.delete_image");
    Route::post('/delete-product-all-image', [ProductsController::class, "delete_all_image_product"])->name("product.delete_all_image_product");
    Route::get('/get-product-colors', [ProductsController::class, 'get_product_colors'])->name('product.get_product_colors');
    Route::post('/add-product-color', [ProductsController::class, 'add_product_color'])->name('product.add_product_color');
    Route::post('/update-product-color', [ProductsController::class, 'update_product_color'])->name('product.update_product_color');
    Route::post('/delete-product-color', [ProductsController::class, 'delete_product_color'])->name('product.delete_product_color');
    Route::post('/products/update-position', [ProductsController::class, 'updatePosition'])->name('products.update-position');

    Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
    Route::get('/order/details/{order_id}', [OrdersController::class, 'show'])->name('order.show');
    Route::get('/order/change-status/{order_id}/{status}', [OrdersController::class, 'change_status'])->name('order.change_status');
    Route::post("/order/delete/{order_id}", [OrdersController::class, "destroy"])->name('order.delete');
    Route::get('/repair', [RepairController::class, 'index'])->name('repair');
    Route::get('/repair/{id}', [RepairController::class, 'show'])->name('repair.show');
    Route::post('/repair/delete/{id}', [RepairController::class, 'destroy'])->name('repair.delete');

    Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
    Route::get('/messages/{id}', [MessagesController::class, 'show'])->name('messages.show');
    Route::post('/messages/{id}', [MessagesController::class, 'destroy'])->name('messages.delete');

    Route::get('/customer-surveys', [CustomerSurveysController::class, 'index'])->name('customer_surveys');
    Route::get('/customer-surveys/{id}', [CustomerSurveysController::class, 'show'])->name('customer_surveys.show');
    Route::post('/customer-surveys/{id}', [CustomerSurveysController::class, 'destroy'])->name('customer_surveys.delete');

    Route::post("/notification-mark", [NotificationController::class, 'mark_read'])->name('notifications.markAsSeen');

    Route::get('/sliders', [SlidersController::class, 'index'])->name('sliders');
    Route::post('/add-slider', [SlidersController::class, "add_slider"])->name("slider.store");
    Route::post('/update-slider', [SlidersController::class, "update_slider"])->name("slider.update");
    Route::post('/delete-slider', [SlidersController::class, "delete_slider"])->name("slider.delete");

    Route::get('/about-us', [AboutController::class, 'index'])->name('about_section');
    Route::post('/update-section', [AboutController::class, "update_section"])->name("about.update_section");

    Route::get('/setting-us', [SettingController::class, 'index'])->name('setting_section');
    Route::post('/update-setting-section', [SettingController::class, "update_section"])->name("setting.update_section");
    Route::get('/advertisement', [SettingController::class, 'advertisement'])->name('advertisement');
    Route::post('/update-advertisement', [SettingController::class, "update_advertisement"])->name("setting.update_advertisement");

    Route::get('/background', [BackgroundController::class, 'index'])->name('background');
    Route::post('/update-background', [BackgroundController::class, "update"])->name("update_background");

    Route::get('/socials', [SocialController::class, "index"])->name("socials");
    Route::get('/change-social-status/{social_id}', [SocialController::class, "change_social_status"])->name("change_social_status");
    Route::post('/add-social', [SocialController::class, "store"])->name("social.store");
    Route::post('/update-social', [SocialController::class, "update"])->name("social.update");
    Route::post('/delete-social', [SocialController::class, "destroy"])->name("social.delete");

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/update-profile', [ProfileController::class, "update"])->name("update_profile");

    Route::get('/home/repair-section', [HomeController::class, 'repair_section'])->name('home.repair_section');
    Route::post('/home/update-repair', [HomeController::class, "update_repair"])->name("home.update_repair");

    Route::get('/home/deal-section', [HomeController::class, 'deal_section'])->name('home.deal_section');
    Route::post('/home/update-deal', [HomeController::class, "update_deal"])->name("home.update_deal");
});

Route::get("/change-route", function () {
    return ;
    $modelsAndColumns = [
        AboutPage::class => ['hero_image', 'logo', 'image'],
        Background::class => ['image'],
        Category::class => ['image'],
        CategoriesFeatures::class => ['image'],
        Pages::class => ['image', 'background'],
        Products::class => ['image'],
        ProductColors::class => ['image'],
        ProductImages::class => ['image'],
        Settings::class => ['logo_light', 'logo_black'],
        Sliders::class => ['image'],
        Social::class => ['icon'],
        Subcategory::class => ['image'],
        User::class => ['image'],
    ];

    $oldUrl = 'https://concordapi.mass-fluence.com';
    $newUrl = 'https://admin.concordonlinestore.com';

    foreach ($modelsAndColumns as $model => $columns) {
        $records = $model::all();
        foreach ($records as $record) {
            $updated = false;
            foreach ($columns as $column) {
                if ($record->$column !== null && strpos($record->$column, $oldUrl) !== false) {
                    $record->$column = str_replace($oldUrl, $newUrl, $record->$column);
                    $updated = true;
                }
            }
            if ($updated) {
                $record->save(); // Save the record only if any column was updated
            }
        }
    }

    return "URLs updated successfully!";
});

Route::match(['get', 'post'],'/payment/callback', [PaymentController::class,'callback'])->name('payment.callback');
Route::match(['get', 'post'],'/payment/callback/cancel', [PaymentController::class,'callback_cancel'])->name('payment.failed');










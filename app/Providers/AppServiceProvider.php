<?php

namespace App\Providers;

use App\Models\Orders;
use App\Models\ContactUs;
use App\Models\CustomerServiceSurvey;
use App\Models\Repair;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $total_pending_booking=Orders::where("status","pending")->count();
        $total_repairs=Repair::where("status",0)->count();
        $total_messages=ContactUs::where("status",0)->count();
        $total_customers_services_survey=CustomerServiceSurvey::where("seen",0)->count();
        $sharedData=[
            "total_pending_booking"=>$total_pending_booking,
            "total_repairs"=>$total_repairs,
            "total_messages"=>$total_messages,
            "total_customers_services_survey"=>$total_customers_services_survey,
        ];
        View::share('sharedData', $sharedData);

    }
}

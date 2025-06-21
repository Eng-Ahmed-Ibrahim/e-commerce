<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CustomerServiceSurvey;
use Illuminate\Http\Request;

class CustomerSurveysController extends Controller
{
    public function index(){
        $customer_surveys=CustomerServiceSurvey::orderBy("id",'DESC')->get();

        return view('customer_surveys.index')
        ->with("customer_surveys",$customer_surveys)
        ;
    }
    public function show($id){
        $customer_survey=CustomerServiceSurvey::find($id);
        $customer_survey->update(["seen"=>1]);
        return view('customer_surveys.show')
        ->with("customer_survey",$customer_survey)
        ;
    }
    public function destroy($id){
        $order=CustomerServiceSurvey::find($id);
        if(! $order )
            return back();
        $order->delete();
        session()->flash("success","Deleted  Successfully");

        return back();
    }
}

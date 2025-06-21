@extends("app")
@section('title','customer service surveys details')
@section('css')
<style>
    .text-bold{
        font-weight: bold;
    }
</style>
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">customer service surveys details</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-6 col-sm-12">From : <span class="text-bold">{{$customer_survey->name}}</span></div>
                <div class="col-lg-6 col-sm-12">Phone :<span class="text-bold"> {{$customer_survey->phone}}  </span></div>
                <div class="col-lg-6 col-sm-12">Call center Rate : {{$customer_survey->call_center_rate}} / 5 </div>
                <div class="col-lg-6 col-sm-12">Service Rate : {{$customer_survey->service_rate}} / 5 </div>
                <div class="col-lg-6 col-sm-12">Issue Resolved :<span class="text-bold"> <span class="badge text-bg-{{$customer_survey->issue_resolved == 1 ? 'success' :'danger'}}">{{$customer_survey->issue_resolved == 1 ? 'Yes' :'No'}}</span>  </span></div>
                <div class="col-lg-6 col-sm-12">Recommend :<span class="text-bold"> <span class="badge text-bg-{{$customer_survey->recommend == 1 ? 'success' :'danger'}}">{{$customer_survey->recommend == 1 ? 'Yes' :'No'}}</span>  </span></div>
                <div class="col-lg-6 col-sm-12">Paid Amount :<span class="text-bold"> {{$customer_survey->paid_amount}}  </span></div>
                <div class="col-lg-6 col-sm-12">After Sale Rate  : {{$customer_survey->after_sale_rate}} / 5 </div>
            </div>
            <h3 class="mt-3">Notes:</h3>
            <div>
                {{$customer_survey->notes}}
            </div>
        </div>
    </div>
    <!-- ROW-1 END -->
</div>
@endsection
    @section('js')
    @endsection
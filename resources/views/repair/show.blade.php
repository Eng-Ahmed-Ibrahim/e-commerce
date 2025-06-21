@extends("app")
@section('title','Repair Details')
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
        <h1 class="page-title">Repair Details</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-6 col-sm-12">From : <span class="text-bold">{{$repair->name}}</span></div>
                <div class="col-lg-6 col-sm-12">Email : {{$repair->email}} </div>
                <div class="col-lg-6 col-sm-12">Phone :<span class="text-bold"> {{$repair->phone}}  </span></div>
                <div class="col-lg-6 col-sm-12">Whatsapp :<span class="text-bold"> {{$repair->whatsapp}} </span> </div>
                <div class="col-lg-6 col-sm-12">City : {{$repair->city}} </div>
                <div class="col-lg-6 col-sm-12">Address : {{$repair->address}} </div>
                <div class="col-lg-6 col-sm-12">Product : {{$repair->product}} [ {{$repair->serial_number}} ] </div>
            </div>
            <h3 class="mt-3">Problem:</h3>
            <div>
                {{$repair->problem}}
            </div>
        </div>
    </div>
    <!-- ROW-1 END -->
</div>
@endsection
    @section('js')
    @endsection
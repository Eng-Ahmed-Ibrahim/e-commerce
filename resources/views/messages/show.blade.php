@extends("app")
@section('title','Message Details')
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
        <h1 class="page-title">Message Details</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-6 col-sm-12">From : <span class="text-bold">{{$message->name}}</span></div>
                <div class="col-lg-6 col-sm-12">Email : {{$message->email}} </div>
                <div class="col-lg-6 col-sm-12">Phone :<span class="text-bold"> {{$message->phone}}  </span></div>
            </div>
            <h3 class="mt-3">Message:</h3>
            <div>
                {{$message->message}}
            </div>
        </div>
    </div>
    <!-- ROW-1 END -->
</div>
@endsection
    @section('js')
    @endsection
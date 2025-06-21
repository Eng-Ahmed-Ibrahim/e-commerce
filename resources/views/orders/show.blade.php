@extends("app")
@section('title','Order Details')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Order Details#214</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-sm-12 my-2">
                    <div class="text-bold">Customer name: {{$order->name}} </div>
                    <div class="text-bold">Phone: {{$order->phone}} </div>
                    <div class="text-bold">Email: {{$order->email}} </div>
                    <div class="text-bold">Address: {{$order->address}} </div>
                    <div class="text-bold">City: {{$order->city}} </div>
                </div>
                <div class="col-lg-6 col-sm-12 my-2">
                    <div>Price : {{$order->price}}</div>
                    <div>Discount : {{$order->discount}} </div>
                    <div>Total : {{$order->total}} </div>
                    <div>Status : 
                        @if($order->status == "pending")
                        <span class="badge text-bg-warning">Pending</span>
                        @elseif($order->status=="confirmed")
                        <span class="badge text-bg-info">Confirmed</span>
                        @elseif($order->status == "out_for_Delivery")
                        <span class="badge text-bg-warning">Out for Delivery</span>
                        @elseif($order->status=="delivered")
                        <span class="badge text-bg-success">Delivered</span>
                        @elseif($order->status=="returned")
                        <span class="badge text-bg-danger">returned</span>
                        @elseif($order->status=="failed_to_delivery")
                        <span class="badge text-bg-secondary">Failed To Delivery</span>
                        @elseif($order->status=="canceled")
                        <span class="badge text-bg-dark">Canceled</span>
                        @endif
                    </div>
                    <div  class="my-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" style="padding: 2px;" data-bs-toggle="dropdown" aria-expanded="false">
                                Change Status
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('order.change_status',['order_id'=>$order->id,'status'=>'pending'])}}">Pending</a></li>
                                <li><a class="dropdown-item" href="{{route('order.change_status',['order_id'=>$order->id,'status'=>'confirmed'])}}">Confirmed</a></li>
                                <li><a class="dropdown-item" href="{{route('order.change_status',['order_id'=>$order->id,'status'=>'out_for_Delivery'])}}">Out for Delivery</a></li>
                                <li><a class="dropdown-item" href="{{route('order.change_status',['order_id'=>$order->id,'status'=>'delivered'])}}">Delivered</a></li>
                                <li><a class="dropdown-item" href="{{route('order.change_status',['order_id'=>$order->id,'status'=>'returned'])}}">Returned</a></li>
                                <li><a class="dropdown-item" href="{{route('order.change_status',['order_id'=>$order->id,'status'=>'failed_to_delivery'])}}">Failed To Delivery</a></li>
                                <li><a class="dropdown-item" href="{{route('order.change_status',['order_id'=>$order->id,'status'=>'canceled'])}}">Canceled</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="table-responsive my-4">
                <table class="table table-bordered table-vcenter text-nowrap">
                    <thead>
                        <tr class="border-top">
                            <th class="text-center w-30">Product Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Color</th>
                            <th class="text-center">quantity</th>
                            <th class="text-center">Discount</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $cart )
                        <tr>
                            <td class="text-center">{{$cart->product->name}}</td>
                            <td class="text-center">{{$cart->price}}</td>
                            <td class="text-center"><img src="{{$cart->image}}" style="height:70px" alt=""></td>
                            <td class="text-center">{{$cart->color_name}} <span style="border: 2px solid rgb(221, 221, 221);margin: 0 10px; padding:5px 10px;background:{{$cart->color_name}};"></span></td>
                            <td class="text-center">{{$cart->quantity}}</td>
                            <td class="text-center">{{$cart->discount}}</td>
                            <td class="text-center">{{$cart->total}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5"></td>
                            <td class="text-center bg-primary " style="color: white;">{{$order->discount}}</td>
                            <td class="text-center bg-primary " style="color: white;">{{$order->total}}</td>
                        </tr>


                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- ROW-1 END -->
</div>
@endsection
@section('js')
@endsection
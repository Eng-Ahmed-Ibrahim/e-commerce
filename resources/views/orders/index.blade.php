@extends("app")
@section('title','Orders')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Orders</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">
            <form id="form" class="col-lg-4 col-md-6 col-sm-10 mb-2">
                <select id="status-select" name="status" class="form-select " onchange="document.getElementById('form-categories').submit()">
                    <option {{request('status') == "pending" ? 'selected' : ' '}} value="pending">Pending</option>
                    <option {{request('status') == "confirmed" ? 'selected' : ' '}} value="confirmed">Confirmed</option>
                    <option {{request('status') == "out_for_Delivery" ? 'selected' : ' '}} value="out_for_Delivery">Out For Delivery</option>
                    <option {{request('status') == "delivered" ? 'selected' : ' '}} value="delivered">Delivered</option>
                    <option {{request('status') == "returned" ? 'selected' : ' '}} value="returned">Returned</option>
                    <option {{request('status') == "failed_to_delivery" ? 'selected' : ' '}} value="failed_to_delivery">Failed To Delivery</option>
                    <option {{request('status') == "canceled" ? 'selected' : ' '}} value="canceled">Canceled</option>
                    <option {{(request('status') == "all" || request('status') === null ) ? 'selected' : ' '}} value="all">All</option>
                    
                </select>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-vcenter text-nowrap">
                    <thead>
                        <tr class="border-top">
                            <th class="text-center">#</th>
                            <th class="text-center w-30">Customer Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Discount</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Payment Type</th>
                            <th class="text-center">Created At</th>

                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $index=> $order)
                        <tr>
                            <td class="text-center"> 
                                <a href="{{route('order.show',$order->id)}}">#{{$index + 1}}</a>
                            </td>
                            <td class="text-center">{{$order->name}}</td>
                            <td class="text-center">{{$order->price}}</td>
                            <td class="text-center">{{$order->discount}}</td>
                            <td class="text-center">{{$order->total}}</td>
                            <td class="text-center">
                                @if($order->status == "pending")
                                <span class="badge text-bg-warning">Pending</span>
                                @elseif($order->status=="confirmed")
                                <span class="badge text-bg-info">Confirmed</span>
                                @elseif($order->status=="failed")
                                <span class="badge text-bg-danger">Failed</span>
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

                            </td>
                            <td>{{$order->payment_method=="cash_on_delivery"?"Cash On Delivery" : "Paid by Credit Card"}}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($order->created_at)->format('m-d-Y') }}</td>
                            <td class="text-center">

                                 <a href="{{route('order.show',$order->id)}}" class="btn">
                                     <i style="font-size: 20px;color: #3838c2;" class="zmdi zmdi-eye" data-bs-toggle="tooltip" title="" data-bs-original-title="View" aria-label="zmdi zmdi-eye"></i>
                                  </a>
                                <form id="delete-form-{{ $order->id }}" action="{{ route('order.delete', $order->id) }}" method="post" style="display: inline-block;">
                                    @csrf
                                    <button type="button" class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete" onclick="confirmDelete({{ $order->id }})">
                                        <span class="bi bi-trash fs-16"></span>
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
            @if ($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $orders->appends(['status' => request('status')])->links() }}
            @endif
            </div>
        </div>
    </div>
    <!-- ROW-1 END -->
</div>
@endsection
@section('js')
<script>
    function confirmDelete(orderId) {
        if (confirm(`Are you sure you want to delete this #${orderId} order?`)) {
            document.getElementById('delete-form-' + orderId).submit();
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        let formSelect = document.getElementById("status-select");

        formSelect.addEventListener("change", function() {
            let categoryId = formSelect.value;
            if (categoryId) {
                const baseUrl = "{{ url('orders') }}"; // Replace 'your-url-here' with your actual route
                window.location.href = `${baseUrl}?status=${categoryId}`;
            }
        });
    })
</script>
@endsection
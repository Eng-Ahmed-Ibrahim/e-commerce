@extends("app")
@section('title','Products')
@section('css')
<style>
    th{
        font-size: 14px;
    }
</style>
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Products</h1>
        <a class="btn btn-primary " href="{{route('product.create')}}"><i class="fa fa-plus-square me-2"></i>New Product</a>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="row my-2">

                <form id="form-categories" class="col-lg-4 col-md-6 col-sm-10 mb-2" style="display: flex; align-items:center">
                    <select id="pagination-select" name="pagination" class="form-select " style="width: 75px;margin-right:5px">
                        <option {{(request('pagination') == "25" || request('pagination') === null ) ? 'selected' : ' '}} value="25">25</option>
                        <option {{request('pagination') == "50" ? 'selected' : ' '}} value="50">50</option>
                        <option {{request('pagination') == "100" ? 'selected' : ' '}} value="100">100</option>
                        <option {{request('pagination') == "all" ? 'selected' : ' '}}  value="all">all</option>
                    </select>
                    <select id="categories-select" name="category_id" class="form-select">
                        <!-- Default option to avoid auto-select -->
                        <option value="" disabled {{ is_null(request('category_id')) ? 'selected' : '' }}>Categories</option>

                        <!-- Loop through categories -->
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </form>




                <form class="col-lg-4 col-md-6 col-sm-12 mb-2 " style="display: flex; align-items:center">
                    <input value="{{$search }}" placeholder="search..." type="search" class="form-control mx-1" name="search" style="width: 85%;margin: 0 !important;border-radius: 5px 0 0 5px;">
                    <button type="submit" style="width: 10%; display:flex;align-items:center;justify-content:center;padding:7px;border-radius: 0px 5px 5px 0px;height:100%" class="btn btn-primary">
                        <svg style="height: 18px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#ffffff" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                        </svg>
                    </button>
                </form>



            </div>
            <div class="table-responsive" style=" overflow-y: auto;">
    <table class="table table-bordered table-vcenter text-nowrap" id="product-table">
        <thead>
            <tr class="border-top">
                <th class="text-center"><span class="p-2"></span></th>
                <th class="text-center">Name</th>
                <th class="text-center">Price</th>
                <th class="text-center">Discount</th>
                <th class="text-center">Price After Discount</th>
                <th class="text-center w-30">Category</th>
                <th class="text-center">Image</th>
                <th class="text-center">Home Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr data-id="{{ $product->id }}">
                <td>
                    <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
                    </svg>
                </td>
                <td class="text-center">{{$product->name}}</td>
                <td class="text-center">{{$product->price}}$</td>
                <td class="text-center">{{$product->discount}}$</td>
                <td class="text-center">{{ number_format(($product->price - $product->discount), 2, '.', '')}}$</td>
                
                <td class="text-center">{{$product->category->name}}</td>
                <td>
                    <div class="text-center">
                        <img src="{{$product->image}}" alt="" class="cart-img text-center">
                    </div>
                </td>
                <td>
                    <form action="{{route('product.change_home_status')}}" id="form-home-status-{{$product->id}}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <label class="switch">
                            <input onchange="document.getElementById('form-home-status-{{$product->id}}').submit()" type="checkbox" {{$product->home_status ==1 ? "checked" : ' '}}>
                            <span class="slider round"></span>
                        </label>
                    </form>
                </td>
                <td class="text-center">
                    <div class="g-2 text-center">
                        <a href="{{route('product.edit',$product->id)}}" class="btn text-secondary bg-secondary-transparent btn-icon py-1 me-2">Edit</a>
                        <form action="{{route('product.delete')}}" method="post" style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                <span class="bi bi-trash fs-16"></span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
            @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $products->appends(['pagination' => request('pagination', 25)])->links() }}
            @endif
            </div>

        </div>

    </div>
    <!-- ROW-1 END -->
</div>




@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const productTable = document.querySelector('#product-table tbody');

    const sortable = new Sortable(productTable, {
        animation: 300,
        scroll: true, // Enable scrolling
        scrollSensitivity: 30, // Sensitivity, lower values will trigger scrolling sooner
        scrollSpeed: 10, // Speed of scroll, higher value is faster
        onEnd: function () {
            // Retrieve all products globally instead of just the current page's products
            const positions = Array.from(document.querySelectorAll('#product-table tbody tr')).map((row, index) => {
                return {
                    id: row.getAttribute('data-id'),
                    position: index + 1
                };
            });

            console.log(positions);

            // Send the updated positions for all products
            fetch("{{ route('products.update-position') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    positions: positions,
                    page: '{{ request('page', 1) }}', // Current page number
                    itemPerPage: '{{ request('pagination', 25) }}', // Number of items per page
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // alert('Position updated successfully');
                } else {
                    alert('Failed to update position');
                }
            });
        }
    });
});

</script>





<script>
    function SetDate(id, name, image) {
        document.getElementById("id").value = id;
        document.getElementById('name').value = name;
        document.getElementById('img').setAttribute("src", image);
    }
    document.addEventListener("DOMContentLoaded", function() {
        let formSelect = document.getElementById("categories-select");

        formSelect.addEventListener("change", function() {
            let categoryId = formSelect.value;
            if (categoryId) {
                const baseUrl = "{{ url('products') }}"; // Replace 'your-url-here' with your actual route
                window.location.href = `${baseUrl}?category_id=${categoryId}`;
            }
        });
        let pagination = document.getElementById("pagination-select");

        pagination.addEventListener("change", function() {
            let paginationValue = pagination.value;
            if (paginationValue) {
                const baseUrl = "{{ url('products') }}"; // Replace 'your-url-here' with your actual route
                window.location.href = `${baseUrl}?pagination=${paginationValue}`;
            }
        });
    });
</script>

@endsection
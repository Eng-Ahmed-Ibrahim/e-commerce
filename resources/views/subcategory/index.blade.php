@extends("app")
@section('title','Sub Category')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Sub Category</h1>
        <button class="btn btn-primary " data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="fa fa-plus-square me-2"></i>New Subcategory</button>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">
        <div class="row my-2">
                <form id="form-categories" class="col-lg-4 col-md-6 col-sm-12" style="display: flex; align-items:center">
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




                <form class="col-lg-4 col-md-6 col-sm-12 " style="display: flex; align-items:center">
                    <input value="{{request('search') }}" placeholder="search..." type="search" class="form-control mx-1" name="search" style="width: 85%;margin: 0 !important;border-radius: 5px 0 0 5px;">
                    <button type="submit" style="width: 10%; display:flex;align-items:center;justify-content:center;padding:7px;border-radius: 0px 5px 5px 0px;height:100%" class="btn btn-primary">
                        <svg style="height: 18px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#ffffff" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                        </svg>
                    </button>
                </form>



            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-vcenter text-nowrap">
                    <thead>
                        <tr class="border-top">
                            <th class="text-center">Name</th>
                            <th class="text-center">Category</th>
                            <th class=" text-center">Image</th>
                            <th class=" text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategories as $subcategory)
                        <tr>
                            <td class="text-center">{{$subcategory->name}}</td>
                            <td class="text-center">{{$subcategory->category->name}}</td>

                            <td>
                                <div class="text-center">
                                    <img src="{{$subcategory->image}}" alt="" class="cart-img text-center">
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="g-2  text-center">
                                <button onclick="SetDate('{{$subcategory->id}}','{{$subcategory->name}}','{{$subcategory->image}}','{{$subcategory->category_id}}')" class="btn text-secondary bg-secondary-transparent btn-icon py-1 me-2" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#edit">Edit</button>

                                    <form action="{{route('subcategory.delete')}}" method="post" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$subcategory->id}}">
                                        <button class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete"><span class="bi bi-trash fs-16"></span></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- ROW-1 END -->
</div>


<div class="modal fade" id="add" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <form action="{{route('subcategory.store')}}" method="post" enctype="multipart/form-data" class="modal-content modal-content-demo">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title">Add New category</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="formGroupExampleInput" class="form-label">Name</label>
                    <input required type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Name">
                </div>
                <div class="my-2">
                    <select name="category_id" required class="form-control ">
                        <option selected disabled>Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="image" class="form-label">Image</label>
                    <input required type="file" name="image" class="form-control" id="image" placeholder="Image">
                </div>


            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Add</button>
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <form action="{{route('subcategory.update')}}" method="post" enctype="multipart/form-data" class="modal-content modal-content-demo">
            @csrf
            <input type="hidden" name="id" id="id">

            <div class="modal-header">
                <h6 class="modal-title">Edit category</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="formGroupExampleInput" class="form-label">Name</label>
                    <input required type="text" id="name" name="name" class="form-control" id="formGroupExampleInput" placeholder="Name">
                </div>
                <div class="my-2">
                    <select name="category_id" id="category_id" required class="form-control ">
                        <option selected disabled>Category</option>

                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="image" class="form-label">Image</label>
                    <img style="height: 100px;" id="img" alt="">
                    <input type="file" name="image" class="form-control" id="image" placeholder="Image">
                </div>


            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Update</button>
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>


@endsection
@section('js')
<script>
    function SetDate(id, name, image, category_id) {
        document.getElementById("id").value = id;
        document.getElementById('name').value = name;
        document.getElementById('img').setAttribute("src", image);
        document.getElementById("category_id").value = category_id
    }
    document.addEventListener("DOMContentLoaded", function() {
        let formSelect = document.getElementById("categories-select");

        formSelect.addEventListener("change", function() {
            let categoryId = formSelect.value;
            if (categoryId) {
                const baseUrl = "{{ url('subcategory') }}"; // Replace 'your-url-here' with your actual route
                window.location.href = `${baseUrl}?category_id=${categoryId}`;
            }
        });
    });
</script>
@endsection
@extends("app")
@section('title','Edit Category')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Edit Category</h1>
        <button class="btn btn-primary " data-bs-effect="effect-scale" data-bs-toggle="modal" href="#category-details"><i class="fa fa-plus-square me-2"></i>Features</button>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <form action="{{route('category.update')}}" enctype="multipart/form-data" method="post" class="card-body">
            @csrf 
            <input type="hidden" name="category_id" value="{{$category->id}}">
            <div class="row mb-4">
                <label class="col-md-3 form-label">Category Name :</label>
                <div class="col-md-9">
                    <input type="text" name="name" class="form-control" required value="{{$category->name}}" placeholder="Category Name">
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-md-3 form-label">Description :</label>
                <div class="col-md-9">
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{$category->description}}</textarea>

                </div>
            </div>
            <div class="row mb-4">
                <label class="col-md-3 form-label">Category Image :</label>
                <div class="col-md-9">
                    <img src="{{$category->image}}" style="height:70px" alt="">
                    <label for="image" class="btn btn-dark"> Change Image</label>
                    <input type="file"  id="image" name="image" hidden class="form-control" >
                </div>
            </div>
            <button class="btn btn-primary w-100">Update</button>

        </form>
    </div>
    <!-- ROW-1 END -->
</div>
<div class="modal fade" id="category-details" style="display: none;" aria-hidden="true">
    <div class="modal-dialog  modal-lg  modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title">Category Details</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form  action="{{route('category.add_feature')}}" method="post" enctype="multipart/form-data" class="my-2">
                    @csrf
                    <input type="hidden" name="category_id" value="{{$category->id}}" id="id">
                    <div class="row">

                        <div class="col-lg-6 col-md-12 my-2">
                            <label class=" form-label">Feature Name :</label>
                            <input type="text" name="name" class="form-control" required  placeholder="Feature Name">
                        </div>
                        <div class="col-lg-6 col-md-12 my-2">
                            <label class=" form-label">Feature Icon :</label>
                            <input type="file" name="image" class="form-control" required placeholder="Category Name">
                        </div>
                    </div>
                    <div><button type="submit" class="btn btn-primary w-100">Add </button></div>


                </form>
                <div class="table-responsive my-2" style="max-height: 350px;overflow-y: scroll;">
                <table class="table table-bordered table-vcenter text-nowrap">
                    <thead>
                        <tr class="border-top">
                            <th class="text-center">Name</th>
                            <th class="text-center">Image</th>

                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    @if(count($category->features) > 0)

                    <tbody>
                        @foreach($category->features as $feature)
                        <tr>
                            <td>{{$feature->name}}</td>
                            <td>
                                <div class="text-center">
                                    <img src="{{$feature->image}}" alt="" class="cart-img text-center">
                                </div>
                            </td>
                            <td>
                                <form method="post" action="{{route('category.delete_feature')}}" class="g-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$feature->id}}">
                                    <button type="submit" class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete"><span class="bi bi-trash fs-16"></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    @else 
                    <tr >
                        <td colspan="3" class="text-center">No Data Avaliable</td>
                    </tr>
                    @endif
                </table>
            </div>


            </div>

        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
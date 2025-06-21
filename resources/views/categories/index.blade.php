@extends("app")
@section('title','Categories')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Categories</h1>
        <button class="btn btn-primary " data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="fa fa-plus-square me-2"></i>New Category</button>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-vcenter text-nowrap" id="categories-table">
                    <thead>
                        <tr class="border-top">
                            <th class="text-center"><span class="p-1"></span></th>
                            <th class="text-center">Name</th>
                            <th class="w-60 text-center">Image</th>
                            <th class="w-20 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr data-id="{{ $category->id }}">
                            <td>
                                <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
                                </svg>
                            </td>
                            <td class="text-center">{{$category->name}}</td>
                            <td>
                                <div class="text-center">
                                    <img src="{{$category->image}}" alt="" class="cart-img text-center">
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="g-2  text-center">
                                    <a href="{{route('category.edit',$category->id)}}" class="btn text-secondary bg-secondary-transparent btn-icon py-1 me-2">Edit</a>
                                    <form action="{{route('category.delete')}}" method="post" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="category_id" value="{{$category->id}}">
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
        <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data" class="modal-content modal-content-demo">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title">Add New category</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="formGroupExampleInput" class="form-label">Name</label>
                    <input required  type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Name">
                </div>
                <div>
                    <label for="image" class="form-label">Image</label>
                    <input required type="file" name="image"  class="form-control" id="image" placeholder="Image">
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
        <form action="{{route('category.update')}}" method="post" enctype="multipart/form-data" class="modal-content modal-content-demo">
            @csrf
            <input type="hidden" name="category_id"  id="id">

            <div class="modal-header">
                <h6 class="modal-title">Edit category</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="formGroupExampleInput" class="form-label">Name</label>
                    <input  required type="text" id="name" name="name" class="form-control" id="formGroupExampleInput" placeholder="Name">
                </div>
                <div>
                    <label for="image" class="form-label">Image</label>
                    <img style="height: 100px;" id="img" alt="">
                    <input type="file" name="image"  class="form-control" id="image" placeholder="Image">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const productTable = document.querySelector('#categories-table tbody');

    const sortable = new Sortable(productTable, {
        animation: 300,
        scroll: true, // Enable scrolling
        scrollSensitivity: 30, // Sensitivity, lower values will trigger scrolling sooner
        scrollSpeed: 10, // Speed of scroll, higher value is faster
        onEnd: function () {
            // Retrieve all products globally instead of just the current page's products
            const positions = Array.from(document.querySelectorAll('#categories-table tbody tr')).map((row, index) => {
                return {
                    id: row.getAttribute('data-id'),
                    position: index + 1
                };
            });

            console.log(positions);

            // Send the updated positions for all products
            fetch("{{ route('categories.update-position') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    positions: positions,
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
    function SetDate(id,name,image){
        document.getElementById("id").value=id;
        document.getElementById('name').value=name;
        document.getElementById('img').setAttribute("src",image);
    }
</script>
@endsection
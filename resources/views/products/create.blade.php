@extends("app")
@section('title','Add Product')
@section('css')
<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" />
<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/plugins/wysiwyag/richtext.css')}}" />
<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/plugins/select2/select2.min.css')}}" />

<style>
    [title="Remove styles"],
    [title="Add table"],
    [title="Add URL"],
    [title="Add file"],
    [title="Add image"] {
        display: none !important;
    }

    .color-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .color-square {
        width: 30px;
        height: 30px;
        border: 2px solid #ddd;
        /* Border for inactive squares */
        cursor: pointer;
        transition: border-color 0.3s;
    }

    .color-square.active {
        border-color: #333;
        /* Border for active squares */
    }
</style>
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header my-0 p-0">
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <form method="post" enctype="multipart/form-data" action="{{route('product.store')}}" class="card">
            @csrf
            <div class="card-header">
                <div class="card-title">Add New Product</div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Product Name :</label>
                    <div class="col-md-9">
                        <input type="text" required name="name" class="form-control" placeholder="Product Name">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Sku :</label>
                    <div class="col-md-9">
                        <input type="text" name="sku" class="form-control" placeholder="Sku">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Price :</label>
                    <div class="col-md-9">
                        <input type="number" required name="price" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Discount *percentage:</label>
                    <div class="col-md-9">
                        <input type="number" min="0" max="100" placeholder="0 : 100 " value="0" name="discount" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Stock:</label>
                    <div class="col-md-9">
                        <input type="number" placeholder="Stock" name="stock" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Categories:</label>
                    <div class="col-md-9">
                        <select name="category_id" id="category-select" required class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <label class="col-md-3 form-label">Subcategory:</label>
                    <div class="col-md-9">
                        <select name="sub_category_id" id="subcategory-select"  class="form-control">
                            <option value="">Select Subcategory</option>
                            <!-- Subcategories will be dynamically populated here -->
                        </select>
                    </div>
                </div>

                <!-- Row -->
                <div class="row">
                    <label class="col-md-3 form-label mb-4">Product Description :</label>
                    <div class="col-md-9 mb-4">

                        <textarea class="form-control" required name="description" style="height: 110px;" placeholder="Description"></textarea>
                    </div>
                </div>
                <!--End Row-->
                <div class="row mb-3">
                    <label class="col-md-3 form-label mb-4">Product Main Color</label>
                    <div class="col-md-9 d-flex align-items-center">
                        <input type="text" name="color" class="form-control"placeholder="Main Color">
                    </div>          
                </div>
                <!--Row-->
                <div class="row mb-3">
                    <label class="col-md-3 form-label mb-4">Product Thumbnail</label>
                    <div class="col-md-9 d-flex align-items-center">
                        <label for="image" class="btn btn-primary">Upload Thumbnail</label>
                        <input id="image" type="file" hidden name="image" accept=".jpg, .png, image/jpeg, image/png" class="ff_fileupload2_hidden">

                        <!-- Preview Image -->
                        <img id="preview" src="" alt="Image Preview" style="display: none; margin-left: 20px; max-width: 100px; max-height: 100px; object-fit: cover;">
                    </div>
                </div>
                <!--End Row-->
                <!--Row-->
                <div class="row">
                    <label class="col-md-3 form-label mb-4">Product Gallery :</label>
                    <div class="col-md-9">
                        <div class="my-2">
                            <input type="file" hidden class="form-control" id="images" name="images[]" onchange="preview_images();" multiple />
                        </div>
                        <div>
                            <label for="images" onclick="upload_files()" type="button" class="btn btn-primary m-0" name='submit_image'>
                                Upload Multiple Images
                            </label>
                            <input onclick="return resetForm();" type="reset" class="btn btn-danger" name='reset_images' value="Reset" />
                        </div>
                    </div>
                    <hr>
                    <div class="row" id="image_preview"></div>
                </div>
                <!--End Row-->
            </div>
            <div class="card-footer">
                <!--Row-->
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Add Product</button>
                    </div>
                </div>
                <!--End Row-->
            </div>
        </form>
    </div>
    <!-- ROW-1 END -->
</div>
@endsection
@section('js')
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/wysiwyag/jquery.richtext.js')}}"></script>
<script src="{{asset('assets/plugins/wysiwyag/wysiwyag.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#category-select').on('change', function() {
            let categoryId = $(this).val();
            $('#subcategory-select').empty().append('<option value="">Select Subcategory</option>'); // Reset subcategory dropdown

            if (categoryId) {
                $.ajax({
                    url: `/subcategories/${categoryId}`,
                    type: 'GET',
                    success: function(data) {
                        // Populate the subcategory dropdown
                        $.each(data, function(key, subcategory) {
                            $('#subcategory-select').append(
                                `<option value="${subcategory.id}">${subcategory.name}</option>`
                            );
                        });
                    },
                    error: function() {
                        alert('Unable to fetch subcategories.');
                    }
                });
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorSquares = document.querySelectorAll('.color-square');
        const selectedColorsInput = document.getElementById('selectedColors');

        // Toggle individual color selection
        colorSquares.forEach(square => {
            square.addEventListener('click', function() {
                this.classList.toggle('active');
                updateSelectedColors();
            });
        });

        // Add All colors
        document.getElementById('addAllColors').addEventListener('click', function() {
            colorSquares.forEach(square => square.classList.add('active'));
            updateSelectedColors();
        });

        // Remove All colors
        document.getElementById('removeAllColors').addEventListener('click', function() {
            colorSquares.forEach(square => square.classList.remove('active'));
            updateSelectedColors();
        });

        // Update hidden input with selected colors
        function updateSelectedColors() {
            const selectedColors = Array.from(document.querySelectorAll('.color-square.active'))
                .map(square => square.getAttribute('data-color'));

            selectedColorsInput.value = selectedColors.join(',');
        }
    });
</script>
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block'; // Show the image
        }
    });

    function preview_images() {
        var total_file = document.getElementById("images").files.length;
        for (var i = 0; i < total_file; i++) {
            $('#image_preview').append(`
                <div class='col-md-3'>
                    <img style='width:100%; height:100px' class='img-responsive' src='${URL.createObjectURL(event.target.files[i])}'>
                </div>`);
        }
    }

    function resetForm() {
        $("#image_preview").html("");
        return true;
    }
</script>
@endsection
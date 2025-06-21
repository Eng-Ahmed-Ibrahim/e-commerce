@extends("app")
@section('title','Edit Product')
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
        <div class="card-header" style="display: flex; justify-content:space-between">
            <div class="card-title">Edit Product</div>
            <div>
                <button class="btn btn-primary" onclick="getColors()" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add-color"> Colors </button>
            </div>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{route('product.update')}}" class="card">
            @csrf
            <input type="hidden" value="{{$product->id}}" name="product_id">
            <div class="card-body">
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Product Name :</label>
                    <div class="col-md-9">
                        <input type="text" name="name" class="form-control" required value="{{$product->name}}" placeholder="Product Name">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Sku:</label>
                    <div class="col-md-9">
                        <input type="text" name="sku" class="form-control" value="{{$product->sku}}" placeholder="SKU">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Price :</label>
                    <div class="col-md-9">
                    <input type="number" required value="{{ $product->price }}" name="price" class="form-control" step="any">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Stock :</label>
                    <div class="col-md-9">
                        <input type="number" value="{{$product->stock}}" name="stock" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Discount :</label>
                    <div class="col-md-9">
                        <input type="number" min="0" max="{{$product->price}}" value="{{$product->discount}}" name="discount" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Categories:</label>
                    <div class="col-md-9">
                        <select name="category_id" id="category-select" required class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option {{$category->id == $product->category_id ? 'selected' : ' '}} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <label class="col-md-3 form-label">Subcategory:</label>
                    <div class="col-md-9">
                        <select name="sub_category_id" id="subcategory-select" class="form-control">
                            <option value="">Select Subcategory</option>
                            @foreach($subategories as $subcategory)
                            <option {{$subcategory->id == $product->sub_category_id ? 'selected' : ' '}} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <!-- Row -->
                <div class="row">
                    <label class="col-md-3 form-label mb-4">Product Description :</label>
                    <div class="col-md-9 mb-4">
                        <textarea class="form-control" name="description" style="height:100px;" placeholder="Description">{{$product->description}}</textarea>
                    </div>
                </div>
                <!--End Row-->



                <!--Row-->
                <div class="row mb-3">
                    <label class="col-md-3 form-label mb-4">Product Thumbnail</label>
                    <div class="col-md-9 d-flex align-items-center">
                        <label for="image" class="btn btn-primary">Update Thumbnail</label>
                        <input id="image" type="file" hidden name="image" accept=".jpg, .png, image/jpeg, image/png" class="ff_fileupload2_hidden">

                        <!-- Preview Image -->
                        <img id="preview" src="{{$product->image}}" alt="Image Preview" style=" margin-left: 20px; max-width: 100px; max-height: 100px; object-fit: cover;">
                    </div>
                </div>
                <!--Row-->
                <div class="row mb-3">
                    <label class="col-md-3 form-label mb-4">Product Main Color</label>
                    <div class="col-md-9 d-flex align-items-center">
                        <span style="padding: 10px; background:{{$product->color}}; margin-right:5px" ></span>
                        <input type="text" name="color" class="form-control" value="{{$product->color}}" placeholder="Main Color">
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
                            <input onclick="return resetForm('{{$product->id}}');" type="reset" class="btn btn-danger" name='reset_images' value="Reset" />
                        </div>
                    </div>
                    <hr>
                    <div class="row" id="image_preview">
                        @foreach($product->images as $image)
                        <div class="col-md-3" style="display: flex; ">

                            <img style="width:90%; height:100px" class="img-responsive" src="{{$image->image}}" data--h-bstatus="4PROCESSING">

                            <button type="button" onclick="deleteImage('{{ $image->id }}')" style="height: 40px;" class="btn text-danger bg-danger-transparent btn-icon py-1">
                                <span class="bi bi-trash fs-16"></span>
                            </button>
                        </div>
                        @endforeach

                    </div>
                </div>
                <!--End Row-->
            </div>
            <div class="card-footer">
                <!--Row-->
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Update Product</button>
                    </div>
                </div>
                <!--End Row-->
            </div>
        </form>
    </div>
    <!-- ROW-1 END -->
</div>



<!-- Modal for Adding/Updating Color -->
<div class="modal fade" id="add-color" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg text-center" role="document">
        <form id="addColorForm" enctype="multipart/form-data" class="modal-content modal-content-demo">
            @csrf
            <input type="hidden" id="colorId" name="colorId">
            <input type="text" hidden name="product_id" value="{{$product->id}}">

            <div class="modal-header">
                <h6 class="modal-title" id="modalTitle">Add New Color</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="form-group col">
                        <label for="color_name">Color Name</label>
                        <input type="text" name="color_name" id="color_name" placeholder="Color Name" class="form-control" required>
                    </div>
                    <div class="form-group col">
                        <label for="color_image">Color Image</label>
                        <input type="file" name="image" id="color_image" class="form-control" accept="image/*">
                        <img id="color_image_preview" style="height:50px; display:none; margin-top:10px;">
                    </div>
                    <div class="form-group col">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" required step="0.01">
                    </div>
                    <div class="col-12">
                        <button type="button" id="addUpdateColorButton" class="btn btn-primary w-100" onclick="addColor()">Add Color</button>
                    </div>
                </div>

                <!-- Table to display colors -->
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="colorTableBody">
                            <!-- Dynamic color rows will be inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
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
    // Fetch colors and populate table
    function getColors() {
        $('#add-color').modal('show');

        $.ajax({
            url: "{{ route('product.get_product_colors') }}",
            method: "GET",
            data: { product_id: '{{$product->id}}' },
            success: function(data) {
                let colorsHTML = '';
                $.each(data, function(index, color) {
                    colorsHTML += `
                        <tr data-id="${color.id}" data-color_name="${color.color_name}" data-image="${color.image}" data-price="${color.price}">
                            <td>${color.color_name} <span style="background:${color.color_name}; padding: 0 6px;margin-left: 10px;"></span></td>
                            <td><img src="${color.image}" alt="${color.color_name}" style="height:50px;"></td>
                            <td>${color.price}</td>
                            <td>
                                <button type="button" class="btn text-secondary bg-secondary-transparent btn-icon py-1 me-2 edit-color">Edit</button>
                                <button   type="button" onclick="deleteColor(${color.id})" class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                    <span class="bi bi-trash fs-16"></span>
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $('#colorTableBody').html(colorsHTML);
            },
            error: function() {
                alert("Failed to fetch colors.");
            }
        });
    }

    // Add a new color
    function addColor() {
        let formData = new FormData(document.getElementById('addColorForm'));
        
        $.ajax({
            url: "{{ route('product.add_product_color') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    let newRow = `
                        <tr data-id="${data.color.id}" data-color_name="${data.color.color_name}" data-image="${data.color.image}" data-price="${data.color.price}">
                            <td>${data.color.color_name} <span style="background:${data.color.color_name}; padding: 0 6px;margin-left: 10px;"></span></td>
                            <td><img src="${data.color.image}" alt="${data.color.color_name}" style="height:50px;"></td>
                            <td>${data.color.price}</td>
                            <td>
                                <button  type="button" class="btn text-secondary bg-secondary-transparent btn-icon py-1 me-2 edit-color">Edit</button>
                                <button   type="button" onclick="deleteColor(${data.color.id})" class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                    <span class="bi bi-trash fs-16"></span>
                                </button>
                            </td>
                        </tr>
                    `;
                    $('#colorTableBody').append(newRow);
                    $('#addColorForm')[0].reset();
                    $('#color_image_preview').hide();
                } else {
                    alert("Error adding color.");
                }
            },
            error: function() {
                alert("Failed to add color.");
            }
        });
    }

    // Update an existing color
    function updateColor() {
        let formData = new FormData(document.getElementById('addColorForm'));
        formData.append('_method', 'POST');
        const colorId = $('#colorId').val();

        console.log("form data of update : "+ formData);
        
        $.ajax({
            url: "{{route('product.update_product_color')}}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    let updatedRow = `
                        <tr data-id="${data.color.id}" data-color_name="${data.color.color_name}" data-image="${data.color.image}" data-price="${data.color.price}">
                            <td>${data.color.color_name} <span style="background:${data.color.color_name}; padding: 0 6px;margin-left: 10px;"></span></td>
                            <td><img src="${data.color.image}" alt="${data.color.color_name}" style="height:50px;"></td>
                            <td>${data.color.price}</td>
                            <td>
                                <button type="button" class="btn text-secondary bg-secondary-transparent btn-icon py-1 me-2 edit-color">Edit</button>
                                <button   type="button" onclick="deleteColor(${data.color.id})" class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                    <span class="bi bi-trash fs-16"></span>
                                </button>
                            </td>
                        </tr>
                    `;
                    $(`#colorTableBody tr[data-id="${colorId}"]`).replaceWith(updatedRow);
                    $('#addColorForm')[0].reset();
                    $('#color_image_preview').hide();
                    $('#addUpdateColorButton').text('Add Color').attr('onclick', 'addColor()');
                } else {
                    alert("Error updating color.");
                }
            },
            error: function() {
                alert("Failed to update color.");
            }
        });
    }
    function deleteColor(colorId) {
        // Confirm with the user before deleting
        if (confirm("Are you sure you want to delete this color?")) {
            $.ajax({
                url: "{{route('product.delete_product_color')}}",
                method: "POST",  // Use DELETE for deleting resources
                data: {
                    _token: '{{ csrf_token() }}',  // Pass the CSRF token for security
                    colorId:colorId
                },
                success: function(data) {
                    if (data.success) {
                        // Remove the color row from the table
                        $(`#colorTableBody tr[data-id="${colorId}"]`).remove();
                    } else {
                        alert("Error deleting color.");
                    }
                },
                error: function() {
                    alert("Failed to delete color.");
                }
            });
        }
    }

    // Edit color button click event
    $(document).on('click', '.edit-color', function() {
        const colorRow = $(this).closest('tr');
        const colorId = colorRow.data('id');
        const colorName = colorRow.data('color_name');
        const colorImage = colorRow.data('image');
        const colorPrice = colorRow.data('price');

        $('#colorId').val(colorId);
        $('#color_name').val(colorName);
        $('#price').val(colorPrice);
        $('#color_image_preview').attr('src', colorImage).show();
        $('#modalTitle').text('Update Color');
        $('#addUpdateColorButton').text('Update').attr('onclick', 'updateColor()');
        $('#add-color').modal('show');
    });


</script>


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

    function resetForm(productId) {
        console.log(productId);
        
        $("#image_preview").html("");   
        $.ajax({
            url: '{{ route('product.delete_all_image_product') }}', // This should match the route
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Ensure CSRF token is sent
                id: productId
            },
            success: function(data) {
                window.location.reload(); // Reload the page on success
            },
            error: function(xhr, status, error) {
                console.error('Error:', error); // Log the error for debugging
            }
        });
        return true;
    }
</script>
<script>
    function deleteImage(imageId) {
        $.ajax({
            url: '{{ route('product.delete_image') }}', // This should match the route
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Ensure CSRF token is sent
                id: imageId
            },
            success: function(data) {
                window.location.reload(); // Reload the page on success
            },
            error: function(xhr, status, error) {
                console.error('Error:', error); // Log the error for debugging
            }
        });
    }
</script>
@endsection
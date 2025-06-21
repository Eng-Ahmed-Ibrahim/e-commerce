@extends("app")
@section('title','Page')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        @if(request('section')=='home')
        <h3 class="page-title">Pages/Home/Sliders</h3>
        @elseif(request('section')=='about_contries')
        <h3 class="page-title">Pages/About/Countries</h3>
        @else 
        <h3 class="page-title">Sliders</h3>
        @endif
        <button class="btn btn-primary " data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="fa fa-plus-square me-2"></i>New Slide</button>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-vcenter text-nowrap">
                    <thead>
                        <tr class="border-top">
                            <th> {{request('section') == "about_contries" ? "Contry" : "Title"}} </th>
                            <th>  {{request('section') == "about_contries" ? "Year" : "Text"}}</th>
                            <th>Image</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $slider)
                        <tr>
                            <td>{{$slider->title}}</td>
                            <td>{{$slider->text}}</td>
                            <td>
                                <div class="text-center">
                                    <img src="{{$slider->image}}" alt="" class="cart-img text-center">
                                </div>
                            </td>
                            <td>
                                <div class="g-2">
                                    <a class="btn text-secondary bg-secondary-transparent btn-icon py-1 me-2" onclick="SetDate('{{$slider->id}}','{{$slider->title}}','{{$slider->text}}','{{$slider->image}}')" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#edit">Edit</a>
                                    <form style="display: inline-block;" action="{{route('slider.delete')}}" method="post">
                                        @csrf 
                                        <input type="hidden" name="slider_id" value="{{$slider->id}}">
                                        <button type="submit" class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete"><span class="bi bi-trash fs-16"></span></button>
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
        <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data" class="modal-content modal-content-demo">
            @csrf 
            <input type="hidden" name="section" value="{{request('section')}}">
            <div class="modal-header">
                <h6 class="modal-title">Add New Slider</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="formGroupExampleInput" class="form-label"> {{request('section') == "about_contries" ? "Contry" : "Title"}}</label>
                    <input required  type="text" name="title" class="form-control" id="formGroupExampleInput" placeholder="title">
                </div>
                <div>
                    <label for="text" class="form-label">{{request('section') == "about_contries" ? "Year" : "Text"}}</label>
                    <textarea name="text" id="text" class="form-control" placeholder="Text"></textarea>
                </div>
                <div>
                    <label for="image" class="form-label">Image</label>
                    <input required type="file" name="image"  class="form-control" id="image" placeholder="Image">
                </div>

 
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary w-100" type="submit">Add</button> 
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <form action="{{route('slider.update')}}" method="post" enctype="multipart/form-data" class="modal-content modal-content-demo">
            @csrf
            <input type="hidden" name="slider_id"  id="id">

            <div class="modal-header">
                <h6 class="modal-title">Edit slider</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="title-edit" class="form-label"> {{request('section') == "about_contries" ? "Contry" : "Title"}}</label>
                    <input  required type="text"  id="title-edit" class="form-control" name="title" placeholder="title">
                </div>

                <div>
                    <label for="text-edit" class="form-label">{{request('section') == "about_contries" ? "Year" : "Text"}}</label>
                    <textarea name="text" id="text-edit" class="form-control" placeholder="Text"></textarea>
                </div>
                <div>
                    <label for="image" class="form-label">Image</label>
                    <img style="height: 100px;" id="img" alt="">
                    <input type="file" name="image"  class="form-control" id="image" placeholder="Image">
                </div>

 
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary w-100" type="submit">Update</button> 
            </div>
        </form>
    </div>
</div>

@endsection
@section('js')
<script>
    function SetDate(id,title,text,image){
        document.getElementById("id").value=id;
        document.getElementById('title-edit').value=title;
        document.getElementById('text-edit').value=text;
        document.getElementById('img').setAttribute("src",image);
    }
</script>
@endsection
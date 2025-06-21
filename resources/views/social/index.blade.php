@extends("app")
@section('title','Social Media')
@section('css')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Social Media</h1>
        <button class="btn btn-primary " data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="fa fa-plus-square me-2"></i>New </button>
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
                            <th class="text-center">Link</th>
                            <th class="w-60 text-center">Icon</th>
                            <th class="w-60 text-center">Status</th>
                            <th class="w-20 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($socials as $social)
                        <tr>
                            <td class="text-center">{{$social->link}}</td>
                            <td>
                                <div class="text-center ">
                                    <span class="bg-primary p-3">
                                        <img src="{{$social->icon}}" alt="" class="cart-img text-center">
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                            <a href="{{route('change_social_status',$social->id)}}" class="switch" >
                                <input type="checkbox" {{$social->status ==1 ? 'checked' : ' '}}>
                                <span class="slider round"></span>
                            </a>
                            </td>
                            <td class="text-center">
                                <div class="g-2  text-center">
                                    <a  onclick="SetDate('{{$social->id}}','{{$social->link}}','{{$social->icon}}')"  data-bs-toggle="modal" href="#edit" class="btn text-secondary bg-secondary-transparent btn-icon py-1 me-2">Edit</a>
                                    <form action="{{route('social.delete')}}" method="post" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="social_id" value="{{$social->id}}">
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
        <form action="{{route('social.store')}}" method="post" enctype="multipart/form-data" class="modal-content modal-content-demo">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title">Add New </h6><button  type="button"  aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="formGroupExampleInput" class="form-label">Link</label>
                    <input required  type="text" name="link" class="form-control" id="formGroupExampleInput" placeholder="link">
                </div>
                <div>
                    <label for="icon" class="form-label">Icon</label>
                    <input required type="file" name="icon"  class="form-control" id="icon" placeholder="icon">
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
        <form action="{{route('social.update')}}" method="post" enctype="multipart/form-data" class="modal-content modal-content-demo">
            @csrf
            <input type="hidden" name="social_id"  id="id">

            <div class="modal-header">
                <h6 class="modal-title">Edit </h6><button type="button" aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="formGroupExampleInput" class="form-label">Link</label>
                    <input  required type="text" id="link" name="link" class="form-control" id="formGroupExampleInput" placeholder="link">
                </div>
                <div > 
                    <label for="icon" class="form-label">Icon</label>
                     <span class="bg-primary p-3" style="height: 100px;"><img  style="width:30px" id="img" alt=""></span> 
                    <input type="file" name="icon"  class="form-control" id="icon" placeholder="icon">
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
    function SetDate(id,link,icon){
        document.getElementById("id").value=id;
        document.getElementById('link').value=link;
        document.getElementById('img').setAttribute("src",icon);
    }
</script>
@endsection
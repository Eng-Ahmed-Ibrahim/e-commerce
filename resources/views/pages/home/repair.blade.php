@extends("app")
@section('title','Repair Page')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Repair Page</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">
            <form action="{{route('home.update_repair')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="mb-3">
                    <img src="{{$section->image}}" style="height:100px;" alt="">
                    <label for="image" class="btn btn-primary">Update Image</label>
                    <input type="file" hidden name="image" id="image">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required value="{{$section->title}}">
                    </div>
                    <div class="col">
                        <label for="text">Text</label>
                        <textarea name="text" id="text" class="form-control" style="height: 100px;" required>{{$section->text}}</textarea>
                    </div>
                </div>
 
                <button class="w-100 btn btn-primary mt-5" type="submit">Update</button>
            </form>

        </div>
    </div>
    <!-- ROW-1 END -->
</div>
@endsection
@section('js')
@endsection
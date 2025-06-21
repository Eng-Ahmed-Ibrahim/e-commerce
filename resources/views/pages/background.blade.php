@extends("app")
@section('title','Page')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Page</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">

        <form action="{{route('update_background')}}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" value="{{request('section')}}" name="section">
                <div class="mb-3">
                    <img src="{{$background->image}}" style="height:100px;" alt="">
                    <label for="Image" class="btn btn-primary">Update Background</label>
                    <input type="file" hidden name="image" id="Image">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="title"></label>
                        <input type="text" class="form-control" id="title" name="title" required value="{{$background->title}}">
                    </div>
                    <div class="col">
                        <label for="text"></label>
                        <textarea name="text" id="text" class="form-control" style="height: 100px;" required>{{$background->text}}</textarea>
                    </div>
                </div>

                <button class="w-100 btn btn-primary" type="submit">Update</button>
            </form>

        </div>
    </div>
    <!-- ROW-1 END -->
</div>
@endsection
@section('js')
@endsection
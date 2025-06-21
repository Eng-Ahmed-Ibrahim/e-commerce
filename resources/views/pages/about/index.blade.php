@extends("app")
@section('title','About Us')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">About Us</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">
            <form action="{{route('about.update_section')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="mb-3">
                    <img src="{{$about->hero_image}}" style="height:100px;" alt="">
                    <label for="hero_image" class="btn btn-primary">Update Background</label>
                    <input type="file" hidden name="hero_image" id="hero_image">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="hero_title"></label>
                        <input type="text" class="form-control" id="hero_title" name="hero_title" required value="{{$about->hero_title}}">
                    </div>
                    <div class="col">
                        <label for="hero_text"></label>
                        <textarea name="hero_text" id="hero_text" class="form-control" style="height: 100px;" required>{{$about->hero_text}}</textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <img src="{{$about->logo}}" style="height:100px;" alt="">
                    <label for="logo" class="btn btn-primary">Update Logo</label>
                    <input type="file" hidden name="logo" id="logo">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="text"></label>
                        <textarea name="text" id="text" class="form-control" style="height: 100px;" required>{{$about->text}}</textarea>
                    </div>
                    <div class="col">
                        <img src="{{$about->image}}" style="height:100px;" alt="">
                        <label for="image" class="btn btn-primary">Update Image</label>
                        <input type="file" hidden name="image" id="image">
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
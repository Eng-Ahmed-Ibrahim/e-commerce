@extends("app")
@section('title','Profile')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Profile</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="card overflow-hidden">
        <div class="card-body">

        <form action="{{route('update_profile')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="mb-3">
                    <img src="{{$user->image}}" style="height:100px;" alt="">
                    <label for="image" class="btn btn-primary">Update Image</label>
                    <input type="file" hidden name="image" id="image">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{$user->name}}">
                    </div>
                    <div class="col">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="{{$user->email}}">
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
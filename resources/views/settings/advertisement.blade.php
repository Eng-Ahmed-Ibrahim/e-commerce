@extends("app")
@section('title','Advertisement')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Advertisement</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class=" overflow-hidden">
        <div class="">

            <form action="{{route('setting.update_advertisement')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="mb-3 row" style="align-items: center;">
                    <div class="col-10">
                        <label for="advertisement">Advertisement</label>
                        <textarea name="advertisement" id="advertisement" class="form-control" style="height: 100px;" required>{{$advertisement->advertisement}}</textarea>
                    </div>
                    <div class="col-2" style="display: flex; align-items:center">

                        <label class="switch">
                            <input name="advertisement_status"  type="checkbox" {{$advertisement->advertisement_status ==true ? "checked" : ' '}}>
                            <span class="slider round"></span>
                        </label>
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
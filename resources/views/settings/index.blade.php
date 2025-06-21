@extends("app")
@section('title','Settings')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Settings</h1>
    </div>
    @include('layouts.messages')

    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class=" overflow-hidden">
        <div class="">
            <form action="{{route('setting.update_section')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="mb-3 row">
                    <div class="col">
                        <img src="{{$setting->logo_black}}" style="height:100px;" alt="">
                        <label for="logo_black" class="btn btn-primary">Update Logo *black</label>
                        <input type="file" hidden name="logo_black" id="logo_black">
                    </div>
                    <div class="col">
                        <img src="{{$setting->logo_light}}" style="height:100px;" alt="">
                        <label for="logo_light" class="btn btn-primary">Update Logo *white</label>
                        <input type="file" hidden name="logo_light" id="logo_light">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control" style="height: 100px;" required>{{$setting->address}}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required value="{{$setting->phone}}">
                    </div>
                    <div class="col">
                        <label for="fax">fax</label>
                        <input type="text" class="form-control" id="fax" name="fax" required value="{{$setting->fax}}">
                    </div>
                    <div class="col">
                        <label for="box">P.O.Box</label>
                        <input type="text" class="form-control" id="box" name="box" required value="{{$setting->box}}">
                    </div>
                    <div class="col-12 my-2">
                        <label for="whatsapp_number">Whatsapp Number</label>
                        <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" required value="{{$setting->whatsapp_number}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" style="height: 100px;" required>{{$setting->description}}</textarea>
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
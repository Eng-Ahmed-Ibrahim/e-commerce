@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
    {{ Session::get('success') }}
</div>
@endif
@if(Session::has('error'))

<div class="alert alert-danger" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
    {{ Session::get('error') }}
</div>

@endif
@if($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
    {{ $error}}
</div>
@endforeach
@endif
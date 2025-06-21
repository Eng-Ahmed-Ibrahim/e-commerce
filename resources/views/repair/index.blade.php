@extends("app")
@section('title','Repairs')
@section('css')
<style>
            table  td,th{
            text-align: center !important;
        }
</style>
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Repairs</h1>
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
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($repairs as $repair)
                        <tr>
                            <td> <a href="{{route('repair.show',$repair->id)}}">#{{$repair->id}}</a> </td>
                            <td>{{$repair->name}}</td>
                            <td>{{$repair->phone}}</td>
                            <td>{{$repair->product}}</td>
                            <td>
                                @if($repair->status==0)
                                <span class="badge text-bg-danger">Not Seen</span>
                                @else 
                                <span class="badge text-bg-success"> Seen</span>
                                @endif
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($repair->created_at)->format('m-d-Y') }}</td>

                            <td class="text-center">
                                <a   href="{{route('repair.show',$repair->id)}}" class="btn"><i  style="font-size: 20px;color: #3838c2;" class="zmdi zmdi-eye" data-bs-toggle="tooltip" title="" data-bs-original-title="View" aria-label="zmdi zmdi-eye"></i> </a>
                                <form id="delete-form-{{ $repair->id }}" action="{{ route('repair.delete', $repair->id) }}" method="post" style="display: inline-block;">
                                    @csrf
                                    <button type="button" class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete" onclick="confirmDelete({{ $repair->id }})">
                                        <span class="bi bi-trash fs-16"></span>
                                    </button>
                                </form>
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
@endsection
    @section('js')
    <script>
    function confirmDelete(id) {
        if (confirm(`Are you sure you want to delete this #${id} ?`)) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
    @endsection
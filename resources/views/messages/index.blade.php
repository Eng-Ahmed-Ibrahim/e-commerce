@extends("app")
@section('title','Messages')
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
        <h1 class="page-title">Messages</h1>
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
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr>
                            <td> <a href="{{route('messages.show',$message->id)}}">#{{$message->id}}</a> </td>
                            <td>{{$message->name}}</td>
                            <td>{{$message->phone}}</td>
                            <td>{{$message->email}}</td>
                            <td>
                                @if($message->status==0)
                                <span class="badge text-bg-danger">Not Seen</span>
                                @else 
                                <span class="badge text-bg-success"> Seen</span>
                                @endif
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($message->created_at)->format('m-d-Y') }}</td>
                            <td class="text-center">
                                <a   href="{{route('messages.show',$message->id)}}" class="btn"><i  style="font-size: 20px;color: #3838c2;" class="zmdi zmdi-eye" data-bs-toggle="tooltip" title="" data-bs-original-title="View" aria-label="zmdi zmdi-eye"></i> </a>
                                <form id="delete-form-{{ $message->id }}" action="{{ route('messages.delete', $message->id) }}" method="post" style="display: inline-block;">
                                    @csrf
                                    <button type="button" class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete" onclick="confirmDelete({{ $message->id }})">
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
        if (confirm(`Are you sure you want to delete this #${id} message?`)) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
    @endsection
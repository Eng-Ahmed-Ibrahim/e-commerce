@extends("app")
@section('title','customer service surveys')
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
        <h1 class="page-title">customer service surveys</h1>
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
                            <!-- <th>Call Center Rate</th>
                            <th>Service Rate</th>
                            <th>Issue Resolved</th> -->
                            <th>Recommend</th>
                            <th>Paid Amount</th>
                            <th>After Sale Rate</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer_surveys as $customer_survey)
                        <tr>
                            <td> <a href="{{route('customer_surveys.show',$customer_survey->id)}}">#{{$customer_survey->id}}</a> </td>
                            <td>{{$customer_survey->name}}</td>
                            <td>{{$customer_survey->phone}}</td>
                            <!-- <td>{{$customer_survey->call_center_rate}}</td> -->
                            <!-- <td>{{$customer_survey->service_rate}}</td> -->
                            <!-- <td> <span class="badge text-bg-{{$customer_survey->issue_resolved == 1 ? 'success' :'danger'}}">{{$customer_survey->issue_resolved == 1 ? 'Yes' :'No'}}</span></td> -->
                            <td> <span class="badge text-bg-{{$customer_survey->recommend == 1 ? 'success' :'danger'}}">{{$customer_survey->recommend == 1 ? 'Yes' :'No'}}</span></td>
                            <td>{{$customer_survey->paid_amount}}</td>
                            <td>{{$customer_survey->after_sale_rate}}</td>
                            <td>
                                @if($customer_survey->seen==0)
                                <span class="badge text-bg-danger">Not Seen</span>
                                @else 
                                <span class="badge text-bg-success"> Seen</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a   href="{{route('customer_surveys.show',$customer_survey->id)}}" class="btn"><i  style="font-size: 20px;color: #3838c2;" class="zmdi zmdi-eye" data-bs-toggle="tooltip" title="" data-bs-original-title="View" aria-label="zmdi zmdi-eye"></i> </a>
                                <form id="delete-form-{{ $customer_survey->id }}" action="{{ route('customer_surveys.delete', $customer_survey->id) }}" method="post" style="display: inline-block;">
                                    @csrf
                                    <button type="button" class="btn text-danger bg-danger-transparent btn-icon py-1" data-bs-toggle="tooltip" data-bs-original-title="Delete" onclick="confirmDelete({{ $customer_survey->id }})">
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
    function confirmDelete(customer_surveyId) {
        if (confirm(`Are you sure you want to delete this #${customer_surveyId} review?`)) {
            document.getElementById('delete-form-' + customer_surveyId).submit();
        }
    }
</script>
    @endsection
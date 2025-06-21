@extends("app")
@section('title','Dashboard')
@section('css')
@endsection
@section('content')
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Dashboard </h1>
    </div>
    @include('layouts.messages')

    <!-- <div class="card overflow-hidden">
        <div class="card-body">

        </div>
    </div> -->
    <div class="row">

        @foreach($status_count as $key=>$value)
        <a class="col-lg-3 col-md-4 col-sm-12 " href="/orders?status={{ $value['status']}}">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mt-2">
                            <h6 class="">{{$key}}</h6>
                            <h2 class="mb-0 number-font">{{$value["count"]}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <canvas id="ordersChart"></canvas>

        </div>
        <div class="col-lg-6 col-md-12">
            <canvas id="usersChart"></canvas>

        </div>
    </div>



</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('ordersChart').getContext('2d');
    var monthlyTotals = @json($order_chart);

    var labels = Object.values(monthlyTotals).map(item => item.name);
    var data = Object.values(monthlyTotals).map(item => item.total);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Earning',
                data: data,
                borderColor: 'red',
                backgroundColor: 'transparent',
                borderWidth: 2,
                lineTension: 0.3 // Adjust this value for smoother curves
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                    }
                },
                y: {
                    title: {
                        display: true,
                    }
                }
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('usersChart').getContext('2d');
    var monthlyTotals = @json($registred_customers);

    var labels = Object.values(monthlyTotals).map(item => item.name);
    var data = Object.values(monthlyTotals).map(item => item.count);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Registered Customers',
                data: data,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                lineTension: 0.3 // Adjust this value for smoother curves
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                    }
                },
                y: {
                    title: {
                        display: true,
                    }
                }
            }
        }
    });
</script>

@endsection

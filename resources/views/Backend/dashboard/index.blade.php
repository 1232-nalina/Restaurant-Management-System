@extends('Backend.dashboard.main')
@section('title', 'Dashboard')
@section('content')
@section('password_changed')
    {{-- @if (Auth::user()->password_changed == 0)
<script>
    $(document).ready(function() {
        $('#passwordChangeModal').modal('show');
    });
</script>
@endif --}}
@endsection

<div class="modal fade" id="passwordChangeModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Change Your Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <p class="mb-0">Dear, <br> {{ @Auth::user()->name }}</p>
                    <hr>
                    <p style="text-transform: lowercase">Please change your password if You Haven't Changed Yet!! It is
                        totally unsafe to use the password given by the system creator.</p>
                    <a href="{{ route('changepassword.page') }}" class="btn btn-primary btn-sm">Change Your Password</a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="content container-fluid">

    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h5>@lang('public.date'): <b>{{ today_date() }}</b> </h5>
                <div class="page-sub-header">
                    <h3 class="page-title">@lang('public.welcome'), {{ @Auth::user()->username }}
                    </h3>


                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> @lang('public.home') </a></li>
                        <li class="breadcrumb-item active">@lang('public.dashboard')</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <p>@lang('public.total-income')</p>
                            <h5>Rs. <b>{{ $totalIncome }}</b> </h5>
                        </div>
                        {{-- <div class="db-icon">
                                <img src="{{ asset('Backend/assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                            </div> --}}
                        <a class="btn btn-success btn-sm"
                            href="{{ route('income_category.index') }}">@lang('public.view-income-sources')</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <p>@lang('public.expenses') - <b>{{ cur_month_full() }}</b></p>
                            <small></small>
                            <h5>Rs.<b>{{ $totalExpenses }}</b></h5>
                        </div>
                        <a class="btn btn-danger btn-sm" href="{{ route('expenses.index') }}">@lang('public.view-expenses')</a>
                    </div>
                </div>
            </div>
        </div>


    </div>

    {{-- <div class="row">

            <div class="col-md-12 col-lg-6">

                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Number of Students</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-blue"></span>Girls</li>
                                    <li><span class="circle-green"></span>Boys</li>
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="bar"></div>
                    </div>
                </div>

            </div>
        </div> --}}
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Inventory (kg<10)< /h3>
                    {{-- <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                    </a>
                </div> --}}
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Last Price Per Unit</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventorykg as $item)
                        <tr>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>{{ $item->price }}</td>
                            <td>

                                {{ $item->qty }}{{ $item->unit }}
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="card">

        <div class="card-header border-0">
            <h3 class="card-title">Inventory(litre<20)< /h3>
                    {{-- <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                    </a>
                </div> --}}
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Last Price Per Unit</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventoryltr as $item)
                        <tr>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>{{ $item->price }}</td>
                            <td>

                                {{ $item->qty }}{{ $item->unit }}
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Inventory(piece<50)< /h3>
                    {{-- <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                    </a>
                </div> --}}
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Last Price Per Unit</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventorypcs as $item)
                        <tr>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>{{ $item->price }}</td>
                            <td>

                                {{ $item->qty }}{{ $item->unit }}
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>



    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Reservation</h3>
            {{-- <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                    </a>
                </div> --}}
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Time</th>
                        <th>Date</th>

                        <th>No of Person</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $item)
                        <tr>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->time }}</td>
                            <td>{{ $item->date }}</td>
                            <td>

                                {{ $item->person }}</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Trend Analysis</h3>
            {{-- <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                    </a>
                </div> --}}
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Menu Item</th>
                        <th>Number of Orders</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trends as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->menuItem->name }}</td>
                            <td>{{ $value->total_menu_items }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <div class="row">
        {{-- bar graph chart --}}
        <div id="expensesChartContainer" class="pt-4 pb-5">
            <canvas id="expensesChart"></canvas>
        </div>
        {{-- view expenses --}}
        <h5> @lang('public.view-your-monthly-expenses-report') </h5>
        <form action="{{ route('expenses.report') }}" method="POST">
            @csrf
            <div class="student-group-form">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <select name="year" class="form-control" id="">
                                @for ($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <select name="month" class="form-control" id="month">

                                <option value="" selected disabled>-- @lang('public.choose-expenses-month') --</option>
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="search-student-btn">
                            <button type="btn" class="btn btn-primary">@lang('public.generate-report')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
@endsection

@section('scripts')
    <script>
        var ctx = document.getElementById('expensesChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Expenses',
                    data: {!! json_encode($amounts) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection

<style>
    #expensesChartContainer {
        width: 100%;
        height: 400px;

    }
</style>

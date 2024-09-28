@extends('Backend.dashboard.main')
@section('title', 'Expenses View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Expenses Report</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Expenses report</li>
                    </ul>
                </div>
            </div>
        </div>
<form action="{{route('expenses.report')}}" method="POST">
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
    
                    <option value="" selected disabled>-- Choose expenses Month --</option>
                    @for ($month = 1; $month <= 12; $month++)
                        <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                     @endfor
                </select>
                </div>
                </div>
           
            <div class="col-lg-2">
            <div class="search-student-btn">
            <button type="btn" class="btn btn-primary">Generate Report</button>
            </div>
            </div>
            </div>
            </div>
        </form>
   
             <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                @if ($expenses)
                                <div class="col">
                                 
                                    <h3 class="page-title">Expenses of {{$monthName}} - {{$yearName}}</h3> 
                                  
                                    
                                </div>
                                <hr>
                                <p> <span class=""> Total expenses:</span>  <b>{{$totalExpenses}}</b> </p>
                                <p> <span class="">Total savings:</span>  <b>{{$totalSavings}}</b> </p>
                                <p>Expenses Details are Shown Below</p>
                                @endif
                                {{-- <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('expenses.create') }}" title="add new domain" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;add new expenses</a>
                                </div> --}}
                            </div>
                        </div>
                        @if ($expenses)
                        <div class="table-responsive-sm">
                            <table class="table border-0  star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th width="">ID</th>
    
                                        <th width="">Expenses Category</th>
                                        <th>Expenses Date</th>
                                        <th>Expenses Amount</th>
    
                                        <th>Status</th>
                                        {{-- <th class="text-end">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($expenses)
                                        @foreach ($expenses as $key => $value)
    
    
                                            <tr>
    
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->expenses_cat->category_name }}</td>
                                            
                                                <td class="text-info">{{ $value->expenses_date }} - @if(today_date()==$value->expenses_date)
                                                    <span class="badge badge-info">Today</span>
                                                    @else
                                                    {{ Carbon\Carbon::parse($value->expenses_date)->diffForHumans() }}
    
                                                @endif </td>
                                                <td>¥ {{ $value->amount }}</td>
    
                                                @if ($value->status == 'active')
                                                    <td class="text-success">{{ $value->status }}</td>
                                                @else
                                                    <td class="text-danger">{{ $value->status }}</td>
                                                @endif
                                                {{-- <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ route('expenses.edit', $value->id) }}"
                                                            class="btn btn-sm bg-success-light me-2">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <form action="{{ route('expenses.destroy', $value->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm bg-danger-light">
                                                                <i class="feather-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                      
                                    @endif
                                    {{-- <p>This month Total Expenses of <b>{{ $currentFullMonth }}</b>: <b>¥ {{ $totalMonthlyExpenses }}</b> </p> --}}
                                </tbody>
                            </table>
                        </div>

                     
                        @else
                        <h3 class="text-center">No expenses found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
       
           
    </div>
@endsection

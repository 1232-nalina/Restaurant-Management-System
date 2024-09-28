@extends('Backend.dashboard.main')
@section('title', 'Expenses View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Expenses</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Expenses</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">All Expenses</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('expenses.create') }}" title="add new domain" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;add new expenses</a>
                                </div>
                            </div>
                        </div>
                            <div class="table-responsive-sm">
                                <table class="table table-responsive-sm border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th width="">Expenses Category</th>
                                            <th>Expenses Date</th>
                                            <th>Expenses Amount</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($expenses->isNotEmpty())
                                            @foreach ($expenses as $key => $value)
                                                {{-- @php
                                                    dd(cur_month());    
                                                @endphp --}}
        
                                                <tr @if (cur_month() == \Carbon\Carbon::parse($value->expenses_date)->format('m'))
                                                    style="background: #d7fae5;border-bottom:1px solid #bfbfbf;"
                                                @endif>
                                                    <td>{{ $value->expenses_cat->category_name }}</td>
                                                
                                                    <td class="text-info">{{ $value->expenses_date }} - @if(today_date()==$value->expenses_date)
                                                        <span class="badge badge-info">Today</span>
                                                        @else
                                                        {{ Carbon\Carbon::parse($value->expenses_date)->diffForHumans() }}
        
                                                    @endif </td>
                                                    <td>¥ {{ $value->amount }}</td>
{{--         
                                                    @if ($value->status == 'active')
                                                        <td class="text-success">{{ $value->status }}</td>
                                                    @else
                                                        <td class="text-danger">{{ $value->status }}</td>
                                                    @endif --}}
                                                    <td class="">
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
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <p>This month Total Expenses of <b>{{ $currentFullMonth }}</b>: <b>¥ {{ $totalMonthlyExpenses }}</b> &nbsp; <div style="width: 20px; height: 20px; background-color: #d7fae5;"></div> <b>Current Month</b> </p>
                                    </tbody>
                                </table>
                            </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('Backend.dashboard.main')
@section('title', 'Income View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">@lang('public.income-sources')</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('public.dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('public.income-sources')</li>
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
                                    <h3 class="page-title">@lang('public.available-income-sources')</h3>
                                    
                                </div>
                            
                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('income_category.create') }}" title="add new income source" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;@lang('public.add-new-income-source')</a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th width="5%">@lang('public.id')</th>

                                    <th width="10%">@lang('public.income-sources')</th>
                                    <th width="10%">@lang('public.income-amount')</th>
                                  
                                    <th>@lang('public.status')</th>
                                    <th class="text-end">@lang('public.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalIncome = 0;
                                @endphp
                                @if ($category->isNotEmpty())
                                    @foreach ($category as $key => $value)
                                        <tr>

                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $value->category_name }}</td>
                                            <td>{{ $value->income_amount }}</td>
                                           
                                            @if ($value->status == 'active')
                                                <td class="text-success">{{ $value->status }}</td>
                                            @else
                                                <td class="text-danger">{{ $value->status }}</td>
                                            @endif
                                            <td class="">
                                                <div class="actions">
                                                    <a href="{{ route('income_category.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('income_category.destroy', $value->id) }}"
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
                                        @php
                                            $totalIncome += $value->income_amount;
                                        @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <p class="mt-4">@lang('public.total-monthly-income'): <b>{{ $totalIncome }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('Backend.dashboard.main')
@section('title', 'View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">@lang('public.expenses-category')</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('public.dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('public.expenses-category')</li>
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
                                    <h3 class="page-title">@lang('public.available-expenses-category')</h3>
                                    
                                </div>
                            
                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('expenses_category.create') }}" title="@lang('public.add-new-expenses-category')" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;@lang('public.add-new-expenses-category')</a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th width="25%">@lang('public.id')</th>
                                    <th width="">@lang('public.expenses-category')</th>
                                    <th>@lang('public.status')</th>
                                    <th class="text-end">@lang('public.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                @if ($category->isNotEmpty())
                                    @foreach ($category as $key => $value)
                                        <tr>

                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $value->category_name }}</td>
                                           
                                           
                                            @if ($value->status == 'active')
                                                <td class="text-success">{{ $value->status }}</td>
                                            @else
                                                <td class="text-danger">{{ $value->status }}</td>
                                            @endif
                                            <td class="">
                                                <div class="actions">
                                                    <a href="{{ route('expenses_category.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('expenses_category.destroy', $value->id) }}"
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
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

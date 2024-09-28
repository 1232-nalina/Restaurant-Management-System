@extends('Backend.dashboard.main')
@section('title', 'stock View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">stock</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">stock</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-stock">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">All stocks</h3>

                                </div>

                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('stock.create') }}" title="add new stock" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;add new stock</a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th width="">Id</th>

                                    <th width="">Stock name</th>
                                    <th width="">Quantity</th>
                                    <th width="">Amount</th>

                                    <th class="text-end">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($stock->isNotEmpty())
                                    @foreach ($stock as $key => $value)
                                        <tr
                                        @if($value->status=='empty')
                                        style="background: #d7fae5;border-bottom:1px solid #bfbfbf;"
                                        @else
                                        style="background: #fad7da;border-bottom:1px solid #bfbfbf;"
                                        @endif
                                        >



                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->quantity_in_gm }}</td>
                                            <td>{{ $value->amount }}</td>

                                            <td class="">
                                                <div class="actions">
                                                    <a href="{{ route('stock.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('stock.destroy', $value->id) }}"
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

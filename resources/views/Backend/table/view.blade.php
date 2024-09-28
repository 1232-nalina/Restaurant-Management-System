@extends('Backend.dashboard.main')
@section('title', 'Table View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Table</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Table</li>
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
                                    <h3 class="page-title">All Tables</h3>

                                </div>

                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('table.create') }}" title="add new table" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;add new table</a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th width="">id</th>

                                    <th width="">Table Name</th>
                                    <th width="">No of seats</th>

                                    <th class="text-end">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($table->isNotEmpty())
                                    @foreach ($table as $key => $value)
                                        <tr
                                        @if($value->status=='empty')
                                        style="background: #d7fae5;border-bottom:1px solid #bfbfbf;"
                                        @else
                                        style="background: #fad7da;border-bottom:1px solid #bfbfbf;"
                                        @endif
                                        >



                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->seats }}</td>

                                            <td class="">
                                                <div class="actions">
                                                    <a href="{{ route('table.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('table.destroy', $value->id) }}"
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

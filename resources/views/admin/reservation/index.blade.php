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
                                <th>S.No.</th>
                                                    <th>Item Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Number of person</th>
                                                    {{-- <th>Image</th> --}}
                                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                               
                            <tbody>
                                            @foreach ($reservations as $key => $data)
    <tr class="menu-tr">
        <td class="text-nowrap">
            {{ ++$key }}
        </td>
        <td class="text-nowrap">
            {{ $data->name ?? "" }}
        </td>
        <td class="text-center">
            {{ $data->email ?? "" }}
        </td>
        <td class="text-center">
            {{ $data->phone ?? "" }}
        </td>
        <td class="text-center">
            {{ $data->date ? $data->date : "" }}
        </td>
        <td class="text-center">
            {{ $data->time ?? "" }}
        </td>
        <td class="text-center">
            {{ $data->person ?? "" }}
        </td>
        {{-- Uncomment and adjust the following block if needed
        <td class="text-center">
            <img src="{{ public_path('/uploads/Menu/' . $data->image) }}" alt="Image" width="50%">
        </td>
        --}}
        {{-- Uncomment and adjust the following block if you want to add edit/delete actions
        <td class="d-inline-flex">
            <div>
                <a href="{{ route('menuitem.edit', $data->id) }}" class="btn btn-sm btn-primary">
                    <i class="feather-edit mr-2"></i>
                </a>
                <form action="{{ route('menuitem.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger ml-2">
                        <i class="feather-trash"></i>
                    </button>
                </form>
            </div>
        </td>
        --}}
    </tr>
@endforeach
                              
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

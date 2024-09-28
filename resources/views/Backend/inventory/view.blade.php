@extends('Backend.dashboard.main')
@section('title', 'Item View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Item</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Item</li>
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
                                    <h3 class="page-title">Item listing</h3>

                                </div>

                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('inventories.create') }}" title="add new Item" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;Add new item</a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th width="">S.N.</th>
                                    <th width="">Item name</th>
                                    <th width="">Item Quantity</th>
                                    <th width="">Item Price</th>
                                   <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($Inventory->isNotEmpty())
                                    @foreach ($Inventory as $key => $value)
                                        <tr>


                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->qty }} {{ $value->unit }}</td>
                                            <td>{{ $value->price }}</td>

                                            <td class="">
                                                <div class="actions">
                                                    <a href="{{ route('inventories.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('inventories.destroy', $value->id) }}"
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

@extends('Backend.dashboard.main')
@section('title', 'kitchen View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">kitchen</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">kitchen</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-kitchen">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">All kitchens</h3>

                                </div>

                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('kitchen.create') }}" title="add new kitchen" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;add new kitchen</a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th width="">id</th>

                                    <th width="">kitchen name</th>
                                    <th width="">Order(live)</th>

                                    <th class="text-end">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($kitchen->isNotEmpty())
                                    @foreach ($kitchen as $key => $value)
                                        <tr
                                        @if($value->status=='empty')
                                        style="background: #d7fae5;border-bottom:1px solid #bfbfbf;"
                                        @else
                                        style="background: #fad7da;border-bottom:1px solid #bfbfbf;"
                                        @endif
                                        >



                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $value->name }}</td>
                                            <td>
                                                @foreach ($data as $item)
                                                    @if ($value->id == $item->kitchen_id)
                                                         <li>{{ $item->menuItem->name }}</li>
                                                    @endif
                                                @endforeach
                                                </td>
                                            <td class="">
                                                <div class="actions">
                                                    <a href="{{ route('kitchen.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('kitchen.destroy', $value->id) }}"
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

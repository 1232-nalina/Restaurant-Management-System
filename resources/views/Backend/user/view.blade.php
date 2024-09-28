@extends('Backend.dashboard.main')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Users</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                                    <h3 class="page-title">All Users in System</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('users.create') }}" title="add new user" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;add new user</a>
                                </div>
                            </div>
                        </div>

                        <table
                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                            <tr>
                                <th>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </th>
                                <th>S.N</th>

                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Roles</th>


{{--                                <th>No of Students</th>--}}
                                <th class="text-end">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users->isNotEmpty())
                                @foreach($users as $key=>$value)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>{{ $key+1 }}</td>

                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td> @foreach ($value->roles as $role)
                                            <span class="badge badge-success mr-1">
                                                {{ $role->name }}
                                            </span>

                                            @endforeach</td>


{{--                                        <td>180</td>--}}
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="{{ route('users.edit',$value->id) }}" class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy',$value->id) }}" method="POST">
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

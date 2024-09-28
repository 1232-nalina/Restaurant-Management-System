@extends('Backend.dashboard.main')
@section('title', 'System Settings View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">System Settings</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">System Settings</li>
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
                                    <h3 class="page-title">Available System Settings</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('systemsetting.create') }}" title="add System Settings" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;add new System Settings</a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th width="5%">ID</th>

                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th>Logo</th>
                                    <th>Signature</th>
                                    <th>PAN/VAT</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($system_settings->isNotEmpty())
                                    @foreach ($system_settings as $key => $value)
                                        <tr>

                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->address }}</td>
                                            <td>
                                                @if($value->logo == "noimg.jpg")
                                                    No Image upload
                                                @else
                                                    <img src="{{ asset('upload/System/'.$value->logo) }}" width="100px" height="80px" style="object-fit: cover" alt="">
                                                @endif
    
                                            </td>
                                            <td>
                                                @if($value->signature == "noimg.jpg")
                                                    No Image upload
                                                @else
                                                    <img src="{{ asset('upload/System/'.$value->signature) }}" width="100px" height="80px" style="object-fit: cover" alt="">
                                                @endif
    
                                            </td>
                                            <td>{{ $value->pan }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->phone }}</td>
                                            @if ($value->status == 'active')
                                                <td class="text-success">{{ $value->status }}</td>
                                            @else
                                                <td class="text-danger">{{ $value->status }}</td>
                                            @endif
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ route('systemsetting.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('systemsetting.destroy', $value->id) }}"
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

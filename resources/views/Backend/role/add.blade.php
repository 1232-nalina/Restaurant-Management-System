@extends('Backend.dashboard.main')

@section('content')
<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Add Role</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Add Role</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <div class="form-group local-forms">
                                    <label>Role <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter a New Role">
                                    @error('name')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <h6>permissions</h6>
                             <div class="col-md-10">

                                <div class="form-group" style="margin-bottom:0.2rem">
                                    <input type="checkbox"   value="1" id="checkPermissionAll" style="cursor: pointer">
                                    <label for="checkPermissionAll" style="cursor:pointer" class="mb-0">Give All Permissions</label>
                                </div>
                                <hr>
                                @php $i=1 @endphp
                                @foreach ($permission_groups as $group)

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group" style="margin-bottom:0.2rem">
                                            <input type="checkbox"  value="{{ $group->name }}"onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" id="{{ $i }}Management" style="cursor: pointer">
                                            <label for="{{ $i }}Management" style="cursor:pointer" class="mb-0">{{ $group->name }}   </label>
                                        </div>
                                    </div>
                                    <div class="col-9 role-{{ $i }}-management-checkbox">
                                        @php
                                            $permissions=App\Models\User::getpermissionsByGroupName($group->name);
                                            $j=1;
                                        @endphp
                                        @if ($permissions)
                                        @foreach ($permissions as $permission )
                                        <div class="form-group" style="margin-bottom:0.2rem">
                                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}" id="permission-checkbox{{ $permission->id }}" style="cursor: pointer">
                                            <label for="permission-checkbox{{ $permission->id }}" style="cursor:pointer" class="mb-0">{{ $permission->name }}   </label>
                                        </div>
                                        @php  $j++; @endphp
                                        @endforeach


                                        @endif
                                    </div>
                                </div>
                                <hr>
                                @php  $i++; @endphp
                                @endforeach




                                </div>
                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">Save Role</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('Backend.dashboard.scripts.permission-checkbox')
@endsection

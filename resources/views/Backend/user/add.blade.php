@extends('Backend.dashboard.main')
@section('content')
<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Add User</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">Add User</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title"><span>Add New User</span></h5>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group local-forms">
                                    <label>User Name <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" placeholder="enter user name" value="{{ old('name') }}">
                                    @error('name')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group local-forms">
                                    <label>User Email <span class="login-danger">*</span></label>
                                    <input type="email" class="form-control @error('started_year')is-invalid @enderror" placeholder="enter user email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group local-forms">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input type="password" class="form-control @error('password')is-invalid @enderror" name="password" placeholder="create password" value="">
                                    @error('password')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group local-forms">
                                    <label>Confirm Password <span class="login-danger">*</span></label>
                                    <input type="password" class="form-control @error('password_confirmation')is-invalid @enderror" placeholder="re-type password to confirm" name="password_confirmation" value="">
                                    @error('password_confirmation')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                <label>Roles <span class="login-danger">*</span></label>
                                <select class="form-control select" aria-placeholder="select" name="roles[]" multiple>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                </div>



                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">Save User</button>
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

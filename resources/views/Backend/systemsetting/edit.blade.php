@extends('Backend.dashboard.main')
@section('title', 'System Settings Edit')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit System Settings</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('systemsetting.index') }}">System Settings</a></li>
                        <li class="breadcrumb-item active">Edit System Settings</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('systemsetting.update', $system_settings->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Company Name <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('name')is-invalid @enderror"
                                            name="name" value="{{ $system_settings->name }}" placeholder="Company Name">
                                        @error('name')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Address<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('address')is-invalid @enderror"
                                            name="address" value="{{ $system_settings->address }}" placeholder="Address">
                                        @error('address')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Logo<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('logo')is-invalid @enderror"
                                            name="logo" value="{{ $system_settings->logo }}" placeholder="">
                                        @error('logo')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Signature<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('signature')is-invalid @enderror"
                                            name="signature" value="{{ $system_settings->signature }}" placeholder="">
                                        @error('signature')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>PAN/VAT<span class="login-danger">*</span></label>
                                        <input type="number" class="form-control @error('pan')is-invalid @enderror"
                                            name="pan" value="{{ $system_settings->pan }}" placeholder="PAN/VAT">
                                        @error('pan')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Email ID<span class="login-danger">*</span></label>
                                        <input type="email" class="form-control @error('email')is-invalid @enderror"
                                            name="email" value="{{ $system_settings->email }}" placeholder="Email Id">
                                        @error('email')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Phone Number <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone')is-invalid @enderror"
                                            name="phone" value=" {{ $system_settings->phone  }}" placeholder="Phone Number">
                                        @error('phone')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group" data-select2-id="11">

                                        <select class="select select2-hidden-accessible" name="status" data-select2-id="1"
                                            tabindex="-1" aria-hidden="true">

                                            <option value="active"
                                                {{ $system_settings->status == 'active' ? 'selected' : '' }}
                                                data-select2-id="17">Active</option>
                                            <option value="inactive"
                                                {{ $system_settings->status == 'inactive' ? 'selected' : '' }}
                                                data-select2-id="18">Inactive</option>


                                        </select>
                                        @error('status')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>



                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update System Settings</button>
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

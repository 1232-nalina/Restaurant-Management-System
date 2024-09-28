@extends('Backend.dashboard.main')
@section('title', 'System Settings Add')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add System Settings</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('systemsetting.index') }}">System Settings</a></li>
                        <li class="breadcrumb-item active">Add System Settings</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('systemsetting.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Company Name <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('name')is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" placeholder="Company Name">
                                        @error('name')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Address<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('address')is-invalid @enderror"
                                            name="address" value="{{ old('address') }}" placeholder="Address">
                                        @error('address')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Logo<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('logo')is-invalid @enderror"
                                            name="logo" value="{{ old('logo') }}" placeholder="">
                                        @error('logo')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Signature<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('signature')is-invalid @enderror"
                                            name="signature" value="{{ old('signature') }}" placeholder="">
                                        @error('signature')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>PAN/VAT<span class="login-danger">*</span></label>
                                        <input type="number" class="form-control @error('pan')is-invalid @enderror"
                                            name="pan" value="{{ old('pan') }}" placeholder="PAN/VAT">
                                        @error('pan')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Email ID<span class="login-danger">*</span></label>
                                        <input type="email" class="form-control @error('email')is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" placeholder="Email Id">
                                        @error('email')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Phone Number <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone')is-invalid @enderror"
                                            name="phone" value="{{ old('phone') }}" placeholder="Phone Number">
                                        @error('phone')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Status <span class="login-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="status" id="status"
                                                    class="form-control @error('status') is-invalid @enderror">
                                                <option value="active"  {{ old('status') == "active" ? 'selected' : '' }}>
                                                   Active
                                                </option>
                                                <option value="inactive"  {{ old('status') == "inactive" ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Save System Settings</button>
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

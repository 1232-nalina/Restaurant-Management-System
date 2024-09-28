@extends('Backend.dashboard.main')
@section('title', 'Income Source Edit')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Table</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('table.index') }}">Table</a></li>
                        <li class="breadcrumb-item active">Edit Table</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('table.update', $table->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Table Name<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('name')is-invalid @enderror"
                                            name="table" value="{{ $table->name }}" placeholder="Income Source">
                                        @error('table')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>No of Seats<span class="login-danger">*</span></label>
                                        <input type="number" class="form-control @error('seat')is-invalid @enderror"
                                            name="seat" value="{{ $table->seats }}" placeholder="No of Seats">
                                        @error('seat')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update Table</button>
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

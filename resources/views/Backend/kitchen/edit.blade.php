@extends('Backend.dashboard.main')
@section('title', 'Income Source Edit')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit kitchen</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kitchen.index') }}">kitchen</a></li>
                        <li class="breadcrumb-item active">Edit kitchen</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('kitchen.update', $kitchen->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group local-forms">
                                        <label>kitchen Name<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('name')is-invalid @enderror"
                                            name="kitchen" value="{{ $kitchen->name }}" placeholder="Income Source">
                                        @error('kitchen')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update kitchen</button>
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

@extends('Backend.dashboard.main')
@section('title', 'Income Source Edit')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Stock</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('stock.index') }}">Stock</a></li>
                        <li class="breadcrumb-item active">Edit Stock</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('stock.update', $stock->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group local-forms">
                                        <label>Stock Name<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('name')is-invalid @enderror"
                                            name="name" value="{{ $stock->name }}" placeholder="Income Source">
                                        @error('stock')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group local-forms">
                                        <label>Stock Quantity<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('quantity')is-invalid @enderror"
                                            name="quantity" value="{{ $stock->quantity_in_gm }}" placeholder="Quantity">
                                        @error('quantity')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group local-forms">
                                        <label>Stock Amount<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('amount')is-invalid @enderror"
                                            name="amount" value="{{ $stock->amount }}" placeholder="Amount">
                                        @error('amount')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update Stock</button>
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

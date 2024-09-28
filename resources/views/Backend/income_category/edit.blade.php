@extends('Backend.dashboard.main')
@section('title', 'Income Source Edit')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit income source</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('income_category.index') }}">income sources</a></li>
                        <li class="breadcrumb-item active">Edit income source</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('income_category.update', $income_category->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group local-forms">
                                        <label>Income Source  <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('name')is-invalid @enderror"
                                            name="category_name" value="{{ $income_category->category_name }}" placeholder="Income Source">
                                        @error('category_name')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                               
                              
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group local-forms">
                                        <label>Income Amount</label>
                                        <input type="text" class="form-control @error('income_amount')is-invalid @enderror"
                                            name="income_amount" value="{{ $income_category->income_amount }}" placeholder="Client income_amount">
                                        @error('income_amount')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group" data-select2-id="11">

                                        <select class="select select2-hidden-accessible" name="status" data-select2-id="1"
                                            tabindex="-1" aria-hidden="true">

                                            <option value="active" {{ $income_category->status == 'active' ? 'selected' : '' }}
                                                data-select2-id="17">Active</option>
                                            <option value="inactive" {{ $income_category->status == 'inactive' ? 'selected' : '' }}
                                                data-select2-id="18">Inactive</option>


                                        </select>
                                        @error('gender')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>



                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update Source</button>
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

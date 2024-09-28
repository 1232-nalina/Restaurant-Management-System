@extends('Backend.dashboard.main')
@section('title', 'Expenses Category Edit')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit expenses category</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('expenses_category.index') }}">expenses categorys</a></li>
                        <li class="breadcrumb-item active">Edit expenses category</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('expenses_category.update', $expenses_category->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group local-forms">
                                        <label>expenses_category <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('name')is-invalid @enderror"
                                            name="category_name" value="{{ $expenses_category->category_name }}" placeholder="expenses category">
                                        @error('category_name')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                               
                
                                <div class="col-12 col-sm-4">
                                    <div class="form-group" data-select2-id="11">

                                        <select class="select select2-hidden-accessible" name="status" data-select2-id="1"
                                            tabindex="-1" aria-hidden="true">

                                            <option value="active" {{ $expenses_category->status == 'active' ? 'selected' : '' }}
                                                data-select2-id="17">Active</option>
                                            <option value="inactive" {{ $expenses_category->status == 'inactive' ? 'selected' : '' }}
                                                data-select2-id="18">Inactive</option>


                                        </select>
                                        @error('gender')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>



                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update Expenses Category</button>
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

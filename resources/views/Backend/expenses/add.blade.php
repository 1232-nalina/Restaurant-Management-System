@extends('Backend.dashboard.main')
@section('title', 'expenses Add')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add expenses</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('expenses.index') }}">expensess</a></li>
                        <li class="breadcrumb-item active">Add expenses</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('expenses.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group" data-select2-id="11">

                                        <select class="select select2-hidden-accessible" name="category_id"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="" selected disabled>-- choose expenses category -- </option>
                                            @if ($expenses_category->isNotEmpty())
                                                @foreach ($expenses_category as $key => $value)
                                                    <option value="{{ $value }}"
                                                        {{ old('category_id') == $value ? 'selected' : '' }}>
                                                        {{ $key }}
                                                    </option>
                                                @endforeach
                                            @endif


                                        </select>
                                        @error('category_id')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>expenses amount <span class="login-danger">*</span></label>
                                        <input type="number" class="form-control @error('amount')is-invalid @enderror"
                                            name="amount" value="{{ old('amount') }}">
                                        @error('amount')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>expenses date <span class="login-danger">*</span></label>
                                        <input type="date" id="" class="datetimepicker form-control @error('expenses_date')is-invalid @enderror"
                                            name="expenses_date" value="{{ old('expenses_date') }}">
                                        @error('expenses_date')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Save expenses</button>
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

@endsection

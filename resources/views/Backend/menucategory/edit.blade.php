@extends('Backend.dashboard.main')
@section('title', 'Menu Categories Edit')
@section('content')
<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit Menu Categories</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('menucategory.index') }}">Menu Categoriess</a></li>
                    <li class="breadcrumb-item active">Edit Menu Categories</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ route('menucategory.update', $menucategory->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group local-forms">
                                    <label>Menu Categories <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control @error('name')is-invalid @enderror" name="menu_category_name" value="{{ $menucategory->name }}" placeholder="Menu Categories">
                                    @error('menu_category_name')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-12 col-sm-5 col-md-5">
                                <div class="form-group local-forms">
                                    <label>Menu Type <span class="login-danger">*</span></label>

                                    <select class="form-control" name="type" id="">
                                        <option selected disabled>-- Choose type --</option>
                                        <option value="all"@if ($menucategory->type == 'all') selected @endif>All</option>
                                        <option value="breakfast"@if ($menucategory->type == 'breakfast') selected @endif>Breakfast</option>
                                        <option value="lunch"@if ($menucategory->type == 'Lunch') selected @endif>Lunch</option>
                                        <option value="dinner"@if ($menucategory->type == 'dinner') selected @endif>Dinner</option>
                                        <option value="drink"@if ($menucategory->type == 'drink') selected @endif>Drink</option>
                                    </select>

                                    @error('type')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>



                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">Update Menu Category</button>
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
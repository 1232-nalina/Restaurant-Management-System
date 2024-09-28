@extends('Backend.dashboard.main')
@section('title', 'Inventories Add')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Inventory Add</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventories.index') }}">List item</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                <div class="card">

                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                        @endif
                        <form method="POST" action="{{ route('inventories.store') }}">
                            @csrf
                            <div class="input-fields">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <div class="form-group local-forms">
                                            <label>Inventory Name<span class="login-danger">*</span></label>
                                            <select name="name" id="" class="form-control @error('name')is-invalid @enderror">
                                                <option value="" selected disabled>Choose Inventory Name</option>
                                                    @foreach ($data as $item)
                                                      <option value="{{ $item->name }}" {{ $item->name == old('name') ? 'selected' : ''  }}>{{ $item->name }}</option>

                                                    @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control @error('name')is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" placeholder="Item Name"> --}}
                                            @error('name')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-12 col-sm-6 col-md-6">
                                        <div class="form-group local-forms">
                                            <label>Price<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('price')is-invalid @enderror"
                                                name="price" value="{{ old('price') }}" placeholder="Item price">
                                            @error('price')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <div class="form-group local-forms">
                                            <label>Quantity<span class="login-danger">*</span></label>
                                            <input type="number" class="form-control @error('qty')is-invalid @enderror"
                                                name="qty" value="{{ old('qty') }}" placeholder="Item Qunatity">
                                            @error('qty')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <div class="form-group local-forms">
                                            <label>Unit <span class="login-danger">*</span></label>

                                                <select class="form-control" name="unit" id="">
                                                    <option selected disabled>-- Choose unit --</option>
                                                    <option value="kg">kg</option>
                                                    <option value="litre">litre</option>
                                                    <option value="pcs">pcs</option>
                                                </select>

                                            @error('unit')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>


                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary" name='status' value="active">Publish</button>
                                </div>
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-warning" name='status' value="inactive">Save as Draft</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


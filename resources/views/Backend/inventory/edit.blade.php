@extends('Backend.dashboard.main')
@section('title', 'Invnetory Edit')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Inventory</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventories.index') }}">Inventory</a></li>
                        <li class="breadcrumb-item active">Edit Invnetory</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('inventories.update', $Inventory->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row input-fields">
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Item Name</label>
                                        <input type="text" class="form-control @error('name')is-invalid @enderror"
                                            name="name" value="{{ $Inventory->name }}" placeholder="Item Name">
                                        @error('name')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Price<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('price')is-invalid @enderror"
                                            name="price" value="{{ $Inventory->price }}" placeholder="Item price">
                                        @error('price')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row col-12 col-sm-12 col-md-12">
                                    <div class="col-4 col-sm-4 col-md-4">
                                        <div class="form-group local-forms">
                                            <label>Quantity<span class="login-danger">*</span></label>
                                            <input type="number" class="form-control @error('qty')is-invalid @enderror"
                                                name="qty" value="{{ $Inventory->qty }}" placeholder="Item Qunatity" disabled>
                                            @error('qty')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4">

                                        <div class="input-group">
                                            <span class="input-group-text" >Goods In</span>
                                            <input type="text" class="form-control" placeholder="Username" id="a" name="g_in"
                                                aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4">

                                        {{-- <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Username" id="b" name="g_out"
                                                aria-label="Username" aria-describedby="basic-addon1">
                                            <span class="input-group-text">Goods Out</span>
                                        </div> --}}
                                        <div class="form-group local-forms">
                                            <label>Unit <span class="login-danger">*</span></label>

                                            <select class="form-control" name="unit" id="">
                                                <option selected disabled>-- Choose unit --</option>
                                                <option value="kg" @if ($Inventory->unit == 'kg') selected @endif>kg
                                                </option>
                                                <option value="litre"@if ($Inventory->unit == 'litre') selected @endif>
                                                    litre</option>
                                                <option value="pcs"@if ($Inventory->unit == 'pcs') selected @endif>pcs
                                                </option>
                                            </select>

                                            @error('unit')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6">

                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary" name='status'
                                                value="active">Publish</button>
                                        </div>
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-warning" name='status'
                                                value="inactive">Save as Draft</button>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const inputA = document.getElementById("a");
        const inputB = document.getElementById("b");

        if (inputA && inputB) {
            inputB.addEventListener("input", function () {
                if (inputB.value.trim() !== "") {
                    inputA.disabled = true;
                } else {
                    inputA.disabled = false;
                }
            });
            inputA.addEventListener("input", function () {
                if (inputA.value.trim() !== "") {
                    inputB.disabled = true;
                } else {
                    inputB.disabled = false;
                }
            });
        } else {
            console.error("One or both input elements not found.");
        }
    });
</script>
@endsection

@extends('Backend.dashboard.main')
@section('title', 'stock Add')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Stock Add</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('income_category.index') }}">Stock</a></li>
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
                        <form method="POST" action="{{ route('stock.store') }}">
                            @csrf
                            <div class="input-fields">
                                <div class="row">

                                    <div class="col-12 col-md-12 d-flex">
                                        <div class="form-group local-forms col-md-3">
                                                <label>Stock Name <span class="login-danger">*</span></label>
                                            <select id="chooseOrType0" onchange="handleChange(this, 0)" class="form-control @error('name') is-invalid @enderror" name="inputs[0][name]">
                                                <option value="" disabled selected>Choose Stock</option>
                                                @foreach ($data as $key)
                                                    <option value={{ $key->id }}>{{ $key->name }}</option>
                                                @endforeach
                                                {{-- <option value="custom">Custom</option> --}}
                                            </select>
                                            {{-- style="display: none;" --}}
                                            {{-- <input type="text" class="form-control @error('name') is-invalid @enderror mt-2" name="inputs[0][name]" value="{{ old('name') }}" id="customInput0" placeholder="Stock Name" > --}}


                                            @error('name')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group local-forms col-md-3 mx-4">
                                            <label>Stock quantity <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('quantity')is-invalid @enderror"
                                                name="inputs[0][quantity]" value="{{ old('quantity') }}" placeholder="Stock quantity">
                                            @error('quantity')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group local-forms col-md-3">
                                            <label>Stock amount <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('amount')is-invalid @enderror"
                                                name="inputs[0][amount]" value="{{ old('amount') }}" placeholder="Stock amount">
                                            @error('amount')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 mx-4">
                                            <a class="btn btn-primary mb-4" title="add more" id="addmore">+</a>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">save</button>
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
{{-- <script>
    function handleChange(selectElement, index) {
        var customInput = document.getElementById("customInput" + index);

        if (selectElement.value === "custom") {
            customInput.style.display = "block";
        } else {
            customInput.style.display = "none";
        }
    }
</script> --}}
<script>
    $(document).ready(function(){
        var max_fields = 10; // maximum input fields allowed
            var wrapper = $(".input-fields"); // container for input fields
            var add_button = $("#addmore"); // add more button

            var x = 0; // initialize counter for input fields

            $(add_button).click(function(e){
                e.preventDefault();
                x++;
                $(wrapper).append(
                    `<div class="row my-fields">

                        <div class="col-12 col-md-12 d-flex">
                            <div class="form-group local-forms col-md-3">

                                <select id="chooseOrType0"  class="form-control @error('name') is-invalid @enderror" name="inputs[`+x+`][name]">
                                                <option value="" disabled selected>Choose Stock</option>
                                                @foreach ($data as $key)
                                                    <option value={{ $key->id }}>{{ $key->name }}</option>
                                                @endforeach
                                            </select>


                                @error('name')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group local-forms col-md-3 mx-4">
                                 <input type="text" class="form-control @error('quantity')is-invalid @enderror"
                                     name="inputs[`+x+`][quantity]" value="{{ old('quantity') }}" >
                                 @error('quantity')
                                     <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                 @enderror
                             </div>
                             <div class="form-group local-forms col-md-3">
                                 <input type="text" class="form-control @error('amount')is-invalid @enderror"
                                     name="inputs[`+x+`][amount]" value="{{ old('amount') }}">
                                 @error('amount')
                                     <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                 @enderror
                             </div>
                             <div class="col-12 col-md-2 mx-4">

                        <a class="btn btn-danger remove-btn" title="remove source">x</a>
                        </div>
                        </div>

                    </tr>
                    </div>`
                )

            });
    });
    $(document).on('click','.remove-btn',function(){
        $(this).parents('.my-fields').remove();
    });

</script>
@endsection

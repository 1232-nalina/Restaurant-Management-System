@extends('Backend.dashboard.main')
@section('title', 'Order')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Order <i class="fa fa-coffee "></i></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('order.take') }}">Order</a></li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                <div class="card">

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        @endif
                        <form method="POST" action="{{ route('order.store') }}">
                            @csrf
                            <div class="input-fields">
                                <div class="row">

                                    <div class="col-12 col-sm-12 col-md-12">
                                        <div class="form-group local-forms">
                                            <label>Table <span class="login-danger">*</span> </label>


                                            <select class="form-control" name="table_id" id="" required>
                                                <option selected disabled>-- Choose Table --</option>
                                                @if ($tables)
                                                    @foreach ($tables as $key => $value)
                                                        <option value="{{ $value->id }}"{{ old('table_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                                    @endforeach

                                                @endif


                                            </select>

                                            @error('table_id')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="form-group local-forms">
                                            <label>Items <span class="login-danger">*</span></label>
                                            <select class="form-control myDropdown" name="inputs[0][menu_item_id]"
                                                id="menu_item">
                                                <option selected disabled>-- Choose Menu Item --</option>
                                                @if ($menuitem)
                                                    @foreach ($menuitem as $key => $value)
                                                        <option value="{{ $value->id }}" {{ old('inputs[0][menu_item_id]') == $value->id ? 'selected' : '' }}
                                                            data-price="{{ $value->price }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('menu_item_id')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Quantity<span class="login-danger">*</span></label>
                                            <input type="number"
                                                class="form-control @error('quantity')is-invalid @enderror"
                                                name="inputs[0][quantity]" id="quantity" value="{{ old('inputs[0][quantity]') }}"
                                                placeholder="Item quantity" required>
                                            @error('quantity')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Price<span class="login-danger">*</span></label>
                                            <input type="number" class="form-control @error('price')is-invalid @enderror"
                                                name="inputs[0][price]" id="price" value="{{ old('inputs[0][price]') }}"
                                                placeholder="Item price" readonly>
                                            @error('price')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a class="btn btn-primary mb-4" title="add more" id="addmore">+</a>
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



    <script>
        $(document).ready(function() {
            var max_fields = 10; // maximum input fields allowed
            var wrapper = $(".input-fields"); // container for input fields
            var add_button = $("#addmore"); // add more button
            var x = 1; // initialize counter for input fields

            $(add_button).click(function(e) {
                e.preventDefault();
                // Check if a table is selected
                var $tableSelect = $('select[name="table_id"]');
                var tableSelected = $tableSelect.val();
                if (!tableSelected) {

                    Swal.fire({
                        title: "No Table Selected",
                        text: "Please Select the Table Your're Ordering ",
                        type: "success",
                        showCancelButton: 0,
                        confirmButtonColor: "#3085d6",

                        confirmButtonText: "Ok",
                        confirmButtonClass: "btn btn-primary",

                    })
                    return false;
                }

                if (x < max_fields) {
                    x++;
                    $(wrapper).append(
                        `<div class="row my-fields">
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="form-group local-forms">
                                <label>Items <span class="login-danger">*</span></label>
                                <select class="form-control menu_item" name="inputs[` + x +
                        `][menu_item_id]" id="menu_item_${x}">
                                    <option selected disabled>-- Choose Menu Item --</option>
                                    @if ($menuitem)
                                    @foreach ($menuitem as $key => $value)
                                    <option value="{{ $value->id }}" data-price="{{ $value->price }}">{{ $value->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('menu_item_id')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group local-forms">
                                <label>Quantity<span class="login-danger">*</span></label>
                                <input type="number" class="form-control quantity @error('quantity')is-invalid @enderror" name="inputs[` +
                        x +
                        `][quantity]" id="quantity" value="{{ old('quantity') }}" placeholder="Item quantity">
                                @error('quantity')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group local-forms">
                                <label>Price<span class="login-danger">*</span></label>
                                <input type="number" class="form-control price @error('price')is-invalid @enderror" name="inputs[` +
                        x + `][price]" id="price" value="{{ old('price') }}" placeholder="Item price" readonly>
                                @error('price')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <a class="btn btn-danger remove-btn" title="remove source"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>`
                    );
                    // Initialize Select2 on the newly created dropdown
                    $(`#menu_item_${x}`).select2();

                }
            });

            $(document).on('click', '.remove-btn', function() {
                $(this).parents('.my-fields').remove();
                x--;
            });

            $(document).on('change', '.menu_item', function() {
                var $myFields = $(this).closest('.my-fields');
                var $quantityInput = $myFields.find('.quantity');
                var $priceInput = $myFields.find('.price');
                var price = $(this).find(':selected').data('price');
                var quantity = $quantityInput.val();
                var total = '';

                if (quantity !== '') {
                    total = price * quantity;
                }

                $priceInput.val(total);
            });

            $(document).on('input', '.quantity', function() {
                var $myFields = $(this).closest('.my-fields');
                var $menuItem = $myFields.find('.menu_item');
                var price = $menuItem.find(':selected').data('price');
                var quantity = $(this).val();
                var total = 0;

                if (quantity !== '') {
                    total = price * quantity;
                    $myFields.find('.price').val(total);
                } else {
                    $myFields.find('.price').val('');
                }
            });

        });
    </script>


    <script>
        $(document).ready(function() {
            $("#menu_item, #quantity").on("change keyup", function() {
                var menu_item_id = $("#menu_item").val();
                var quantity = $("#quantity").val();
                var price = $("#menu_item option:selected").data("price");

                if (menu_item_id && quantity) {
                    var total_price = price * quantity;
                    $("#price").val(total_price.toFixed(2));
                } else {
                    $("#price").val("");
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.myDropdown').select2();
        });
    </script>

@endsection

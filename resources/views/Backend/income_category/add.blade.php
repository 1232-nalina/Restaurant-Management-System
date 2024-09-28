@extends('Backend.dashboard.main')
@section('title', 'Income Source Add')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">@lang('public.add-income-sources')</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('public.dashboard')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('income_category.index') }}">@lang('public.income-sources')</a></li>
                        <li class="breadcrumb-item active">@lang('public.add-income-sources')</li>
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
                        <form method="POST" action="{{ route('income_category.store') }}">
                            @csrf
                            <div class="input-fields">
                                <div class="row">

                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>@lang('public.income-sources')<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('category_name')is-invalid @enderror"
                                                name="inputs[0][category_name]" value="{{ old('category_name') }}" placeholder="@lang('public.income-sources') ">
                                            @error('category_name')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>@lang('public.income-amount') </label>
                                            <input type="text" class="form-control @error('income_amount')is-invalid @enderror"
                                                name="inputs[0][income_amount]" value="{{ old('income_amount') }}" placeholder="@lang('public.income-amount') ">
                                            @error('income_amount')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <a class="btn btn-primary mb-4" title="add more income_category" id="addmore">+</a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">@lang('public.save')</button>
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
    $(document).ready(function(){
        var max_fields = 10; // maximum input fields allowed
            var wrapper = $(".input-fields"); // container for input fields
            var add_button = $("#addmore"); // add more button

            var x = 1; // initialize counter for input fields

            $(add_button).click(function(e){
                e.preventDefault();
                x++;
                $(wrapper).append(
                    `<div class="row my-fields">

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group local-forms">
                              
                                <input type="text" class="form-control @error('category_name')is-invalid @enderror"
                                    name="inputs[`+x+`][category_name]" value="{{ old('category_name') }}">
                                @error('category_name')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group local-forms">
                             
                                <input type="text" class="form-control @error('income_amount')is-invalid @enderror"
                                    name="inputs[`+x+`][income_amount]" value="{{ old('income_amount') }}">
                                @error('income_amount')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                     
                        <div class="col-12 col-md-1">
                        <a class="btn btn-danger remove-btn" title="remove source">x</a>
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

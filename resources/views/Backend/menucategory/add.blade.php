@extends('Backend.dashboard.main')
@section('title', 'Menu Category Add')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Menu Category Add</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('menucategory.index') }}">Menu Category</a></li>
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
                        <form method="POST" action="{{ route('menucategory.store') }}">
                            @csrf
                            <div class="input-fields">
                                <div class="row">

                                    <div class="col-12 col-sm-6 col-md-5">
                                        <div class="form-group local-forms">
                                            <label>Menu Category <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('name')is-invalid @enderror"
                                                name="inputs[0][name]" value="{{ old('name') }}" placeholder="Menu Category Name ">
                                            @error('name')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-2">
                                        <a class="btn btn-primary mb-4" title="add more" id="addmore">+</a>
                                    </div>
                                    <div class="col-12 col-sm-5 col-md-5">
                                        <div class="form-group local-forms">
                                            <label>Menu Type <span class="login-danger">*</span></label>

                                                <select class="form-control" name="inputs[0][type]" id="">
                                                    <option selected disabled>-- Choose type --</option>
                                                    <option value="all">All</option>
                                                    <option value="breakfast">Breakfast</option>
                                                    <option value="lunch">Lunch</option>
                                                    <option value="dinner">Dinner</option>
                                                    <option value="drink">Drink</option>
                                                </select>

                                            @error('type')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
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

                        <div class="col-12 col-sm-6 col-md-5">
                            <div class="form-group local-forms">

                                <input type="text" class="form-control @error('name')is-invalid @enderror"
                                    name="inputs[`+x+`][name]" value="{{ old('name') }}">
                                @error('name')
                                    <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="col-12 col-md-2">
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

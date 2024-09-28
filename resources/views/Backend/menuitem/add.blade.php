@extends('Backend.dashboard.main')
@section('title', 'Menu Item Add')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Menu Item Add</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('menuitem.index') }}">Menu Item</a></li>
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
                        <form method="POST" action="{{ route('menuitem.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-fields">
                                <div class="row">

                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="form-group local-forms">
                                            <label>Menu Category <span class="login-danger">*</span></label>


                                                <select class="form-control" name="menu_cat_id" id="">
                                                    <option selected disabled>-- Choose Menu Category --</option>
                                                    @if($menucategory)
                                                    @foreach ($menucategory as $key=>$value)
                                                    <option value="{{ $value->id }}"{{ $value->id == old('name') ? 'selected' : ''  }}>{{ $value->name }}</option>

                                                    @endforeach

                                                    @endif


                                                </select>

                                            @error('menu_cat_id')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Menu Item Name<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('name')is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" placeholder="Item Name">
                                            @error('name')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Price<span class="login-danger">*</span></label>
                                            <input type="number" class="form-control @error('price')is-invalid @enderror"
                                                name="price" value="{{ old('price') }}" placeholder="Item price">
                                            @error('price')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    {{-- <div class="col-md-2">
                                        <a class="btn btn-primary mb-4" title="add menu item" id="addmore">+</a>
                                    </div> --}}
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Ingredients Name 1<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('ingredients_name')is-invalid @enderror"
                                                name="inputs[0][ingredients_name]" value="{{ old('ingredients_name') }}" placeholder="Ingredients name">
                                            @error('ingredients_name')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Quantity<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('quantity')is-invalid @enderror"
                                                name="inputs[0][quantity]" value="{{ old('quantity') }}" placeholder="quantity">
                                            @error('quantity')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Unit <span class="login-danger">*</span></label>

                                                <select class="form-control" name="inputs[0][unit]" id="">
                                                    <option selected disabled>-- Choose unit --</option>
                                                    <option value="kg" {{ 'kg' == old('unit') ? 'selected' : ''  }}>kg</option>
                                                    <option value="litre"{{ 'litre' == old('unit') ? 'selected' : ''  }}>litre</option>
                                                    <option value="pcs"{{ 'pcs' == old('unit') ? 'selected' : ''  }}>pcs</option>
                                                </select>

                                            @error('unit')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <a class="btn btn-primary mb-4" title="add ingredients" id="addmore">+</a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12">
                                    <div class=" col-md-8 ml-2">
                                        <div class="form-group local-forms">
                                            <label>Description<span class="login-danger"> *</span></label>
                                            <input type="text" class="form-control @error('description')is-invalid @enderror"
                                                name="description" value="{{ old('description') }}" placeholder="" id="description">
                                            @error('description')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-4" id="display_original_image">
                                            <img src="" style="max-width: auto; height:250px; display:none;" class="img-thumbnail img-fluid" id="img_prv" alt="">
                                        </div>
                                    </div>
                                <div class=" col-md-4">
                                    <div class="form-group local-forms">
                                        <label>Image<span class="login-danger"> *</span></label>
                                        <input type="file" class="form-control @error('image')is-invalid @enderror"
                                            name="image" value="{{ old('image') }}" placeholder="" id="image">
                                        @error('image')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4" id="display_original_image">
                                        <img src="" style="max-width: auto; height:250px; display:none;" class="img-thumbnail img-fluid" id="img_prv" alt="">
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
                    `
                    <div class="row my-fields">
                        <div class="col-12 col-sm-6 col-md-3 ">
                                        <div class="form-group local-forms">
                                            <label>Ingredients Name `+x+` <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('ingredients_name')is-invalid @enderror"
                                                name="inputs[`+x+`][ingredients_name]" value="{{ old('ingredients_name') }}" placeholder="Ingredients name">
                                            @error('ingredients_name')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Quantity<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('quantity')is-invalid @enderror"
                                                name="inputs[`+x+`][quantity]" value="{{ old('quantity') }}" placeholder="quantity">
                                            @error('quantity')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">

                                    <div class="form-group local-forms">
                                            <label>Unit <span class="login-danger">*</span></label>

                                                <select class="form-control" name="inputs[`+x+`][unit]" id="">
                                                    <option selected disabled>-- Choose unit --</option>
                                                    <option value="kg" {{ 'kg' == old('unit') ? 'selected' : ''  }}>kg</option>
                                                    <option value="litre"{{ 'litre' == old('unit') ? 'selected' : ''  }}>litre</option>
                                                    <option value="pcs"{{ 'pcs' == old('unit') ? 'selected' : ''  }}>pcs</option>
                                                </select>

                                            @error('unit')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        </div>
                        <div class="col-12 col-md-3">
                        <a class="btn btn-danger remove-btn" title="remove source"><i class="fa fa-trash"></i></a>
                        </div>
</div>
                    `
                )

            });
    });
    $(document).on('click','.remove-btn',function(){
        $(this).parents('.my-fields').remove();
    });
    $('#image').on('change', function(ev) {
            var reader = new FileReader();

            reader.onload = function(ev) {
                $('#img_prv').attr('src', ev.target.result).css('display', 'inline')
            }
            reader.readAsDataURL(this.files[0]);
        })

</script>
@endsection

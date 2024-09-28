@extends('Backend.dashboard.main')
@section('title', 'menu item Edit')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit menu item</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('menuitem.index') }}">menu items</a></li>
                        <li class="breadcrumb-item active">Edit menu item</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('menuitem.update', $menuitem->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row input-fields">

                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>menu item  <span class="login-danger">*</span></label>
                                        <select class="form-control" name="menu_category_name" id="">
                                            <option selected disabled>-- Choose Menu Category --</option>
                                            @if($menucategory)
                                            @foreach ($menucategory as $key=>$value)
                                            <option value="{{ $value->id }}" {{ $menuitem->menu_cat_id == $value->id ? 'selected' : ''}}>{{ $value->name }}</option>

                                            @endforeach

                                            @endif


                                        </select>

                                        @error('menu_category_name')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>


                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>Menu Item Name</label>
                                        <input type="text" class="form-control @error('Menu_Item_Name')is-invalid @enderror"
                                            name="Menu_Item_Name" value="{{ $menuitem->name }}" placeholder="Menu Item Name">
                                        @error('Menu_Item_Name')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>Price<span class="login-danger">*</span></label>
                                        <input type="number" class="form-control @error('price')is-invalid @enderror"
                                            name="price" value="{{ old('price',$menuitem->price) }}" placeholder="Item price">
                                        @error('price')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                @if (count($ingredients) > 0)
                                @foreach ($ingredients as $key => $ingredient )
                    <div class="row my-fields">

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group local-forms">
                                        <label>Ingredients Name {{ $key + 1 }}<span class="login-danger">*</span></label>
                                        <input type="hidden" name="inputs[{{ $key }}][ingredients_id]" value="{{ $ingredient->id }}">
                                        <input type="text" class="form-control @error('ingredients_name')is-invalid @enderror"
                                            name="inputs[{{ $key }}][ingredients_name]" value="{{ old('ingredients_name',$ingredient->name) }}" placeholder="Ingredients name">
                                        @error('ingredients_name')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group local-forms">
                                        <label>Quantity<span class="login-danger">*</span></label>
                                        <input type="number" class="form-control @error('quantity')is-invalid @enderror"
                                            name="inputs[{{ $key }}][quantity]" value="{{ old('quantity',$ingredient->quantity) }}" placeholder="quantity">
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
                                                <option value="kg" {{ 'kg' == $ingredient->unit ? 'selected' : ''  }}>kg</option>
                                                <option value="litre"{{ 'litre' == $ingredient->unit ?  'selected' : ''  }}>litre</option>
                                                <option value="pcs"{{ 'pcs' == $ingredient->unit ? 'selected' : ''  }}>pcs</option>
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
                                @endforeach
                                @else
                                {{-- @dd('hi'); --}}

                                <div class="col-12 col-sm-6 col-md-5">
                                    <div class="form-group local-forms">
                                        <label>Ingredients Name 1<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('inputs[0][ingredients_name]')is-invalid @enderror"
                                            name="inputs[0][ingredients_name]" value="{{ old('inputs[0][ingredients_name]') }}" placeholder="Ingredients name">
                                            @error('inputs[0][ingredients_name]')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6 col-md-5">
                                    <div class="form-group local-forms">
                                        <label>Quantity<span class="login-danger">*</span></label>
                                        <input type="number" class="form-control @error('inputs[0][quantity]')is-invalid @enderror"
                                            name="inputs[0][quantity]" value="{{ old('inputs[0][quantity]') }}" placeholder="quantity">
                                        @error('inputs[0][quantity]')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                @endif


                                <div class="col-md-2">
                                    <a class="btn btn-primary mb-4" title="add ingredients" id="addmore">+</a>
                                </div>
                                <div class=" col-md-12  ml-2">
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
                                <div class="form-group local-forms">
                                        <label>Image<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('image')is-invalid @enderror"
                                            name="image" value="{{ old('image',$menuitem->image) }}" placeholder="">
                                        @error('image')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    @if ($menuitem->image)
                                    {{-- <img src="public_path().'/upload/Menu/'.{{$menuitem->image }}" alt="" width="50%"> --}}
                                    <img src="{{ asset('/upload/Menu/' . $menuitem->image) }}" alt="Image" style="width: 30%;">

                                    @endif

                            </div>
                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">Update Source</button>
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
                                            @error('inputs[`+x+`][ingredients_name]')
                                                <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Quantity<span class="login-danger">*</span></label>
                                            <input type="number" class="form-control @error('quantity')is-invalid @enderror"
                                                name="inputs[`+x+`][quantity]" value="{{ old('quantity') }}" placeholder="quantity">
                                            @error('inputs[`+x+`][quantity]')
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

</script>
@endsection

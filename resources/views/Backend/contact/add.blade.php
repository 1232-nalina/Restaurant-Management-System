@extends('Backend.dashboard.main')
@section('title', 'Contact Details Add')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Contact Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Contact Details</a></li>
                        <li class="breadcrumb-item active">Add Contact Details</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Address<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('address')is-invalid @enderror"
                                            name="address" value="{{ old('address') }}" placeholder="Enter Address">
                                        @error('address')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Email<span class="login-danger">*</span></label>
                                        <input type="email" class="form-control @error('email')is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" id="email"
                                            placeholder="Enter Email">
                                        @error('email')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Phone One<span class="login-danger">*</span></label>
                                        <input type="tel" class="form-control @error('phone_one')is-invalid @enderror"
                                            name="phone_one" value="{{ old('phone_one') }}" id="phone_one"
                                            placeholder="Enter Phone One">
                                        @error('phone_one')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Phone Two<span class="login-danger">*</span></label>
                                        <input type="tel" class="form-control @error('phone_two')is-invalid @enderror"
                                            name="phone_two" value="{{ old('phone_two') }}" id="phone_two"
                                            placeholder="Enter Phone Two">
                                        @error('phone_two')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Logo<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('logo')is-invalid @enderror"
                                            name="logo" value="{{ old('logo') }}" placeholder="" id="image">
                                        @error('logo')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4" id="display_original_image">
                                        <img src="" style="max-width: auto; height:250px; display:none;"
                                            class="img-thumbnail img-fluid" id="img_prv" alt="">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Fab Icon<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('fab_icon')is-invalid @enderror"
                                            name="fab_icon" value="{{ old('fab_icon') }}" placeholder="" id="image1">
                                        @error('fab_icon')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4" id="display_original_image">
                                        <img src="" style="max-width: auto; height:250px; display:none;"
                                            class="img-thumbnail img-fluid" id="img_prv_1" alt="">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Banner Image<span class="login-danger">*</span></label>
                                        <input type="file"
                                            class="form-control @error('banner_image')is-invalid @enderror"
                                            name="banner_image" value="{{ old('banner_image') }}" placeholder="" id="image2">
                                        @error('banner_image')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4" id="display_original_image">
                                        <img src="" style="max-width: auto; height:250px; display:none;"
                                            class="img-thumbnail img-fluid" id="img_prv_2" alt="">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Google Map<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('google_map')is-invalid @enderror"
                                            name="google_map" value="{{ old('google_map') }}" id="google_map"
                                            placeholder="Enter Google Map">
                                        @error('google_map')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Facebook Link<span class="login-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('facebook_link')is-invalid @enderror"
                                            name="facebook_link" value="{{ old('facebook_link') }}" id="facebook_link"
                                            placeholder="Enter Facebook Link">
                                        @error('facebook_link')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Instagram Link<span class="login-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('instagram_link')is-invalid @enderror"
                                            name="instagram_link" value="{{ old('instagram_link') }}" id="instagram_link"
                                            placeholder="Enter Instagram Link">
                                        @error('instagram_link')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Twitter Link<span class="login-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('twitter_link')is-invalid @enderror"
                                            name="twitter_link" value="{{ old('twitter_link') }}" id="twitter_link"
                                            placeholder="Enter Twitter Link">
                                        @error('twitter_link')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Gmail Link<span class="login-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('gmail_link')is-invalid @enderror"
                                            name="gmail_link" value="{{ old('gmail_link') }}" id="gmail_link"
                                            placeholder="Enter Gmail Link">
                                        @error('gmail_link')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
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
        $('#image').on('change', function(ev) {
            var reader = new FileReader();

            reader.onload = function(ev) {
                $('#img_prv').attr('src', ev.target.result).css('display', 'inline')
            }
            reader.readAsDataURL(this.files[0]);
        })
        $('#image1').on('change', function(ev) {
            var reader = new FileReader();

            reader.onload = function(ev) {
                $('#img_prv_1').attr('src', ev.target.result).css('display', 'inline')
            }
            reader.readAsDataURL(this.files[0]);
        })
        $('#image2').on('change', function(ev) {
            var reader = new FileReader();

            reader.onload = function(ev) {
                $('#img_prv_2').attr('src', ev.target.result).css('display', 'inline')
            }
            reader.readAsDataURL(this.files[0]);
        })
    </script>
@endsection
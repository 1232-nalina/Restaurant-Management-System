@extends('Backend.dashboard.main')
@section('title', 'About Details Add')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add About Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('about.index') }}">About Details</a></li>
                        <li class="breadcrumb-item active">Add About Details</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('about.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-12">
                                    <div class="form-group local-forms">
                                        <label>Title <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('title')is-invalid @enderror"
                                            name="title" value="{{ old('title') }}" placeholder="About title">
                                        @error('title')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Meta Keywords<span class="login-danger">*</span></label>
                                        <textarea name="meta_keyword" class="form-control @error('meta_keyword')is-invalid @enderror" cols="30" rows="10">{{ old('meta_keyword') }}</textarea>
                                        @error('meta_keyword')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Meta Description<span class="login-danger">*</span></label>
                                        <textarea name="meta_description" class="form-control @error('meta_description')is-invalid @enderror" cols="30" rows="10">{{ old('meta_description') }}</textarea>
                                        @error('meta_description')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Description<span class="login-danger">*</span></label>
                                        <textarea name="description" class="ckeditor @error('description')is-invalid @enderror" data-editor="ClassicEditor" cols="30" rows="10">{{ old('description') }}</textarea>
                                        @error('description')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Mission<span class="login-danger">*</span></label>
                                        <textarea name="mission" class="ckeditor @error('mission')is-invalid @enderror" data-editor="ClassicEditor" cols="30" rows="10">{{ old('mission') }}</textarea>
                                        @error('mission')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Vision<span class="login-danger">*</span></label>
                                        {{-- <input type="text" class="form-control @error('vision')is-invalid @enderror"
                                            name="vision" value="{{ old('vision') }}" id="vision" placeholder="vision"> --}}
                                        <textarea name="vision" class="ckeditor @error('vision')is-invalid @enderror" data-editor="ClassicEditor" cols="30" rows="10">{{ old('vision') }}</textarea>
                                        @error('vision')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Values<span class="login-danger">*</span></label>
                                        {{-- <input type="text" class="form-control @error('values')is-invalid @enderror"
                                            name="values" value="{{ old('values') }}" id="values" placeholder="values"> --}}
                                        <textarea name="values" class="ckeditor @error('values')is-invalid @enderror" data-editor="ClassicEditor" cols="30" rows="10">{{ old('values') }}</textarea>
                                        @error('values')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Image<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('image')is-invalid @enderror"
                                            name="image" value="{{ old('image') }}" id="image">
                                        @error('image')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Banner Image<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('banner_image')is-invalid @enderror"
                                            name="banner_image" value="{{ old('banner_image') }}" id="image1">
                                        @error('banner_image')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="mb-4" id="display_original_image">
                                        <img src="" style="max-width: auto; height:250px; display:none;" class="img-thumbnail img-fluid" id="img_prv" alt="">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="mb-4" id="display_original_image">
                                        <img src="" style="max-width: auto; height:250px; display:none;" class="img-thumbnail img-fluid" id="img_prv_1" alt="">
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Status <span class="login-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="status" id="status"
                                                    class="form-control @error('status') is-invalid @enderror">
                                                <option value="active"  {{ old('status') == "active" ? 'selected' : '' }}>
                                                   Active
                                                </option>
                                                <option value="inactive"  {{ old('status') == "inactive" ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>
                                </div> --}}
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary" name='status' value="active">Publish</button>
                                    </div>
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-warning" name='status' value="inactive">Save as Draft</button>
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
    </script>
@endsection

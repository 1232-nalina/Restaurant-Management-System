@extends('Backend.dashboard.main')
@section('title', 'About Details Edit')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit About Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('about.index') }}">About Details</a></li>
                        <li class="breadcrumb-item active">Edit About Details</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('about.update', $About->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-12">
                                    <div class="form-group local-forms">
                                        <label>Title <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('title')is-invalid @enderror"
                                            name="title" value="{{ $About->title }}" placeholder="About title">
                                        @error('title')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Meta Keywords<span class="login-danger">*</span></label>
                                        {{-- <input type="text" class="form-control @error('meta_keyword')is-invalid @enderror"
                                            name="meta_keyword" value="{{ $About->meta_keyword }}" id="meta_keyword" placeholder="meta keyword"> --}}
                                        <textarea name="meta_keyword" class="form-control @error('meta_keyword')is-invalid @enderror" cols="30" rows="10">{{ $About->meta_keyword }}</textarea>
                                        @error('meta_keyword')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Meta Description<span class="login-danger">*</span></label>
                                        {{-- <input type="text" class="form-control @error('meta_description')is-invalid @enderror"
                                        name="meta_description" value="{{ $About->meta_description }}" id="meta_description" placeholder="meta description"> --}}
                                        <textarea name="meta_description" class="form-control @error('meta_description')is-invalid @enderror" cols="30" rows="10">{{ $About->meta_description }}</textarea>
                                        @error('meta_description')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Description<span class="login-danger">*</span></label>
                                        {{-- <input type="text" class="form-control @error('description')is-invalid @enderror"
                                        name="description" value="{{ $About->description }}" id="description" placeholder="description"> --}}
                                        <textarea name="description" class="ckeditor @error('description')is-invalid @enderror" cols="30" rows="10">{!! htmlspecialchars_decode($About->description) !!}</textarea>
                                        @error('description')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Mission<span class="login-danger">*</span></label>
                                        {{-- <input type="text" class="form-control @error('mission')is-invalid @enderror"
                                            name="mission" value="{!! htmlspecialchars_decode($About->mission) !!}" id="mission" placeholder="mission"> --}}
                                        <textarea name="mission" class="ckeditor @error('mission')is-invalid @enderror" cols="30" rows="10">{!! htmlspecialchars_decode($About->mission) !!}</textarea>
                                        @error('mission')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Vision<span class="login-danger">*</span></label>
                                        {{-- <input type="text" class="form-control @error('vision')is-invalid @enderror"
                                            name="vision" value="{!! htmlspecialchars_decode($About->vision) !!}" id="vision" placeholder="vision"> --}}
                                        <textarea name="vision" class="ckeditor @error('vision')is-invalid @enderror" cols="30" rows="10">{!! htmlspecialchars_decode($About->vision) !!}</textarea>
                                        @error('vision')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Values<span class="login-danger">*</span></label>
                                        {{-- <input type="text" class="form-control @error('values')is-invalid @enderror"
                                            name="values" value="{!! htmlspecialchars_decode($About->values) !!}" id="values" placeholder="values"> --}}
                                        <textarea name="values" class="ckeditor @error('values')is-invalid @enderror" cols="30" rows="10">{!! htmlspecialchars_decode($About->values) !!}</textarea>
                                        @error('values')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Image<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('image')is-invalid @enderror"
                                            name="image" value="{{ $About->image }}" id="image">
                                        @error('image')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Banner Image<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('banner_image')is-invalid @enderror"
                                            name="banner_image" value="{{ $About->banner_image }}" id="image1">
                                        @error('banner_image')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="mb-4" id="display_original_image">
                                        @if ($About->image)
                                        <img src="{{asset('upload/About/'.$About->image)}}" style="max-width: auto; height:250px;" class="img-thumbnail img-fluid" id="img_prv" alt="">
                                        @endif
                                        {{-- <img src="" style="max-width: auto; height:250px; display:none;" class="img-thumbnail img-fluid" id="img_prv" alt=""> --}}
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="mb-4" id="display_original_image">
                                        @if ($About->banner_image)
                                        <img src="{{asset('upload/About/'.$About->banner_image)}}" style="max-width: auto; height:250px;" class="img-thumbnail img-fluid" id="img_prv_1" alt="">
                                        @endif
                                        {{-- <img src="" style="max-width: auto; height:250px; display:none;" class="img-thumbnail img-fluid" id="img_prv1" alt=""> --}}
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Status <span class="login-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="status" id="status"
                                                    class="form-control @error('status') is-invalid @enderror">
                                                <option value="active"  {{ $About->status == "active" ? 'selected' : '' }}>
                                                   Active
                                                </option>
                                                <option value="inactive"  {{ $About->status == "inactive" ? 'selected' : '' }}>
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

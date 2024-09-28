@extends('Backend.dashboard.main')
@section('title', 'Team Member Add')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Team Member</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('team.index') }}">Team Member</a></li>
                        <li class="breadcrumb-item active">Add Team Member</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('team.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Team Member Name<span class="login-danger"> *</span></label>
                                        <input type="text" class="form-control @error('name')is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" placeholder="Enter Name">
                                        @error('name')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Position<span class="login-danger"> *</span></label>
                                        <input type="text" class="form-control @error('position')is-invalid @enderror"
                                            name="position" value="{{ old('position') }}" id="position"
                                            placeholder="Enter Position">
                                        @error('position')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Phone<span class="login-danger"> *</span></label>
                                        <input type="text" class="form-control @error('phone')is-invalid @enderror"
                                            name="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                        @error('phone')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Email<span class="login-danger"> *</span></label>
                                        <input type="email" class="form-control @error('email')is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" id="email"
                                            placeholder="Enter Email">
                                        @error('email')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Description</label>
                                        <textarea class="form-control ckeditor @error('description')is-invalid @enderror"
                                            name="description" value="{{ old('description') }}" placeholder="Enter Description"></textarea>
                                        @error('description')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Facebook Link<span class="login-danger"> *</span></label>
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
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Instagram Link<span class="login-danger"> *</span></label>
                                        <input type="text" class="form-control @error('insta_link')is-invalid @enderror"
                                            name="insta_link" value="{{ old('insta_link') }}" id="insta_link"
                                            placeholder="Enter Instagram Link">
                                        @error('insta_link')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Linkedin Link<span class="login-danger"> *</span></label>
                                        <input type="text"
                                            class="form-control @error('linkedin_link')is-invalid @enderror"
                                            name="linkedin_link" value="{{ old('linkedin_link') }}" id="linkedin_link"
                                            placeholder="Enter Linkedin Link">
                                        @error('linkedin_link')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group local-forms" id='editor'>
                                        <label>Twitter Link<span class="login-danger"> *</span></label>
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
    </script>
@endsection

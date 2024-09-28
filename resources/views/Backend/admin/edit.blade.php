@extends('Backend.dashboard.main')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit user</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">user</a></li>
                        <li class="breadcrumb-item active">Edit user</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.update', $admin->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Edit {{ $admin->name }}</span></h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>user Name <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('name')is-invalid @enderror"
                                            name="name" placeholder="enter user name" value="{{ $admin->name }}">
                                        @error('name')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-sm-12 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>user Email <span class="login-danger">*</span></label>
                                        <input type="email" class="form-control @error('email')is-invalid @enderror"
                                            placeholder="enter user email" name="email" value="{{ $admin->email }}">
                                        @error('email')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>user username <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('username')is-invalid @enderror"
                                            placeholder="enter user username" name="username"
                                            value="{{ $admin->username }}">
                                        @error('username')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Password <span class="login-danger">*</span></label>
                                        <input type="password" class="form-control @error('password')is-invalid @enderror"
                                            name="password" placeholder="create password" value="">
                                        @error('password')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Confirm Password <span class="login-danger">*</span></label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation')is-invalid @enderror"
                                            placeholder="re-type password to confirm" name="password_confirmation"
                                            value="">
                                        @error('password_confirmation')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Roles <span class="login-danger">*</span></label>
                                        <select class="form-control select" aria-placeholder="select" name="roles[]"
                                            multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ $admin->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <p class="text-info"> <i class="fas fa-solid fa-bell"></i> Drag in your location and click to mark your location.</p>
                                {{-- <div id="map" style="height: 400px;"></div> --}}

                                <input type="hidden" id="latitude" value="{{$admin->latitude}}" name="latitude">
                                <input type="hidden" id="longitude" value="{{$admin->longitude}}" name="longitude">


                                <div class="col-12">
                                    <div class="student-submit mt-3">
                                        <button type="submit" class="btn btn-primary">Update user</button>
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
    @parent <!-- Add this line if you have other scripts included -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSarrGYiqbmpg9XSIT9FnsQdgtUbXdTJ4&callback=initMap" async defer></script>
    <script>
        var marker; // Variable to store the marker instance

        // Function to initialize the map
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 35.6895, lng: 139.6917 },
                zoom: 6
            });

            // Retrieve the existing latitude and longitude values
            var latitude = parseFloat(document.getElementById('latitude').value);
            var longitude = parseFloat(document.getElementById('longitude').value);

            // Check if latitude and longitude are valid numbers
            if (!isNaN(latitude) && !isNaN(longitude)) {
                // Create a LatLng object with the existing coordinates
                var latLng = new google.maps.LatLng(latitude, longitude);

                // Add a marker for the existing location
                marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: 'Selected Location'
                });

                // Center the map on the existing location
                map.setCenter(latLng);
            }

            // Add a click event listener to the map
            map.addListener('click', function(event) {
                // Check if a marker already exists
                if (marker) {
                    // Remove the existing marker from the map
                    marker.setMap(null);
                }

                latitude = event.latLng.lat();
                longitude = event.latLng.lng();

                // Update the hidden input fields with the selected coordinates
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;

                // Add a marker to indicate the selected location
                marker = new google.maps.Marker({
                    position: { lat: latitude, lng: longitude },
                    map: map,
                    title: 'Selected Location'
                });
            });
        }
    </script>
@endsection

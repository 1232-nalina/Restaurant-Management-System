@extends('Backend.dashboard.main')
@section('title', 'Change Password')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Change Password</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('changepassword')}}">
                            @csrf
                           
                            <div class="row">
                                <div class="col-12">
                                      <span>Hello,</span> 
                                    <b>{{Auth::user()->username}}</b>

                                    <h5 class="form-title"><span>please note the following whole changing your password,</span></h5>
                                    <div class="alert alert-info mb-5">
                                        <ul>
                                            <li>Password must be at least 8 charactes long</li>
                                            <li>Old password & new password should be different</li>
                                            <li>Retype the password matching with new password</li>
                                            <li>Update your current location</li>
                                           
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>Current Password <span class="login-danger">*</span></label>
                                        <input type="password" class="form-control @error('current_password')is-invalid @enderror"
                                            name="current_password" placeholder="" value="">
                                        @error('current_password')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-sm-12 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>New Password <span class="login-danger">*</span></label>
                                        <input type="password" class="form-control @error('new_password')is-invalid @enderror"
                                            name="new_password" placeholder="" value="">
                                        @error('new_password')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-sm-12 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>Retype New Password <span class="login-danger">*</span></label>
                                        <input type="password" class="form-control @error('new_password_confirmation')is-invalid @enderror"
                                            name="new_password_confirmation" placeholder="" value="">
                                        @error('new_password_confirmation')
                                            <p style="color: indianred;margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>

                                <p class="text-info"> <i class="fas fa-solid fa-bell"></i> Drag in your location and click to mark your location.</p>
                                <div id="map" style="height: 400px;"></div>
                               
                                <input type="hidden" id="latitude" value="{{Auth::user()->latitude}}" name="latitude">
                                <input type="hidden" id="longitude" value="{{Auth::user()->longitude}}" name="longitude">
                                <div class="col-12">
                                    <div class="student-submit mt-3">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
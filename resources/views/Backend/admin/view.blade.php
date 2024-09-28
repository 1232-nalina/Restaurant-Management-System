@extends('Backend.dashboard.main')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">users</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">users</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">All users in System based on location</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('admin.create') }}" title="add new Admin" class="btn btn-primary mb-2"><i
                                            class="fas fa-plus"></i>&nbsp;add new User</a>
                                </div>
                                  {{-- <div id="map" style="height: 400px;"></div> --}}
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </th>
                                    <th>S.N</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Coordinates</th>
                                    <th>Roles</th>


                                    {{--                                <th>No of Students</th> --}}
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($admin->isNotEmpty())
                                    @foreach ($admin as $key => $value)
                                        <tr @if ($value->password_changed==0)
                                            style="background: #fad7d9;border-bottom:1px solid #bfbfbf;"
                                        @endif >
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            @if ($value->latitude && $value->longitude)
                                            <td>Lat:{{ $value->latitude }}, Lon:{{$value->longitude}}</td>
                                            @else
                                            <td>-</td>
                                            @endif
                                            <td>
                                                @foreach ($value->roles as $role)
                                                    <span class="badge badge-success mr-1">
                                                        {{ $role->name }}
                                                    </span>
                                                @endforeach
                                            </td>


                                            {{--                                        <td>180</td> --}}
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ route('admin.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.destroy', $value->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm bg-danger-light">
                                                            <i class="feather-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

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
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 35.6895, lng: 139.6917},
                zoom: 2
            });

            // Fetch the admin data from the backend
            fetchAdminData();

            function fetchAdminData() {
                fetch('{{ route('mapadmin.index') }}')
                    .then(response => response.json())
                    .then(data => {
                        var users = data;
                        console.log(users);
                        var bounds = new google.maps.LatLngBounds();

                        users.forEach(function(user) {
                            var lat = parseFloat(user.latitude);
                            var lng = parseFloat(user.longitude);

                            var marker = new google.maps.Marker({
                                position: {lat: lat, lng: lng},
                                map: map,
                                title: user.name
                            });

                            bounds.extend(marker.getPosition());

                            var contentString = '<strong>Name:</strong> ' + user.name + '<br>' +
                                            '<strong>Email:</strong> ' + user.email;

                            // Create an InfoWindow for each marker
                            var infoWindow = new google.maps.InfoWindow({
                                content: contentString
                            });

                            //show InfoWindow on default
                            infoWindow.open(map, marker);

                             //Show the InfoWindow when marker is clicked
                            marker.addListener('click', function() {
                                infoWindow.open(map, marker);
                            });
                        });

                        map.fitBounds(bounds);
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
@endsection

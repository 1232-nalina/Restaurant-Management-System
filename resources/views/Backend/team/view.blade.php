@extends('Backend.dashboard.main')
@section('title', 'Team Member View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Team Member</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Team Member</li>
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
                                    <h3 class="page-title">Available Team Member</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('team.create') }}" title="add Team Member"
                                        class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;add new Team Member</a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>image</th>
                                    <th>Social Media</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($teamMember->isNotEmpty())
                                    @foreach ($teamMember as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->position }}</td>
                                            <td>
                                                @if ($value->image == 'noimg.jpg')
                                                    No Image upload
                                                @else
                                                    <img src="{{ asset('upload/Team/' . $value->image) }}"
                                                        width="100px" height="80px" style="object-fit: cover"
                                                        alt="">
                                                @endif

                                            </td>
                                            {{\Str::limit($value->google_map,20,$ends="...")}}
                                        <td>
                                            <b>Facbook Link&nbsp;:&nbsp;</b><a href="{{$value->facebook_link == null ? 'javascript:void(0)' : $value->facebook_link}}" target="_blank">{{ $value->facebook_link == null ? 'Not available' : $value->facebook_link }}</a><br><br>
                                            <b>Twitter Link&nbsp;:&nbsp;</b><a href="{{$value->twitter_link}}" target="_blank">{{ $value->twitter_link == null ? 'Not available' : $value->twitter_link }}</a><br><br>
                                            <b>Instagram Link&nbsp;:&nbsp;</b><a href="{{$value->insta_link}}" target="_blank">{{ $value->insta_link == null ? 'Not available' : $value->insta_link }}</a><br><br>
                                            <b>Linkedin Link&nbsp;:&nbsp;</b><a href="{{$value->linkedin_link}}" target="_blank">{{ $value->linkedin_link == null ? 'Not available' : $value->linkedin_link }}</a><br>
                                        </td>

                                            @if ($value->status == 'active')
                                                <td class="text-success">{{ $value->status }}</td>
                                            @else
                                                <td class="text-danger">{{ $value->status }}</td>
                                            @endif
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ route('team.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('team.destroy', $value->id) }}"
                                                        method="POST">
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

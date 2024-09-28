@extends('Backend.dashboard.main')
@section('title', 'Contact Details View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Contact Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Contact Details</li>
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
                                    <h3 class="page-title">Available Contact Details</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('contact.create') }}" title="add Contact Details"
                                        class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;add new Contact Details</a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone One</th>
                                    <th>Phone Two</th>
                                    <th>Logo</th>
                                    <th>Fab Icon</th>
                                    <th>Banner Image</th>
                                    <th>Social Links</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($ContactDetails->isNotEmpty())
                                    @foreach ($ContactDetails as $key => $value)
                                        <tr>

                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->address }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->phone_one }}</td>
                                            <td>{{ $value->phone_two }}</td>
                                            <td>
                                                @if ($value->logo == 'noimg.jpg')
                                                    No Image upload
                                                @else
                                                    <img src="{{ asset('upload/Contact/' . $value->logo) }}" width="100px"
                                                        height="80px" style="object-fit: cover" alt="">
                                                @endif

                                            </td>
                                            <td>
                                                @if ($value->fab_icon == 'noimg.jpg')
                                                    No Image upload
                                                @else
                                                    <img src="{{ asset('upload/Contact/' . $value->fab_icon) }}"
                                                        width="100px" height="80px" style="object-fit: cover"
                                                        alt="">
                                                @endif

                                            </td>
                                            <td>
                                                @if ($value->banner_image == 'noimg.jpg')
                                                    No Image upload
                                                @else
                                                    <img src="{{ asset('upload/Contact/' . $value->banner_image) }}"
                                                        width="100px" height="80px" style="object-fit: cover"
                                                        alt="">
                                                @endif

                                            </td>
                                            <td>
                                                <b>Facbook Link&nbsp;:&nbsp;</b><a
                                                    href="{{ $value->facebook_link == null ? 'javascript:void(0)' : $value->facebook_link }}"
                                                    target="_blank">{{ $value->facebook_link == null ? 'Not available' : $value->facebook_link }}</a><br><br>
                                                <b>Instagram Link&nbsp;:&nbsp;</b><a
                                                    href="{{ $value->instagram_link == null ? 'javascript:void(0)' : $value->instagram_link }}"
                                                    target="_blank">{{ $value->instagram_link == null ? 'Not available' : $value->instagram_link }}</a><br><br>
                                                <b>Twitter Link&nbsp;:&nbsp;</b><a href="{{ $value->twitter }}"
                                                    target="_blank">{{ $value->twitter_link == null ? 'Not available' : $value->twitter_link }}</a><br><br>
                                                <b>Google Link&nbsp;:&nbsp;</b><a href="{{ $value->gmail_link }}"
                                                    target="_blank">{{ $value->gmail_link == null ? 'Not available' : $value->gmail_link }}</a><br>
                                            </td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ route('contact.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('contact.destroy', $value->id) }}"
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

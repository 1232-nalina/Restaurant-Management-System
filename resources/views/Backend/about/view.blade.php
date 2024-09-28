@extends('Backend.dashboard.main')
@section('title', 'About Details View')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">About Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">About Details</li>
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
                                    <h3 class="page-title">Available About Details</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    <a href="{{ route('about.create') }}" title="add About Details" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>&nbsp;add new About Details</a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Banner Image</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($About->isNotEmpty())
                                    @foreach ($About as $key => $value)
                                        <tr>

                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $value->title }}</td>
                                            <td> {{ \Str::limit(strip_tags(html_entity_decode($value->description)),20,$ends="...") }} </td>
                                            <td>
                                                @if ($value->image == 'noimg.jpg')
                                                    No Image upload
                                                @else
                                                    <img src="{{ asset('upload/About/' . $value->image) }}" width="100px" height="80px" style="object-fit: cover" alt="">
                                                @endif

                                            </td>
                                            <td>
                                                @if ($value->banner_image == 'noimg.jpg')
                                                    No Image upload
                                                @else
                                                    <img src="{{ asset('upload/About/' . $value->banner_image) }}" width="100px" height="80px" style="object-fit: cover" alt="">
                                                @endif

                                            </td>
                                            @if ($value->status == 'active')
                                                <td class="text-success">{{ $value->status }}</td>
                                            @else
                                                <td class="text-danger">{{ $value->status }}</td>
                                            @endif
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ route('about.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('about.destroy', $value->id) }}"
                                                        class="btn btn-sm bg-danger-light">
                                                        <i class="feather-trash"></i>
                                                    </a> --}}
                                                    <form action="{{ route('about.destroy', $value->id) }}"
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

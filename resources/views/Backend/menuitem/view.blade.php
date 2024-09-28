@extends('Backend.dashboard.main')
@section('title', 'Menu Item View')
@section('content')
<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Menu Item</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Menu Item</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table" style="background:aliceblue">
                <div class="card-body" style="padding: 0">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Menu Items at {{config('app.name')}}</h3>

                            </div>

                            <div class="col-auto text-end float-end ms-auto download-grp">

                                <a href="{{ route('menuitem.create') }}" title="add new menuitem" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;add new menu item</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if($menucategory)
                        @foreach ($menucategory as $key=> $value)
                        <div class="col-md-4 col-sm-6">
                            <div class="ribbon-wrapper card">
                                <div class="card-body" style="padding: 10px">
                                    <div class="ribbon ribbon-primary"> {{$value->name}}</div>
                                    <div class="table-responsive">
                                        <table class="table star-student table-hover table-center table-borderless table-striped">
                                            <thead class="thead-light">

                                                <tr class="menu-tr">

                                                    <th>Item Name</th>
                                                    <th class="text-center">Price</th>
                                                    {{-- <th class="text-center">Image</th> --}}
                                                    <th class="text-center">Action</th>

                                                </tr>


                                            </thead>
                                            <tbody>
                                                @foreach ($value->MenuItem as $item)
                                                <tr class="menu-tr">

                                                    <td class="text-nowrap">
                                                        {{$item->name }}
                                                    </td>
                                                    <td class="text-center"> {{$item->price }}</td>
                                                    {{-- <td class="text-center">
                                                        <img src="{{ public_path('/uploads/Menu/' . $item->image) }}" alt="Image" width="50%" >
                                                        </td> --}}

                                                    <td class="d-inline-flex">
                                                        <div class="">
                                                            <a href="{{ route('menuitem.edit', $item->id) }}" class="btn btn-sm btn-primary ">
                                                                <i class="feather-edit mr-2"></i>
                                                            </a>
                                                            <form action="{{ route('menuitem.destroy', $item->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger ml-2">
                                                                    <i class="feather-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif



                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- card view --}}



</div>
@endsection

<style>
    .menu-tr td,
    th {
        padding: 0 !important;
    }
</style>

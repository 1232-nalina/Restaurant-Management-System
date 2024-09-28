<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.dashboard.header')
    @yield('styles')
</head>


<body>


    <div class="main-wrapper">

        <div class="page-wrapper" style="margin-left: 0; padding-top:20px!important">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col text-center">
                        <img src="{{asset('Backend/coffee-cup.png')}}" width="80" alt="">
                        <h2 class="text-center mb-3" style="font-weight:600">Menu Items at {{config('app.name')}}</h2>
                        <i>Happiness begins with a good food.</i>
                        <hr>
                    </div>
                    <div class="card card-table" style="background: #f7f7fa">
                        <div class="card-body" style="">
    
                            <div class="page-header">
                                <div class="row align-items-center">
                                    
    
                                    
                                </div>
                            </div>
                            <div class="row">
                                @if($menucategory)
                                @foreach ($menucategory as $key=> $value)
                                <div class="col-md-4 col-xl-3 col-sm-6">
                                    <div class="ribbon-wrapper card">
                                    <div class="card-body" style="padding: 10px">
                                    <div class="ribbon ribbon-success">  {{$value->name}}</div>
                                    <div class="table-responsive">
                                        <table class="table star-student table-hover table-center table-borderless table-striped">
                                        <thead class="thead-light">
                                       
                                            <tr class="menu-tr">
                                      
                                                <th>Item Name</th>
                                                <th class="text-center">Price</th>
                                                {{-- <th class="text-center">Action</th> --}}
                                              
                                                </tr>
                                      
                                        
                                        </thead>
                                        <tbody>
                                        @foreach ($value->menuItems as $item)
                                        <tr class="menu-tr">
                                        
                                        <td class="text-nowrap">
                                       {{$item->name }}
                                        </td>
                                        <td class="text-center"> {{config('app.price')}} {{$item->price }}</td>
                                        {{-- <td class="text-center"><a href="" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a><a href="" class="btn btn-danger btn-sm mx-1"><i class="fa fa-trash"></i></a></td>
                                         --}}
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


            <footer>
                <p> @lang('public.copyright') ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> RMS || @lang('public.powered-by') <a href="https://sandesthapa.com.np/"
                        target="_blank">@lang('public.sandesh-thapa')</a>.
                </p>
            </footer>
        </div>
    </div>

    @include('Backend.dashboard.footer-scripts')



</body>
<style>
    .menu-tr td,th{
        padding: 0!important;
    }
</style>
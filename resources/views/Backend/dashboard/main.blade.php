<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.dashboard.header')
    @yield('styles')
</head>


<body>


    <div class="main-wrapper">

        @include('Backend.dashboard.top-nav')


        @include('Backend.dashboard.sidebar')
        <div class="page-wrapper">
            @yield('content')
            <footer>
                <p> @lang('public.copyright') ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> RMS || @lang('public.powered-by') <a href="#"
                        target="_blank">@lang('RMS')</a>.
                </p>
            </footer>
        </div>
    </div>

    @include('Backend.dashboard.footer-scripts')


    @yield('scripts')
    @include('Backend.dashboard.toaster-message');


</body>

</html>

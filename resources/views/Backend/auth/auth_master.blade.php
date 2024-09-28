<!DOCTYPE html>
<html lang="en">
<head>
@include('Backend.dashboard.header')
</head>
<body>

@yield('auth-content')


@include('Backend.dashboard.footer-scripts')
@include('Backend.dashboard.toaster-message')
</body>
</html>

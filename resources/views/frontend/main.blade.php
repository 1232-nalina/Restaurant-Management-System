<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap 4.3.1 CSS -->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/bootstrap.min.css')}}">
    <!--    Fontawesome 5 CSS-->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/fontawesome.css')}}">
    <!--    Fontawesome 5 all CSS-->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/all.min.css')}}">
    <!--    Owl-carousel 2.3.4 CSS-->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/owl.carousel.min.css')}}">
    <!--    lightbox CSS-->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/lightbox.min.css')}}">
    <!--    aos CSS-->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/aos.css')}}">
    <!--    Style CSS-->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/style.css')}}" type="text/css">
    <title>Restaurant</title>
</head>

<body>
    <!--Start Mobile menu-->
    <div class="slide-menu">
        <span class="menu-close"><i class="fal fa-times"></i></span>
        <div class="slide-menu-wrp">
            <ul class="mb_menu">
                <li><a href="index.html">Home</a></li>
                <li><a href="home-two.html">Home-Two</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="blog-details.html">Blog-Details</a></li>
                <li><a href="book-table.html">Book-Table</a></li>
                <li><a href="chef.html">Chef</a></li>
                <li><a href="error.html">Error-404</a></li>
                <li><a href="menu-1.html">Menu-1</a></li>
                <li><a href="menu-2.html">Menu-2</a></li>
                <li><a href="menu-single.html">Single-Menu</a></li>
                <li><a href="single-blog.html">Single-Blog</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>
    </div>
    <!--End Mobile menu-->

    <!--+++++++ Start header ++++++-->
    <header>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="logo">
                        <a href="{{route('index')}}"><img src="{{asset('Frontend/assets/img/logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-6 col-md-9 col-lg-10 text-right">
                    <nav>
                        <ul class="menu">
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li><a href="{{route('frontend.about')}}">About</a></li>
                            <li><a href="{{route('frontend.menu')}}">Menu</a></li>
                            <li><a href="{{route('frontend.team')}}">Team</a></li>
                            <!-- <li class="has-children"><a href="#">Pages</a>
                                <div class="sub_menu">
                                    <ul>
                                        <li><a href="home-two.html">Home-Two</a></li>
                                        <li><a href="blog-details.html">Blog-Details</a></li>
                                        <li><a href="book-table.html">Book-Table</a></li>
                                        <li><a href="chef.html">Chef</a></li>
                                        <li><a href="error.html">Error-404</a></li>
                                        <li><a href="menu-1.html">Menu-1</a></li>
                                        <li><a href="menu-2.html">Menu-2</a></li>
                                        <li><a href="menu-single.html">Single-Menu</a></li>
                                        <li><a href="single-blog.html">Single-Blog</a></li>
                                    </ul>
                                </div>
                            </li> -->
                            <!-- <li><a href="#">Shop</a></li> -->
                            <!-- <li><a href="contact.html">Contact</a></li> -->
                        </ul>
                    </nav>
                    <!-- <div class="od cmn_btn">
                        <a href="#">Book a table</a>
                    </div> -->
                    <div class="mobile_menu">
                        <i class="fal fa-align-left"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--+++++++ End header ++++++-->
@yield('content')
    <!--+++++++ Start footer ++++++-->
    <footer>
        <div class="footer_top pad">
            <div class="ft_left">
                <img src="{{asset('Frontend/assets/img/footer-circle-right.png')}}" alt="">
            </div>
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-4">
                        <div class="footer_widget">
                            <img src="{{asset('Frontend/assets/img/logo.png')}}" alt="">
                            <p>Revolutionizing restaurant management with seamless integration and unparalleled efficiency.</p>
                            <ul class="social">
                                <li data-aos="fade-up" data-aos-duration="500"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li data-aos="fade-up" data-aos-duration="1000"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li data-aos="fade-up" data-aos-duration="1500"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li data-aos="fade-up" data-aos-duration="2000"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="footer_widget">
                            <h5>Quick Links</h5>
                            <ul class="foot_menu">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Our Menu</a></li>
                                <li><a href="#">Food List</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="footer_widget">
                            <h5>Support Links</h5>
                            <ul class="foot_menu">
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Book a Table</a></li>
                                <li><a href="#">Contact Manager</a></li>
                                <li><a href="#">Call Now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ft_right">
                <img src="{{asset('Frontend/assets/img/footer-circle-left.png')}}" alt="">
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="copy_txt">
                            <p><span>RMS</span> © 2023. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--+++++++ End footer ++++++-->


    <!--    Start scroll top button-->
    <div class="scroll_top">
        <img src="{{asset('Frontend/assets/img/icon-scroll-top.png')}}" alt="">
    </div>
    <!--    End scroll top button-->


    <!-- jQuery 3.3.1 first, then Popper js, then Bootstrap 4.3.1 JS -->
    <script src="{{asset('Frontend/assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('Frontend/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('Frontend/assets/js/bootstrap.min.js')}}"></script>
    <!--    Owl-carousel2.3.4 JS-->
    <script src="{{asset('Frontend/assets/js/owl.carousel.min.js')}}"></script>
    <!--    lightbox-popup JS-->
    <script src="{{asset('Frontend/assets/js/lightbox.min.js')}}"></script>
    <!--    isotope Js-->
    <script src="{{asset('Frontend/assets/js/isotope.pkgd.min.js')}}"></script>
    <!--    aos Js-->
    <script src="{{asset('Frontend/assets/js/aos.js')}}"></script>
    <!--    Custom JS-->
    <script src="{{asset('Frontend/assets/js/custom.js')}}"></script>
    <script>
        @if(Session::has('success'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.success("{{ session('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.error("{{ session('error') }}");
        @endif

    </script>
</body>

</html>

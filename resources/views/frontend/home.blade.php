@extends('frontend.main')
@section('content')

    <!--+++++++ Start hero_sec ++++++-->
    <section class="hero_sec">
        <div class="container">
            @if (session('error'))
                {{-- <div class="alert alert-danger">{{ session('error') }}</div> --}}
                <script>
                    alert("{{ session('error') }}");
                </script>
            @endif
            <div class="hero_content">
                <div class="row justify-content-between align-items-center mt-50">
                    <div class="col-md-6 col-lg-5">
                        <div class="hero_food_item" data-aos="zoom-in-down" data-aos-duration="1000">
                            <img src="{{ asset('Frontend/assets/img/hero-content.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5">
                        <div class="hero_inner" data-aos="zoom-in-down" data-aos-duration="1000">
                            <h1>Savor the Moment, Taste the Perfection</h1>
                            <p>Indulge in unforgettable flavors, where every bite is a moment to treasure.</p>
                            <!-- <div class="cmn_btn">
                                                                                                                                            <a href="#">Discover More</a>
                                                                                                                                        </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--+++++++ End hero_sec ++++++-->

    <!--+++++++ Start special_menu_sec ++++++-->
    <section class="special_menu_sec pad">
        <div class="shef_img">
            <img src="{{ asset('Frontend/assets/img/special-menu-right.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="title">
                        <h1><span>Special</span> Menu</h1>
                        <p>From Our Kitchen to Your Table, With Love.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="menu_headding">
                        <ul class="menu_list">
                            <!-- <li class="active" data-filter="*">All</li>-->
                            @foreach ($menus_categories as $data)
                                <li data-filter=".all">{{ $data->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row grid">
                @foreach ($menus as $menu)
                    <div class="col-md-6 grid_item all">
                        <div class="single_item">
                            <div class="item_img">
                                <img src="{{ asset('/upload/Menu/' . $menu->image) }}" alt="">
                            </div>
                            <div class="item_details">
                                <h5>{{ $menu->name }}</h5>
                                <span>Rs.{{ $menu->price }}</span>
                                <p> </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <div class="cmn_btn mb0">
                        <a href="{{ route('frontend.cart') }}">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--+++++++ End special_menu_sec ++++++-->

    <!--+++++++ Start gallery_sec ++++++-->
    <section class="gallery_sec pad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="title">
                        <h1><span>Restaurants</span> Gallery</h1>
                        <p>---</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="single_gallery_item">
                        <img src="{{ asset('Frontend/assets/img/gallery-1.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_gallery_item">
                        <img src="{{ asset('Frontend/assets/img/gallery-2.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_gallery_item">
                        <img src="{{ asset('Frontend/assets/img/gallery-3.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_gallery_item">
                        <img src="{{ asset('Frontend/assets/img/gallery-4.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_gallery_item">
                        <img src="{{ asset('Frontend/assets/img/gallery-5.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_gallery_item">
                        <img src="{{ asset('Frontend/assets/img/gallery-6.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_gallery_item">
                        <img src="{{ asset('Frontend/assets/img/gallery-7.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_gallery_item">
                        <img src="{{ asset('Frontend/assets/img/gallery-8.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="cmn_btn">
                        <!--<a href="/public/menus">Load More</a>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--+++++++ End gallery_sec ++++++-->

    <!--+++++++ Start book_table_sec ++++++-->
    <section class="book_table_sec pad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="booking_form">
                        <h1>Book A Table</h1>
                        <form action="{{ route('book') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="name" placeholder="Name" required>
                                    <input type="tel" name="mobile" placeholder="Mobile" required>
                                    <input type="date" name="date" placeholder="Date" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" placeholder="E-mail">
                                    <input type="time" name="time" placeholder="Time" required>
                                    <input type="number" name="person" placeholder="No of Person" required>

                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit">Book Table</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--+++++++ End book_table_sec ++++++-->

    <!--+++++++ Start feature_sec ++++++-->
    <section class="feature_sec pad">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="single_feature">
                        <div class="feature_icon">
                            <img src="{{ asset('Frontend/assets/img/icon-1.png') }}" alt="">
                        </div>
                        <h4>Serving high quality food</h4>
                        <p></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single_feature">
                        <div class="feature_icon">
                            <img src="{{ asset('Frontend/assets/img/icon-2.png') }}" alt="">
                        </div>
                        <h4>Experience Chef</h4>
                        <p></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single_feature">
                        <div class="feature_icon">
                            <img src="{{ asset('Frontend/assets/img/icon-3.png') }}" alt="">
                        </div>
                        <h4>Fast Delivery</h4>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--+++++++ End feature_sec ++++++-->

    <!--+++++++ Start about_sec ++++++-->
    <section class="about_sec pad">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-5">
                    <div class="about_left">
                        <div class="left_img">
                            <img src="{{ asset('Frontend/assets/img/about-1.jpg') }}" alt="">
                            <img class="ltm" src="{{ asset('Frontend/assets/img/about-2.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about_right">
                        <h1>About <span>Our Restaurant</span></h1>
                        <p></p>
                        <div class="cmn_btn">
                            <a href="{{ route('frontend.about') }}">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--+++++++ End about_sec ++++++-->

    <!--+++++++ Start team_members_sec ++++++-->
    <section class="team_members_sec pad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="title">
                        <h1><span>Our</span> team</h1>
                        <p>----------</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($Team)
                    @foreach ($Team as $key => $value)
                        <div class="col-md-6 col-lg-3">
                            <div class="member mb">
                                <div class="chef">
                                    <img src="{{ asset('upload/Team/' . $value->image) }}" alt="">
                                </div>
                                <h5>{{ $value->name }}</h5>
                                <span>{{ $value->position }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        </div>
    </section>
    <!--+++++++ End team_members_sec ++++++-->

@endsection

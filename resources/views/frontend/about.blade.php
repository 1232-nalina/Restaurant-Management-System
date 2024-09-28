@extends('Frontend.main')
@section('content')

    <!--+++++++ Start hero_sec ++++++-->
    <section class="hero_sec">
    <div class="container">
        <div class="hero_content">
            <div class="row justify-content-between align-items-center mt-50">
                <div class="col-md-6 col-lg-5">
                    <div class="hero_food_item" data-aos="zoom-in-down" data-aos-duration="1000">
                        <img src="{{asset('Frontend/assets/img/aboutburger.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="hero_inner" data-aos="zoom-in-down" data-aos-duration="1000">
                        <h1>Where passion meets flavor, and technology drives excellence.</h1>
                        <p>Highlighting the blend of culinary expertise and modern technology that defines our system.</p>
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

    <!--+++++++ Start feature_sec ++++++-->
    <section class="feature_sec_two pad_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="single_feature">
                        <div class="feature_icon">
                            <img src="{{asset('Frontend/assets/img/icon-1.png')}}" alt="">
                        </div>
                        <h4>Serving high quality food</h4>
                        <p>At RMS, we are committed to serving high-quality food by combining culinary passion with innovative technology. Our food management system ensures that every dish meets the highest standards of taste and consistency. By streamlining kitchen operations, optimizing ingredient use, and maintaining rigorous quality control, we help restaurants deliver exceptional meals that delight customers and reflect the care and precision behind their preparation. Because we believe that every great meal starts with great management.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single_feature">
                        <div class="feature_icon">
                            <img src="{{asset('Frontend/assets/img/icon-2.png')}}" alt="">
                        </div>
                        <h4>Our Team</h4>
                        <p>At RMS, our system is designed with the experience of chefs in mind, recognizing that their expertise is the heart of any great kitchen. We provide tools that support their creativity while streamlining the day-to-day tasks that can often distract from the art of cooking. From precise inventory management to seamless recipe scaling, our food management system allows chefs to focus on what they do best—crafting extraordinary dishes—while ensuring that every aspect of the kitchen runs smoothly and efficiently.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single_feature">
                        <div class="feature_icon">
                            <img src="{{asset('Frontend/assets/img/icon-3.png')}}" alt="">
                        </div>
                        <h4>Fast Delivery</h4>
                        <p>At RMS, we understand that fast delivery is crucial to customer satisfaction and operational efficiency. Our food management system is designed to streamline every step of the delivery process, from order placement to dispatch, ensuring that your meals reach customers quickly and in perfect condition. By optimizing routes, automating order tracking, and providing real-time updates, we help you achieve speedy and reliable delivery that enhances your service and keeps your customers delighted.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--+++++++ End feature_sec ++++++-->

    <!--+++++++ Start book_table_sec ++++++-->
    <section class="book_table pad">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-lg-4">
                    <div class="table_img">
                        <img src="{{asset('Frontend/assets/img/home-two/book-table.png')}}" alt="">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                <div class="booking_form style-2">
                        <h1>Book A Table</h1>
                        <form action="{{ route('book') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" placeholder="Name">
                                <input type="tel" name="mobile" placeholder="Mobile">
                                <input type="date" name="date" placeholder="Date">
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" placeholder="E-mail">
                                <input type="time" name="time" placeholder="Time">
                                <input type="number" name="person" placeholder="No of Person">

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

@endsection
@extends('frontend.main')
@section('content')

<!--+++++++ Start hero_sec ++++++-->
<section class="hero_sec">
    <div class="container">
        <div class="hero_content">
            <div class="row justify-content-between align-items-center mt-50">
                <div class="col-md-6 col-lg-5">
                    <div class="hero_food_item" data-aos="zoom-in-down" data-aos-duration="1000">
                        <img src="{{asset('Frontend/assets/img/teamhero.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="hero_inner" data-aos="zoom-in-down" data-aos-duration="1000">
                        <h1>Uniting culinary teams and partners for a harmonious dining experience.</h1>
                        <p>Our system seamlessly integrates chefs, suppliers, and delivery partners, ensuring smooth communication and coordinated operations. This collaboration enhances the overall efficiency and quality of the dining experience..</p>
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

<!--+++++++ Start team_members_sec ++++++-->
<section class="team_members_sec chef_page pad_top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="title">
                    <h1><span>Our</span> Team</h1>
                    <p>At RMS, we recognize the power of collaboration in enhancing the dining experience, and our food management system is built to support seamless integration across various restaurant partners. Whether it's coordinating between multiple locations, aligning with local suppliers, or integrating with third-party delivery services, our system fosters effective collaboration that streamlines operations and improves efficiency. By facilitating smooth communication and data sharing among all stakeholders, we enable restaurants to work together more cohesively, ensuring consistent quality and exceptional service across every touchpoint.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @if($Team)
            @foreach($Team as $key => $value)
            <div class="col-md-6 col-lg-3">
                <div class="member mb">
                    <div class="chef">
                        <img src="{{ asset('upload/Team/'.$value->image)}}" alt="">
                    </div>
                    <h5>{{$value->name}}</h5>
                    <span>{{$value->position}}</span>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
<!--+++++++ End team_members_sec ++++++-->
@endsection

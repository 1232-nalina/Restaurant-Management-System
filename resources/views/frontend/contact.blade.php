@extends('Frontend.main')
@section('content')
 <!--+++++++ Start breadcrum_sec ++++++-->
 <section class="breadcrum_sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="breadcrum_inner">
                        <h1>Contact us</h1>
                        <a href="#"><span>Home</span> - Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--+++++++ End breadcrum_sec ++++++-->


    <!--+++++++ Start error_sec ++++++-->
    <section class="error_sec pad_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 text-center">
                    <div class="comment-form">
                        <h4>Sand A Message Us</h4>
                        <form action="https://www.banglahype.com/rh-jewel/restaurant/mailer.php" method="post" id="ajax-contact">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="clear" type="text" name="name" placeholder="Name">
                                </div>
                                <div class="col-md-6">
                                    <input class="clear" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="col-md-12">
                                    <textarea class="clear" name="message" cols="30" rows="10" placeholder="Your Comment"></textarea>
                                    <input type="submit" value="send">
                                </div>
                            </div>
                        </form>
                        <p id="form-messages"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--+++++++ End error_sec ++++++-->

    <!--+++++++ Start google_map_sec ++++++-->
    <section class="google_map_sec pad_top">
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe width="100%" height="600" id="gmap_canvas" src="https://maps.google.com/maps?q=old%20dhaka%2Croyal%20resturennt&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.divi-discounts.com/"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--+++++++ End google_map_sec ++++++-->
@endsection
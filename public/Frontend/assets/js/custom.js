(function ($) {

    //Mobile menu js
    $('.mobile_menu').click(function () {
        $('.slide-menu').toggleClass('activee');
    });

    $('.menu-close').click(function () {
        $('.slide-menu').removeClass('activee');
    });


    //Scroll Top btn
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('.scroll_top').fadeIn().addClass('opacity');
        } else {
            $('.scroll_top').fadeOut();
        }
    });
    $('.scroll_top').on('click', function () {
        $("html, body").animate({
            scrollTop: 0
        }, 1500);
        return false;
    });

    //Testimonial_slider
    $('.testimonial_slider').owlCarousel({
        items: 3,
        autoplay: true,
        center: true,
        loop: true,
        autoplaySpeed: 2500,
        margin: 30,
        nav: true,
        navText: ['<i class="fal fa-arrow-left"></i>', '<i class="fal fa-arrow-right"></i>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    });


    //Isotope with image load
    jQuery(function () {
        var $container = jQuery('#container');
        $container.imagesLoaded(function () {
            $container.isotope({
                itemSelector: '.grid_item',
                sortBy: 'random'
            });
        });
    });

    $('ul.menu_list li').on('click', function () {

        $("ul.menu_list li").removeClass("active");
        $(this).addClass("active");

        var selector = $(this).attr('data-filter');
        $(".grid").isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false,
            }
        });
        return false;
    });

    //Amination AOS
    AOS.init();



})(jQuery);
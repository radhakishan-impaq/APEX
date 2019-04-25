(function ($) {
    'use strict';
    //========================
    // Loader
    //========================
    $(window).load(function () {
        if ($(".loader-wrap").length > 0)
        {
            $(".loader-wrap").delay(500).fadeOut("slow");
        }
    });
    //========================
    // Window Height
    //========================
    if ($(window).width() > 1199) {
        var windowH = window.innerHeight;
        $('#main-slider').css({'height': windowH + 'px'});
        $(window).on('resize', function () {
            var windowH = window.innerHeight;
            $('#main-slider').css({'height': windowH + 'px'});
        });
    }
    //========================
    // Home Slider
    //========================
    if ($('#main-slider').length > 0) {
        $('#main-slider').owlCarousel({
            margin: 0,
            loop: true,
            autoplay: true,
            nav: true,
            items: 1,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            autoplayHoverPause: true,
            autoplaySpeed: 500,
            smartSpeed: 450,
            dots: true,
            dotsContainer: '#customDots',
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    //-----------------------------------
    //Fixed Header
    //-----------------------------------
    if ($(".header-area").length > 0) {
        $(window).on('scroll', function () {
            if ($(window).scrollTop() > 250) {
                $(".header-area").addClass('fixed-menu animated fadeInDown');
            }
            else
            {
                $(".header-area").removeClass('fixed-menu animated fadeInDown');
            }
        });
    }

    //=======================================================
    // Contact Map
    //=======================================================
    if ($("#map").length > 0)
    {
        var map;
        map = new GMaps({
            el: '#map',
            lat: 19.1159524,
            lng: 72.8481002,
            scrollwheel: false,
            zoom: 16,
            zoomControl: false,
            panControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            overviewMapControl: false,
            clickable: false
        });

        // Marker
        map.addMarker({
            lat: 19.1159524,
            lng: 72.8481002,
            icon: gmapMarker(),
            animation: google.maps.Animation.BOUNCE,
            infoWindow: {
                content: '<p>Your Company Info</p>'
            }
        });
    }
    //Gmap Marker Function
    function gmapMarker() {
        if ($('#map.home3-map').length > 0) {
            return 'images/marker3.png';
        } else if ($('#map.home2-map').length > 0) {
            return 'images/marker2.png';
        } else {
            return 'images/marker.png';
        }
    }
    //------------------------------------------------------
    // Fun Facts Counter
    //------------------------------------------------------
    if ($(".funfacts-section").length > 0)
    {
        $('.funfacts-count h3').appear(function () {
            var $this = $(this);
            $({Counter: 0}).animate({Counter: $this.text()},
            {
                duration: 4000,
                easing: 'swing',
                step: function () {
                    $this.text(Math.ceil(this.Counter));
                }
            });
        });
    }

    //========================
    // Gallery Slider
    //========================
    if ($("#gallery-slider").length > 0)
    {
        $('#gallery-slider').owlCarousel({
            margin: 0,
            loop: true,
            autoplay: true,
            nav: true,
            navContainer: '.owl-nav-arrows',
            items: 4,
            autoplayHoverPause: true,
            autoplaySpeed: 500,
            smartSpeed: 450,
            dots: false, responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 2
                },
                1200: {
                    items: 4
                }
            }
        });
    }
    //-------------------------------------
    //Gallery Popup
    //-------------------------------------
    if ($("a[data-rel^=lightcase]").length > 0)
    {
        $('a[data-rel^=lightcase]').lightcase();
    }

    //-------------------------------------
    //Count Down
    //-------------------------------------
    if ($("#count-down").length > 0)
    {
        $('#count-down').countdown({
            date: '12/24/2018 23:59:59',
            offset: +6,
            day: 'Day',
            days: 'Days'
        });
    }
    //-------------------------------------
    //Color Preset
    //-------------------------------------
    $('.preset-list li').on('click', function () {
        $('.preset-list li.active').removeClass('active');
        $(this).addClass('active');
        var color = $(this).data('color'),
                url = 'css/colors/' + color + '.css',
                logoSrc = 'images/preset/' + color + '.png',
                footerLogoSrc = 'images/preset/footer-' + color + '.png';

        $('.logo a img').attr('src', logoSrc);
        $('.footer-logo a img').attr('src', footerLogoSrc);
        $('#preset').attr('href', url);
    });

    $('.toggoler').on('click', function (e) {
        e.preventDefault();
        $('.style-chooser').toggleClass('active');
    });

    //=======================================================
    // Mobile Menu
    //=======================================================
    $(".toggle-btn").on('click', function () {
        $(".main-menu > ul").slideToggle(400);
    });
    $("ul li.has-sub-menu > a").on('click', function (e) {
        e.preventDefault();
        $(this).next('.main-menu .sub-menu').slideToggle(400);
    });

    //-------------------------------------------------------
    // Background Video
    //-------------------------------------------------------
    var vid = document.getElementById("event-video");
    function playPause() {
        if (vid.paused) {
            vid.play();
        }
        else {
            vid.pause();
        }
    }
    if ($('#event-video').length > 0) {
        $('#play-icon').on('click', function (e) {
            e.preventDefault();
            $('#video-wrap').toggleClass('video-playing');
            playPause();
            if ($(this).hasClass('playing'))
            {
                $(this).removeClass('playing').html('<i class="icofont icofont-play-alt-1"></i>');
                vid.pause();
            }
            else
            {
                $(this).addClass('playing').html('<i class="icofont icofont-pause"></i>');
                vid.play();
            }
        });
    }
    //----------------------------------------------------
    // Contact
    //----------------------------------------------------
    if ($(".contact-form").length > 0)
    {
        $(".contact-form").on('submit', function (e) {
            e.preventDefault();
            var allData = $(this).serialize();
            var required = 0;
            $('.form-submit').val('Sending...');
            $(".need-to-fill", this).each(function () {
                if ($(this).val() == '')
                {
                    $(this).addClass('required');
                    required += 1;
                }
                    else
                {
                    if ($(this).hasClass('required'))
                        {
                        $(this).removeClass('required');
                        if (required > 0)
                        {
                            required -= 1;
                        }
                    }
                }
            });
            //alert(required);
                    if (required === 0)
                {
            $('.form-submit').val('Sending...');
                $.ajax({
                type: "POST",
                    url: 'mail.php',
                    data: {allData: allData},
            success: function (data)
    {
    $(".contact-form input[type='text'], .contact-form input[type='email'], .contact-form textarea").val('');
        $('.form-submit').val('Success!');
                    }
            });             }
            else
            {
            $('.form-submit').val('Send');
            }
            });
    }
    //========================
            // WOW INIT
    //========================
                if ($(window).width() > 490 && $('.wow').length > 0)
                {
                    var wow = new WOW({mobile: false
        });
                    wow.init();
    }
})(jQuery);
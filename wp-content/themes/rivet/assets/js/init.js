;(function($) {
    "use strict";

    /*
    |=========================
    | Search Modal PopUp
    |=========================
    */ 
    let rivetSearchModalPopUp = function(){
        $( '.search-trigger' ).on( 'click', function () {
            $( '.edu-search-popup' ).addClass( 'open' );
            $( 'body, html' ).css( 'overflow-y','hidden' );
        } )
        $( '.close-trigger' ).on( 'click', function () {
            $( '.edu-search-popup' ).removeClass( 'open' );
            $( 'body, html' ).css( 'overflow-y','inherit' );
        } )
        $( '.edu-search-popup' ).on( 'click', function () {
            $( '.edu-search-popup' ).removeClass( 'open' );
            $( 'body, html' ).css( 'overflow-y','inherit' );
        } )
        $( '.edu-search-popup .rivet-search-popup-field' ).on( 'click', function (e) {
            e.stopPropagation();
        } )
    }

    /*
    |=========================
    | Add class for table style
    |=========================
    */  
    $( 'table' ).addClass( 'table table-bordered table-striped' );

    /* mobile menu active
    ========================================================================== */
    if ( $.isFunction( $.fn.metisMenu ) ) {
        $( '.rivet-mobile-menu-item' ).metisMenu();
    }

    $( '.rivet-mobile-menu-nav-wrapper .menu-item-has-children > a' ).on( 'click', function (e) {
        e.preventDefault();
    } );

    $( '.rivet-mobile-hamburger-menu > a' ).on( 'click', function (e) {
        e.preventDefault();
        $( '.rivet-mobile-menu-nav-wrapper' ).toggleClass( 'rivet-mobile-menu-visible' );
        $( 'body' ).addClass( 'rivet-mobile-menu-active' );
        $(this).addClass( 'rivet-mobile-menu-close--active' );
    } );

    $( '.rivet-mobile-menu-close > a' ).on( 'click', function (e) {
        e.preventDefault();
        $( '.rivet-mobile-menu-nav-wrapper' ).removeClass( 'rivet-mobile-menu-visible' );
        $( 'body').removeClass( 'rivet-mobile-menu-active' );
        $( '.rivet-mobile-hamburger-menu > a' ).removeClass( 'rivet-mobile-menu-close--active' );
    } );

    $( '.rivet-mobile-menu-overlay' ).on( 'click', function () {
        $( '.rivet-mobile-menu-nav-wrapper' ).removeClass( 'rivet-mobile-menu-visible' );
        $( 'body' ).removeClass( 'rivet-mobile-menu-active' );
        $( '.rivet-mobile-hamburger-menu > a' ).removeClass( 'rivet-mobile-menu-close--active' );
    } );

    /*
    |=========================
    | Tilt Hover Animation
    |=========================
    */
    if ( $.isFunction( $.fn.tilt ) ) {
        $( '.rivet-single-product-thumb-wrapper' ).tilt( {
            maxTilt: 50,
            perspective: 1400,
            easing: 'cubic-bezier(.03,.98,.52,.99)',
            speed: 1200,
            glare: false,
            maxGlare: 0.3,
            scale: 1.04
        } );
    }

    /*
    |=========================
    | Slick Slider Items
    |=========================
    */  
    $( '.rivet-related-course-items, .rivet-related-product-items' ).each( function() {
        let carouselWrapper = $(this),
        slidesToShow        = undefined !== carouselWrapper.data( 'slidestoshow' ) ? carouselWrapper.data( 'slidestoshow' ) : 3,
        tabletItems         = undefined !== carouselWrapper.data( 'tablet-items' ) ? carouselWrapper.data( 'tablet-items' ) : 2,
        mobileItems         = undefined !== carouselWrapper.data( 'mobile-items' ) ? carouselWrapper.data( 'mobile-items' ) : 1,
        smallMobileItems    = undefined !== carouselWrapper.data( 'small-mobile-items' ) ? carouselWrapper.data( 'small-mobile-items' ) : 1,
        autoplaySpeed       = undefined !== carouselWrapper.data( 'autoplayspeed' ) ? carouselWrapper.data( 'autoplayspeed' ) : 3000,
        autoplay                = undefined !== carouselWrapper.data( 'autoplay' ) ? carouselWrapper.data( 'autoplay' ) : false,
        loop                = undefined !== carouselWrapper.data( 'loop' ) ? carouselWrapper.data( 'loop' ) : false,
        direction           = false;
        if ( "rtl" == document.dir ) {
            direction = true;
        }
        if ( $.isFunction( $.fn.slick ) ) {  
            $(this).slick( {
                dots: false,
                infinite: true,
                arrows: false,
                speed: 1000,
                loop: loop,
                slidesToShow: slidesToShow,
                slidesToScroll: 1,
                autoplay: autoplay,
                autoplaySpeed: autoplaySpeed,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: tabletItems,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: mobileItems
                        }
                    },
                    {
                        breakpoint: 481,
                        settings: {
                            slidesToShow: smallMobileItems
                        }
                    }
                ]
            } )
        }
    });

    /*
    |=========================
    | Menu Sticky Function
    |=========================
    */  
    let rivetTransparentHeader = function() {
        let header_height = $( '.rivet-sticky-header-wrapper' ).outerHeight();
        $(window).on('load scroll', function() {
            let y = $(this).scrollTop();
            if ( y > 120 ) {
                $( '.header-get-sticky, .rivet-sticky-header-wrapper' ).addClass( 'rivet-header-sticky' );
            } else {
                $( '.header-get-sticky, .rivet-sticky-header-wrapper' ).removeClass( 'rivet-header-sticky' );
            }
        } );
    };    

    let rivetMegaMenu = function() {
        if ( "rtl" == document.dir ) {
            $( '.main-navigation ul > li.mega-menu' ).each(function() {
                let items       = $(this).find( ' > ul.rivet-dropdown-menu > li' ).length,
                bodyWidth       = $( 'body' ).outerWidth(),
                parentLinkWidth = $(this).find( ' > a' ).outerWidth(),
                parentLinkpos   = $(this).find( ' > a' ).offset().left,
                width           = items * 250,
                left            = width / 2 - parentLinkWidth / 2,
                linkleftWidth   = parentLinkpos + parentLinkWidth / 2,
                linkRightWidth  = bodyWidth - (parentLinkpos + parentLinkWidth);

                if (width / 2 > linkleftWidth) {
                    $(this).find( ' > ul.rivet-dropdown-menu' ).css( {
                        width: width + 'px',
                        right: 'inherit',
                        left: '-' + parentLinkpos + 'px'
                    } );
                } else if (width / 2 > linkRightWidth) {
                    $(this).find( ' > ul.rivet-dropdown-menu' ).css( {
                        width: width + 'px',
                        left: 'inherit',
                        right: '-' + linkRightWidth + 'px'
                    } );
                } else {
                    $(this).find( ' > ul.rivet-dropdown-menu' ).css( {
                        width: width + 'px',
                        right: '-' + left + 'px'
                    } );
                }
            } );
        } else {
            $( '.main-navigation ul > li.mega-menu' ).each(function() {
                let items       = $(this).find( ' > ul.rivet-dropdown-menu > li' ).length,
                bodyWidth       = $( 'body' ).outerWidth(),
                parentLinkWidth = $(this).find( ' > a' ).outerWidth(),
                parentLinkpos   = $(this).find( ' > a' ).offset().left,
                width           = items * 250,
                left            = width / 2 - parentLinkWidth / 2,
                linkleftWidth   = parentLinkpos + parentLinkWidth / 2,
                linkRightWidth  = bodyWidth - (parentLinkpos + parentLinkWidth);

                if (width / 2 > linkleftWidth) {
                    $(this).find( ' > ul.rivet-dropdown-menu' ).css( {
                        width: width + 'px',
                        right: 'inherit',
                        left: '-' + parentLinkpos + 'px'
                    } );
                } else if (width / 2 > linkRightWidth) {
                    $(this).find( ' > ul.rivet-dropdown-menu' ).css( {
                        width: width + 'px',
                        left: 'inherit',
                        right: '-' + linkRightWidth + 'px'
                    } );
                } else {
                    $(this).find( ' > ul.rivet-dropdown-menu' ).css( {
                        width: width + 'px',
                        left: '-' + left + 'px'
                    } );
                }
            } );
        }
    }

    /*
    |=========================
    | Nice Select
    |=========================
    */
    $( '.widget select' ).niceSelect();

    
    /*
    |=========================
    | Preloader
    |=========================
    */  
    let rivetsitePreloader = function () {
        jQuery( window ).load( function() {
            jQuery( '#rivet-preloader' ).fadeOut();
        } );
            
        // Close The Preloader while clicking on the button
        $( '.rivet-preloader-close-btn' ).on( 'click', function (e) {
            e.preventDefault();
            jQuery( '#rivet-preloader' ).fadeOut();
        } );
    }


    // Dom Ready
    $(function() {
        rivetMegaMenu();
        rivetTransparentHeader();
        rivetSearchModalPopUp();
        rivetsitePreloader();
    } );


    /*
    |============================
    | Scroll To Top
    |============================
    */ 
    let rivet_back_to_top_offset = 300,
    rivet_back_to_top_duration   = 800;

    $(window).on( 'scroll', function() {
        if ( $(this).scrollTop() > rivet_back_to_top_offset ) {
            $( '.rivet-default-scroll-to-top' ).fadeIn( 100 );
        } else {
            $( '.rivet-default-scroll-to-top' ).fadeOut( 100 );
        }
    } );

    $( '.rivet-default-scroll-to-top' ).on( 'click', function(event) {
        event.preventDefault();
        $( 'html, body' ).animate({
          scrollTop: 0
        }, rivet_back_to_top_duration );
        return false;
    } );

    /*
    |============================
    | svgInject Js
    |============================
    */
	const svgVivusAnimation = () => {
		// Select all elements with the class 'svgInject' and apply SVGInject
		SVGInject(document.querySelectorAll('img.svgInject'), {
		  makeIdsUnique: true,
		});
	  };
	// Call the function to initiate the SVG animation
	svgVivusAnimation();

}(jQuery));
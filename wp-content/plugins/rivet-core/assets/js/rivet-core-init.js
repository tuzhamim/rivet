;( function( $ ) {
	'use strict';

	/**
	 * Testimonial Slider
	 */
	var slider = new Swiper(".rivet-testimonial-style-1", {
		slidesPerView: 4,
		spaceBetween: 30,
		loop: true,
		// Navigation arrows
		navigation: {
		  nextEl: ".rivet-testimonial__next",
		  prevEl: ".rivet-testimonial__prev",
		},
		breakpoints: {
		  1600: {
			slidesPerView: 4,
		  },
		  1400: {
			slidesPerView: 4,
		  },
		  1200: {
			slidesPerView: 3,
		  },
		  992: {
			slidesPerView: 3,
		  },
		  768: {
			slidesPerView: 2,
		  },
		  576: {
			slidesPerView: 1,
		  },
		  0: {
			slidesPerView: 1,
		  },
		},
	});

	/**
	 * Testimonial Slider 2
	 */
	var slider = new Swiper(".rivet-testimonial-style-2", {
		slidesPerView: 3,
		spaceBetween: 30,
		centeredSlides: true,
		loop: true,
		// Navigation arrows
		navigation: {
		  nextEl: ".rivet-testimonial-2__next",
		  prevEl: ".rivet-testimonial-2__prev",
		},
		breakpoints: {
		  1600: {
			slidesPerView: 3,
		  },
		  1400: {
			slidesPerView: 3,
		  },
		  1200: {
			slidesPerView: 3,
		  },
		  992: {
			slidesPerView: 3,
		  },
		  768: {
			slidesPerView: 1,
		  },
		  576: {
			slidesPerView: 1,
		  },
		  0: {
			slidesPerView: 1,
		  },
		},
	});
    
} )( jQuery );
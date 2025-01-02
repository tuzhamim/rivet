<?php

if( ! function_exists( 'rivet_root_css_variables' ) ) :
	function rivet_root_css_variables() {
		$css_root = ":root {
			--rivet-color-primary: #1ab69d;
			--color-secondary: #ee4a62;
			--color-tertiary: #FFA41B;
			--color-dark: #231F40;
			--color-body: #808080;
			--color-heading: #181818;
			--color-white: #ffffff;
			--color-shade: #F5F5F5;
			--color-border: #EEEEEE;
			--color-black: #000000;
			--radius-small: 5px;
			--radius: 10px;
			--radius-big: 16px;
			--p-light: 300;
			--p-regular: 400;
			--p-medium: 500;
			--p-semi-bold: 600;
			--p-bold: 700;
			--p-extra-bold: 800;
			--p-black: 900;
			--shadow-dark: 0px 10px 30px 0px rgba(20,36,66,0.15);
			--shadow-dark2: 0px 20px 50px 0px rgba(26,46,85,0.1);
			--transition: 0.3s;
			--transition-2: 0.5s;
			--transition-transform: transform .65s cubic-bezier(.23,1,.32,1);
			--font-primary: 'Poppins', sans-serif;
			--font-secondary: 'Spartan', sans-serif;
			--font-size-b1: 15px;
			--font-size-b2: 13px;
			--font-size-b3: 14px;
			--font-size-b4: 12px;
			--line-height-b1: 1.73;
			--line-height-b2: 1.85;
			--line-height-b3: 1.6;
			--line-height-b4: 1.3;
			--h1: 50px;
			--h2: 36px;
			--h3: 28px;
			--h4: 20px;
			--h5: 18px;
			--h6: 16px;
			--h1-lineHeight: 1.2;
			--h2-lineHeight: 1.39;
			--h3-lineHeight: 1.43;
			--h4-lineHeight: 1.4;
			--h5-lineHeight: 1.45;
			--h6-lineHeight: 1.62;
		}";

		$global_breadcrumb_type   = rivet_set_value( 'global_breadcrumb_bg_type', 'image' );
		if ( 'image' === $global_breadcrumb_type ) :
			$global_breadcrumb_overlay   = rivet_set_value( 'global_breadcrumb_bg_image_overlay' );
			if ( $global_breadcrumb_overlay ) :
				$opacity = $global_breadcrumb_overlay/100;
				$css_root .= "
					.rivet-page-title-area.rivet-breadcrumb-has-bg:before {
						background:rgba(0,0,0,{$opacity});
					}
				";
			endif;
		endif;

		$css_root = apply_filters( 'rivet_custom_color_style_css', $css_root );   

		return $css_root;
	}
endif;

if( ! function_exists( 'rivet_custom_color_styles' ) ) :
	function rivet_custom_color_styles() {   
	    wp_add_inline_style( 'rivet-main', html_entity_decode( rivet_root_css_variables(), ENT_QUOTES ) );
	}
endif;
add_action( 'wp_enqueue_scripts', 'rivet_custom_color_styles' );
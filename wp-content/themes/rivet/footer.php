<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rivet
 */

		echo '</div>';

		$footer = apply_filters( 'rivet_get_footer_layout', rivet_set_value( 'footer_type' ) );
		$default_footers = array( 'theme-default-footer' );

		if ( 'none' !== $footer ) :
			if ( in_array( $footer, $default_footers ) || empty( $footer ) ) :
				echo '<footer id="colophon" class="rivet-footer-default-wrapper site-footer">';
					echo '<div class="site-info ' . esc_attr( apply_filters( 'rivet_footer_site_info_container_class', 'rivet-container' ) ) . '">';
						echo '<div class="rivet-row">';
							echo '<div class="rivet-col-lg-12">';
								$allowed_html_array = array( 'a' => array( 'href' => array() ) );
								echo wp_kses( sprintf( __( '&copy; %s - Rivet. All Rights Reserved. Proudly powered by <a href="https://devsvibe.com">DevsVibe</a>', 'rivet' ), date( "Y" ) ), $allowed_html_array );
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</footer>';
			else :
				rivet_show_footer_builder( $footer );
			endif;
		endif;

		if ( rivet_set_value( 'scroll_to_top', true ) ) :
			echo '<div class="devsvibe-progress-parent">';
				echo '<svg class="devsvibe-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">';
					echo '<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />';
				echo '</svg>';
			echo '</div>';
		endif;
	echo '</div>';

	wp_footer();
echo '</body>';
echo '</html>';

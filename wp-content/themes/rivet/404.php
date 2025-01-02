<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Rivet
 */

get_header( 'blank' );
	echo '<div class="edu-error-area rivet-404-page edu-error-style">';
		echo '<div class="rivet-container rivet-animated-shape">';
			echo '<div class="rivet-row">';
				echo '<div class="rivet-col-lg-12">';
					echo '<div class="content text-center">';

						$error_page_title = rivet_set_value( 'error_page_title', __( 'Oops... Page Not Found!', 'rivet' ) );
						$error_page_desc = rivet_set_value( 'error_page_description', __( 'Please return to the site\'s homepage, It looks like nothing was found at this location.', 'rivet' ) );

						if ( ! empty( $error_page_title ) ) :
							echo '<h3 class="title">' . wp_kses_post( $error_page_title ) . '</h3>';
						endif;
						
						if ( ! empty( $error_page_desc ) ) :
							echo '<p class="description">' . wp_kses_post( $error_page_desc ) . '</p>';
						endif;

						echo '<div class="backto-home-btn">';
							echo '<a class="edu-btn" href="' . esc_url( get_site_url() ) . '">Back To Home<i class="ri-arrow-right-line"></i></a>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

get_footer( 'blank' );
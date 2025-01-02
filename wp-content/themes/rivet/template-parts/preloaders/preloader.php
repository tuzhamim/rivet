<?php

$preloader_type = rivet_set_value( 'preloader_type', '1' );
echo '<div id="rivet-preloader" class="rivet-preloader-wrapper rivet-preloader-' . esc_attr( $preloader_type ) . '-wrapper">';
	echo '<div class="rivet-preloader-inner">';
		get_template_part( 'template-parts/preloaders/preloader', $preloader_type );

		echo '<div class="rivet-preloader-close-btn-wraper">';
			echo '<span class="rivet-preloader-close-btn">';
				_e( 'Cancel Preloader', 'rivet' );
			echo '</span>';
		echo '</div>';
	echo '</div>';
echo '</div>';
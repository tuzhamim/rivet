<?php
use \Elementor\Control_Media;

echo '<div class="rivet-testimonial-3__item white-bg">';
    echo '<div class="rivet-testimonial-3__rating rivet-text-center">';
        $this->rating( $testimonial['rating'] );
    echo '</div>';
    if( !empty( $testimonial['testimonial'] ) ) : 
    echo '<div class="rivet-testimonial-3__content rivet-text-center">';
        echo '<p>' . wp_kses_post( $testimonial['testimonial'] ) . '</p>';
    echo '</div>';
    endif;
    echo '<div class="rivet-testimonial-3__avater rivet-d-flex rivet-align-items-center rivet-justify-content-center">';
        if ( ! empty( $image_url ) ) :
        echo '<div class="rivet-testimonial-3__avater-thumb">';
            echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
        echo '</div>';
        endif;
        echo '<div class="rivet-testimonial-3__avater-text">';
            echo $testimonial['name'] ? '<h5 class="rivet-testimonial-2__avater-title">' . esc_html( $testimonial['name'] ) . '</h5>' : '';
            echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
        echo '</div>';
    echo '</div>';
    $this->logo_print( $testimonial, true, 'rivet-testimonial-3__shape', false );
echo '</div>';
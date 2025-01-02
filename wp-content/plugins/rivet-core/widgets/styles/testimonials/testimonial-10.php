<?php
use \Elementor\Control_Media;

echo '<div class="rivet-testimonial-13__item rivet-testimonial-card">';
    echo '<div class="rivet-testimonial-13__rating">';
        $this->rating( $testimonial['rating'], 'star-5' );
    echo '</div>';
    if( !empty( $testimonial['testimonial'] ) ) : 
    echo '<div class="rivet-testimonial-13__content">';
        echo '<p>“' . wp_kses_post( $testimonial['testimonial'] ) . '”</p>';
    echo '</div>';
    endif;
    echo '<div class="rivet-testimonial-13__author">';
        if ( ! empty( $image_url ) ) :
        echo '<div class="rivet-testimonial-13__author-thumb">';
            echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
        echo '</div>';
        endif;
        echo '<div class="rivet-testimonial-13__author-text">';
            echo $testimonial['name'] ? '<h4 class="rivet-testimonial-13__author-title">' . esc_html( $testimonial['name'] ) . '</h4>' : '';
            echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
        echo '</div>';
    echo '</div>';
    $this->logo_print( $testimonial, true, 'rivet-testimonial-13__shape-1', false );
echo '</div>';
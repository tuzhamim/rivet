<?php
use \Elementor\Control_Media;

echo '<div class="rivet-testimonial-12__item">';
    if ( ! empty( $image_url ) ) :
    echo '<div class="rivet-testimonial-12__author">';
        echo '<div class="rivet-testimonial-12__author-thumb">';
            echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
        echo '</div>';
    echo '</div>';
    endif;
    echo '<div class="rivet-testimonial-12__content">';
        echo '<div class="rivet-testimonial-12__author-text">';
            echo $testimonial['name'] ? '<h6 class="rivet-testimonial-12__author-title">' . esc_html( $testimonial['name'] ) . '</h6>' : '';
            echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
        echo '</div>';
        if( !empty( $testimonial['testimonial'] ) ) : 
        echo '<p>“' . wp_kses_post( $testimonial['testimonial'] ) . '”</p>';
        endif;
        echo '<div class="rivet-testimonial-12__rating">';
            $this->rating( $testimonial['rating'] );
        echo '</div>';
    echo '</div>';
echo '</div>';
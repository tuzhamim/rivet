<?php
use \Elementor\Control_Media;

echo '<div class="rivet-testimonial__item">';
    echo '<div class="rivet-testimonial__icon">';
        $this->rating( $testimonial['rating'] );
    echo '</div>';
    if( !empty( $testimonial['testimonial'] ) ) : 
    echo '<div class="rivet-testimonial__content">';
        echo '<p>“' . wp_kses_post( $testimonial['testimonial'] ) . '“</p>';
    echo '</div>';
    endif;
    echo '<div class="rivet-testimonial__avater">';
        if ( ! empty( $image_url ) ) :
        echo '<div class="rivet-testimonial__avater-thumb">';
            echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
        echo '</div>';
        endif;
        echo '<div class="rivet-testimonial__avater-text">';
            echo $testimonial['name'] ? '<h4 class="rivet-testimonial__avater-title">' . esc_html( $testimonial['name'] ) . '</h4>' : '';
            echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
        echo '</div>';
    echo '</div>';
echo '</div>';
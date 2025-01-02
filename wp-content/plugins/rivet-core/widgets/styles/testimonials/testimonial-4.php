<?php
use \Elementor\Control_Media;

echo '<div class="rivet-testimonial-6__item">';
    echo '<div class="rivet-testimonial-6__box">';
        echo '<div class="rivet-testimonial-6__rating">';
            $this->rating( $testimonial['rating'], 'star-2' );
        echo '</div>';
        if( !empty( $testimonial['testimonial'] ) ) : 
        echo '<div class="rivet-testimonial-6__content">';
            echo '<p>' . wp_kses_post( $testimonial['testimonial'] ) . '</p>';
        echo '</div>';
        endif;
    echo '</div>';
    echo '<div class="rivet-testimonial-6__avater">';
        if ( ! empty( $image_url ) ) :
        echo '<div class="rivet-testimonial-6__avater-thumb">';
            echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
        echo '</div>';
        endif;
        echo '<div class="rivet-testimonial-6__avater-content">';
            echo $testimonial['name'] ? '<h5 class="rivet-testimonial-6__avater-title">' . esc_html( $testimonial['name'] ) . '</h5>' : '';
            echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
        echo '</div>';
    echo '</div>';
echo '</div>';
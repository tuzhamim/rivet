<?php
use \Elementor\Control_Media;

echo '<div class="rivet-testimonial-11__item">';
    echo '<div class="rivet-testimonial-11__rating">';
        $this->rating( $testimonial['rating'], 'star-4' );
    echo '</div>';
    echo '<div class="rivet-testimonial-11__content">';
        if( !empty( $settings['heading'] ) ) : 
        echo '<h4 class="rivet-testimonial-11__title">' . wp_kses_post( $settings['heading'] ) . '</h4>';
        endif;
        if( !empty( $testimonial['testimonial'] ) ) : 
        echo '<p>' . wp_kses_post( $testimonial['testimonial'] ) . '</p>';
        endif;
    echo '</div>';
    echo '<div class="rivet-testimonial-11__author">';
        if ( ! empty( $image_url ) ) :
        echo '<div class="rivet-testimonial-11__author-thumb">';
            echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
        echo '</div>';
        endif;
        echo '<div class="rivet-testimonial-11__author-text">';
            echo $testimonial['name'] ? '<h6 class="rivet-testimonial-11__author-title">' . esc_html( $testimonial['name'] ) . '</h6>' : '';
            echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
        echo '</div>';
    echo '</div>';
echo '</div>';
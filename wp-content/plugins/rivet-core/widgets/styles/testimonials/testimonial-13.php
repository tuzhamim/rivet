<?php
use \Elementor\Control_Media;

echo '<div class="rivet-testimonial-15__single">';
    echo '<div class="rivet-testimonial-15__item">';
        echo '<div class="rivet-testimonial-15__rating">';
            $this->rating( $testimonial['rating'], 'star-6' );
        echo '</div>';
        
        if( !empty( $testimonial['testimonial'] ) ) : 
        echo '<div class="rivet-testimonial-15__content">';
            echo '<p>“' . wp_kses_post( $testimonial['testimonial'] ) . '”</p>';
        echo '</div>';
        endif;
        echo '<div class="rivet-testimonial-15__author">';
            if ( ! empty( $image_url ) ) :
            echo '<div class="rivet-testimonial-15__author-thumb">';
                echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
            echo '</div>';
            endif;
            echo '<div class="rivet-testimonial-15__author-text">';
                echo $testimonial['name'] ? '<h6 class="rivet-testimonial-15__author-title">' . esc_html( $testimonial['name'] ) . '</h6>' : '';
                echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';
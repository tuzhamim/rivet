<?php
use \Elementor\Control_Media;

echo '<div class="rivet-testimonial-10__item ' . ( "yes" == $testimonial['active'] ? 'active' : '' ) . '">';
    echo '<div class="rivet-testimonial-10__rating">';
        $this->rating( $testimonial['rating'] );
    echo '</div>';
    echo '<div class="rivet-testimonial-10__content">';
        if( !empty( $testimonial['testimonial'] ) ) : 
        echo '<p>“' . wp_kses_post( $testimonial['testimonial'] ) . '”</p>';
        endif;
        echo '<div class="rivet-testimonial-10__avater">';
            if ( ! empty( $image_url ) ) :
            echo '<div class="rivet-testimonial-10__avater-thumb">';
                echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
            echo '</div>';
            endif;
            echo '<div class="rivet-testimonial-10__avater-text">';
                echo $testimonial['name'] ? '<h6 class="rivet-testimonial-10__avater-title">' . esc_html( $testimonial['name'] ) . '</h6>' : '';
                echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
            echo '</div>';
        echo '</div>';
    echo '</div>';
    $this->logo_print( $testimonial, true, 'rivet-testimonial-10__shape-1', false );
echo '</div>';
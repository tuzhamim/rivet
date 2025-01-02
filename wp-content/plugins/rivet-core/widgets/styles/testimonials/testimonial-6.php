<?php
use \Elementor\Control_Media;

echo '<div class="rivet-testimonial-9__item">';
    echo '<div class="rivet-testimonial-9__avater">';
        if ( ! empty( $image_url ) ) :
        echo '<img class="avatar" src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
        endif;
        $this->logo_print( $testimonial, true, 'rivet-testimonial-9__avater-shape', true, 'qotation' );
    echo '</div>';
    echo '<div class="rivet-testimonial-9__content">';
        if( !empty( $testimonial['testimonial'] ) ) : 
        echo '<p>“' . wp_kses_post( $testimonial['testimonial'] ) . '”</p>';
        endif;
        echo '<div class="rivet-testimonial-9__avater-content">';
            echo $testimonial['name'] ? '<h5 class="rivet-testimonial-9__avater-title">' . esc_html( $testimonial['name'] ) . '</h5>' : '';
            echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
        echo '</div>';
    echo '</div>';
echo '</div>';
<?php

echo '<div class="rivet-testimonial-7__item">';
    if( !empty( $testimonial['testimonial'] ) ) : 
    echo '<div class="rivet-testimonial-7__content">';
        echo '<p>“' . wp_kses_post( $testimonial['testimonial'] ) . '”</p>';
    echo '</div>';
    endif;
    echo '<div class="rivet-testimonial-7__rating">';
        $this->rating( $testimonial['rating'], 'star-2' );
    echo '</div>';
    echo '<div class="rivet-testimonial-7__avater">';
        echo $testimonial['name'] ? '<h5 class="rivet-testimonial-7__avater-title">' . esc_html( $testimonial['name'] ) . '</h5>' : '';
        echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
    echo '</div>';
echo '</div>';
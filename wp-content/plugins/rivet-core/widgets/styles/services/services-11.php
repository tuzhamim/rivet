<?php

echo '<div class="rivet-services-11__item">';
    $this->icon_print( $service, true, 'rivet-services-11__icon' );
    echo '<div class="rivet-services-11__content">';
        echo '<h4 class="rivet-services-11__title">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['title'] );
            echo '</a>';
        echo '</h4>';
        echo $service['details'] ? '<p>' . esc_html( $service['details'] ) . '</p>' : '';
        if( !empty( $service['button_text'] ) ) : 
        echo '<div class="rivet-services-11__btn">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['button_text'] );
            echo '</a>';
        echo '</div>';
        endif;
    echo '</div>';
echo '</div>';
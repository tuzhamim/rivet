<?php
use \Elementor\Icons_Manager;

echo '<div class="rivet-services-18__item">';
    $this->icon_print( $service, true, 'rivet-services-18__icon' );
    echo '<div class="rivet-services-18__content">';
        echo '<h4 class="rivet-services-18__title">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['title'] );
            echo '</a>';
        echo '</h4>';
        echo $service['details'] ? '<p>' . esc_html( $service['details'] ) . '</p>' : '';
    echo '</div>';
    if( !empty( $service['button_text'] ) ) :
    echo '<div class="rivet-services-18__btn">';
        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
            echo esc_html( $service['button_text'] );
            echo '<span>';
                Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
            echo '</span>';
        echo '</a>';
    echo '</div>';
    endif;
echo '</div>';
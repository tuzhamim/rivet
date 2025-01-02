<?php
use \Elementor\Icons_Manager;

echo '<div class="rivet-services-14__item">';
    echo '<div class="rivet-services-14__wrap">';
        $this->icon_print( $service, true, 'rivet-services-14__icon' );
        echo '<div class="rivet-services-14__content">';
            echo '<h4 class="rivet-services-14__title">';
                echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                    echo esc_html( $service['title'] );
                echo '</a>';
            echo '</h4>';
            echo $service['details'] ? '<span>' . esc_html( $service['details'] ) . '</span>' : '';
        echo '</div>';
    echo '</div>';
    if( !empty( $service['button_text'] ) ) :
    echo '<div class="rivet-services-14__arrow">';
        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
            echo '<span>';
                Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
            echo '</span>';
        echo '</a>';
    echo '</div>';
    endif;
echo '</div>';
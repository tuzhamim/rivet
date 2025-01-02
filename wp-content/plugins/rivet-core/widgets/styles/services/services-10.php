<?php
use \Elementor\Icons_Manager;

$services_item_count = count( $settings['services_items'] );
$border = '';
$key+=1;

if( $key % 3 == 0 ) {
    $border = 'border-right';
}

echo '<div class="rivet-services-10__item border-left ' . $border . '">';
    $this->icon_print( $service, true, 'rivet-services-10__icon' );
    echo '<div class="rivet-services-10__content">';
        echo '<h6 class="rivet-services-10__title">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['title'] );
            echo '</a>';
        echo '</h6>';
        echo $service['details'] ? '<p>' . esc_html( $service['details'] ) . '</p>' : '';
        if( !empty( $service['button_text'] ) ) : 
        echo '<div class="rivet-services-10__btn">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['button_text'] );
                echo '<span>';
                    Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</span>';
            echo '</a>';
        echo '</div>';
        endif;
    echo '</div>';
echo '</div>';
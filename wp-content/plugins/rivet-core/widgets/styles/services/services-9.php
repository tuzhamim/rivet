<?php
use \Elementor\Icons_Manager;

$services_item_count = count( $settings['services_items'] );
$border = '';

if( $services_item_count == ($key + 1) ) {
    $border = 'border-none';
}

echo '<div class="rivet-services-9__item ' . $border . '">';
    $this->icon_print( $service, true, 'rivet-services-9__icon' );
    echo '<div class="rivet-services-9__content">';
        echo '<h5 class="rivet-services-9__title">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['title'] );
            echo '</a>';
        echo '</h5>';
        echo $service['details'] ? '<p>' . esc_html( $service['details'] ) . '</p>' : '';
        if( !empty( $service['button_text'] ) ) : 
        echo '<div class="rivet-services-9__btn">';
            echo '<a class="btn-arrow-twice-dark rivet-d-flex" ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['button_text'] );
                echo '<span>';
                    Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</span>';
            echo '</a>';
        echo '</div>';
        endif;
    echo '</div>';
    echo '<div class="rivet-services-9__count"></div>';
echo '</div>';
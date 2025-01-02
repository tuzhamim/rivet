<?php

echo '<div class="rivet-services-20__item">';
    $this->icon_print( $service, true, 'rivet-services-20__icon' );
    echo '<div class="rivet-services-20__content">';
        echo '<h4 class="rivet-services-20__title">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['title'] );
            echo '</a>';
        echo '</h4>';
        echo $service['details'] ? '<p>' . esc_html( $service['details'] ) . '</p>' : '';
    echo '</div>';
echo '</div>';
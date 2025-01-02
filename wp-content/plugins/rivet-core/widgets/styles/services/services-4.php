<?php

echo '<div class="rivet-process-3__item">';
    $this->icon_print( $service, true, 'rivet-process-3__icon' );
    echo '<div class="rivet-process-3__content">';
        echo '<h4 class="rivet-process-3__title">' . esc_html( $service['title'] ) . '</h4>';
        echo $service['details'] ? '<p>' . esc_html( $service['details'] ) . '</p>' : '';
    echo '</div>';
echo '</div>';
<?php
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;

$services_image = $service['services_thumb'];
$services_image_src_url = Group_Control_Image_Size::get_attachment_image_src( $services_image['id'], 'thumb_size', $settings );
if ( empty( $services_image_src_url ) ) :
    $services_image_url = $services_image['url']; 
else :
    $services_image_url = $services_image_src_url;
endif;

echo '<div class="rivet-services-7__item">';
    $this->icon_print( $service, true, 'rivet-services-7__icon' );
    echo '<div class="rivet-services-7__content">';
        echo '<h4 class="rivet-services-7__title">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['title'] );
            echo '</a>';
        echo '</h4>';
        echo $service['details'] ? '<p>' . esc_html( $service['details'] ) . '</p>' : '';
    echo '</div>';
    if( !empty( $services_image_url ) ) :
    echo '<div class="rivet-services-7__shape">';
        echo '<img src="' . esc_url( $services_image_url ) . '" alt="' . Control_Media::get_image_alt( $service['services_thumb'] ) . '">';
    echo '</div>';
    endif;
echo '</div>';
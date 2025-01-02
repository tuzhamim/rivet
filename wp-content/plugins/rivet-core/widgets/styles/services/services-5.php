<?php
use \Elementor\Icons_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;


$services_image = $service['services_thumb'];
$services_image_src_url = Group_Control_Image_Size::get_attachment_image_src( $services_image['id'], 'thumb_size', $settings );
if ( empty( $services_image_src_url ) ) :
    $services_image_url = $services_image['url']; 
else :
    $services_image_url = $services_image_src_url;
endif;

echo '<div class="rivet-services-4__item">';
    echo '<h4 class="rivet-services-4__title">';
        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
            echo esc_html( $service['title'] );
        echo '</a>';
    echo '</h4>';
    if( !empty( $services_image_url ) ) :
    echo '<div class="rivet-services-4__thumb">';
        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
            echo '<img src="' . esc_url( $services_image_url ) . '" alt="' . Control_Media::get_image_alt( $service['services_thumb'] ) . '">';
        echo '</a>';
    echo '</div>';
    endif;
    echo '<div class="rivet-services-4__content">';
        echo $service['details'] ? '<p>' . esc_html( $service['details'] ) . '</p>' : '';
        if( !empty( $service['button_text'] ) ) : 
        echo '<div class="rivet-services-4__btn">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo '<span>' . esc_html( $service['button_text'] ) . '</span>';
                echo '<i>';
                    Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</i>';
            echo '</a>';
        echo '</div>';
        endif;
    echo '</div>';
    $this->icon_print( $service, true, 'rivet-services-4__shape', false );
echo '</div>';
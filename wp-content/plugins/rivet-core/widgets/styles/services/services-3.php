<?php
use \Elementor\Icons_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;

echo '<div class="rivet-services-3__item">';
    $services_image = $service['services_thumb'];
    $services_image_src_url = Group_Control_Image_Size::get_attachment_image_src( $services_image['id'], 'thumb_size', $settings );
    if ( empty( $services_image_src_url ) ) :
        $services_image_url = $services_image['url']; 
    else :
        $services_image_url = $services_image_src_url;
    endif;
    if( !empty( $services_image_url ) ) :
    echo '<div class="rivet-services-3__thumb">';
        echo '<img src="' . esc_url( $services_image_url ) . '" alt="' . Control_Media::get_image_alt( $service['services_thumb'] ) . '">';
    echo '</div>';
    endif;
    echo '<div class="rivet-services-3__content">';
        echo '<h5 class="rivet-services-3__title">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['title'] );
            echo '</a>';
        echo '</h5>';
        echo $service['details'] ? '<p>' . esc_html( $service['details'] ) . '</p>' : '';
        if( !empty( $service['button_text'] ) ) : 
        echo '<div class="rivet-services-3__btn">';
            echo '<a class="btn-arrow-twice-fell" ' . $this->get_render_attribute_string( $link_key ) . '> ' . esc_html( $service['button_text'] ) . '';
                echo '<span>';
                    Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</span>';
            echo '</a>';
        echo '</div>';
        endif; 
    echo '</div>';
echo '</div>';
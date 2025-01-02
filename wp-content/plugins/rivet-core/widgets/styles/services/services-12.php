<?php
use \Elementor\Icons_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;

$background_image = $settings['background_image'];
$background_image_src_url = Group_Control_Image_Size::get_attachment_image_src( $background_image['id'], 'bg_image_size', $settings );
if ( empty( $background_image_src_url ) ) :
    $background_image_url = $background_image['url']; 
else :
    $background_image_url = $background_image_src_url;
endif;

echo '<div class="rivet-services-13__item">';
    if( !empty( $background_image_url ) ) : 
    echo '<div class="rivet-services-13__item-bg">';
        echo '<img src="' . esc_url( $background_image_url ) . '" alt="' . Control_Media::get_image_alt( $settings['background_image'] ) . '">';
    echo '</div>';
    endif;
    $this->icon_print( $service, true, 'rivet-services-13__icon' );
    echo '<div class="rivet-services-13__content">';
        echo '<h4 class="rivet-services-13__title">';
            echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['title'] );
            echo '</a>';
        echo '</h4>';
        echo $service['details'] ? '<p>' . esc_html( $service['details'] ) . '</p>' : '';
        if( !empty( $service['button_text'] ) ) :
        echo '<div class="rivet-services-13__btn">';
            echo '<a class="btn-arrow-twice-dark" ' . $this->get_render_attribute_string( $link_key ) . '>';
                echo esc_html( $service['button_text'] );
                echo '<span>';
                    Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</span>';
            echo '</a>';
        echo '</div>';
        endif;
    echo '</div>';
    echo '<div class="rivet-services-13__count">';
        echo '<span>' . ( $key < 9 ? '0' . ( $key + 1 ) : ( $key + 1 ) ) . '</span>';
    echo '</div>';
    $services_image = $service['services_thumb'];
    $services_image_src_url = Group_Control_Image_Size::get_attachment_image_src( $services_image['id'], 'thumb_size', $settings );
    if ( empty( $services_image_src_url ) ) :
        $services_image_url = $services_image['url']; 
    else :
        $services_image_url = $services_image_src_url;
    endif;
    if( !empty( $services_image_url ) ) : 
    echo '<div class="rivet-services-13__shape">';
        echo '<span>';
            echo '<img src="' . esc_url( $services_image_url ) . '" alt="' . Control_Media::get_image_alt( $service['services_thumb'] ) . '">';
        echo '</span>';
    echo '</div>';
    endif;
echo '</div>';
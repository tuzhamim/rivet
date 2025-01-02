<?php

namespace RivetCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Rivet Core
 *
 * Elementor widget for service.
 *
 * @since 1.0.0
 */
class Services extends Widget_Base {
    use \Rivet_Core\Traits\Slider_Arrows;
    use \Rivet_Core\Traits\Slider_Dots;
    use \Rivet_Core\Traits\Grid, \Rivet_Core\Traits\Slider {
        \Rivet_Core\Traits\Slider::settings insteadof \Rivet_Core\Traits\Grid;
        \Rivet_Core\Traits\Grid::settings as grid_settings;
    }
    
    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'rivet-services';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Services( Grid / Carousel )', 'rivet-core' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'rivet-elementor-icon eicon-flash';
    }

    /**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'rivet', 'services', 'features', 'marketing' ];
	}

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'rivet_elementor_widgets' ];
    }

    protected $desktop_max_slider     = 6;
    protected $desktop_default_slider = 3;
    protected $desktop_default_grid   = 3;
    protected $tablet_max_slider      = 3;
    protected $tablet_default_slider  = 2;
    protected $tablet_default_grid    = 2;
    protected $mobile_max_slider      = 2;
    protected $mobile_default_slider  = 1;
    protected $mobile_default_grid    = 1;
    protected $default_display_type;

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'section_services',
            [
                'label' => __( 'Services', 'rivet-core' )
            ]
        );

        $this->add_control(
            'display_type',
            [
                'label'      => __( 'Display Type', 'rivet-core' ),
                'type'       => Controls_Manager::SELECT,
                'default'    => 'grid',
                'options'    => [
                    'grid'   => __( 'Grid', 'rivet-core' ),
                    'slider' => __( 'Slider', 'rivet-core' )
                ]
            ]
        );

        $this->add_control(
            'style',
            [
                'label'      => __( 'Style', 'rivet-core' ),
                'type'       => Controls_Manager::SELECT,
                'default'    => '1',
                'options'    => [
                    '1'   => __( 'Style 1', 'rivet-core' ),
                    '2'   => __( 'Style 2', 'rivet-core' ),
                    '3'   => __( 'Style 3', 'rivet-core' ),
                    '4'   => __( 'Style 4', 'rivet-core' ),
                    '5'   => __( 'Style 5', 'rivet-core' ),
                    '6'   => __( 'Style 6', 'rivet-core' ),
                    '7'   => __( 'Style 7', 'rivet-core' ),
                    '8'   => __( 'Style 8', 'rivet-core' ),
                    '9'   => __( 'Style 9', 'rivet-core' ),
                    '10'   => __( 'Style 10', 'rivet-core' ),
                    '11'   => __( 'Style 11', 'rivet-core' ),
                    '12'   => __( 'Style 12', 'rivet-core' ),
                    '13'   => __( 'Style 13', 'rivet-core' ),
                    '14'   => __( 'Style 14', 'rivet-core' ),
                    '15'   => __( 'Style 15', 'rivet-core' ),
                    '16'   => __( 'Style 16', 'rivet-core' ),
                    '17'   => __( 'Style 17', 'rivet-core' ),
                    '18'   => __( 'Style 18', 'rivet-core' ),
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

            $repeater->start_controls_tabs( 'services_item_tabs' );
            
                $repeater->start_controls_tab( 'services_item_content_tab', ['label' => __( 'Content', 'rivet-core' )]);

                    $repeater->add_control(
                        'image_or_icon',
                        [
                            'label'     => __( 'Image/Icon', 'rivet-core' ),
                            'type'      => Controls_Manager::SELECT,
                            'default'   => 'icon',
                            'description' => __( 'Not applicable for Style 3, 15.', 'rivet-core' ),
                            'options'   => [
                                'image' => __( 'Image', 'rivet-core' ),
                                'icon'  => __( 'Icon', 'rivet-core' )
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'thumb', 
                        [
                            'label'       => __( 'Image', 'rivet-core' ),
                            'type'        => Controls_Manager::MEDIA,
                            'default'     => [
                                'url'     => Utils::get_placeholder_image_src()
                            ],
                            'description' => __( 'Not applicable for Style 3, 15.', 'rivet-core' ),
                            'condition'   => [
                                'image_or_icon' => 'image'
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'icon', 
                        [
                            'label'       => __( 'Icon', 'rivet-core' ),
                            'type'        => Controls_Manager::ICONS,
                            'default'     => [
                                'value'   => 'fas fa-trophy',
                                'library' => 'fa-solid'
                            ],
                            'description' => __( 'Not applicable for Style 3, 15.', 'rivet-core' ),
                            'condition'   => [
                                'image_or_icon' => 'icon'
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'title', 
                        [
                            'label'       => __( 'Title', 'rivet-core' ),
                            'type'        => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default'     => __( 'Service', 'rivet-core' )
                        ]
                    );

                    $repeater->add_control(
                        'details', 
                        [
                            'label'       => __( 'Details', 'rivet-core' ),
                            'type'        => Controls_Manager::TEXTAREA,
                            'label_block' => true,
                            'default'     => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'rivet-core' )
                        ]
                    );

                    $repeater->add_control(
                        'button_text', 
                        [
                            'label'       => __( 'Button Text', 'rivet-core' ),
                            'type'        => Controls_Manager::TEXT,
                            'default'     => __( 'Learn More', 'rivet-core' ),
                            'description' => __( 'Not applicable for Style 1, 2, 4, 7, 8, 16.', 'rivet-core' ),
                        ]
                    );

                    $repeater->add_control(
                        'link',
                        [
                            'label'           => __( 'Link', 'rivet-core' ),
                            'type'            => Controls_Manager::URL,
                            'default'         => [
                                'url'         => '#',
                                'is_external' => ''
                            ],
                            'show_external'   => true,
                            'placeholder'     => __( 'https://your-link.com', 'rivet-core' ),
                            'description' => __( 'Not applicable for Style 4.', 'rivet-core' ),
                        ]
                    );

                    $repeater->add_control(
                        'services_thumb',
                        [
                            'label'   => esc_html__( 'Image', 'rivet-core' ),
                            'type'    => \Elementor\Controls_Manager::MEDIA,
                            'default' => [
                                'url' => \Elementor\Utils::get_placeholder_image_src(),
                            ],
                            'description' => __( 'Not applicable for Style 4, 6, 9, 10, 11, 14, 16, 17, 18.', 'rivet-core' ),
                        ]
                    );
                
                $repeater->end_controls_tab();

                $repeater->start_controls_tab( 'services_item_style_tab', ['label' => __( 'Style', 'rivet-core' )]);

                    $repeater->add_control(
                        'background_color', 
                        [
                            'label'       => __( 'Background Color', 'rivet-core' ),
                            'type'        => Controls_Manager::COLOR,
                            'default'     => '#F5F0EB',
                            'description' => __( 'Only applicable for Style 1.', 'rivet-core' ),
                            'selectors'   => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.rivet-services__item' => 'background: {{VALUE}}'
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'title_color', 
                        [
                            'label'       => __( 'Title Color', 'rivet-core' ),
                            'type'        => Controls_Manager::COLOR,
                            'default'     => '#030027',
                            'description' => __( 'Only applicable for Style 1.', 'rivet-core' ),
                            'selectors'   => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.rivet-services__item .rivet-semi-title-32' => 'color: {{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}}.rivet-services__item .rivet-semi-title-32 a' => 'color: {{VALUE}}',
                            ]
                        ]        
                    );

                    $repeater->add_control(
                        'details_color', 
                        [
                            'label'       => __( 'Details Color', 'rivet-core' ),
                            'type'        => Controls_Manager::COLOR,
                            'default'     => '#666768',
                            'description' => __( 'Only applicable for Style 1.', 'rivet-core' ),
                            'selectors'   => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.rivet-services__item p' => 'color: {{VALUE}}'
                            ]
                        ]        
                    );

                $repeater->end_controls_tab();
            
            $repeater->end_controls_tabs();
        
        $this->add_control(
            'services_items',
            [
                'label'       => esc_html__( 'Services', 'rivet-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'            => esc_html__( 'Industrial Building', 'rivet-core' ),
                        'background_color' => '#F5F0EB',
                        'title_color'      => '#030027',
                        'details_color'    => '#666768',
                    ],
                    [
                        'title'            => esc_html__( 'Solid Waste Removal', 'rivet-core' ),
                        'background_color' => '#F60',
                        'title_color'      => '#fff',
                        'details_color'    => '#fff',
                    ],
                    [
                        'title'            => esc_html__( 'Project Planning', 'rivet-core' ),
                        'background_color' => '#0C0A0A',
                        'title_color'      => '#fff',
                        'details_color'    => '#fff',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumb_size',
                'default'   => 'full'
            ]
        );

        $this->add_control(
            'button_icon', 
            [
                'label'       => __( 'Button Icon', 'rivet-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid'
                ],
                'description' => __( 'Applicable for this style', 'rivet-core' ),
                'condition'   => [
                    'style' => [ '3', '5', '6', '9', '10', '12', '13', '14', '15', '17', '18' ]
                ]
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label'   => esc_html__( 'Background Image', 'rivet-core' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'description' => __( 'Applicable for this style', 'rivet-core' ),
                'condition'   => [
                    'style' => '12'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'bg_image_size',
                'default'   => 'full',
                'description' => __( 'Applicable for this style', 'rivet-core' ),
                'condition'   => [
                    'style' => '12'
                ]
            ]
        );

        $this->end_controls_section();

        $this->grid_settings();

        $this->settings();

    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings  = $this->get_settings_for_display();
        $direction = is_rtl() ? 'true' : 'false';

        $this->add_render_attribute( 'wrapper', 'class', 'rivet-services-wrapper' );
        $this->add_render_attribute( 'container', 'class', 'rivet-services-container' );
        $this->add_render_attribute( 'container', 'class', 'rivet-services-' . esc_attr( $settings['display_type'] ) );
        $this->add_render_attribute( 'single', 'class', 'rivet-services-' . esc_attr( $settings['style'] ) . '-widget' );

        if( '9' == $settings['style'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'rivet-services-9__wrap' );
        }

        if ( 'grid' === $settings['display_type'] ) :
            $this->add_render_attribute( 'container', 'class', 'rivet-row' );
            if ( '5' === $settings['desktop_grid_columns'] ) :
                $grid_desktop_column = 'el-5';
            else :
                $grid_desktop_column = 12/$settings['desktop_grid_columns'];
            endif;
            $grid_tablet_column  = 12/$settings['tablet_grid_columns'];
            $grid_mobile_column  = 12/$settings['mobile_grid_columns'];
            $grid_column = 'rivet-col-lg-' . esc_attr( $grid_desktop_column ) . ' rivet-col-md-' . esc_attr( $grid_tablet_column ) . ' rivet-col-sm-' . esc_attr( $grid_mobile_column );

            $this->add_render_attribute( 'single', 'class', $grid_column );
        else :
            $this->add_render_attribute( 'wrapper', 'class', 'rivet-slider-wrapper' );
            $this->add_render_attribute( 'container', 'class', 'swiper swiper-container swiper-container-initialized' );
            $this->add_render_attribute( 'single', 'class', 'rivet-slider-item swiper-slide' );

            $this->add_render_attribute( 
                'swiper', 
                [
                    'class'                   => 'swiper-wrapper',
                    'data-slidestoshow'       => intval( esc_attr( $settings['desktop_columns']['size'] ) ),
                    'data-tablet-items'       => intval( esc_attr( $settings['tablet_columns']['size'] ) ),
                    'data-mobile-items'       => intval( esc_attr( $settings['mobile_columns']['size'] ) ), 
                    'data-small-mobile-items' => intval( esc_attr( $settings['small_mobile_columns']['size'] ) ),
                    'data-speed'              => intval( esc_attr( $settings['transition_duration'] ) ),
                    'data-direction'          => esc_attr( $direction )
                ]
            );
    
            if ( 'yes' === $settings['autoplay'] ) :
                $this->add_render_attribute( 'swiper', 'data-autoplay', 'true' );
                $this->add_render_attribute( 'swiper', 'data-autoplayspeed', intval( esc_attr( $settings['autoplay_speed'] ) ) );
            endif;
    
            if ( 'yes' === $settings['loop'] ) :
                $this->add_render_attribute( 'swiper', 'data-loop', 'true' );
            endif;

            if ( 'arrows' === $settings['arrows_and_dots'] || 'both' === $settings['arrows_and_dots'] ) :
                $this->add_render_attribute( 'wrapper', 'class', 'rivet-slider-wrapper-arrows-enable' );
            endif;

            if ( 'dots' === $settings['arrows_and_dots'] || 'both' === $settings['arrows_and_dots'] ) :
                $this->add_render_attribute( 'wrapper', 'class', 'rivet-slider-wrapper-dots-enable' );
                $this->add_render_attribute( 'container', 'class', 'rivet-slider-dots-enable' );
            endif;
        endif;

        echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                if ( 'slider' === $settings['display_type'] ) : 
                    echo '<div ' . $this->get_render_attribute_string( 'swiper' ) . '>';
                endif;

                    foreach( $settings['services_items'] as $key => $service ) :
                    $link_key      = 'link_' . $key;
                    if ( $service['link']['url'] ) :
                        $this->add_render_attribute( $link_key, 'href', esc_url( $service['link']['url'] ) );
                        if ( $service['link']['is_external'] ) :
                            $this->add_render_attribute( $link_key, 'target', '_blank' );
                        endif;
                        if ( $service['link']['nofollow'] ) :
                            $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        endif;
                    endif;
                    echo '<div ' . $this->get_render_attribute_string( 'single' ) . ' >';
                        include RIVET_PLUGIN_DIR . 'widgets/styles/services/services-' . $settings['style'] . '.php';
                    echo '</div>';
                    endforeach; 

                if ( 'slider' === $settings['display_type'] ) : 
                    echo '</div>';
                endif;
            echo '</div>';
        echo '</div>';
        
    }

    /**
     * Print icon or image
     *
     * @param array $settings
     * @param bool  $div
     * @param string $div_class
     * @param bool  $span
     * @param string $span_class
     */
    private function icon_print( $settings, $div = true, $div_class = '', $span = true, $span_class = '' ) {

        $div_class;
        $span_class;

        if( !empty( $div_class ) ) : 
        $this->add_render_attribute( 'div_class', [ 'class' => esc_attr( $div_class ) ] );
        endif;

        if( !empty( $span_class ) ) : 
        $this->add_render_attribute( 'span_class', [ 'class' => esc_attr( $span_class ) ] );
        endif;

        if ( 'image' === $settings['image_or_icon'] ) :
            $image         = $settings['thumb'];
            $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumb_size', $settings );
            if ( empty( $image_src_url ) ) :
                $image_url = $image['url']; 
            else :
                $image_url = $image_src_url;
            endif;
            if( !empty( $image_url ) ) : 
            echo $div == true ? '<div ' . $this->get_render_attribute_string( 'div_class' ) . '>' : '';
                echo $span == true ? '<span ' . $this->get_render_attribute_string( 'span_class' ) . '>' : '';
                    echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $settings['thumb'] ) . '">';
                echo $span == true ? '</span>' : '';
            echo $div == true ? '</div>' : '';
            endif; 
        else :
            if( !empty( $settings['icon']['value'] ) ) : 
            echo $div == true ? '<div ' . $this->get_render_attribute_string( 'div_class' ) . '>' : '';
                echo $span == true ? '<span ' . $this->get_render_attribute_string( 'span_class' ) . '>' : '';
                    Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                echo $span == true ? '</span>' : '';
            echo $div == true ? '</div>' : '';
            endif;
        endif;
    }
}
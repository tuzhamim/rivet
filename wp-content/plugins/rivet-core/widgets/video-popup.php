<?php

namespace RivetCore\Widgets;

use \RivetCore\Helper;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Rivet Core
 *
 * Elementor widget for counterup.
 *
 * @since 1.0.0
 */
class Video_PopUp extends Widget_Base {

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
		return 'rivet-video-popup';
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
		return __( 'Video PopUp', 'rivet-core' );
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
        return 'rivet-elementor-icon eicon-play';
    }

    /**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'jquery-fancybox' ];
	}

    /**
     * Get style dependencies.
     *
     * Retrieve the list of style dependencies the element requires.
     *
     * @since 1.9.0
     * @access public
     *
     * @return array Element styles dependencies.
     */
    public function get_style_depends() {
        return [ 'jquery-fancybox' ];
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
		return [ 'rivet', 'video', 'popup', 'youtube', 'vimeo' ];
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
        $primary_color = rivet_set_value( 'primary_color', '#525FE1' );

  		$this->start_controls_section(
            'section_video_popup',
            [
                'label' => __( 'Video PopUp', 'rivet-core' )
            ]
        );

        $this->add_control(
            'enable_background_image',
            [
                'label'        => __( 'Background Image', 'rivet-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'image',
            [
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url'   => Utils::get_placeholder_image_src()
                ],
                'condition' => [
                    'enable_background_image' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'full',
                'condition' => [
                    'image[url]!'             => '',
                    'enable_background_image' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'url',
            [
                'label'       => __( 'Video URL', 'rivet-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'https://www.youtube.com/watch?v=pNje3bWz7V8',
                'description' => __( 'Place your video URL here.', 'rivet-core' )
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'       => __( 'Video Icon', 'rivet-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-play',
                    'library' => 'fa-solid'
                ]
            ]
        );

        $this->add_control(
            'text',
            [
                'label'       => __( 'Side Text', 'rivet-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => __( 'Place your video popup text information. Example: Play Now', 'rivet-core' )
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'rivet-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'flex-start' => [
                        'title'  => __( 'Left', 'rivet-core' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'rivet-core' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'flex-end'   => [
                        'title'  => __( 'Right', 'rivet-core' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .rivet-video-popup-wrapper .rivet-video-popup-content' => 'justify-content: {{VALUE}};'
                ],
                'condition'      => [
                    'enable_background_image!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'animation_type',
            [
                'label'     => __( 'Animation', 'rivet-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'continious',
                'options'   => [
                    'continious' => __( 'Continious', 'rivet-core' ),
                    'on-hover'   => __( 'On Hover', 'rivet-core' ),
                    'never'      => __( 'Never', 'rivet-core' )
                ]
            ]
        );

        $this->add_control(
            'continious_animation_type',
            [
                'label'     => __( 'Continious Animation', 'rivet-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'colored',
                'options'   => [
                    'colored' => __( 'Colored', 'rivet-core' ),
                    'white' => __( 'White', 'rivet-core' ),
                    'white-ripple'   => __( 'White Ripple', 'rivet-core' ),
                    'custom-ripple-color'   => __( 'Custom Ripple Color', 'rivet-core' )
                ],
                'condition' => [
                    'animation_type' => 'continious'
                ]
            ]
        );

        $this->add_control(
            'custom_color_ripple',
                [
                    'label'     => __( 'Overlay', 'rivet-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#525FE1',
                    'selectors' => [
                        '{{WRAPPER}} .rivet-video-popup-animation-continious.rivet-video-popup-continious-type-custom-ripple-color .rivet-video-popup-icon::before, {{WRAPPER}} .rivet-video-popup-animation-continious.rivet-video-popup-continious-type-custom-ripple-color .rivet-video-popup-icon::after' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [
                        'animation_type' => 'continious',
                        'continious_animation_type' => 'custom-ripple-color'
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label'     => __( 'Image', 'rivet-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'image[url]!'             => '',
                    'enable_background_image' => 'yes'
                ]
            ]
        );

        $this->add_control(
          'image_overlay',
            [
                'label'     => __( 'Overlay', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => Helper::hex2rgba( $primary_color, 0.5 ),
                'selectors' => [
                    '{{WRAPPER}} .rivet-video-popup-wrapper.rivet-video-popup-bg-enable::before' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'        => __( 'Height', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 50,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .rivet-video-popup-wrapper.rivet-video-popup-bg-enable' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'selector' => '{{WRAPPER}} .rivet-video-popup-wrapper.rivet-video-popup-bg-enable'
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-video-popup-wrapper.rivet-video-popup-bg-enable' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .rivet-video-popup-wrapper.rivet-video-popup-bg-enable'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label' => __( 'Icon', 'rivet-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'icon_box_size',
            [
                'label'        => __( 'Box Size', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 30,
                        'step' => 2,
                        'max'  => 300
                    ]
                ],
                'default'     => [
                    'size'    => 100
                ],
                'selectors'    => [
                    '{{WRAPPER}} .rivet-video-popup-wrapper .rivet-video-popup-content .rivet-video-popup-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_on_hover_box_size',
            [
                'label'        => __( 'Box Size ( On Hover( Increase ) )', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 5,
                        'step' => 1,
                        'max'  => 300
                    ]
                ],
                'default'      => [
                    'size'     => 50
                ],
                'selectors'    => [
                    '{{WRAPPER}} .rivet-video-popup-animation-on-hover .rivet-video-popup-icon:before' => 'height: calc({{SIZE}}{{UNIT}} + {{icon_box_size.SIZE}}{{icon_box_size.UNIT}}); width: calc({{SIZE}}{{UNIT}} + {{icon_box_size.SIZE}}{{icon_box_size.UNIT}}); line-height: calc({{SIZE}}{{UNIT}} + {{icon_box_size.SIZE}}{{icon_box_size.UNIT}});'
                ],
                'condition'    => [
                    'animation_type' => 'on-hover'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_font_size',
            [
                'label'        => __( 'Size', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 14,
                        'step' => 5,
                        'max'  => 200
                    ]
                ],
                'default'     => [
                    'size'    => 36
                ],
                'selectors'   => [
                    '{{WRAPPER}} .rivet-video-popup-wrapper .rivet-video-popup-content .rivet-video-popup-icon' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
          'icon_color',
            [
                'label'     => __( 'Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .rivet-video-popup-wrapper .rivet-video-popup-content .rivet-video-popup-icon' => 'color: {{VALUE}}; fill: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
          'icon_bg_color',
            [
                'label'     => __( 'Background Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => $primary_color,
                'selectors' => [
                    '{{WRAPPER}} .rivet-video-popup-wrapper .rivet-video-popup-content .rivet-video-popup-icon' => 'background-color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'selector' => '{{WRAPPER}} .rivet-video-popup-wrapper .rivet-video-popup-content .rivet-video-popup-icon'
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label'      => __( 'Border Radius', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'      => [
                    'top'      => '100',
                    'right'    => '100',
                    'bottom'   => '100',
                    'left'     => '100',
                    'unit'     => '%',
                    'isLinked' => true
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-video-popup-wrapper .rivet-video-popup-content .rivet-video-popup-icon, {{WRAPPER}} .rivet-video-popup-animation-on-hover .rivet-video-popup-icon:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .rivet-video-popup-wrapper .rivet-video-popup-content .rivet-video-popup-icon'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'text_style',
            [
                'label'     => __( 'Text', 'rivet-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'selector' => '{{WRAPPER}} .rivet-video-popup-title a'
            ]
        );

        $this->add_control(
          'text_color',
            [
                'label'     => __( 'Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-video-popup-title a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $direction = is_rtl() ? 'right' : 'left';
        $this->add_responsive_control(
            'text_inden',
            [
                'label'        => __( 'Indent', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'step' => 1,
                        'max'  => 100
                    ]
                ],
                'default'     => [
                    'size'    => 20
                ],
                'selectors'    => [
                    '{{WRAPPER}} .rivet-video-popup-title' => 'margin-' . $direction . ': {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
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
		$settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            'container',
            [
                'class' => [
                    'rivet-video-popup-wrapper',
                    'rivet-video-popup-animation-' . esc_attr( $settings['animation_type'] )
                ]
            ]
        );

        $this->add_render_attribute(
            'popup',
            [
                'class' => 'rivet-video-popup-icon',
                'href'  => esc_url( $settings['url'] )
            ]
        );

        if ( 'continious' === $settings['animation_type'] ) :
            $this->add_render_attribute( 'container', 'class', 'rivet-video-popup-continious-type-' . $settings['continious_animation_type'] );
        endif;

        if ( 'yes' === $settings['enable_background_image'] ) :
            $image     = $settings['image'];
            $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
            if ( empty( $image_url ) ) :
                $image_url = $image['url'];
            else :
                $image_url = $image_url;
            endif;
            $this->add_render_attribute(
                'container',
                [
                    'class' => 'rivet-video-popup-bg-enable',
                    'style' => 'background-image: url(' . esc_url( $image_url ) . ')'
                ]
            );
        endif;

        echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
            echo '<div class="rivet-video-popup-content">';
                echo '<a ' . $this->get_render_attribute_string( 'popup' ) . '>';
                    Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                echo '</a>';
                if ( $settings['text'] ) :
                    echo '<h4 class="rivet-video-popup-title">';
                        echo '<a class="rivet-video-popup-text" href=' . esc_url( $settings['url'] ) . '>';
                            echo esc_html( $settings['text'] );
                        echo '</a>';
                    echo '</h4>';
                endif;
            echo '</div>';
        echo '</div>';
    }
}
<?php

namespace RivetCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Rivet Core
 *
 * Elementor widget for animation.
 *
 * @since 1.0.0
 */
class Animation extends Widget_Base {

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
		return 'rivet-animation';
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
		return __( 'Animation', 'rivet-core' );
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
        return 'rivet-elementor-icon eicon-animation';
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
        return [ 'jquery-tilt', 'rivet-animation' ];
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
		return [ 'rivet', '3d', 'effect', 'hover', 'image', 'tilt', 'parallax', 'mouse', 'move', 'tracker', 'scrolling', 'animation', 'vertical', 'horizontal' ];
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
            'section_animation',
            [
                'label' => __( 'Animation', 'rivet-core' )
            ]
        );

        $this->add_control(
            'animation_type',
            [
                'label'       => __( 'Animation Type', 'rivet-core' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'     => 'mouse-track',
                'options'     => [
                    'animated-image'              => __( 'Animated Image', 'rivet-core' ),
                    'animated-color'              => __( 'Animated Color', 'rivet-core' ),
                    'infinite-animation'          => __( 'Infinite Animation', 'rivet-core' ),
                    'infinite-animation-parallax' => __( 'Infinite Animation + Parallax', 'rivet-core' ),
                    'mouse-track'                 => __( 'Mouse Track', 'rivet-core' ),
                    'parallax'                    => __( 'Parallax', 'rivet-core' ),
                    'tilt'                        => __( 'Tilt', 'rivet-core' )
                ]
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label'     => __( 'Content Type', 'rivet-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'image',
                'options'   => [
                    'image' => __( 'Image', 'rivet-core' ),
                    'icon'  => __( 'Icon', 'rivet-core' ),
                    'text'  => __( 'Text', 'rivet-core' ),
                    'color' => __( 'Color', 'rivet-core' )
                ],
                'condition' => [
                    'animation_type!' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_control(
            'image_type',
            [
                'label'     => __( 'Image Type', 'rivet-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'custom-image',
                'options'   => [
                    'custom-image'     => __( 'Custom Image', 'rivet-core' ),
                    'predefined-image' => __( 'Predefined Image', 'rivet-core' )
                ],
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '!==',
                                    'value'    => 'animated-color'
                                ],
                                [
                                    'name'     => 'content_type',
                                    'operator' => '===',
                                    'value'    => 'image'
                                ]
                            ]
                        ],
                        [
                            'name'     => 'animation_type',
                            'operator' => '===',
                            'value'    => 'animated-image'
                        ]
                    ]
                ]
            ]
        );

        $predefined_image = range( 1, 6 );
        $predefined_image = array_combine( $predefined_image, $predefined_image );

        $this->add_control(
            'predefined_image',
            [
                'type'      => Controls_Manager::SELECT,
                'label'     => __( 'Predefined Image', 'rivet-core' ),
                'default'   => 'hero-area-2-1.png',
                'options'   => [
                    'hero-area-2-1.png' => 'Image 1',
                    'hero-area-2-2.png' => 'Image 2',
                    'hero-area-2-3.png' => 'Image 3',
                    'hero-area-2-4.png' => 'Image 4',
                    'hero-area-2-5.png' => 'Image 5',
                    'hero-area-2-6.png' => 'Image 6'
                ],
                'condition' => [
                    'image_type'      => 'predefined-image',
                    'animation_type!' => 'animated-color',
                    'content_type'    => 'image',
                ]
            ]
        );

  		$this->add_control(
            'image',
            [
                'label'     => __( 'Image', 'rivet-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url'   => Utils::get_placeholder_image_src()
                ],
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '!==',
                                    'value'    => 'animated-color'
                                ],
                                [
                                    'name'     => 'content_type',
                                    'operator' => '===',
                                    'value'    => 'image'
                                ],
                                [
                                    'name'     => 'image_type',
                                    'operator' => '===',
                                    'value'    => 'custom-image'
                                ]
                            ]
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '===',
                                    'value'    => 'animated-image'
                                ],
                                [
                                    'name'     => 'image_type',
                                    'operator' => '===',
                                    'value'    => 'custom-image'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'         => 'thumbnail',
                'default'      => 'full',
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'image[url]',
                                    'operator' => '!==',
                                    'value'    => ''
                                ],
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '===',
                                    'value'    => 'animated-image'
                                ]
                            ]
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'image[url]',
                                    'operator' => '!==',
                                    'value'    => ''
                                ],
                                [
                                    'name'     => 'content_type',
                                    'operator' => '===',
                                    'value'    => 'image'
                                ],
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '!==',
                                    'value'    => 'animated-color'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'       => __( 'Icon', 'rivet-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid'
                ],
                'condition'   => [
                    'content_type'    => 'icon',
                    'animation_type!' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_control(
            'text',
            [
                'label'       => __( 'Text', 'rivet-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Your Text', 'rivet-core' ),
                'condition'   => [
                    'content_type'    => 'text',
                    'animation_type!' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_control(
            'animated_image_color_type',
            [
                'label'     => __( 'Type', 'rivet-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'rivet-animated-transform-1 8s linear infinite alternate forwards',
                'options'   => [
                    'rivet-animated-transform-1 8s linear infinite alternate forwards' => __( 'Type 1', 'rivet-core' ),
                    'rivet-animated-transform-2 8s ease-in-out infinite'               => __( 'Type 2', 'rivet-core' ),
                    'rivet-animated-transform-3 8s ease-in-out alternate infinite'     => __( 'Type 3', 'rivet-core' ),
                    'rivet-animated-transform-4 8s infinite'                           => __( 'Type 4', 'rivet-core' ),
                    'rivet-animated-transform-5 5s linear infinite'                    => __( 'Type 5', 'rivet-core' )
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivet-animation-widget img, {{WRAPPER}} .rivet-animation-widget span.rivet-animation-widget-color' => '-webkit-animation: {{VALUE}}; -moz-animation: {{VALUE}}; -ms-animation: {{VALUE}}; -o-animation: {{VALUE}}; animation: {{VALUE}};'
                ],
                'condition' => [
                    'animation_type' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_control(
            'infinite_animation_type',
            [
                'label'     => __( 'Infinite Type', 'rivet-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'rivet-circle-small 15s normal infinite linear',
                'options'   => [
                    'rivet-circle-small 15s normal infinite linear'         => __( 'Circle Small', 'rivet-core' ),
                    'rivet-circle-medium 25s normal infinite linear'        => __( 'Circle Medium', 'rivet-core' ),
                    'rivet-circle-large 35s normal infinite linear'         => __( 'Circle Large', 'rivet-core' ),
                    'rivet-fade-in-out 5s normal infinite linear'           => __( 'Fade In Out', 'rivet-core' ),
                    'rivet-flipX 2s infinite'                               => __( 'flipX', 'rivet-core' ),
                    'rivet-flipY 2s infinite'                               => __( 'flipY', 'rivet-core' ),
                    'rivet-vsm-y-move 5s alternate infinite linear'         => __( 'Move Y Very Small', 'rivet-core' ),
                    'rivet-vsm-y-reverse-move 5s alternate infinite linear' => __( 'Move Y Very Small ( Reverse )', 'rivet-core' ),
                    'rivet-sm-y-move 15s alternate infinite linear'         => __( 'Move Y Small', 'rivet-core' ),
                    'rivet-md-y-move 25s alternate infinite linear'         => __( 'Move Y Medium', 'rivet-core' ),
                    'rivet-lg-y-move 35s alternate infinite linear'         => __( 'Move Y Large', 'rivet-core' ),
                    'rivet-sm-x-move 15s alternate infinite linear'         => __( 'Move X Small', 'rivet-core' ),
                    'rivet-md-x-move 25s alternate infinite linear'         => __( 'Move X Medium', 'rivet-core' ),
                    'rivet-lg-x-move 35s alternate infinite linear'         => __( 'Move X Large', 'rivet-core' ),
                    'rivet-sm-xy-move 5s alternate infinite linear'         => __( 'Move XY Small', 'rivet-core' ),
                    'rivet-md-xy-move 10s alternate infinite linear'        => __( 'Move XY Medium', 'rivet-core' ),
                    'rivet-lg-xy-move 15s alternate infinite linear'        => __( 'Move XY Large', 'rivet-core' ),
                    'rivet-sm-yx-move 5s alternate infinite linear'         => __( 'Move YX Small', 'rivet-core' ),
                    'rivet-md-yx-move 10s alternate infinite linear'        => __( 'Move YX Medium', 'rivet-core' ),
                    'rivet-lg-yx-move 15s alternate infinite linear'        => __( 'Move YX Large', 'rivet-core' ),
                    'rivet-rotate-x 15s normal infinite linear'             => __( 'Rotate X', 'rivet-core' ),
                    'rivet-rotate-y 15s normal infinite linear'             => __( 'Rotate Y', 'rivet-core' ),
                    'rivet-swing 5s infinite both'                         => __( 'Swing', 'rivet-core' ),
                    'rivet-zoom-in-out 3s normal infinite linear'           => __( 'Zoom In Out', 'rivet-core' )
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivet-animation-widget img, {{WRAPPER}} .rivet-animation-widget i, {{WRAPPER}} .rivet-animation-widget .rivet-animation-widget-text, {{WRAPPER}} .rivet-animation-widget span.rivet-animation-widget-color' => '-webkit-animation: {{VALUE}}; -moz-animation: {{VALUE}}; -ms-animation: {{VALUE}}; -o-animation: {{VALUE}}; animation: {{VALUE}};'
                ],
                'condition' => [
                    'animation_type' => [ 'infinite-animation-parallax', 'infinite-animation' ]
                ]
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
                    '{{WRAPPER}} .rivet-animation-widget' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'enable_custom_duration',
            [
                'label'        => __( 'Custom Animation Duration', 'rivet-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'animation_type' => [ 'animated-image', 'animated-color', 'infinite-animation', 'infinite-animation-parallax' ]
                ]
            ]
        );
        
        $this->add_responsive_control(
            'custom_duration',
            [
                'label'        => __( 'Set Animation Duration', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => 35,
                        'step' => 1
                    ]
                ],
                'description'  => __( 'Set custom animation duration in second( unit ).', 'rivet-core' ),
                'selectors'    => [
                    '{{WRAPPER}} .rivet-animation-widget img, {{WRAPPER}} .rivet-animation-widget i, {{WRAPPER}} .rivet-animation-widget .rivet-animation-widget-text, {{WRAPPER}} .rivet-animation-widget span.rivet-animation-widget-color' => '-webkit-animation-duration: {{SIZE}}s; -moz-animation-duration: {{SIZE}}s; -ms-animation-duration: {{SIZE}}s; -o-animation-duration: {{SIZE}}s; animation-duration: {{SIZE}}s;'
                ],
                'condition'    => [
                    'enable_custom_duration' => 'yes',
                    'animation_type'           => [ 'animated-image', 'animated-color', 'infinite-animation', 'infinite-animation-parallax' ]
                ]  
            ]
        );

        $this->add_responsive_control(
            'z_index',
            [
                'label'     => __( 'Z Index', 'rivet-core' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => -100,
                'max'       => 999,
                'step'      => 1,
                'default'   => 0,
                'selectors' => [
                    '{{WRAPPER}} .rivet-animation-widget' => 'z-index: {{SIZE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'rotate_along',
            [
                'label'       => __( 'Rotation Along', 'rivet-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'z-axis',
                'options'     => [
                    'x-axis'  => __( 'X - axis', 'rivet-core' ),
                    'y-axis'  => __( 'Y - axis', 'rivet-core' ),
                    'z-axis'  => __( 'Z - axis', 'rivet-core' )
                ],
                'condition'   => [
                    'animation_type!' => [ 'tilt', 'mouse-track', 'parallax', 'infinite-animation-parallax' ]
                ]
            ]
        );      
        
        $this->add_responsive_control(
            'rotate_x',
            [
                'label'               => __( 'Rotation X - axis', 'rivet-core' ),
                'type'                => Controls_Manager::SLIDER,
                'range'               => [
                    'px'              => [
                        'min'         => 0,
                        'max'         => 360,
                        'step'        => 1
                    ]
                ],
                'selectors'           => [
                    '{{WRAPPER}}'     => '-webkit-transform: rotateX({{SIZE}}deg); -moz-transform: rotateX({{SIZE}}deg); -ms-transform: rotateX({{SIZE}}deg); -o-transform: rotateX({{SIZE}}deg); transform: rotateX({{SIZE}}deg);'
                ],
                'condition'           => [
                    'rotate_along'    => 'x-axis',
                    'animation_type!' => [ 'tilt', 'mouse-track', 'parallax', 'infinite-animation-parallax' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'rotate_y',
            [
                'label'               => __( 'Rotation Y - axis', 'rivet-core' ),
                'type'                => Controls_Manager::SLIDER,
                'range'               => [
                    'px'              => [
                        'min'         => 0,
                        'max'         => 360,
                        'step'        => 1
                    ]
                ],
                'selectors'           => [
                    '{{WRAPPER}}'     => '-webkit-transform: rotateY({{SIZE}}deg); -moz-transform: rotateY({{SIZE}}deg); -ms-transform: rotateY({{SIZE}}deg); -o-transform: rotateY({{SIZE}}deg); transform: rotateY({{SIZE}}deg);'
                ],
                'condition'           => [
                    'rotate_along'    => 'y-axis',
                    'animation_type!' => [ 'tilt', 'mouse-track', 'parallax', 'infinite-animation-parallax' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'rotate_z',
            [
                'label'               => __( 'Rotation Z - axis', 'rivet-core' ),
                'type'                => Controls_Manager::SLIDER,
                'range'               => [
                    'px'              => [
                        'min'         => 0,
                        'max'         => 360,
                        'step'        => 1
                    ]
                ],
                'selectors'           => [
                    '{{WRAPPER}}'     => '-webkit-transform: rotateZ({{SIZE}}deg); -moz-transform: rotateZ({{SIZE}}deg); -ms-transform: rotateZ({{SIZE}}deg); -o-transform: rotateZ({{SIZE}}deg); transform: rotateZ({{SIZE}}deg);'
                ],
                'condition'           => [
                    'rotate_along'    => 'z-axis',
                    'animation_type!' => [ 'tilt', 'mouse-track', 'parallax', 'infinite-animation-parallax' ]
                ]
            ]
        );
        
        $this->add_responsive_control(
            'item_opacity',
            [
                'label'        => __( 'Opacity', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'default'      => [
                    'size'     => 1
                ],
                'range'        => [
                    'px'       => [
                        'max'  => 1,
                        'step' => 0.01
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .rivet-animation-widget' => 'opacity: {{SIZE}}'
                    
                ]
            ]
        );

        $this->add_responsive_control(
            'responsive_show_hide',
            [
                'label'           => __( 'Show / Hide', 'rivet-core' ),
                'description'     => __( 'To show or hide in the responsive devices.', 'rivet-core' ),
                'type'            => Controls_Manager::CHOOSE,
                'default'         => 'flex',
                'options'         => [
                    'flex'        => [
                        'title'   => __( 'Show', 'rivet-core' ),
                        'icon'    => ' eicon-preview-medium'
                    ],
                    'none'        => [
                        'title'   => __( 'Hide', 'rivet-core' ),
                        'icon'    => 'eicon-editor-close'
                    ]
                ],
                'selectors'       => [
                    '{{WRAPPER}} .rivet-animation-widget' => 'display: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tilt',
            [
                'label'     => __( 'Tilt', 'rivet-core' ),
                'condition' => [
                    'animation_type' => 'tilt'
                ]
            ]
        );

        $this->add_control(
            'maxtilt',
            [
                'label'       => __( 'maxTilt', 'rivet-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 20,
                'description' => __( 'Default: 20.', 'rivet-core' )
            ]
        );

        $this->add_control(
            'perspective',
            [
                'label'       => __( 'Perspective', 'rivet-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 1000,
                'description' => __( 'Transform perspective, the lower the more extreme the tilt gets. Default: 1000', 'rivet-core' )
            ]
        );

        $this->add_control(
            'scale',
            [
                'label'       => __( 'Scale', 'rivet-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 1,
                'description' => __( 'On hover it\'ll be scaled. Here, 1 = 100%, 1.5 = 150%, 2 = 200%, etc...Default: 1', 'rivet-core' )
            ]
        );

        $this->add_control(
            'tilt_speed',
            [
                'label'       => __( 'Speed', 'rivet-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 300,
                'description' => __( 'Speed of the enter/exit transition. Default: 300', 'rivet-core' )
            ]
        );

        $this->add_control(
            'glare',
            [
                'label'        => __( 'Glare', 'rivet-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'maxglare',
            [
                'label'        => __( 'maxGlare', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => .1
                    ]
                ],
                'default'      => [
                    'size'     => .3
                ],
                'description'  => __( 'Data range isrom 0 - 1. Default: .3', 'rivet-core' ),
                'condition'    => [
                    'glare'    => 'yes'
                ]
            ]
        );

        $this->add_control(
            'reset',
            [
                'label'        => __( 'Reset', 'rivet-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'description'  => __( 'Disabling this option will not reset the tilt element when the user mouse leaves the element.', 'rivet-core' ),
            ]
        );

        $this->add_control(
            'enable_axis',
            [
                'label'    => __( 'Enable Axis', 'rivet-core' ),
                'type'     => Controls_Manager::SELECT,
                'default'  => 'null',
                'options'  => [
                    'null' => __( 'Both', 'rivet-core' ),
                    'x'    => __( 'X', 'rivet-core' ),
                    'y'    => __( 'Y', 'rivet-core' )
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_mouse_track',
            [
                'label'     => __( 'Mouse Track', 'rivet-core' ),
                'condition' => [
                    'animation_type' => 'mouse-track'
                ]
            ]
        );

        $this->add_control(
            'mouse_speed',
            [
                'label'        => __( 'Speed', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -10,
                        'step' => 0.1,
                        'max'  => 10
                    ]
                ],
                'default'      => [
                    'size'     => 1.5
                ],
                'description'  => __( 'Negative value will work on mouse direction. Positive value will work on mouse reverse direction.', 'rivet-core' )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_parallax',
            [
                'label'     => __( 'Parallax', 'rivet-core' ),
                'condition' => [
                    'animation_type' => [ 'parallax', 'infinite-animation-parallax' ]
                ]
            ]
        );

        $this->add_control(
            'x_axis_translation',
            [
                'label'        => __( 'X', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of scrolling at horizontal(X) axis. unit: pixels', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 0
                ]
            ]
        );

        $this->add_control(
            'y_axis_translation',
            [
                'label'        => __( 'Y', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of scrolling at vertical(Y) axis.', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 110
                ]
            ]
        );

        $this->add_control(
            'x_axis_rotation',
            [
                'label'        => __( 'rotateX', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of rotation at horizontal(X) axis. unit: degrees', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ]
            ]
        );

        $this->add_control(
            'y_axis_rotation',
            [
                'label'        => __( 'rotateY', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of rotation at vertical(Y) axis. unit: degrees', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ]
            ]
        );

        $this->add_control(
            'z_axis_rotation',
            [
                'label'        => __( 'rotateZ', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of rotation at Z axis. unit: degrees', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ]
            ]
        );

        $this->add_control(
            'global_scale',
            [
                'label'        => __( 'scale( global )', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of global scale. unit: ratio', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'step' => 0.1,
                        'max'  => 3
                    ]
                ],
                'default'      => [
                    'size'     => 1
                ]
            ]
        );

        $this->add_control(
            'disable_parallax_at_responsive_big_tablet',
            [
                'label'        => __( 'Disable Parallax at Big Tablet.', 'rivet-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'label'        => __( 'Disable Parallax at Responsive Devices ( screen size < 1200px ).', 'rivet-core' ),
            ]
        );

        $this->add_control(
            'disable_parallax_at_responsive_small_tablet',
            [
                'label'        => __( 'Disable Parallax at Big Tablet.', 'rivet-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'label'        => __( 'Disable Parallax at Responsive Devices ( screen size < 992px ).', 'rivet-core' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label'        => __( 'Image', 'rivet-core' ),
                'tab'          => Controls_Manager::TAB_STYLE,
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'image[url]',
                                    'operator' => '!==',
                                    'value'    => ''
                                ],
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '===',
                                    'value'    => 'animated-image'
                                ]
                            ]
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'image[url]',
                                    'operator' => '!==',
                                    'value'    => ''
                                ],
                                [
                                    'name'     => 'content_type',
                                    'operator' => '===',
                                    'value'    => 'image'
                                ],
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '!==',
                                    'value'    => 'animated-color'
                                ]
                            ]
                        ]
                    ]
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
                    '{{WRAPPER}} .rivet-animation-widget img' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'        => __( 'Width', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%', 'em' ],
                'range'        => [
                    'px'       => [
                        'min'  => 50,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .rivet-animation-widget img' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => __( 'Padding', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-animation-widget img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __( 'Margin', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-animation-widget img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'selector' => '{{WRAPPER}} .rivet-animation-widget img'
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-animation-widget img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'animation_type!' => 'animated-image'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .rivet-animation-widget img'
            ]
        );

        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'image_css_filters',
				'selector' => '{{WRAPPER}} .rivet-animation-widget img'
			]
		);

        $this->add_control(
            'image_backdrop_filter',
            [
                'label'    => __( 'Backdrop Filter', 'rivet-core' ),
                'type'     => Controls_Manager::TEXT,
                'selectors' => [
                    '{{WRAPPER}} .rivet-animation-widget img' => 'backdrop-filter: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label'     => __( 'Icon', 'rivet-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_type'    => 'icon',
                    'animation_type!' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_control(
          'icon_color',
            [
                'label'     => __( 'Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-animation-widget i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rivet-animation-widget svg' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
          'icon_bg_color',
            [
                'label'     => __( 'Background Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-animation-widget i, {{WRAPPER}} .rivet-animation-widget svg'   => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'       => __( 'Icon Size', 'rivet-core' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size'    => 35
                ],
                'range'       => [
                    'px'      => [
                        'max' => 750
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .rivet-animation-widget i, {{WRAPPER}} .rivet-animation-widget' => 'font-size: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => __( 'Padding', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-animation-widget i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __( 'Margin', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-animation-widget i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'selector' => '{{WRAPPER}} .rivet-animation-widget i'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .rivet-animation-widget i'
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label'      => __( 'Border Radius', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-animation-widget i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'text_style',
            [
                'label'     => __( 'Text', 'rivet-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_type'    => 'text',
                    'animation_type!' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'selector' => '{{WRAPPER}} span.rivet-animation-widget-text'
            ]
        );

        $this->add_control(
          'text_color',
            [
                'label'     => __( 'Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} span.rivet-animation-widget-text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'text_margin',
            [
                'label'      => __( 'Margin', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} span.rivet-animation-widget-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'color_style',
            [
                'label'        => __( 'Color', 'rivet-core' ),
                'tab'          => Controls_Manager::TAB_STYLE,
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'content_type',
                                    'operator' => '===',
                                    'value'    => 'color'
                                ],
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '!==',
                                    'value'    => [ 'animated-image', 'animated-color' ]
                                ]
                            ]
                        ],
                        [
                            'name'     => 'animation_type',
                            'operator' => '===',
                            'value'    => 'animated-color'
                        ]
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'            => 'colors_color',
                'types'           => [ 'classic', 'gradient' ],
                'selector'        => '{{WRAPPER}} .rivet-animation-widget .rivet-animation-widget-color',
                'exclude'         => [ 'image' ],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => $primary_color
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'color_height',
            [
                'label'        => __( 'Height', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 5,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 80
                ],
                'selectors'    => [
                    '{{WRAPPER}} .rivet-animation-widget .rivet-animation-widget-color' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'color_width',
            [
                'label'        => __( 'Width', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 5,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 80
                ],
                'selectors'    => [
                    '{{WRAPPER}} .rivet-animation-widget .rivet-animation-widget-color' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'color_padding',
            [
                'label'      => __( 'Padding', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-animation-widget .rivet-animation-widget-color' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'color_margin',
            [
                'label'      => __( 'Margin', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-animation-widget .rivet-animation-widget-color' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'color_border',
                'selector' => '{{WRAPPER}} .rivet-animation-widget .rivet-animation-widget-color'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'color_box_shadow',
                'selector' => '{{WRAPPER}} .rivet-animation-widget .rivet-animation-widget-color'
            ]
        );

        $this->add_responsive_control(
            'color_border_radius',
            [
                'label'      => __( 'Border Radius', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'condition'  => [
                    'animation_type!' => 'animated-color'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-animation-widget .rivet-animation-widget-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
        $settings       = $this->get_settings_for_display();
        $content_type   = '';
        $animation_type = $settings['animation_type'];

        $this->add_render_attribute(
            'container',
            [
                'class' => [
                    'rivet-animation-widget',
                    'rivet-animation-display-type-' . esc_attr( $animation_type )
                ]
            ]
        );

        if ( 'animated-image' !== $animation_type && 'animated-color' !== $animation_type ) :
            $content_type = $settings['content_type'];
            $this->add_render_attribute( 'container', 'class', 'rivet-animation-content-type-' . esc_attr( $content_type ) );
        else :
            $this->add_render_attribute( 'container', 'class', 'rivet-animated-morph-type-' . esc_attr( $settings['animated_image_color_type'] ) );
        endif;

        if ( 'tilt' === $animation_type ) :
            $this->add_render_attribute(
                'container',
                [
                    'class'            => 'rivet-tilt-item',
                    'data-maxtilt'     => esc_attr( $settings['maxtilt'] ),
                    'data-perspective' => esc_attr( $settings['perspective'] ),
                    'data-scale'       => esc_attr( $settings['scale'] ),
                    'data-speed'       => esc_attr( $settings['tilt_speed'] ),
                    'data-axis'        => esc_attr( $settings['enable_axis'] )
                ]
            );

            if ( 'yes' === $settings['glare'] ) :
                $this->add_render_attribute( 'container', 'data-glare', 'true' );
                $this->add_render_attribute( 'container', 'data-maxglare', esc_attr( $settings['maxglare']['size'] ) );
            endif;

            if ( 'yes' !== $settings['reset'] ) :
                $this->add_render_attribute( 'container', 'data-reset', 'false' );
            endif;
        elseif ( 'mouse-track' === $animation_type ) :
            $this->add_render_attribute( 'container', 'class', 'rivet-mouse-track-item' );
        elseif ( 'parallax' === $animation_type || 'infinite-animation-parallax' === $animation_type  ) :

            $x_axis_translation = $settings['x_axis_translation']['size'] ? $settings['x_axis_translation']['size'] : 0;
            $y_axis_translation = $settings['y_axis_translation']['size'] ? $settings['y_axis_translation']['size'] : 0;
            $x_axis_rotation    = $settings['x_axis_rotation']['size'] ? $settings['x_axis_rotation']['size'] : 0;
            $y_axis_rotation    = $settings['y_axis_rotation']['size'] ? $settings['y_axis_rotation']['size'] : 0;
            $z_axis_rotation    = $settings['z_axis_rotation']['size'] ? $settings['z_axis_rotation']['size'] : 0;
            $global_scale       = $settings['global_scale']['size'] ? $settings['global_scale']['size'] : 1;

            $this->add_render_attribute(
                'container',
                [
                    'class'         => 'rivet-parallax-item',
                    'data-parallax' => '{"x": ' . esc_attr( $x_axis_translation ) . ', "y": ' . esc_attr( $y_axis_translation ) . ', "rotateX": ' . esc_attr( $x_axis_rotation ) . ', "rotateY": ' . esc_attr( $y_axis_rotation ) . ', "rotateZ": ' . esc_attr( $z_axis_rotation ) . ', "scale": ' . esc_attr( $global_scale ) . '}'
                ]
            );

            if ( 'yes' === $settings['disable_parallax_at_responsive_big_tablet'] ) :
                $this->add_render_attribute( 'container', 'class', 'rivet-parallax-disable-at-big-tablet' );
            endif;

            if ( 'yes' === $settings['disable_parallax_at_responsive_small_tablet'] ) :
                $this->add_render_attribute( 'container', 'class', 'rivet-parallax-disable-at-small-tablet' );
            endif;
        endif;
        
        echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
            if ( 'animated-image' !== $animation_type && 'animated-color' !== $animation_type  ) :
                if ( 'mouse-track' === $animation_type ) :
                    echo '<span data-depth="' . esc_attr( $settings['mouse_speed']['size'] ) . '">';
                endif;
                if ( 'image' === $content_type ) :
                    if ( 'custom-image' === $settings['image_type'] )  :
                        echo '<img src="' . esc_url( $this->render_image( $settings ) ) . '" alt="' . Control_Media::get_image_alt( $settings['image'] ) . '">';
                    else :
                        echo '<img src="' . RIVET_ASSETS_URL . 'images/predefined-images/' . esc_attr( $settings['predefined_image'] ) . '" alt="">';
                    endif;
                elseif ( 'icon' === $content_type ) :
                    Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                elseif ( 'text' === $content_type ) :
                    echo $settings['text'] ? '<span class="rivet-animation-widget-text">' . esc_html( $settings['text'] ) . '</span>' : '';
                elseif ( 'color' === $content_type ) :
                    echo '<span class="rivet-animation-widget-color"></span>';
                endif;
                if ( 'mouse-track' === $animation_type ) :
                    echo '</span>';
                endif;
            elseif ( 'animated-image' === $animation_type ) :
                if ( 'custom-image' === $settings['image_type'] )  :
                    echo '<img src="' . esc_url( $this->render_image( $settings ) ) . '" alt="' . Control_Media::get_image_alt( $settings['image'] ) . '">';
                else :
                    echo '<img src="' . RIVET_ASSETS_URL . 'images/predefined-images/' . esc_attr( $settings['predefined_image'] ) . '" alt="">';
                endif;
            elseif ( 'animated-color' === $animation_type ) :
                echo '<span class="rivet-animation-widget-color"></span>';
            endif;
        echo '</div>';
    }

    /**
     * return image URL for static course categories
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_image( $settings ) {
        $image     = $settings['image'];
        $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
        if ( empty( $image_url ) ) :
            $image_url = $image['url'];
        else :
            $image_url = $image_url;
        endif;
        return $image_url;
    }
}
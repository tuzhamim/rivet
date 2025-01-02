<?php

namespace RivetCore\HF\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Rivet Core
 *
 * Elementor widget for footer menu.
 *
 * @since 1.0.0
 */
class Copyright extends Widget_Base {

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
		return 'rivet-footer-copyright';
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
		return __( 'Copyright', 'rivet-core' );
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
        return 'rivet-elementor-icon eicon-footer';
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
		return [ 'rivet', 'copy', 'right', 'footer' ];
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
		return [ 'rivet_hf_elementor_widgets' ];
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
            'section_copyright',
            [
                'label' => __( 'Copyright', 'rivet-core' )
            ]
        );

        $this->add_control(
			'shortcode',
			[
				'label'   => __( 'Copyright Text', 'rivet-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Copyright [rivet_core_running_year] [rivet_core_site_title] | Developed By DevsVibe. All Rights Reserved', 'rivet-core' )
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'copyright_style',
            [
                'label'     => __( 'Copyright', 'rivet-core' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'rivet-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'left' => [
                        'title'  => __( 'Left', 'rivet-core' ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'rivet-core' ),
                        'icon'   => 'eicon-h-align-center'
                    ],
                    'right'   => [
                        'title'  => __( 'Right', 'rivet-core' ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .rivet-copyright-wrapper' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .rivet-copyright-wrapper span'
            ]
        );

        $this->add_control(
            'color',
            [
                'label'     => __( 'Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-copyright-wrapper span, {{WRAPPER}} .rivet-copyright-wrapper a' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'       => __( 'Link Color', 'rivet-core' ),
                'type'        => Controls_Manager::COLOR,
                'description' => __( 'Only applicable if there is any link.', 'rivet-core' ),
                'selectors'   => [
                    '{{WRAPPER}} .rivet-copyright-wrapper span a' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label'       => __( 'Link Hover Color', 'rivet-core' ),
                'type'        => Controls_Manager::COLOR,
                'default'     => $primary_color,
                'description' => __( 'Only applicable if there is any link.', 'rivet-core' ), 
                'selectors'   => [
                    '{{WRAPPER}} .rivet-copyright-wrapper a:hover' => 'color: {{VALUE}}'
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
        $copyright = do_shortcode( shortcode_unautop( $settings['shortcode'] ) );

        echo '<div class="rivet-copyright-wrapper">';
            echo '<span>' . wp_kses_post( $copyright ) . '</span>';
        echo '</div>';
    }
}
<?php

namespace RivetCore\Widgets;

use \RivetCore\Helper;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Rivet Core
 *
 * Elementor widget for counterup.
 *
 * @since 1.0.0
 */
class Contact_Form_Seven extends Widget_Base {

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
		return 'rivet-contact-form-seven';
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
		return __( 'Contact Form 7', 'rivet-core' );
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
        return 'rivet-elementor-icon eicon-mail';
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
		return [ 'rivet', 'contact', 'form', 'seven', '7', 'cf7', 'send', 'query' ];
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

        if ( ! class_exists( 'WPCF7_ContactForm' ) ) :

            $this->start_controls_section(
                'alert_section',
                [
                    'label' => __( 'Alert!', 'rivet-core' ),
                ]
            );

            $this->add_control(
                'alert_text',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => __( '<strong>contact Form 7</strong> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=contact+form+7&tab=search&type=term" target="_blank">Contact Form 7</a> first.', 'rivet-core' ),
                    'content_classes' => 'rivet-elementor-widget-alert elementor-panel-alert elementor-panel-alert-warning'
                ]
            );

            $this->end_controls_section();

            return;

        endif;

  		$this->start_controls_section(
            'section_contact_form_seven',
            [
                'label' => __( 'Contact Form 7', 'rivet-core' )
            ]
        );

        $this->add_control(
            'forms',
            [
                'label'       => __( 'Select a Form', 'rivet-core' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'options'     => Helper::retrieve_posts( 'wpcf7_contact_form', true ),
                'default'     => 0,
                'description' => __( 'It\'s a list of all the contact forms you\'ve created with the <strong>Contact Form 7</strong> from the admin panel.', 'rivet-core' )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'container_style',
            [
                'label' => __( 'Container', 'rivet-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'container_background_color',
            [
                'label'     => __( 'Background Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-contact-form-single-item-content' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label'      => __( 'Padding', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],                
                'selectors'  => [
                    '{{WRAPPER}} .rivet-contact-form-single-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'container_border',
                'selector' => '{{WRAPPER}} .rivet-contact-form-single-item-content'
            ]
        );

        $this->add_responsive_control(
            'container_border_radius',
            [
                'label'      => __( 'Border Radius', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .rivet-contact-form-single-item-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'label_style',
            [
                'label'     => __( 'Label', 'rivet-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'selector' => '{{WRAPPER}} .rivet-contact-form-single-item label'
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => __( 'Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-contact-form-single-item label' => 'color: {{VALUE}};'
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

        $this->add_render_attribute( 'contact-form-wrapper', 'class', 'rivet-contact-form-wrapper' );

        if ( ! empty( $settings['forms'] ) ) :
            echo '<div ' . $this->get_render_attribute_string( 'contact-form-wrapper' ) . '>';                    
                echo do_shortcode( '[contact-form-7 id="' . esc_attr( $settings['forms'] ) . '" ]' );
            echo '</div>';
        endif;
    }
}
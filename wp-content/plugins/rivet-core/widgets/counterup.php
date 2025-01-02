<?php
namespace RivetCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Plugin;
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
class Counter_Up extends Widget_Base {

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
		return 'rivet-counterup';
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
		return __( 'Counter Up', 'rivet-core' );
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
        return 'rivet-elementor-icon eicon-counter';
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
		return [ 'jquery-odometer', 'jquery-viewport' ];
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
        return [ 'jquery-odometer' ];
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
		return [ 'rivet', 'up', 'counter', 'increase', 'counter up', 'count up', 'odometer' ];
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
            'section_counter_up',
            [
                'label' => __( 'CounterUp', 'rivet-core' )
            ]
        );

        $this->add_control(
            'ending_number',
            [
                'label'   => __( 'Ending Number', 'rivet-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '52,147'
            ]
        );

        $this->add_control(
			'prefix',
			[
				'label'       => __( 'Number Prefix', 'rivet-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => 1
			]
		);

		$this->add_control(
			'suffix',
			[
				'label'       => __( 'Number Suffix', 'rivet-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( '+', 'rivet-core' )
			]
		);

        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'rivet-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'toggle'         => false,
                'label_block'    => false,
                'default'        => 'text-center',
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
                'selectors'     => [
                    '{{WRAPPER}} .rivet-counter-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
          'ending_number_style',
            [
                'label'      => __( 'Ending Number', 'rivet-core' ),
                'tab'        => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ending_number_typography',
                'selector' => '{{WRAPPER}} .rivet-counter-item'
            ]
        );

        $this->add_control(
          'ending_number_color',
            [
                'label'     => __( 'Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-counter-item' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'ending_number_margin',
            [
                'label'      => __( 'Margin', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-counter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'ending_number_padding',
            [
                'label'      => __( 'Padding', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-counter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
          'prefix_style',
            [
                'label'       => __( 'Prefix', 'rivet-core' ),
                'tab'         => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'prefix!' => ''
				]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'prefix_typography',
                'selector' => '{{WRAPPER}} .rivet-counter-prefix'
            ]
        );

        $this->add_control(
          'prefix_color',
            [
                'label'     => __( 'Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-counter-prefix' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'prefix_margin',
            [
                'label'      => __( 'Margin', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-counter-prefix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'prefix_padding',
            [
                'label'      => __( 'Padding', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-counter-prefix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
          'suffix_style',
            [
                'label'       => __( 'Suffix', 'rivet-core' ),
                'tab'         => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'suffix!' => ''
				]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'suffix_typography',
                'selector' => '{{WRAPPER}} .rivet-counter-suffix'
            ]
        );

        $this->add_control(
          'suffix_color',
            [
                'label'     => __( 'Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-counter-suffix' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'suffix_margin',
            [
                'label'      => __( 'Margin', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-counter-suffix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'suffix_padding',
            [
                'label'      => __( 'Padding', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-counter-suffix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
        echo '<div class="rivet-counter-item" id="' . esc_attr( $this->get_id() ) . '">';
            echo $settings['prefix'] ? '<span class="rivet-counter-prefix">' . esc_html( $settings['prefix'] ). '</span>' : '';
            echo '<span class="odometer" data-odometer-final="' . esc_attr( $settings['ending_number']). '">';
                if ( Plugin::$instance->editor->is_edit_mode() ) :
                    echo esc_html( $settings['ending_number'] );
                endif;
            echo '</span>';
            echo $settings['suffix'] ? '<span class="rivet-counter-suffix">' . esc_html( $settings['suffix'] ). '</span>' : '';
        echo '</div>';
    }
}
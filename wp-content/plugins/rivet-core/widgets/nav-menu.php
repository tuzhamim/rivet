<?php

namespace RivetCore\HF\Widgets;

use \Rivet\Navwalker\WP_Bootstrap_Navwalker;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Plugin;
use \Elementor\Widget_Base;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Rivet Core
 *
 * Elementor widget for navigation menu.
 *
 * @since 1.0.0
 */
class Nav_Menu extends Widget_Base {

    /**
     * Menu index.
     *
     * @access protected
     * @var $nav_menu_index
     */
    protected $nav_menu_index = 1;

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
		return 'rivet-nav-menu';
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
		return __( 'Nav Menu', 'rivet-core' );
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
        return 'rivet-elementor-icon eicon-nav-menu';
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
		return [ 'rivet', 'menu', 'nav', 'navigation' ];
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
     * Retrieve the menu index.
     *
     * Used to get index of nav menu.
     *
     * @since 1.0.0
     * @access protected
     *
     * @return string nav index.
     */
    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    /**
     * Retrieve the list of available menus.
     *
     * Used to get the list of available menus.
     *
     * @since 1.0.0
     * @access private
     *
     * @return array get WordPress menus list.
     */
    private function get_available_menus() {

        $menus   = wp_get_nav_menus();
        $options = [];
        foreach ( $menus as $menu ) :
            $options[ $menu->slug ] = $menu->name;
        endforeach;
        return $options;
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
        
        $this->start_controls_section(
            'section_nav_menu',
            [
                'label' => __( 'Nav Menu', 'rivet-core' )
            ]
        );

        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) :
            $this->add_control(
                'menu',
                [
                    'label'        => __( 'Menu', 'rivet-core' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'rivet-core' ), admin_url( 'nav-menus.php' ) )
                ]
            );
        else :
            $this->add_control(
                'menu_alert',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'rivet-core' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info'
                ]
            );
        endif;

        $this->add_responsive_control(
            'alignment',
            [
                'label'             => __( 'Alignment', 'rivet-core' ),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'flex-start'    => [
                        'title'     => __( 'Left', 'rivet-core' ),
                        'icon'      => 'eicon-h-align-left'
                    ],
                    'center'        => [
                        'title'     => __( 'Center', 'rivet-core' ),
                        'icon'      => 'eicon-h-align-center'
                    ],
                    'flex-end'      => [
                        'title'     => __( 'Right', 'rivet-core' ),
                        'icon'      => 'eicon-h-align-right'
                    ],
                    'space-between' => [
                        'title'     => __( 'Justify', 'rivet-core' ),
                        'icon'      => 'eicon-h-align-stretch'
                    ]
                ],
                'selectors'         => [
                    '{{WRAPPER}} .rivet-navbar-expand-lg .rivet-navbar-nav' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_menu_responsive',
            [
                'label' => __( 'Responsive', 'rivet-core' )
            ]
        );

        $this->add_control(
            'breakpoint',
            [
                'label'        => __( 'Breakpoint', 'rivet-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'tablet',
                'options'      => [
                    'mobile'   => __( 'Mobile (768px >)', 'rivet-core' ),
                    'tablet'   => __( 'Tablet (992px >)', 'rivet-core' ),
                    'big-tablet' => __( 'Big Tablet (1200px >)', 'rivet-core' ),
                    'none'     => __( 'None', 'rivet-core' )
                ],
                'prefix_class' => 'rivet-nav-menu-breakpoint-'
            ]
        );

        $this->add_control(
            'menu_icon',
            [
                'label'       => __( 'Menu Icon', 'rivet-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-bars',
                    'library' => 'fa-solid'
                ]
            ]
        );

        $this->add_control(
            'close_icon',
            [
                'label'       => __( 'Icon', 'rivet-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-times',
                    'library' => 'fa-solid'
                ]
            ]
        );

        $spacing = is_rtl() ? 'left' : 'right';
        $this->add_control(
            'toggle_alignment',
            [
                'label'          => __( 'Toggle Alignment', 'rivet-core' ),
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
                    '{{WRAPPER}} .rivet-elementor-mobile-hamburger-menu' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_menu_style',
            [
                'label' => __( 'Nav Menu', 'rivet-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'selector' => '{{WRAPPER}} .rivet-header-area.rivet-navbar-expand-lg ul.rivet-navbar-nav > li > a.nav-link'
            ]
        );

        $last_child_padding = is_rtl() ? 'left' : 'right';
        $this->add_responsive_control(
            'menu_padding',
            [
                'label'      => __( 'Padding', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-header-area.rivet-navbar-expand-lg ul.rivet-navbar-nav > li' => 'padding: 0 {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rivet-header-area.rivet-navbar-expand-lg ul.rivet-navbar-nav > li > a.nav-link' => 'padding: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    '{{WRAPPER}} .rivet-header-area.rivet-navbar-expand-lg ul.rivet-navbar-nav > li:last-child' => 'padding-' . $last_child_padding . ': 0;'
                ]
            ]
        );

        $this->add_responsive_control(
            'menu_margin',
            [
                'label'      => __( 'Margin', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-header-area.rivet-navbar-expand-lg ul.rivet-navbar-nav > li > a.nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'menu_style_tabs' );

            $this->start_controls_tab( 'menu_normal', [ 'label' => __( 'Normal', 'rivet-core' ) ] );

            $this->add_control(
                'menu_color',
                [
                    'label'     => __( 'Color', 'rivet-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rivet-header-area.rivet-navbar-expand-lg ul.rivet-navbar-nav > li > a.nav-link' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'menu_hover', [ 'label' => __( 'Hover', 'rivet-core' ) ] );

            $this->add_control(
                'menu_hover_color',
                [
                    'label'     => __( 'Color', 'rivet-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rivet-header-area.rivet-navbar-expand-lg ul.rivet-navbar-nav > li:hover > a.nav-link' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'menu_bar_style',
            [
                'label'     => __( 'Menu Bottom Bar', 'rivet-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'menu_bar_color',
            [
                'label'     => __( 'Color( Hover/Active )', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-header-area .main-navigation ul.rivet-navbar-nav > li.current-menu-item > a:after, {{WRAPPER}} .rivet-header-area .main-navigation ul.rivet-navbar-nav > li:hover > a:after' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'menu_bar_size',
            [
                'label'       => __( 'Size', 'rivet-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'max' => 10
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .rivet-header-area .main-navigation ul.rivet-navbar-nav > li > a:after'  => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'menu_bar_border_radius',
            [
                'label'      => __( 'Border Radius', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '5',
                    'right'    => '5',
                    'bottom'   => '0',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-header-area .main-navigation ul.rivet-navbar-nav > li > a:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'dropdown_style',
            [
                'label' => __( 'Dropdown', 'rivet-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'dropdwon_width',
            [
                'label'       => __( 'Width', 'rivet-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'max' => 800
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .rivet-header-area .main-navigation ul ul.rivet-dropdown-menu'  => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dropdown_typography',
                'selector' => '{{WRAPPER}} .rivet-header-area ul.rivet-navbar-nav .dropdown ul.rivet-dropdown-menu li a'
            ]
        );

        $this->add_responsive_control(
            'dropdown_menu_padding',
            [
                'label'      => __( 'Padding', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-header-area ul.rivet-navbar-nav .dropdown ul.rivet-dropdown-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'dropdown_menu_border_radius',
            [
                'label'      => __( 'Border Radius', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-header-area ul.rivet-navbar-nav .dropdown ul.rivet-dropdown-menu li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'dropdown_style_tabs' );

            $this->start_controls_tab( 'dropdown_normal', [ 'label' => __( 'Normal', 'rivet-core' ) ] );

            $this->add_control(
                'dropdown_color',
                [
                    'label'     => __( 'Color', 'rivet-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rivet-header-area ul.rivet-navbar-nav .dropdown ul.rivet-dropdown-menu li a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'dropdown_bg_color',
                [
                    'label'     => __( 'Background Color', 'rivet-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rivet-header-area ul.rivet-navbar-nav .dropdown ul.rivet-dropdown-menu li a' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'dropdown_hover', [ 'label' => __( 'Hover', 'rivet-core' ) ] );

            $this->add_control(
                'dropdown_hover_color',
                [
                    'label'     => __( 'Color', 'rivet-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rivet-header-area ul.rivet-navbar-nav .dropdown ul.rivet-dropdown-menu li a:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'dropdown_hover_bg_color',
                [
                    'label'     => __( 'Background Color', 'rivet-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rivet-header-area ul.rivet-navbar-nav .dropdown ul.rivet-dropdown-menu li a:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'responsive_style',
            [
                'label'     => __( 'Responsive', 'rivet-core' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'toggle_menu_color',
            [
                'label'     => __( 'Toggle Menu Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-elementor-mobile-hamburger-menu a, {{WRAPPER}} .rivet-header-transparent-enable .rivet-sticky-header-wrapper:not(.rivet-header-sticky) .rivet-elementor-mobile-hamburger-menu a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'toggle_menu_size',
            [
                'label'       => __( 'Toggle Menu Size', 'rivet-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'max' => 50
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .rivet-elementor-mobile-hamburger-menu a'  => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'close_icon_color',
            [
                'label'     => __( 'Close Icon Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-elementor-mobile-menu-close a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'close_icon_size',
            [
                'label'       => __( 'Close Icon Size', 'rivet-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'max' => 50
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .rivet-elementor-mobile-menu-close a'  => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label'     => __( 'Overlay Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-elementor-mobile-menu-overlay' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mobile_menu_padding',
            [
                'label'      => __( 'Mobile Menu Padding', 'rivet-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivet-mobile-menu-nav-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'mobile_menu_bg_color',
            [
                'label'     => __( 'Mobile Menu Background Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-mobile-menu-nav-wrapper' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'mobile_menu_color',
            [
                'label'     => __( 'Mobile Menu Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-mobile-menu-nav-wrapper ul li a, {{WRAPPER}} .rivet-header-transparent-enable .rivet-sticky-header-wrapper:not(.rivet-header-sticky) ul.rivet-elementor-mobile-menu-item > li > a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'mobile_menu_border',
                'selector' => '{{WRAPPER}} .rivet-mobile-menu-nav-wrapper ul li a, {{WRAPPER}} .rivet-header-transparent-enable .rivet-sticky-header-wrapper:not(.rivet-header-sticky) ul.rivet-elementor-mobile-menu-item > li > a'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'transparent_and_sticky_style',
            [
                'label'     => __( 'Transparent & Sticky', 'rivet-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'transparent_alert_text',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __( 'If you set this Header as Transparent and Sticky then this section style will work. This style will be applied when the transparent menu will be hidden and get sticky.', 'rivet-core' ),
                'content_classes' => 'rivet-elementor-widget-alert elementor-panel-alert elementor-panel-alert-warning'
            ]
        );

        $this->add_control(
            'toggle_menu_transparent_sticky_color',
            [
                'label'     => __( 'Toggle Menu Color', 'rivet-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.rivet-header-transparent-enable .rivet-sticky-header-wrapper.rivet-header-sticky {{WRAPPER}} .rivet-elementor-mobile-hamburger-menu a' => 'color: {{VALUE}};'
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
        $args = [
            'echo'        => false,
            'menu'        => $settings['menu'],
            'menu_class'  => 'rivet-navbar-nav rivet-navbar-right nav-menu rivet-nav-ul-wrapper',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => '__return_empty_string',
            'container'   => '',
            'walker'      => new WP_Bootstrap_Navwalker
        ];

        $menu_html = wp_nav_menu( $args );

        $this->add_render_attribute( 'wrapper', 'class', 'rivet-nav-menu-wrapper rivet-header-area rivet-navbar-expand-lg rivet-elementor-nav-menu-wrapper' );

        $this->add_render_attribute( 'menu', 'class', 'main-navigation rivet-navbar-collapse rivet-elementor-nav' );

        echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
            echo '<nav ' . $this->get_render_attribute_string( 'menu' ) . '>';
                echo trim( $menu_html );
            echo '</nav>';

            echo '<div class="rivet-default-header-mobile-navbar rivet-mobile-menu">';
                echo '<div class="rivet-elementor-mobile-menu-overlay"></div>';
                echo '<div class="rivet-elementor-mobile-hamburger-menu">';
                    echo '<a href="javascript:void(0);">';
                        Icons_Manager::render_icon( $settings['menu_icon'], [ 'aria-hidden' => 'true' ] );
                    echo '</a>';
                echo '</div>';
                echo '<div class="rivet-mobile-menu-nav-wrapper rivet-elementor-mobile-menu-nav-wrapper">';
                    echo '<div class="rivet-elementor-mobile-menu-close">';
                        echo '<a href="javascript:void(0);">';
                            Icons_Manager::render_icon( $settings['close_icon'], [ 'aria-hidden' => 'true' ] );
                        echo '</a>';
                    echo '</div>';
                    wp_nav_menu( array(
                        'menu'       => $settings['menu'],
                        'depth'      => 4,
                        'container'  => 'ul',
                        'menu_id'    => 'rivet-elementor-mobile-menu-item',
                        'menu_class' => 'rivet-elementor-mobile-menu-item'                     
                    ) );
                echo '</div>';
            echo '</div>';
        echo '</div>';

        if ( Plugin::$instance->editor->is_edit_mode() ) :
            $this->render_editor_script();
        endif;
    }

    private function render_editor_script(){ 
        ?>
        <script type="text/javascript">
            jQuery( document ).ready( function($) {
                $( '.main-navigation ul > li.mega-menu' ).each( function() {
                    let items       = $(this).find( ' > ul.rivet-dropdown-menu > li' ).length,
                    bodyWidth       = $( 'body' ).outerWidth(),
                    parentLinkWidth = $(this).find( ' > a' ).outerWidth(),
                    parentLinkpos   = $(this).find( ' > a' ).offset().left,
                    width           = items * 250,
                    left            = width / 2 - parentLinkWidth / 2,
                    linkleftWidth   = parentLinkpos + parentLinkWidth / 2,
                    linkRightWidth  = bodyWidth - (parentLinkpos + parentLinkWidth);

                    if (width / 2 > linkleftWidth) {
                        $(this).find( ' > ul.rivet-dropdown-menu' ).css( {
                            width: width + 'px',
                            right: 'inherit',
                            left: '-' + parentLinkpos + 'px'
                        } );
                    } else if (width / 2 > linkRightWidth) {
                        $(this).find( ' > ul.rivet-dropdown-menu' ).css( {
                            width: width + 'px',
                            left: 'inherit',
                            right: '-' + linkRightWidth + 'px'
                        } );
                    } else {
                        $(this).find( ' > ul.rivet-dropdown-menu' ).css( {
                            width: width + 'px',
                            left: '-' + left + 'px'
                        } );
                    }
                } );
            } );
        </script>
        <?php
    }
}
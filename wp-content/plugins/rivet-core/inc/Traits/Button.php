<?php

namespace Rivet_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;

trait Button {

    protected function style() {

        if( 'button' === $this->default_button_type ) :
            $this->start_controls_section(
                'button_style',
                [
                    'label'        => __( 'Button', 'rivet-core' ),
                    'tab'          => Controls_Manager::TAB_STYLE
                ]
            );
        else :
            $this->start_controls_section(
                'button_style',
                [
                    'label'        => __( 'Button', 'rivet-core' ),
                    'tab'          => Controls_Manager::TAB_STYLE,
                    'condition'    => [
                        'button_text!'  => ''
                    ]
                ]
            );
        endif;

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'         => 'button_typography',
                'selector'     => $this->button_normal
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'         => 'button_text_shadow',
                'selector'     => $this->button_normal
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'        => __( 'Padding', 'rivet-core' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%', 'em' ],
                'selectors'    => [
                    $this->button_normal => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_alignment',
            [
                'label'         => __( 'Alignment', 'rivet-core' ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'options'       => [
                    'left'      => [
                        'title' => __( 'Left', 'rivet-core' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'rivet-core' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'rivet-core' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors'     => [
                    $this->button_alignment => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_spacing',
            [
                'label'        => __( 'Bottom Spacing', 'rivet-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 80,
                        'step' => 1
                    ]
                ],
                'selectors'    => [
                    $this->button_normal => 'margin-bottom: {{SIZE}}px;'
                ]
            ]
        );

        $this->start_controls_tabs( 'button_style_tabs' );

            $this->start_controls_tab( 'button_normal', [ 'label' => __( 'Normal', 'rivet-core' ) ] );

            $this->add_control(
              'button_color',
                [
                    'label'      => __( 'Color', 'rivet-core' ),
                    'type'       => Controls_Manager::COLOR,
                    'selectors'  => [
                        $this->button_normal => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
              'button_bg_color',
                [
                    'label'      => __( 'Background Color', 'rivet-core' ),
                    'type'       => Controls_Manager::COLOR,
                    'selectors'  => [
                        $this->button_normal => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'       => 'button_border',
                    'selector'   => $this->button_normal
                ]
            );

            $this->add_responsive_control(
                'button_border_radius',
                [
                    'label'      => __( 'Border Radius', 'rivet-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        $this->button_normal => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'       => 'button_box_shadow',
                    'selector'   => $this->button_normal
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'button_hover', [ 'label' => __( 'Hover', 'rivet-core' ) ] );

            $this->add_control(
              'button_hover_color',
                [
                    'label'      => __( 'Color', 'rivet-core' ),
                    'type'       => Controls_Manager::COLOR,
                    'selectors'  => [
                        $this->button_hover => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
              'button_hover_bg_color',
                [
                    'label'      => __( 'Background Color', 'rivet-core' ),
                    'type'       => Controls_Manager::COLOR,
                    'selectors'  => [
                        $this->button_hover => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'       => 'button_hover_border',
                    'selector'   => $this->button_hover
                ]
            );

            $this->add_responsive_control(
                'button_hover_border_radius',
                [
                    'label'      => __( 'Border Radius', 'rivet-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        $this->button_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'       => 'button_hover_box_shadow',
                    'selector'   => $this->button_hover
                ]
            );

            $this->add_control(
                'button_hover_animation',
                [
                    'label'      => __( 'Hover Animation', 'rivet-core' ),
                    'type'       => Controls_Manager::HOVER_ANIMATION,
                    'default'    => 'rivet-button-hover-effect'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
}
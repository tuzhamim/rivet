<?php

namespace Rivet_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \Elementor\Controls_Manager;

trait Grid {

	protected function settings() {

        if( 'grid' === $this->default_display_type ) :
            $this->start_controls_section(
                'grid_settings',
                [
                    'label'     => __( 'Grid Settings', 'rivet-core' )
                ]
            );
        else :
            $this->start_controls_section(
                'grid_settings',
                [
                    'label'     => __( 'Grid Settings', 'rivet-core' ),
                    'condition' => [
                        'display_type' => 'grid'
                    ]
                ]
            );
        endif;

        $this->add_control(
            'desktop_grid_columns',
            [
                'label'        => __( 'Desktop Columns', 'rivet-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => $this->desktop_default_grid,
                'options'      => [
                    '1' => __( '1 Column', 'rivet-core' ),
                    '2' => __( '2 Columns', 'rivet-core' ),
                    '3' => __( '3 Columns', 'rivet-core' ),
                    '4' => __( '4 Columns', 'rivet-core' ),
                    '6' => __( '6 Columns', 'rivet-core' )
                ]
            ]
        );

        $this->add_control(
            'tablet_grid_columns',
            [
                'label'        => __( 'Tablet Columns', 'rivet-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => $this->tablet_default_grid,
                'options'      => [
                    '1' => __( '1 Column', 'rivet-core' ),
                    '2' => __( '2 Columns', 'rivet-core' ),
                    '3' => __( '3 Columns', 'rivet-core' ),
                    '4' => __( '4 Columns', 'rivet-core' ),
                    '6' => __( '6 Columns', 'rivet-core' )
                ],
                'description'  => __( 'Number of columns in tablet( up to 992 px ).', 'rivet-core' )
            ]
        );

        $this->add_control(
            'mobile_grid_columns',
            [
                'label'        => __( 'Mobile Columns', 'rivet-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => $this->mobile_default_grid,
                'options'      => [
                    '1' => __( '1 Column', 'rivet-core' ),
                    '2' => __( '2 Columns', 'rivet-core' ),
                    '3' => __( '3 Columns', 'rivet-core' ),
                    '4' => __( '4 Columns', 'rivet-core' ),
                    '6' => __( '6 Columns', 'rivet-core' )
                ],
                'description'  => __( 'Number of columns in mobile( works between 768 to 576 px ).', 'rivet-core' )
            ]
        );

        $this->end_controls_section();
	}
}
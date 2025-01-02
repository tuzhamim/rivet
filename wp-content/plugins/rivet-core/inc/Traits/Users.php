<?php

namespace Rivet_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \RivetCore\Helper;
use \Elementor\Controls_Manager;
trait Users {

    protected function query() {
        if ( NULL === $this->default_content_type ) :
            $this->start_controls_section(
                'query_settings',
                [
                    'label'     => __( 'Query Settings', 'rivet-core' )
                ]
            );
        else :
            $this->start_controls_section(
                'query_settings',
                [
                    'label'     => __( 'Query Settings', 'rivet-core' ),
                    'condition' => [
                        'content_type' => 'dynamic'
                    ]
                ]
            );
        endif;

        $this->add_control(
            'image_size',
            [
                'label'       => __( 'Image Size', 'rivet-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'min' => 100,
                        'max' => 1200
                    ]
                ],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => $this->image_size
                ]
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => __( 'Number Of Instructors', 'rivet-core' ),
                'type'          => Controls_Manager::SLIDER,
                'description'   =>  __( 'Number of instructors to show. Default -1, it will show all.', 'rivet-core' ),
                'default'       => [
                    'size'      => -1,
                ],
                'range'         => [
                    'px'        => [
                        'min'   => -1
                    ]
                ]
            ]
        ); 

        $this->add_control(
            'order',
            [
                'type'          => Controls_Manager::SELECT,
                'label'         => __( 'Order', 'rivet-core' ),
                'default'       => 'DESC',
                'description'   => __( 'Order', 'rivet-core' ),
                'options'       => [
                    'ASC'       => __( 'Ascending', 'rivet-core' ),
                    'DESC'      => __( 'Descending', 'rivet-core' )
                ]
            ]
        );        

        $this->add_control(
            'order_by',
            [
                'type'              => Controls_Manager::SELECT,
                'label'             => __( 'Order by', 'rivet-core' ),
                'default'           => 'date',
                'description'       => __( 'Orderby', 'rivet-core' ),
                'options'           => [
                    'none'            => __( 'No order', 'rivet-core' ),
                    'ID'              => __( 'User ID', 'rivet-core' ),
                    'display_name'    => __( 'Display Name', 'rivet-core' ),
                    'user_name'       => __( 'User Name', 'rivet-core' ),
                    'include'         => __( 'Include', 'rivet-core' ),
                    'user_login'      => __( 'User Login', 'rivet-core' ),
                    'user_nicename'   => __( 'User Nicename', 'rivet-core' ),
                    'user_url'        => __( 'User URL', 'rivet-core' ),
                    'user_registered' => __( 'User Registered', 'rivet-core' ),
                    'post_count'      => __( 'Post Count', 'rivet-core' )
                ]
            ]
        );
        
        $this->add_control(
            'specific_user_include',
            [   
                'label'       => __( 'Specific Instructors( Include )', 'rivet-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => rivet_get_all_instructors( $this->instructor ),
                'description' => __( 'It will show the selected instructors only.', 'rivet-core' )

            ]
        );

        $this->add_control(
            'specific_user_exclude',
            [   
                'label'       => __( 'Specific Instructors( Exclude )', 'rivet-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => rivet_get_all_instructors( $this->instructor ),
                'description' => __( 'It will hide the selected instructors only.', 'rivet-core' )

            ]
        );

        $this->end_controls_section();
    }
}
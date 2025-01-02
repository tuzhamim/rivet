<?php

namespace Rivet_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \RivetCore\Helper;
use \Elementor\Controls_Manager;

trait Taxonomy {

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
            'items_to_show',
            [
                'label'       => __( 'Number of Category to Show.', 'rivet-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 0,
                'min'         => 0,
                'step'        => 1,
                'description' => __( 'Default 0. It will show all the category items.', 'rivet-core' )
            ]
        );

        $this->add_control(
            'include_categories',
            [
                'label'       => __( 'Include Specific Category', 'rivet-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'options'     => Helper::retrieve_categories( $this->taxomy_name ),
                'multiple'    => true
            ]
        );

        $this->add_control(
            'exclude_categories',
            [
                'label'       => __( 'Exclude Specific Category', 'rivet-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'options'     => Helper::retrieve_categories( $this->taxomy_name ),
                'multiple'    => true,
                'description' => __( 'Either use exclude or include, don\'t use both together.', 'rivet-core' )
            ]
        );

        $this->add_control(
            'order_by',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => __( 'Order by', 'rivet-core' ),
                'default' => 'name',
                'options' => [
                    'name'       => __( 'Name', 'rivet-core' ),
                    'id'         => __( 'ID', 'rivet-core' ),
                    'count'      => __( 'Count', 'rivet-core' ),
                    'slug'       => __( 'Slug', 'rivet-core' ),
                    'term_group' => __( 'Term Group', 'rivet-core' ),
                    'none'       => __( 'None', 'rivet-core' )
                ]
            ]
        );

        $this->add_control(
            'order',
            [
                'type'          => Controls_Manager::SELECT,
                'label'         => __( 'Order', 'rivet-core' ),
                'default'       => 'DESC',
                'options'       => [
                    'ASC'       => __( 'Ascending', 'rivet-core' ),
                    'DESC'      => __( 'Descending', 'rivet-core' )
                ]
            ]
        );

        $this->add_control(
            'enable_parent_only',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Only Top Level Category?', 'rivet-core' ),
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'description'  => __( 'By enabling this option, only top level category will show.', 'rivet-core' )
            ]
        );

        $this->add_control(
            'hide_empty_cat',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Empty Category', 'rivet-core' ),
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->end_controls_section();
    }
}
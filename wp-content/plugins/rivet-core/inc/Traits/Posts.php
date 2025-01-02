<?php

namespace Rivet_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \RivetCore\Helper;
use \Elementor\Controls_Manager;
trait Posts {

    protected function query() {

        $excerpt_support = [
            'rivet-post-slider',
            'rivet-events-one',
            'rivet-events-two',
            'rivet-lp-course-slider',
            'rivet-ld-course-slider',
            'rivet-tl-course-slider'
        ];

        if ( NULL === $this->post_type ) :
            $this->post_type = 'post';
        endif;

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
            'per_page',
            [
                'label'         => __( 'Number Of Posts', 'rivet-core' ),
                'type'          => Controls_Manager::SLIDER,
                'description'   =>  __( 'Number of posts to show. Default 6. If you want to show all the posts then put <b>-1</b>', 'rivet-core' ),
                'default'       => [
                    'size'      => 6,
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
                'options'           => [
                    'none'            => __( 'No order', 'rivet-core' ),
                    'ID'              => __( 'Post ID', 'rivet-core' ),
                    'author'          => __( 'Author', 'rivet-core' ),
                    'title'           => __( 'Title', 'rivet-core' ),
                    'name'            => __( 'Name', 'rivet-core' ),
                    'type'            => __( 'Type', 'rivet-core' ),
                    'date'            => __( 'Published Date', 'rivet-core' ),
                    'modified'        => __( 'Modified Date', 'rivet-core' ),
                    'parent'          => __( 'By Parent', 'rivet-core' ),
                    'rand'            => __( 'Random Order', 'rivet-core' ),
                    'comment_count'   => __( 'Comment Count', 'rivet-core' ),
                    'relevance'       => __( 'Relevance', 'rivet-core' ),
                    'menu_order'      => __( 'Menu Order', 'rivet-core' ),
                    'meta_value'      => __( 'Meta Value', 'rivet-core' ),
                    'meta_value_num'  => __( 'Meta Value Num', 'rivet-core' ),
                    'post__in'        => __( 'Post In( by include order )', 'rivet-core' ),
                    'post_name__in'   => __( 'Post Name In', 'rivet-core' ),
                    'post_parent__in' => __( 'post Parent In', 'rivet-core' )
                ]
            ]
        );

        $this->add_control(
            'specific_post_include',
            [   
                'label'       => __( 'Specific Posts( Include )', 'rivet-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => Helper::retrieve_posts( $this->post_type ),
                'description' => __( 'It will show the selected posts only.', 'rivet-core' )

            ]
        );

        $this->add_control(
            'specific_post_exclude',
            [   
                'label'       => __( 'Specific Posts( Exclude )', 'rivet-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => Helper::retrieve_posts( $this->post_type ),
                'description' => __( 'It will hide the selected posts only.', 'rivet-core' )

            ]
        );

        $this->add_control(
            'enable_only_featured_posts',
            [
                'label'        => __( 'Only Has Featured Image', 'rivet-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'description'  => __( 'Only show posts which has feature image set.', 'rivet-core' ),           
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        if ( 'post' === $this->post_type ) :
            $this->add_control(
                'ignore_sticky',
                [
                    'type'         => Controls_Manager::SWITCHER,
                    'label'        => __( 'Ignore Sticky Posts?', 'rivet-core' ),
                    'label_on'     => __( 'Enable', 'rivet-core' ),
                    'label_off'    => __( 'Disable', 'rivet-core' ),
                    'default'      => 'no',
                    'return_value' => 'yes'
                ]
            );
        endif;

        if ( 'post' === $this->post_type || 'simple_event' === $this->post_type ) :
            $this->add_control(
                'enable_date',
                [
                    'type'         => Controls_Manager::SWITCHER,
                    'label'        => __( 'Date', 'rivet-core' ),
                    'label_on'     => __( 'Enable', 'rivet-core' ),
                    'label_off'    => __( 'Disable', 'rivet-core' ),
                    'default'      => 'yes',
                    'return_value' => 'yes'
                ]
            );
        endif;

        if ( 'post' === $this->post_type ) :
            $this->add_control(
                'date_format',
                [
                    'type'            => Controls_Manager::SELECT,
                    'label'           => __( 'Date Format', 'rivet-core' ),
                    'default'         => 'default',
                    'options'         => [
                        'default'     => __( 'Default', 'rivet-core' ),
                        'F j, Y'      => __( 'F j, Y', 'rivet-core' ),
                        'Y-m-d'       => __( 'Y-m-d', 'rivet-core' ),
                        'm/d/Y'       => __( 'm/d/Y', 'rivet-core' ),
                        'd/m/Y'       => __( 'd/m/Y', 'rivet-core' ),
                        'j M. Y'      => __( 'j M. Y', 'rivet-core' ),
                        'l F j, Y'    => __( 'l F j, Y', 'rivet-core' ),
                        'D M j'       => __( 'D M j', 'rivet-core' ),
                        'dS M Y'      => __( 'dS M Y', 'rivet-core' ),
                        'F Y'         => __( 'F Y', 'rivet-core' ),
                        'custom'      => __( 'Custom', 'rivet-core' )
                    ],
                    'condition'       => [
                        'enable_date' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'custom_date_format',
                [   
                    'label'           => __( 'Custom Date Format', 'rivet-core' ),
                    'type'            => Controls_Manager::TEXT,
                    'default'         => __( 'F j, Y', 'rivet-core' ),
                    'condition'       => [
                        'enable_date' => 'yes',
                        'date_format' => 'custom'
                    ]
                ]
            );
        endif;

        if ( in_array( $this->get_name(), $excerpt_support ) ) :
            $this->add_control(
                'enable_excerpt',
                [
                    'label'        => __( 'Excerpt.', 'rivet-core' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Enable', 'rivet-core' ),
                    'label_off'    => __( 'Disable', 'rivet-core' ),
                    'default'      => 'yes',
                    'return_value' => 'yes'
                ]
            );  

            $this->add_control(
                'excerpt_length',
                [
                    'label'       => __( 'Number of Words', 'rivet-core' ),
                    'type'        => Controls_Manager::NUMBER,
                    'default'     => 20,
                    'description' => __( 'Number of excerpt words.', 'rivet-core' ),
                    'condition'   => [
                        'enable_excerpt' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'excerpt_end',
                [
                    'label'       => __( 'Excerpt End Text', 'rivet-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => '...',
                    'description' => __( 'Content to show at the end of the excerpt. Default: ...', 'rivet-core' ),
                    'condition'   => [
                        'enable_excerpt' => 'yes'
                    ]
                ]
            );
        endif;

        $this->add_control(
            'include_categories',
            [
                'label'       => __( 'Include Specific Category', 'rivet-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'options'     => Helper::retrieve_categories( $this->category_taxonomy, true ),
                'multiple'    => true
            ]
        );

        $this->end_controls_section();
    }
}
<?php

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

if ( ! class_exists( 'Rivet_Elementor_Extensions' ) ) :
    final class Rivet_Elementor_Extensions {

        private static $_instance = null;

        public function __construct() {
            add_filter( 'rivet_generate_post_builder', array( $this, 'render_post_builder' ), 10, 2 );
        }

        public static function instance () {
            if ( is_null( self::$_instance ) ) :
                self::$_instance = new self();
            endif;
            return self::$_instance;
        }

        public function render_page_content( $post_id ) {
            if ( class_exists( 'Elementor\Core\Files\CSS\Post' ) ) :
                $css_file = new Elementor\Core\Files\CSS\Post( $post_id );
                $css_file->enqueue();
            endif;

            return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id );
        }

        public function render_post_builder( $html, $post ) {
            if ( ! empty( $post ) && ! empty( $post->ID ) ) :
                return $this->render_page_content( $post->ID );
            endif;
            return $html;
        }
    }
endif;

if ( did_action( 'elementor/loaded' ) ) :
    // Finally initialize code
    Rivet_Elementor_Extensions::instance();
endif;
<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

if ( ! class_exists( 'Rivet_Redux_Framework_Config' ) ) :
	class Rivet_Redux_Framework_Config {

		public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            if ( ! class_exists( 'ReduxFramework' ) ) :
                return;
            endif;
            add_action( 'init', array( $this, 'initSettings' ), 10 );
        }

        public function initSettings() {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if ( ! isset( $this->args['opt_name'] ) ) : // No errors please
                return;
            endif;

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections() {

            $columns = array( 
                '1' => __( '1 Column', 'rivet' ),
                '2' => __( '2 Columns', 'rivet' ),
                '3' => __( '3 Columns', 'rivet' ),
                '4' => __( '4 Columns', 'rivet' )
            );

            global $wp_registered_sidebars;
            $sidebars = array();

            if ( is_admin() && ! empty( $wp_registered_sidebars ) ) :
                foreach ( $wp_registered_sidebars as $sidebar ) :
                    $sidebars[$sidebar['id']] = $sidebar['name'];
                endforeach;
            endif;

            // General
            $this->sections[] = array(
                'icon'   => 'el el-website',
                'title'  => __( 'General Settings', 'rivet' ),
                'fields' => array(
                    array(
                        'id'      => 'preloader',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Preloader at Website', 'rivet' ),
                        'default' => false
                    ),
                    array(
                        'id'       => 'preloader_type',
                        'type'     => 'select',
                        'title'    => __( 'Preloader Type', 'rivet' ),
                        'subtitle' => __( 'Choose a preloader for your website.', 'rivet' ),
                        'default'  => '3',
                        'options'  => array(
                            '1'    => 'Preloader 1',
                            '2'    => 'Preloader 2',
                            '3'    => 'Preloader 3'
                        ),
                        'required' => array( 'preloader', 'equals', true )
                    ),
                    array(
                        'id'      => 'smooth_scroll',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Smooth Scroll', 'rivet' ),
                        'default' => false
                    ),
                    array(
                        'id'      => 'mailchimp_api',
                        'type'    => 'text',
                        'default' => '6b38881989adf4b2160cd9290974f7d5-us2',
                        'title'   => __( 'MailChimp API Key', 'rivet' )
                    ),
                    array(
                        'id'      => 'google_map_api_key',
                        'type'    => 'text',
                        'default' => 'AIzaSyDQui8Qo1nZHxT3PXQuX4XnAcfhPn06kmI',
                        'title'   => __( 'Google Map API Key', 'rivet' )
                    )
                )
            );
            
            // Header
            $this->sections[] = array(
				'icon'   => 'el el-website',
				'title'  => __( 'Header Settings', 'rivet' ),
				'fields' => array(
                    array(
						'id'       => 'header_type',
						'type'     => 'select',
						'title'    => __( 'Header Layout Type', 'rivet' ),
						'subtitle' => __( 'Choose a header for your website.', 'rivet' ),'default'  => 'theme-header-1',
						'options'  => rivet_fetch_header_layouts(),
						'desc'     => sprintf( wp_kses( __( 'You can add or edit a header in <a href="%s" target="_blank">Headers Builder</a>', 'rivet' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit.php?post_type=rivet_header' ) ) )
                    ),
                    array(
                        'id'      => 'sticky_header',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Sticky Header', 'rivet' ),
                        'default' => false
                    ),
                    array(
                        'id'      => 'global_breadcrumb_visibility',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Breadcrumb On Your Site?', 'rivet' ),
                        'default' => true
                    ),
                    array(
                        'id'       => 'global_breadcrumb_bg_type',
                        'type'     => 'button_set',
                        'title'    => __( 'Global Breadcrumb Background Type', 'rivet' ),
                        'options'  => array(
                            'image'    => __( 'Background Image', 'rivet' ),
                            'color'  => __( 'Background Color', 'rivet' )
                        ),
                        'default' => 'image',
                        'required' => array( 'global_breadcrumb_visibility', 'equals', 'true' )
                    ),
                    array(
                        'id'       => 'global_breadcrumb_bg_image',
                        'type'     => 'media',
                        'title'    => __( 'Global Breadcrumb Background', 'rivet' ),
                        'subtitle' => __( 'Upload a .jpg or .png image that will be your breadcrumbs background image.', 'rivet' ),
                        'default'  => array(
                            'url'  => get_template_directory_uri() . '/assets/images/rivet-breadcrumb-bg.jpg'
                        ),
                        'required'    => array( 
                            array( 'global_breadcrumb_bg_type', 'equals', 'image' ),
                            array( 'global_breadcrumb_visibility', 'equals', true )    
                        )
                    ),
                    array(
                        'id'       => 'global_breadcrumb_bg_image_overlay',
                        'type'     => 'slider',
                        'title'    => __( 'Breadcrumb Overlay Opacity (in %)', 'rivet' ),
                        'min'      => 0,
                        'max'      => 100,
                        'step'     => 1,
                        'default'  => 0,
                        'display_value' => 'label',
                        'required'    => array( 
                            array( 'global_breadcrumb_bg_type', 'equals', 'image' ),
                            array( 'global_breadcrumb_visibility', 'equals', true )    
                        )
                    ), 
                    array(
                        'id'       => 'global_breadcrumb_bg_color',
                        'type'     => 'color',
                        'title'    => __( 'Breadcrumb Background Color', 'rivet'), 
                        'validate' => 'color',
                        'required'    => array( 
                            array( 'global_breadcrumb_bg_type', 'equals', 'color' ),
                            array( 'global_breadcrumb_visibility', 'equals', true )    
                        )
                    )
                )
            );

            // Footer
            $this->sections[] = array(
                'icon'   => 'el el-website',
                'title'  => __( 'Footer Settings', 'rivet' ),
                'fields' => array(
                    array(
                        'id'       => 'footer_type',
                        'type'     => 'select',
                        'title'    => __( 'Footer Layout Type', 'rivet' ),
                        'subtitle' => __( 'Choose a footer for your website.', 'rivet' ),
                        'default'  => 'theme-default-footer',
                        'options'  => rivet_fetch_footer_layouts(),
                        'desc'     => sprintf( wp_kses( __( 'You can add or edit a footer in <a href="%s" target="_blank">Footers Builder</a>', 'rivet' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit.php?post_type=rivet_footer' ) ) )
                    ),
                    array(
                        'id'       => 'scroll_to_top',
                        'type'     => 'switch',
                        'on'       => __( 'Enable', 'rivet' ),
                        'off'      => __( 'Disable', 'rivet' ),
                        'title'    => __( 'Scroll To Top Button', 'rivet' ),
                        'subtitle' => __( 'Toggle whether or not to enable a scroll to top button on your pages.', 'rivet' ),
                        'default'  => true
                    )
                )
            );

            // Page settings
            $this->sections[] = array(
                'icon'   => 'el el-pencil',
                'title'  => __( 'Page Settings', 'rivet' ),
                'fields' => array(
                    array(
                        'id'      => 'show_page_breadcrumb',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Breadcrumbs', 'rivet' ),
                        'default' => true,
                        'desc'     => sprintf( 'If you set <strong>"Global Breadcrumb Background"</strong> to <strong>"Disbale"</strong> then you can\'t enable it here.', 'rivet' )
                    ),
                    array(
                        'id'      => 'default_breadcrumb_at_page',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Default Breadcrumb Settings', 'rivet' ),
                        'default' => true,
                        'required' => array( 'show_page_breadcrumb', 'equals', true )
                    ),
                    array(
                        'id'       => 'page_breadcrumb_image',
                        'type'     => 'media',
                        'title'    => __( 'Breadcrumbs Background', 'rivet' ),
                        'subtitle' => __( 'Upload a .jpg or .png image that will be your breadcrumbs.', 'rivet' ),
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/assets/images/rivet-breadcrumb-bg.jpg'
                        ),
                        'required'    => array( 
                            array( 'show_page_breadcrumb', 'equals', true ),
                            array( 'default_breadcrumb_at_page', '!=', true )    
                        )
                    ),
                    array (
                        'id'          => 'page_breadcrumb_color',
                        'title'       => __( 'Breadcrumbs Background Color', 'rivet' ),
                        'subtitle'    => '<em>' . __( 'If you uploaded an image at <strong>Global Breadcrumb Background</strong> then this field option won\'t work.', 'rivet' ) . '</em>',
                        'type'        => 'color',
                        'required'    => array( 
                            array( 'show_page_breadcrumb', 'equals', true ),
                            array( 'default_breadcrumb_at_page', '!=', true )    
                        )
                    )
                )
            );

            // Blog settings
            $this->sections[] = array(
                'icon'   => 'el el-pencil',
                'title'  => __( 'Blog Settings', 'rivet' ),
                'fields' => array(
                    array(
                        'id'      => 'show_blog_breadcrumb',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Breadcrumbs', 'rivet' ),
                        'default' => true,
                        'desc'     => sprintf( 'If you set <strong>"Global Breadcrumb Background"</strong> to <strong>"Disbale"</strong> then you can\'t enable it here.', 'rivet' )
                    ),
                    array(
                        'id'      => 'default_breadcrumb_at_blog',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Default Breadcrumb Settings', 'rivet' ),
                        'default' => true,
                        'required' => array( 'show_blog_breadcrumb', 'equals', true )
                    ),
                    array(
                        'id'       => 'blog_breadcrumb_image',
                        'type'     => 'media',
                        'title'    => __( 'Breadcrumbs Background', 'rivet' ),
                        'subtitle' => __( 'Upload a .jpg or .png image that will be your breadcrumbs.', 'rivet' ),
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/assets/images/rivet-breadcrumb-bg.jpg'
                        ),
                        'required'    => array( 
                            array( 'show_blog_breadcrumb', 'equals', true ),
                            array( 'default_breadcrumb_at_blog', '!=', true )    
                        )
                    ),
                    array (
                        'id'          => 'blog_breadcrumb_color',
                        'title'       => __( 'Breadcrumbs Background Color', 'rivet' ),
                        'subtitle'    => '<em>' . __( 'If you uploaded an image at <strong>Global Breadcrumb Background</strong> then this field option won\'t work.', 'rivet' ) . '</em>',
                        'type'        => 'color',
                        'required'    => array( 
                            array( 'show_blog_breadcrumb', 'equals', true ),
                            array( 'default_breadcrumb_at_blog', '!=', true )    
                        )
                    )
                )
            );

            // Archive Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title'      => __( 'Blog/Post Archive', 'rivet' ),
                'fields'     => array(
                    array(
                        'id'       => 'blog_archive_layout',
                        'type'     => 'image_select',
                        'compiler' => true,
                        'title'    => __( 'Layout', 'rivet' ),
                        'default'  => 'right-sidebar',
                        'options'  => array(
                            'no-sidebar' => array(
                                'title'  => __( 'No Sidebar', 'rivet' ),
                                'alt'    => __( 'No Sidebar', 'rivet' ),
                                'img'    => get_template_directory_uri() . '/assets/images/sidebar-none.png'
                            ),
                            'left-sidebar'  => array(
                                'title'  => __( 'Left Sidebar', 'rivet' ),
                                'alt'    => __( 'Left Sidebar', 'rivet' ),
                                'img'    => get_template_directory_uri() . '/assets/images/sidebar-left.png'
                            ),
                            'right-sidebar' => array(
                                'title'  => __( 'Right Sidebar', 'rivet' ),
                                'alt'    => __( 'Right Sidebar', 'rivet' ),
                                'img'    => get_template_directory_uri() . '/assets/images/sidebar-right.png'
                            )
                        )
                    ),
                    array(
                        'id'       => 'blog_archive_sidebar_name',
                        'type'     => 'select',
                        'default'  => 'blog-sidebar',
                        'title'    => __( 'Select Sidebar', 'rivet' ),
                        'options'  => $sidebars,
                        'required' => array( 'blog_archive_layout', '!=', 'no-sidebar' )
                    ),
                    array(
                        'id'       => 'blog_post_style',
                        'type'     => 'select',
                        'title'    => __( 'Post Style', 'rivet' ),
                        'default'  => 'standard',
                        'options'  => array(
                            1      => 'Post 1',
                            2      => 'Post 2',
                            3      => 'Post 3',
                            'standard' => 'Post Standard'
                        )
                    ),
                    array(
                        'id'       => 'blog_post_columns',
                        'type'     => 'select',
                        'title'    => __( 'Post Columns', 'rivet' ),
                        'options'  => $columns,
                        'default'  => 2, // it's mandatory value is 2, before changing it, search for the param blog_post_columns and analyze it.
                        'required'  => array( 'blog_post_style', '!=', 'standard' )
                    ),
                    array(
                        'id'        => 'blog_post_excerpt_length',
                        'type'      => 'slider',
                        'title'     => __( 'Excerpt Length', 'rivet' ),
                        'default'   => 42,
                        'min'       => 1,
                        'step'      => 1,
                        'max'       => 250,
                        'required'  => array( 'blog_post_style', 'equals', 'standard' )
                    )
                )
            );

            // Single Blog settings
            $this->sections[] = array(
                'subsection' => true,
                'title'      => __( 'Post Single', 'rivet' ),
                'fields'     => array(
                    array(
                        'id'       => 'blog_single_layout',
                        'type'     => 'image_select',
                        'compiler' => true,
                        'title'    => __( 'Layout', 'rivet' ),
                        'default'  => 'right-sidebar',
                        'options'  => array(
                            'no-sidebar' => array(
                                'title'  => __( 'No Sidebar', 'rivet' ),
                                'alt'    => __( 'No Sidebar', 'rivet' ),
                                'img'    => get_template_directory_uri() . '/assets/images/sidebar-none.png'
                            ),
                            'left-sidebar'  => array(
                                'title'  => __( 'Left Sidebar', 'rivet' ),
                                'alt'    => __( 'Left Sidebar', 'rivet' ),
                                'img'    => get_template_directory_uri() . '/assets/images/sidebar-left.png'
                            ),
                            'right-sidebar' => array(
                                'title'  => __( 'Right Sidebar', 'rivet' ),
                                'alt'    => __( 'Right Sidebar', 'rivet' ),
                                'img'    => get_template_directory_uri() . '/assets/images/sidebar-right.png'
                            )
                        )
                    ),
                    array(
                        'id'       => 'blog_single_sidebar_name',
                        'type'     => 'select',
                        'default'  => 'blog-sidebar',
                        'title'    => __( 'Select Sidebar', 'rivet' ),
                        'options'  => $sidebars,
                        'required' => array( 'blog_single_layout', '!=', 'no-sidebar' )
                    ),                    
                    array(
                        'id'        => 'featured_image_height',
                        'type'      => 'slider',
                        'title'     => __( 'Blog Feature Image Height', 'rivet' ),
                        'default'   => 450,
                        'min'       => 300,
                        'step'      => 1,
                        'max'       => 1250,
                        'desc'      => __( 'If you changed the image size, you have to regenerate thumbnails. You can use any regenerate thumbnails plugin for that.', 'rivet' ),
                    ),
                    array(
                        'id'        => 'featured_image_width',
                        'type'      => 'slider',
                        'title'     => __( 'Blog Feature Image Width', 'rivet' ),
                        'default'   => 770,
                        'min'       => 500,
                        'step'      => 1,
                        'max'       => 1500
                    ),
                    array(
                        'id'        => 'blog_single_catgory_and_social_share',
                        'type'      => 'switch',
                        'on'        => __( 'Enable', 'rivet' ),
                        'off'       => __( 'Disable', 'rivet' ),
                        'title'     => __( 'Category & Social Share', 'rivet' ),
                        'default'   => true
                    ),
                    array(
                        'id'        => 'blog_single_author_bio',
                        'type'      => 'switch',
                        'on'        => __( 'Enable', 'rivet' ),
                        'off'       => __( 'Disable', 'rivet' ),
                        'title'     => __( 'Author Bio', 'rivet' ),
                        'default'   => true
                    )
                )
            );

            if ( rivet_is_woocommerce_activated() ) :
                // WooCommerce  settings
                $this->sections[] = array(
                    'icon'   => 'el el-pencil',
                    'title'  => __( 'Shop Settings', 'rivet' ),
                    'fields' => array(
                        array(
                            'id'      => 'show_shop_breadcrumb',
                            'type'    => 'switch',
                            'on'      => __( 'Enable', 'rivet' ),
                            'off'     => __( 'Disable', 'rivet' ),
                            'title'   => __( 'Breadcrumbs', 'rivet' ),
                            'default' => true,
                            'desc'     => sprintf( 'If you set <strong>"Global Breadcrumb Background"</strong> to <strong>"Disbale"</strong> then you can\'t enable it here.', 'rivet' )
                        ),
                        array(
                            'id'      => 'default_breadcrumb_at_shop',
                            'type'    => 'switch',
                            'on'      => __( 'Enable', 'rivet' ),
                            'off'     => __( 'Disable', 'rivet' ),
                            'title'   => __( 'Default Breadcrumb Settings', 'rivet' ),
                            'default' => true,
                            'required' => array( 'show_shop_breadcrumb', 'equals', true )
                        ),
                        array(
                            'id'       => 'shop_breadcrumb_image',
                            'type'     => 'media',
                            'title'    => __( 'Breadcrumbs Background', 'rivet' ),
                            'subtitle' => __( 'Upload a .jpg or .png image that will be your breadcrumbs.', 'rivet' ),
                            'default'  => array(
                                'url' => get_template_directory_uri() . '/assets/images/rivet-breadcrumb-bg.jpg'
                            ),
                            'required'    => array( 
                                array( 'show_shop_breadcrumb', 'equals', true ),
                                array( 'default_breadcrumb_at_shop', '!=', true )    
                            )
                        ),
                        array (
                            'id'          => 'shop_breadcrumb_color',
                            'title'       => __( 'Breadcrumbs Background Color', 'rivet' ),
                            'subtitle'    => '<em>' . __( 'If you uploaded an image at <strong>Global Breadcrumb Background</strong> then this field option won\'t work.', 'rivet' ) . '</em>',
                            'type'        => 'color',
                            'required'    => array( 
                                array( 'show_shop_breadcrumb', 'equals', true ),
                                array( 'default_breadcrumb_at_shop', '!=', true )    
                            )
                        )
                    )
                );

                $this->sections[] = array(
                    'subsection' => true,
                    'title'      => __( 'Product Archive', 'rivet' ),
                    'fields'     => array(
                        array(
                            'id'        => 'woo_number_of_products',
                            'type'      => 'slider',
                            'title'     => __( 'Number of Products Per Page', 'rivet' ),
                            'default'   => 12,
                            'min'       => 1,
                            'step'      => 1,
                            'max'       => 100
                        ),
                        array(
                            'id'       => 'woo_product_columns',
                            'type'     => 'select',
                            'title'    => __( 'Product Columns', 'rivet' ),
                            'options'  => $columns,
                            'default'  => 4
                        )
                    )
                );

                $this->sections[] = array(
                    'subsection' => true,
                    'title'      => __( 'Shop Single', 'rivet' ),
                    'fields'     => array(
                        array(
                            'id'      => 'woo_related_products',
                            'type'    => 'switch',
                            'on'      => __( 'Enable', 'rivet' ),
                            'off'     => __( 'Disable', 'rivet' ),
                            'title'   => __( 'Related Products', 'rivet' ),
                            'default' => true
                        ),
                        array(
                            'id'       => 'woo_related_products_subtitle',
                            'type'     => 'text',
                            'title'    => __( 'Related Products Sub Title', 'rivet' ),
                            'default'  => __( 'SIMILAR ITEMS', 'rivet' ),
                            'required' => array( 'woo_related_products', 'equals', true )
                        ),
                        array(
                            'id'       => 'woo_related_products_title',
                            'type'     => 'text',
                            'title'    => __( 'Related Products Title', 'rivet' ),
                            'default'  => __( 'Related Products', 'rivet' ),
                            'required' => array( 'woo_related_products', 'equals', true )
                        )
                    )
                );

            endif;

            // 404 page
            $this->sections[] = array(
                'title'  => __( '404 Page', 'rivet' ),
                'fields' => array(
                    array(
                        'id'      => 'error_page_title',
                        'type'    => 'text',
                        'title'   => __( 'Title', 'rivet' ),
                        'default' => __( 'Oops... Page Not Found!', 'rivet' )
                    ),
                    array(
                        'id'      => 'error_page_description',
                        'type'    => 'editor',
                        'title'   => __( 'Description', 'rivet' ),
                        'default' => __( 'Please return to the site\'s homepage, It looks like nothing was found at this location.', 'rivet' )
                    )
                )
            );

            // Social Media
            $this->sections[] = array(
                'icon'   => 'el el-file',
                'title'  => __( 'Social Media', 'rivet' ),
                'desc'   => __( 'This options will be applied at Event Details and Post Details page.', 'rivet' ),
                'fields' => array(
                    array(
                        'id'      => 'facebook_share',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Facebook', 'rivet' ),
                        'default' => true
                    ),
                    array(
                        'id'      => 'twitter_share',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Twitter', 'rivet' ),
                        'default' => true
                    ),
                    array(
                        'id'      => 'linkedin_share',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Linkedin', 'rivet' ),
                        'default' => true
                    ),
                    array(
                        'id'      => 'pinterest_share',
                        'type'    => 'switch',
                        'on'      => __( 'Enable', 'rivet' ),
                        'off'     => __( 'Disable', 'rivet' ),
                        'title'   => __( 'Pinterest', 'rivet' ),
                        'default' => true
                    )
                )
            );

            // Custom Code
            $this->sections[] = array(
                'title'           => __( 'Import / Export', 'rivet' ),
                'desc'            => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'rivet' ),
                'icon'            => 'el-icon-refresh',
                'fields'          => array(
                    array(
                        'id'         => 'opt-import-export',
                        'type'       => 'import_export',
                        'title'      => 'Import Export',
                        'subtitle'   => 'Save and restore your Redux options',
                        'full_width' => false
                    ),
                ),
            );
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {
        	$theme = wp_get_theme(); // For use with some settings. Not necessary.
        	$this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'                    => apply_filters( 'rivet_theme_option_name', 'rivet_theme_options' ),
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'                => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'             => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'                   => 'submenu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'              => true,
                // Show the sections below the admin menu item or not
                'menu_title'                  => __( 'Theme Options', 'rivet' ),
                'page_title'                  => __( 'Theme Options', 'rivet' ),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'              => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly'        => false,
                // Must be defined to add google fonts to the typography module
                'async_typography'            => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'                   => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon'              => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority'          => 50,
                // Choose an priority for the admin bar menu
                'global_variable'             => 'rivet_options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'                    => false,
                // Show the time the page took to load, etc
                'update_notice'               => false,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer'                  => true,
                // Enable basic customizer support
                //'open_expanded'             => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn'         => true,                    // Disable the save warning when a user changes a field
                
                // OPTIONAL -> Give you extra features
                'page_priority'               => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'                 => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'            => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'                   => '',
                // Specify a custom URL to an icon
                'last_tab'                    => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'                   => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'                   => 'rivet_options',
                // Page slug used to denote the panel
                'save_defaults'               => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'                => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'                => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export'          => true,
                // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'              => 60 * MINUTE_IN_SECONDS,
                'output'                      => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'                  => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'            => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'                    => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'                 => false,
                // REMOVE
                'use_cdn'                     => true
            );
            return $this->args;
        }
    }
    global $reduxConfig;
    $reduxConfig = new Rivet_Redux_Framework_Config();
endif;
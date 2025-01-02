<?php
namespace RivetCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\REPEATER;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Rivet Core
 *
 * Elementor widget for test.
 *
 * @since 1.0.0
 */
class Test extends Widget_Base {

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
        return 'rivet-test-widget';
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
        return __( 'Filterable Gallery (Testing)', 'rivet-core' );
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
        return 'rivet-elementor-icon eicon-posts-masonry';
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
        return [ 'jquery-isotope' ];
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

        $exad_primary_color   = get_option( 'exad_primary_color_option', '#7a56ff' );
        $exad_secondary_color = get_option( 'exad_secondary_color_option', '#00d8d8' );
        
        /**
         * Filter Gallery Grid Settings
         */
        $this->start_controls_section(
            'exad_section_fg_grid_settings',
            [
                'label' => esc_html__('Items', 'rivet-core')
            ]
        );

        $filter_repeater = new Repeater();

        $filter_repeater->add_control(
			'exad_fg_gallery_item_title',
			[
                'label'       => esc_html__('Title', 'rivet-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__('Gallery item title', 'rivet-core'),
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $filter_repeater->add_control(
			'exad_fg_gallery_item_content',
			[
                'label'       => esc_html__('Details', 'rivet-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__('Lorem ipsum dolor sit amet.', 'rivet-core'),
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $filter_repeater->add_control(
			'exad_fg_gallery_control_name',
			[
                'label'       => esc_html__('Control Name', 'rivet-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => __( '<b>Comma separated gallery controls. Example: Design, Branding</b>', 'rivet-core' )
            ]
        );

        $filter_repeater->add_control(
			'exad_fg_gallery_img',
			[
                'label'       => esc_html__('Image', 'rivet-core'),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url'     => Utils::get_placeholder_image_src()
                ],
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $filter_repeater->add_control(
			'exad_fg_gallery_img_link',
			[
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'     => '#'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_gallery_items',
            [
                'type'      => Controls_Manager::REPEATER,
                'fields'  => $filter_repeater->get_controls(),
                'seperator' => 'before',
                'default' => [
                    ['exad_fg_gallery_control_name' => 'Design, Branding'],
                    ['exad_fg_gallery_control_name' => 'Interior'],
                    ['exad_fg_gallery_control_name' => 'Development'],
                    ['exad_fg_gallery_control_name' => 'Design, Interior'],
                    ['exad_fg_gallery_control_name' => 'Branding, Development'],
                    ['exad_fg_gallery_control_name' => 'Design, Development']
                ],
                'title_field' => '{{exad_fg_gallery_item_title}}'
            ]
        );

        $this->end_controls_section();

        /**
         * Filter Gallery Settings
         */
        $this->start_controls_section(
            'exad_section_fg_settings',
            [
                'label' => esc_html__('Settings', 'rivet-core')
            ]
        );

        $this->add_control(
            'exad_fg_columns',
            [
                'label'   => esc_html__('Columns', 'rivet-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'exad-col-3',
                'options' => [
                    'exad-col-1' => esc_html__('1', 'rivet-core'),
                    'exad-col-2' => esc_html__('2',   'rivet-core'),
                    'exad-col-3' => esc_html__('3', 'rivet-core'),
                    'exad-col-4' => esc_html__('4',  'rivet-core')
                ]
            ]
        );

        $this->add_control(
            'exad_fg_grid_hover_style',
            [
                'label'   => esc_html__('Hover Style', 'rivet-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'exad-zoom-in',
                'options' => [
                    'exad-zoom-in'      => esc_html__('Zoom In', 'rivet-core'),
                    'exad-slide-left'   => esc_html__('Slide In Left',   'rivet-core'),
                    'exad-slide-right'  => esc_html__('Slide In Right', 'rivet-core'),
                    'exad-slide-top'    => esc_html__('Slide In Top', 'rivet-core'),
                    'exad-slide-bottom' => esc_html__('Slide In Bottom', 'rivet-core')
                ]
            ]
        );

        $this->add_control(
            'exad_fg_show_icons',
            [
                'label'   => __('Show Icons', 'rivet-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'popup' => 'PopUp',
                    'link'  => 'Link',
                    'both'  => 'PopUp and Link',
                    'none'  => 'None'
                ]
            ]
        );

        $this->add_control(
            'exad_section_fg_zoom_icon',
            [
                'label'   => esc_html__('PopUp Icon', 'rivet-core'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-search',
                    'library' => 'fa-solid'
                ],
                'condition' => [
                    'exad_fg_show_icons' => [ 'popup', 'both']
                ]
            ]
        );

        $this->add_control(
            'exad_section_fg_link_icon',
            [
                'label'   => esc_html__('Link Icon', 'rivet-core'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-link',
                    'library' => 'fa-solid'
                ],
                'condition' => [
                    'exad_fg_show_icons' => [ 'link', 'both']
                ]
            ]
        );

        $this->add_control(
            'exad_fg_show_constrols',
            [
                'label'        => __('Show Controls?', 'rivet-core'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_fg_all_items_text',
            [
                'label'     => esc_html__('Text for All Item', 'rivet-core'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __('All', 'rivet-core'),
                'condition' => [
                    'exad_fg_show_constrols' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_show_title',
            [
                'label'        => __('Enable Title.', 'rivet-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'rivet-core' ),
                'label_off'    => __( 'Off', 'rivet-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_fg_show_details',
            [
                'label'        => __('Enable Details.', 'rivet-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'rivet-core' ),
                'label_off'    => __( 'Off', 'rivet-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'exad_filter_image_size',
                'default' => 'full'
            ]
        );

        $this->end_controls_section();
    }

    private function render_editor_script() { ?>
                <script type="text/javascript">
            ( function($) {
                if ( $.isFunction( $.fn.isotope ) ) {
                    $( '.exad-gallery-items' ).each( function() {
                        var $container  = $( this ).find( '.exad-gallery-element' );
                        var carouselNav = $container.attr( 'id' );

                        var galleryItem = '#' + $(this).attr( 'id' );
                        $container.isotope( {
                            filter: '*',
                            animationOptions: {
                                queue: true
                            }
                        } );

                        $( galleryItem + ' .exad-gallery-menu button' ).click(function(){
                            $( galleryItem + ' .exad-gallery-menu button.current' ).removeClass( 'current' );
                            $(this).addClass('current');
                     
                            var selector = $(this).attr( 'data-filter' );
                            $container.isotope( {
                                filter: selector,
                                animationOptions: {
                                    queue: true
                                }
                            } );
                            return false;
                        } );
                    } );
                }
            } )(jQuery);
            
        </script>
    <?php
    }

    protected function render() {
        
        $settings     = $this->get_settings_for_display();
        $show_title   = $settings['exad_fg_show_title'];
        $show_details = $settings['exad_fg_show_details'];
         ?>

        <div id ="exad-filterable-gallery-id-<?php echo $this->get_id(); ?>" class="exad-gallery-items">
            <div class="exad-gallery-one exad-gallery-wrapper">
            <?php
                if( 'yes' === $settings['exad_fg_show_constrols'] ): ?>
                    <div class="exad-gallery-menu">
                        <?php
                            do_action( 'exad_fg_controls_wrapper_before' );
                            if( !empty( $settings['exad_fg_all_items_text'] ) ) : ?>
                                <button data-filter="*" class="filter-item current"><?php echo esc_html($settings['exad_fg_all_items_text']); ?></button>
                            <?php    
                            endif;
                            $exad_gallerycontrols             = array_column( $settings['exad_fg_gallery_items'], 'exad_fg_gallery_control_name' );
                            $exad_fg_controls_comma_separated = implode( ', ', $exad_gallerycontrols );
                            $exad_fg_controls_array           = explode( ",",$exad_fg_controls_comma_separated );
                            $exad_fg_controls_lowercase       = array_map( 'strtolower', $exad_fg_controls_array );
                            $exad_fg_controls_remove_space    = array_filter( array_map( 'trim', $exad_fg_controls_lowercase ) );
                            $exad_fg_controls_items           = array_unique( $exad_fg_controls_remove_space );

                            foreach( $exad_fg_controls_items as $control ) :
                                $control_attribute = preg_replace( '#[ -]+#', '-', $control );
                                echo '<button class="filter-item" data-filter=".'.esc_attr( $control_attribute ).'">'.esc_html( $control ).'</button>';
                            endforeach;
                            do_action( 'exad_fg_controls_wrapper_after' );
                        ?>
                    </div>
                    <?php    
                endif;
                ?>

                <div id="filters-<?php echo $this->get_id(); ?>" class="exad-gallery-element">
                <?php
                    foreach( $settings['exad_fg_gallery_items'] as $index => $gallery ) :
                        $exad_controls                = $gallery['exad_fg_gallery_control_name'];
                        $exad_controls_to_array       = explode( ",",$exad_controls );
                        $exad_controls_to_lowercase   = array_map( 'strtolower', $exad_controls_to_array );
                        $exad_controls_remove_space   = array_filter( array_map( 'trim', $exad_controls_to_lowercase ) );
                        $exad_controls_space_replaced = array_map( function($val) { return str_replace( ' ', '-', $val ); }, $exad_controls_remove_space );
                        $exad_control                 = implode ( " ", $exad_controls_space_replaced );
                        $title                        = $gallery['exad_fg_gallery_item_title'];
                        $content                      = $gallery['exad_fg_gallery_item_content'];

                        do_action( 'exad_fg_item_wrapper_before' ); ?>
                        <div class="exad-gallery-item <?php echo esc_attr( $exad_control );?> rivet-col-lg-4">
                            <div class="exad-gallery-content-wrapper">
                                <div class="exad-gallery-image">
                                    <?php 
                                        $fg_image         = $gallery['exad_fg_gallery_img'];
                                        $fg_image_src_url = Group_Control_Image_Size::get_attachment_image_src( $fg_image['id'], 'exad_filter_image_size', $settings );

                                        if( empty( $fg_image_src_url ) ) {
                                            $fg_image_url = $fg_image['url']; 
                                        } else { 
                                            $fg_image_url = $fg_image_src_url;
                                        }
                                    ?>

                                        <img src="<?php echo esc_url( $fg_image_url ); ?>" />
                                </div>
                            </div>
                        </div>
                        <?php do_action('exad_fg_item_wrapper_after');
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <?php do_action('exad_fg_wrapper_after');

        // if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            $this->render_editor_script();
        // }
    }

}
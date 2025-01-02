<?php
namespace RivetCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * rivet Core
 *
 * Elementor widget for testimonial.
 *
 * @since 1.0.0
 */
class Testimonial extends Widget_Base {
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
		return 'rivet-testimonial';
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
		return __( 'Testimonial', 'rivet-core' );
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
		return 'rivet-elementor-icon eicon-testimonial';
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
		return [ 'rivet', 'testimonials', 'reviews', 'blockquote', 'feedback', 'slider', 'carousel' ];
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
        $rating_number = range( 1, 5 );
        $rating_number = array_combine( $rating_number, $rating_number );

        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => __( 'Testimonial', 'rivet-core' )
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'active',
            [
                'label'        => __( 'Active', 'rivet-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'description'  => __( 'Only applicable for style 7', 'rivet-core' )
            ]
        );

        $repeater->add_control(
            'name', 
            [
                'label'       => __( 'Name', 'rivet-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Lorraine Raines', 'rivet-core' )
            ]
        );

        $repeater->add_control(
            'testimonial',
            [
                'label'       => __( 'Testimonial', 'rivet-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => __( 'Lorem ipsum dolor amet consec tur elit adicing sed do usmod zx tempor enim minim veniam quis nostrud exer citation.', 'rivet-core' )
            ]
        );

        $repeater->add_control(
            'designation', 
            [
                'label'       => __( 'Designation', 'rivet-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Designer', 'rivet-core' )
            ]
        );

        $repeater->add_control(
            'thumb', 
            [
                'label'       => __( 'Reviewer Image', 'rivet-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url'     => Utils::get_placeholder_image_src()
                ],
                'description' => __( 'Not Applicable for Style 5.', 'rivet-core' )
            ]
        );

        $repeater->add_control(
            'rating', 
            [
                'label'       => __( 'Rating', 'rivet-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 5,
                'options'     => $rating_number,
                'description' => __( 'Not Applicable for Style 6.', 'rivet-core' )
            ]
        );

        $repeater->add_control(
            'logo_image_or_icon',
            [
                'label'     => __( 'Logo Image/Icon', 'rivet-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'icon',
                'description' => __( 'Applicable for Style 2, 3, 6, 7, 11.', 'rivet-core' ),
                'options'   => [
                    'image' => __( 'Image', 'rivet-core' ),
                    'icon'  => __( 'Icon', 'rivet-core' )
                ]
            ]
        );

        $repeater->add_control(
            'logo_thumb', 
            [
                'label'       => __( 'Logo Image', 'rivet-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url'     => Utils::get_placeholder_image_src()
                ],
                'description' => __( 'Applicable for Style 2, 3, 6, 7, 11.', 'rivet-core' ),
                'condition'   => [
                    'logo_image_or_icon' => 'image'
                ]
            ]
        );

        $repeater->add_control(
            'logo_icon', 
            [
                'label'       => __( 'Logo Icon', 'rivet-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-quote-right',
                    'library' => 'fa-solid'
                ],
                'description' => __( 'Applicable for Style 2, 3, 6, 7, 11.', 'rivet-core' ),
                'condition'   => [
                    'logo_image_or_icon' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [ 'name'  => __( 'Robert Lane', 'rivet-core' ) ],
                    [ 'name'  => __( 'Thomas Lopez', 'rivet-core' ) ],
                    [ 'name'  => __( 'Amber Page', 'rivet-core' ) ],
                    [ 'name'  => __( 'Ray Sanchez', 'rivet-core' ) ]
                ],
                'title_field' => '{{name}}'
            ]
        );

        $this->add_control(
            'settings_separator_before',
            [
                'type' => Controls_Manager::DIVIDER
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __( 'Style', 'rivet-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __( 'Style 1', 'rivet-core' ),
                    '2' => __( 'Style 2', 'rivet-core' ),
                    '3' => __( 'Style 3', 'rivet-core' ),
                    '4' => __( 'Style 4', 'rivet-core' ),
                    '5' => __( 'Style 5', 'rivet-core' ),
                    '6' => __( 'Style 6', 'rivet-core' ),
                    '7' => __( 'Style 7', 'rivet-core' ),
                    '8' => __( 'Style 8', 'rivet-core' ),
                    '9' => __( 'Style 9', 'rivet-core' ),
                    '10' => __( 'Style 10', 'rivet-core' ),
                    '11' => __( 'Style 11', 'rivet-core' ),
                    '12' => __( 'Style 12', 'rivet-core' ),
                    '13' => __( 'Style 13', 'rivet-core' ),
                ]
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'       => esc_html__( 'Heading', 'rivet-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Quality Service Make You Happy', 'rivet-core' ),
                'placeholder' => esc_html__( 'Write text here..', 'rivet-core' ),
                'label_block' => true,
                'condition'   => [
                    'style' => '8'
                ]
            ]
        );

        $this->add_control(
            'reviewer_thumb_label',
            [
                'label' => __( 'Reviewer Image Resolution', 'rivet-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style!' => '5'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'thumb_size',
                'default' => 'thumbnail',
                'condition' => [
                    'style!' => '5'
                ]
            ]
        );

        $this->add_control(
            'logo_thumb_label',
            [
                'label' => __( 'Logo Image Resolution', 'rivet-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => [ '2', '3', '6', '7', '10', '11' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'logo_thumb_size',
                'default' => 'thumbnail',
                'description' => __( 'Applicable for this style.', 'rivet-core' ),
                'condition' => [
                    'style' => [ '2', '3', '6', '7', '10', '11' ]
                ]
            ]
        );

        $this->add_control(
            'shadow_overly',
            [
                'label'        => __( 'Shadow Overly', 'rivet-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    'style' => '2'
                ]
            ]
        );

        $this->end_controls_section();

        // box style
        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__( 'Box Style', 'rivet-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ '2', '10' ]
                ]
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box_bg',
                'label'   => esc_html__( 'Background', 'rivet-core' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rivet-testimonial-card',
            ]
        );

        $this->add_control(
            'box_active_bg_color',
            [
                'label'       => esc_html__( 'Active Box Background Color', 'rivet-core' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivet-testimonial-style-2 .swiper-slide-active .rivet-testimonial-card' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__( 'Border', 'rivet-core' ),
                'selector' => '{{WRAPPER}} .rivet-testimonial-card',
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'rivet-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                '{{WRAPPER}} .rivet-testimonial-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
         );
        
        $this->end_controls_section();

        // qotation background
        $this->start_controls_section(
            'quote_style',
            [
                'label' => esc_html__( 'Qotation', 'rivet-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => '6'
                ]
            ]
        );
        
        $this->add_control(
            'quote_bg_color',
            [
                'label'       => esc_html__( 'Background Color', 'rivet-core' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qotation' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

	}

    /**
     * Echo testimonial rating
     *
     * @since 1.0.0
     *
     * @access protected
     *
     * @param int $ratings Rating value.
     */
    protected function rating( $ratings, $name = 'star' ) {
        for ( $i = 1; $i <= 5; $i++ ) :
            if ( $ratings >= $i ) :
                $active_class = '<span><img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/' . $name .  '.svg' ) . '" alt="' . esc_attr__( 'star', 'rivet-core' ) . '"></span>';
            else :
                $active_class = '<span class="deactive"><img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/' . $name .  '.svg' ) . '" alt="' . esc_attr__( 'star', 'rivet-core' ) . '"></span>';
            endif;
            echo $active_class;
        endfor;
    }

	/**
	 * Render the widget output in the editor.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'wrapper', 'class', 'rivet-testimonial-wrapper rivet-testimonial-wrapper-style-' . esc_attr( $settings['style'] ) );
        $this->add_render_attribute( 'container', 'class', 'rivet-testimonial rivet-testimonial-style-' . esc_attr( $settings['style'] ) );
        $sliderWrapper = 'swiper-wrapper';
        $sliderItem = 'swiper-slide';
        $this->add_render_attribute( 'container', 'class', 'swiper swiper-container swiper-container-initialized' );
        $this->add_render_attribute( 'swiper', 'class', $sliderWrapper );

        if( '2' === $settings['style'] && 'yes' == $settings['shadow_overly'] ) :
            $this->add_render_attribute( 'wrapper', 'class', 'rivet-testimonial-2__bg' );
        endif; 

        echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';

            if( '13' == $settings['style'] ) :
            echo '<div class="rivet-testimonial-15__wrap">';
                foreach( $settings['testimonials'] as $key => $testimonial ) : 
                    $image         = $testimonial['thumb'];
                    $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumb_size', $settings );

                    if ( empty( $image_src_url ) ) :
                        $image_url = $image['url']; 
                    else :
                        $image_url = $image_src_url;
                    endif;
                    include RIVET_PLUGIN_DIR . 'widgets/styles/testimonials/testimonial-13.php';
                endforeach;
            echo '<div>';
            else :
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                echo '<div ' . $this->get_render_attribute_string( 'swiper' ) . '>';
                    foreach( $settings['testimonials'] as $key => $testimonial ) : 
                        $image         = $testimonial['thumb'];
                        $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumb_size', $settings );

                        if ( empty( $image_src_url ) ) :
                            $image_url = $image['url']; 
                        else :
                            $image_url = $image_src_url;
                        endif;

                        $each_item = $this->get_repeater_setting_key('title', 'testimonials', $key);
                        $item_class = ['rivet-testimonial-item'];
                        $this->add_render_attribute( $each_item, 'class', $item_class );
                        $this->add_render_attribute( $each_item, 'class', 'elementor-repeater-item-'. esc_attr( $testimonial['_id'] ) );
                        echo '<div class="' . esc_attr( $sliderItem ) . '">';
                            echo '<div ' . $this->get_render_attribute_string( $each_item ) . '>';
                                include RIVET_PLUGIN_DIR . 'widgets/styles/testimonials/testimonial-' . $settings['style'] . '.php';
                            echo '</div>';
                        echo '</div>';
                    endforeach;
                echo '</div>';
            echo '</div>';
            endif;

        echo '</div>';
    }

    /**
     * Print icon or image
     *
     * @param array $settings
     * @param bool  $div
     * @param string $div_class
     * @param bool  $span
     * @param string $span_class
     */
    private function logo_print( $settings, $div = true, $div_class = '', $span = true, $span_class = '' ) {
        $div_class;
        $span_class;

        if( !empty( $div_class ) ) : 
        $this->add_render_attribute( 'div_class', [ 'class' => esc_attr( $div_class ) ] );
        endif;

        if( !empty( $span_class ) ) : 
        $this->add_render_attribute( 'span_class', [ 'class' => esc_attr( $span_class ) ] );
        endif;

        if ( 'image' === $settings['logo_image_or_icon'] ) :
            $image         = $settings['logo_thumb'];
            $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'logo_thumb_size', $settings );
            if ( empty( $image_src_url ) ) :
                $image_url = $image['url']; 
            else :
                $image_url = $image_src_url;
            endif;
            if( !empty( $image_url ) ) : 
            echo $div == true ? '<div ' . $this->get_render_attribute_string( 'div_class' ) . '>' : '';
                echo $span == true ? '<span ' . $this->get_render_attribute_string( 'span_class' ) . '>' : '';
                    echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $settings['thumb'] ) . '">';
                echo $span == true ? '</span>' : '';
            echo $div == true ? '</div>' : '';
            endif; 
        else :
            if( !empty( $settings['logo_icon']['value'] ) ) : 
            echo $div == true ? '<div ' . $this->get_render_attribute_string( 'div_class' ) . '>' : '';
                echo $span == true ? '<span ' . $this->get_render_attribute_string( 'span_class' ) . '>' : '';
                    Icons_Manager::render_icon( $settings['logo_icon'], [ 'aria-hidden' => 'true' ] );
                echo $span == true ? '</span>' : '';
            echo $div == true ? '</div>' : '';
            endif;
        endif;
    }
}
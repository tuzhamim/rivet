<?php
namespace RivetCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduBlink Core
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
                ]
            ]
        );

        $repeater->add_control(
            'rating', 
            [
                'label'       => __( 'Rating', 'rivet-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 5,
                'options'     => $rating_number
            ]
        );

        $repeater->add_control(
            'logo', 
            [
                'label'       => __( 'Brand Logo', 'rivet-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url'     => Utils::get_placeholder_image_src()
                ],
                'description' => __( 'Not Applicable for Style 1', 'rivet-core' )
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
                    '1'       => __( 'Style 1', 'rivet-core' ),
                    '2'       => __( 'Style 2', 'rivet-core' ),
                ]
            ]
        );

        $this->add_control(
            'pre_heading_icon',
            [
                'label' => esc_html__( 'Pre Heading Icon', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-trophy',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_control(
            'pre_heading',
            [
                'label'       => __( 'Pre Heading', 'rivet-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'TESTIMONIALS' , 'rivet-core' ),
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'       => __( 'Heading', 'rivet-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => __( 'What Our Students Say' , 'rivet-core' ),
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label'   => __( 'Sub Heading', 'rivet-core' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => __( 'Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor incididunt labore dolore magna aliquaenim ad minim.' , 'rivet-core' ),
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'thumb_size',
                'default' => 'thumbnail'
            ]
        );

        // $this->add_control(
        //     'autoplay',
        //     [
        //         'label'        => __( 'Autoplay', 'rivet-core' ),
        //         'type'         => Controls_Manager::SWITCHER,
        //         'label_on'     => __( 'Enable', 'rivet-core' ),
        //         'label_off'    => __( 'Disable', 'rivet-core' ),
        //         'default'      => 'yes',
        //         'return_value' => 'yes',
        //     ]
        // );

        // $this->add_control(
        //     'autoplay_speed',
        //     [
        //         'label'        => __( 'Autoplay Speed', 'rivet-core' ),
        //         'type'         => Controls_Manager::NUMBER,
        //         'placeholder'  => 3000,
        //         'condition'    => [
        //             'autoplay' => 'yes'
        //         ],
        //         'description'  => __( 'Speed in milliseconds. Example value: 3000', 'rivet-core' )
        //     ]
        // );

        $this->add_control(
            'navigation',
            [
                'label'        => __( 'Navigation', 'rivet-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'rivet-core' ),
                'label_off'    => __( 'Disable', 'rivet-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        // $this->add_control(
        //     'pagination',
        //     [
        //         'label'        => __( 'Pagination', 'rivet-core' ),
        //         'type'         => Controls_Manager::SWITCHER,
        //         'label_on'     => __( 'Enable', 'rivet-core' ),
        //         'label_off'    => __( 'Disable', 'rivet-core' ),
        //         'default'      => 'yes',
        //         'return_value' => 'yes',
        //     ]
        // );
        
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
    protected function rating( $ratings ) {
        for ( $i = 1; $i <= 5; $i++ ) :
            if ( $ratings >= $i ) :
                $active_class = '<span><img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/star.svg' ) . '" alt="' . esc_attr__( 'star', 'rivet-core' ) . '"></span>';
            else :
                $active_class = '<span class="deactive"><img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/star.svg' ) . '" alt="' . esc_attr__( 'star', 'rivet-core' ) . '"></span>';
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

        if( '1' == $settings['style'] ) :
            $this->add_render_attribute( 'wrapper', 'class', 'bg-primary-color' );
        endif;

        echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
            if( '1' == $settings['style'] ) :
                echo '<div class="rivet-row align-items-end">';
                    echo '<div class="rivet-col-lg-8">';
                        echo '<div class="rivet-section rivet-mb-50" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">';
                            if( !empty( $settings['pre_heading'] ) ) : 
                            echo '<span class="rivet-section__subtitle-white">';
                                \Elementor\Icons_Manager::render_icon( $settings[ 'pre_heading_icon' ], [ 'aria-hidden' => 'true', 'class' => 'rivet-mr-5' ] );
                                echo esc_html( $settings['pre_heading'] );
                            echo '</span>';
                            endif;
                            if ( !empty( $settings['heading'] ) ) :
                            echo '<h3 class="rivet-section__title-white">' . wp_kses_post( $settings['heading'] ) . '</h3>';
                            endif; 
                            if ( ! empty( $settings['sub_heading'] ) ) :
                            echo '<p class="rivet-section__sub-title-white">' . wp_kses_post( $settings['sub_heading']) . '</p>';
                            endif;
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="rivet-col-lg-4">';
                        if( 'yes' == $settings['navigation'] ) :
                        echo '<div class="rivet-testimonial__arrow rivet-mb-70">';
                            echo '<div class="rivet-testimonial__prev rivet-arrow-round">';
                                echo '<span><img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/prev-arrow.svg' ) . '" alt=""></span>';
                            echo '</div>';
                            echo '<div class="rivet-testimonial__next rivet-arrow-round rivet-ml-15">';
                                echo '<span><img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/next-arrow.svg' ) . '" alt=""></span>';
                            echo '</div>';
                        echo '</div>';
                        endif;
                    echo '</div>';
                echo '</div>';
                
                echo '<div class="rivet-row">';
                    echo '<div class="rivet-col-12">';

                        echo '<div class="rivet-testimonial__wrapper">';
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
                                    echo '<div class="swiper-slide">';
                                        echo '<div class="rivet-testimonial__item">';
                                            echo '<div class="rivet-testimonial__icon">';
                                                $this->rating( $testimonial['rating'] );
                                            echo '</div>';
                                            if( !empty( $testimonial['testimonial'] ) ) : 
                                            echo '<div class="rivet-testimonial__content">';
                                                echo '<p>“' . wp_kses_post( $testimonial['testimonial'] ) . '“</p>';
                                            echo '</div>';
                                            endif;
                                            echo '<div class="rivet-testimonial__avater">';
                                                if ( ! empty( $image_url ) ) :
                                                echo '<div class="rivet-testimonial__avater-thumb">';
                                                    echo '<img src="' . esc_url( $image_url ) . '" class="testimonial-author-avatar" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
                                                echo '</div>';
                                                endif;
                                                echo '<div class="rivet-testimonial__avater-text">';
                                                    echo $testimonial['name'] ? '<h4 class="rivet-testimonial__avater-title">' . esc_html( $testimonial['name'] ) . '</h4>' : '';
                                                    echo $testimonial['designation'] ? '<span>' . esc_html( $testimonial['designation'] ) . '</span>' : '';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                    endforeach;
                
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';

                    echo '</div>';
                echo '</div>';
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

                if( '2' == $settings['style'] ) :
                echo '<div class="rivet-testimonial-2__arrow rivet-mt-60">';
                    echo '<div class="rivet-testimonial-2__prev rivet-arrow-dark round">';
                        echo '<span><img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/arrow-long-left.svg' ) . '" alt=""></span>';
                    echo '</div>';
                    echo '<div class="rivet-testimonial-2__next rivet-arrow-dark round">';
                        echo '<span><img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/arrow-long-right.svg' ) . '" alt=""></span>';
                    echo '</div>';
                echo '</div>';
                endif; 
            endif;
        echo '</div>';
    }
}
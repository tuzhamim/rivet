<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

$rivet_post_thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
if ( isset( $rivet_post_thumb_src ) && ! empty( $rivet_post_thumb_src ) ) :
    $rivet_post_thumb_url = $rivet_post_thumb_src[0];
else :
    $rivet_post_thumb_url = '';
endif;

$excerpt_length = rivet_set_value( 'blog_post_excerpt_length', 42 );
if ( isset( $_GET['excerpt_length'] ) ) :
	$excerpt_length = (int)$_GET['excerpt_length'] ? $_GET['excerpt_length'] : $excerpt_length;
endif;

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( apply_filters( 'rivet_post_standard_classes', 'rivet-post-one-single-grid rivet-col-lg-12 rivet-blog-post-standard' ) ); ?>>
    <?php
    echo '<div class="edu-blog radius-small">';
        echo '<div class="inner">';
            if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                echo '<div class="thumbnail">';
                    echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                        echo '<img src="' . esc_url( $rivet_post_thumb_url ). '" alt="' . esc_attr( rivet_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '" >';
                    echo '</a>';

                    if ( rivet_category_by_id( get_the_ID() ) ) :
                        echo '<div class="top-position status-group left-top">';
                            echo '<span class="rivet-status status-01 bg-primary-color">' . wp_kses_post( rivet_category_by_id( get_the_ID(), 'category' ) ) . '</span>';
                        echo '</div>';
                    endif;
                echo '</div>';
            endif;

            echo '<div class="content">';
                echo '<ul class="rivet-blog-meta">';
                    echo '<li>';
                        echo '<i class="icon-eye-line"></i>';
                        echo rivet_post_estimated_reading_time() . ' '. __( 'Read', 'rivet' );
                    echo '</li>';

                    echo '<li>';
                        echo '<i class="icon-discuss-line"></i>';
                        printf( // WPCS: XSS OK.
                            /* translators: 1: comment count number, 2: title. */
                            esc_html( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'rivet' ) ),
                            number_format_i18n( get_comments_number() ),
                            '<span>' . get_the_title() . '</span>'
                        );
                    echo '</li>';

                    echo '<li>';
                        echo '<i class="icon-calendar-2-line"></i>';
                        echo esc_html( get_the_date( 'd M, Y' ) );
                    echo '</li>';
                echo '</ul>';

                echo rivet_get_title();

                echo '<div class="card-bottom">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $excerpt_length ), '...' ) );
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';
<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Rivet
 */

if ( ! function_exists( 'rivet_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function rivet_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) :
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		endif;

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'rivet' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'rivet_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function rivet_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'rivet' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'rivet_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function rivet_entry_footer() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'rivet' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		endif;

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'rivet' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'rivet_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function rivet_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ( ! has_post_thumbnail() && ! get_the_post_thumbnail_url() ) ) :
			return;
		endif;

		if ( is_singular() ) :
			?>

			<div class="rivet-postbox__details-thumb rivet-mb--30">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/postbox-thumb-1.jpg" alt="">
				<?php
					/**
					 * rivet_single_post_before hook
					 *
					 * @hooked rivet_single_post_before_content - 10
					 */
					do_action( 'rivet_single_post_before' );
				?>
			</div>

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'rivet-post-thumb', array(
				'alt' => the_title_attribute( array(
					'echo' => false
				) )
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


/**
 * Thumbnail alt attribute text
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'rivet_thumbanil_alt_text' ) ) :
	function rivet_thumbanil_alt_text( $image_id ) {
		$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        $title = get_post( $image_id )->post_title;
        $alt_text = apply_filters( 'rivet_thumbanil_alt_default_text', __( 'Post Thumb', 'rivet' ) );

        if ( $alt ) :
            $alt_text = $alt;
        else :
            $alt_text = $title;
        endif;
		return $alt_text;
	}
endif;

/**
 * Get tags meta
 *
 * @return string
 */
if ( ! function_exists( 'rivet_entry_meta_tags' ) ) :
	function rivet_entry_meta_tags() {
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) :
			return sprintf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'rivet' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		endif;

		return '';
	}
endif;

/**
 * Search Form Theme Style
 *
 */
if ( ! function_exists( 'rivet_search_form_replace' ) ) {
    function rivet_search_form_replace( $search_form ) {

        $search_form = sprintf(
            '<div class="rivet-search-box">
				<form class="search-form" action="%s" method="get">
					<input type="search" value="%s" required name="s" placeholder="%s">
					<button type="submit" class="search-button"><img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/search.svg' ) . '?>" alt=""></button>
				</form>
			</div>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            __( 'Search', 'rivet' )
        );

        return $search_form;
    }
    add_filter( 'get_search_form', 'rivet_search_form_replace' );
}

/**
 * Single Post Before Content
 *
 * @since 1.0.0
 */
add_action( 'rivet_single_post_before', 'rivet_single_post_before_content', 10 );
function rivet_single_post_before_content() {

echo '<div class="rivet-postbox__meta rivet-postbox__meta-position">';
    echo '<div class="rivet-postbox__meta-item">';
        echo '<div class="rivet-postbox__meta-icon">';
            echo '<span><img class="svgInject" src="' . get_template_directory_uri() . '/assets/img/icon/calendar-5.svg" alt=""></span>';
        echo '</div>';
        echo '<div class="rivet-postbox__meta-text">';
            echo '<p>Published</p>';
            echo '<span>' . esc_html( get_the_date( 'M d, Y' ) ) . '</span>';
        echo '</div>';
    echo '</div>';
    
    echo '<div class="rivet-postbox__meta-item">';
        echo '<div class="rivet-postbox__meta-icon">';
            echo '<span><img class="svgInject" src="' . get_template_directory_uri() . '/assets/img/icon/stopwatch.svg" alt=""></span>';
        echo '</div>';
        echo '<div class="rivet-postbox__meta-text">';
            echo '<p>Duration</p>';
            echo '<span>' . rivet_post_estimated_reading_time() . ' '. __( 'Read', 'rivet' ) . '</span>';
        echo '</div>';
    echo '</div>';
    
    echo '<div class="rivet-postbox__meta-item">';
        echo '<div class="rivet-postbox__meta-icon">';
            echo '<span><img class="svgInject" src="' . get_template_directory_uri() . '/assets/img/icon/user-circle-3.svg" alt=""></span>';
        echo '</div>';
        echo '<div class="rivet-postbox__meta-text">';
            echo '<p>Author</p>';
            echo '<span>By</span>';
            echo '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"> ' . esc_html( ucwords( get_the_author() ) ) . '</a>';
        echo '</div>';
    echo '</div>';
    
    echo '<div class="rivet-postbox__meta-item">';
        echo '<div class="rivet-postbox__meta-icon">';
            echo '<span><img class="svgInject" src="' . get_template_directory_uri() . '/assets/img/icon/chats.svg" alt=""></span>';
        echo '</div>';
        echo '<div class="rivet-postbox__meta-text">';
            echo '<p>Comments</p>';
            echo '<span>' . get_comments_number() . esc_html__( ' Comments', 'rivet' ) . '</span>';
        echo '</div>';
    echo '</div>';
echo '</div>';

}

/**
 * Single Post After Content
 *
 * Post Category and Post Share
 *
 * @since 1.0.0
 */
add_action( 'rivet_single_post_after', 'rivet_single_post_after_cats_social_share', 10 );
function rivet_single_post_after_cats_social_share() {
	if ( 'post' === get_post_type() && rivet_set_value( 'blog_single_catgory_and_social_share', true ) ) :
		$categories = rivet_category_by_id( get_the_ID(), 'category', false );
		echo '<div class="rivet-cat-social-share-wrapper">';
			echo '<div class="rivet-cat-social-share rivet-row">';
				if ( empty( $categories ) ) :
					$column = 'rivet-col-sm-12';
				else :
					$column = 'rivet-col-sm-6';
				endif;

				if( ! empty( $categories ) ) :
					echo '<div class="rivet-post-category ' . esc_attr( $column ). '">';
						echo wp_kses_post( $categories );
					echo '</div>';
				endif;
				
				echo '<div class="rivet-single-post-social-share ' . esc_attr( $column ). '">';
					echo '<span>' . __( 'Share: ', 'rivet' ) . '</span>';
					get_template_part( 'template-parts/social', 'share' );
				echo '</div>';
			echo '</div>';
		echo '</div>';
	endif;
}

/**
 * Single Post After Content
 *
 * Author Bio
 *
 * @since 1.0.0
 */
add_action( 'rivet_single_post_after', 'rivet_single_post_after_author_bio', 15 );
function rivet_single_post_after_author_bio() {
	if ( 'post' === get_post_type() && rivet_set_value( 'blog_single_author_bio', true ) ) :
		rivet_author_bio();
	endif;
}

/**
 * Single Post After Content
 *
 * Related Posts
 *
 * @since 1.0.0
 */
// add_action( 'rivet_single_post_after', 'rivet_single_post_after_related_posts', 20 );
function rivet_single_post_after_related_posts() {
	if ( 'post' === get_post_type() && rivet_set_value( 'blog_single_related_post', true ) ) :
		get_template_part( 'template-parts/related', 'posts' );
	endif;
}

/**
 * Single Post After Content
 *
 * Displays Previous & Next Post Naviation
 *
 * @since 1.0.0
 */
add_action( 'rivet_single_post_after', 'rivet_post_nav_prev_next', 20 );
if ( ! function_exists( 'rivet_post_nav_prev_next' ) ) :
	function rivet_post_nav_prev_next() {
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		if ( ! empty( $prev_post->post_title ) || ! empty( $next_post->post_title ) ) :
			echo '<div class="rivet-post-nav-prev-next rivet-row rivet-d-flex rivet-align-items-center">';
				if ( ! empty( $prev_post->post_title ) ) :
					echo '<div class="rivet-col-md-6">';
						echo '<div class="rivet-postbox__single-post-item">';
							echo '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '">';
								echo '<div class="rivet-postbox__single-post-icon mr-15">';
									echo '<i>';
										echo '<img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/arrow-left.svg' ) . '" alt="">';
									echo '</i>';
								echo '</div>';
								echo '<div class="rivet-postbox__single-post-text">';
									echo '<span>' . esc_html( 'Previous Blog', 'rivet' ) . '</span>';
									echo '<p>' . esc_html( $prev_post->post_title ) . '</p>';
								echo '</div>';
							echo '</a>';
						echo '</div>';
					echo '</div>';
				endif;

				if ( ! empty( $next_post->post_title ) ) :
					echo '<div class="rivet-col-md-6">';
						echo '<div class="rivet-postbox__single-post-item rivet-text-end right-post rivet-d-flex rivet-justify-content-end">';
							echo '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '">';
								echo '<div class="rivet-postbox__single-post-text">';
									echo '<span>' . esc_html( 'Previous Blog', 'rivet' ) . '</span>';
									echo '<p>' . esc_html( 'Billing & Customer Service' ) . '</p>';
								echo '</div>';
								echo '<div class="rivet-postbox__single-post-icon ml-15">';
									echo '<i>';
										echo '<img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/arrow-right-4.svg' ) . '" alt="">';
									echo '</i>';
								echo '</div>';
							echo '</a>';
						echo '</div>';
					echo '</div>';
				endif;
			echo '</div>';
		endif;
	}
endif;

<?php
if ( ! isset( $rivet_blog_post_style ) ) :
    $rivet_blog_post_style = rivet_set_value( 'blog_post_style', 'standard' );
endif;

if ( isset( $_GET['post_preset'] ) ) :
	$rivet_blog_post_style = in_array( $_GET['post_preset'], array( 1, 2, 3, 'standard' ) ) ? $_GET['post_preset'] : $rivet_blog_post_style;
endif;

if ( have_posts() ) :

	if ( is_home() && ! is_front_page() ) :
		?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>
		<?php
	endif;
	echo '<div class="rivet-row rivet-blog-post-archive-style-' . esc_attr( $rivet_blog_post_style ) . '">';
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			/*
			 * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			 */
			get_template_part( 'template-parts/posts/post', $rivet_blog_post_style );

		endwhile;
		wp_reset_postdata();
	echo '</div>';

	if ( function_exists( 'rivet_numeric_pagination' ) ) :
		rivet_numeric_pagination();
	else :
		the_posts_navigation();
	endif;

else :

	get_template_part( 'template-parts/content', 'none' );

endif;

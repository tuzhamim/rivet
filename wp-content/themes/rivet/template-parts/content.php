<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rivet
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'rivet-single-post' ); ?>>
	<?php rivet_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		if ( is_single() ) :

			the_content( sprintf(
				/* translators: %s: Name of current post. Only visible to screen readers */
				wp_kses( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'rivet' ), array( 'span' => array( 'class' => array() ) ) ),
				get_the_title()
			) );

			if ( function_exists( 'rivet_link_pages' ) ) :
				rivet_link_pages( array(
					'before' => '<nav class="rivet-theme-page-links">' . __( 'Pages:', 'rivet' ) . '<ul class="pager">',
					'after'  => '</ul></nav>',
				) );
			else :
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'rivet' ),
					'after'  => '</div>',
				) );
			endif;
			
			/**
			 * rivet_single_post_after hook
			 *
			 * @hooked rivet_single_post_after_cats_social_share - 10
			 * @hooked rivet_single_post_after_author_bio - 15
			 * @hooked rivet_post_nav_prev_next - 20
			 */
			do_action( 'rivet_single_post_after' );
		else :
			the_excerpt();
		endif;
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php rivet_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

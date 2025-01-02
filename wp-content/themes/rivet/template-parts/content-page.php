<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rivet
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'rivet-single-page' ); ?>>

	<?php rivet_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();
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
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer<?php do_action( 'rivet_page_footer_wrapper_class' ); ?>">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'rivet' ),
						array(
							'span' => array(
								'class' => array()
							)
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

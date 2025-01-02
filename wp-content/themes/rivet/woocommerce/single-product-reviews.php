<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'rivet' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Reviews', 'rivet' );
			}
			?>
		</h2>

		<?php if ( have_comments() ) : ?>
			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
							'next_text' => is_rtl() ? '&larr;' : '&rarr;',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'rivet' ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper">
			<div id="review_form">
                <?php
                    if ( wc_review_ratings_enabled() ) {
                        $rating = '<p class="comment-form-rating">
                        <label for="rating">' . esc_html__( 'Your Rating', 'rivet' ) .'</label>
                        <select name="rating" id="rating">
                            <option value="">' . esc_html__( 'Rate&hellip;', 'rivet' ) . '</option>
                            <option value="5">' . esc_html__( 'Perfect', 'rivet' ) . '</option>
                            <option value="4">' . esc_html__( 'Good', 'rivet' ) . '</option>
                            <option value="3">' . esc_html__( 'Average', 'rivet' ) . '</option>
                            <option value="2">' . esc_html__( 'Not that bad', 'rivet' ) . '</option>
                            <option value="1">' . esc_html__( 'Very Poor', 'rivet' ) . '</option>
                        </select></p>';
                    }

                    $commenter = wp_get_current_commenter();
                    $fields = array();
                        
                    $comment_form = array(
                        'title_reply'          => have_comments() ? esc_html__( 'Add A Review', 'rivet' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'rivet' ), get_the_title() ),
                        'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'rivet' ),
                        'comment_notes_before' => '',
                        'comment_notes_after'  => '',
                        'fields'               => array_merge( $fields, array(

                            'review' => $rating,

                            'author' => '<div class="rivet-row"><div class="rivet-col-md-6"><div class="comment-form-author form-group">'  .
                                        '<label>'.esc_attr__( 'Name', 'rivet' ).'</label>
                                        <input id="author" name="author" class="form-control" placeholder="'.esc_attr__( 'Your Name', 'rivet' ).'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />
                                        </div></div>',
                            'email'  => '<div class="rivet-col-md-6"><div class="comment-form-email form-group">' .
                                        '<label>'.esc_attr__( 'Email', 'rivet' ).'</label>
                                        <input id="email" name="email" class="form-control" placeholder="'.esc_attr__( 'Your Email', 'rivet' ).'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />
                                        </div></div></div>',
                        )),
                        'label_submit'  => esc_html__( 'Submit Review', 'rivet' ),
                        'logged_in_as'  => '',
                        'comment_field' => '',
                        'class_submit' => 'rivet-button-item rivet-button-type-fill submit'
                    );

                    if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
                        $comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf(wp_kses(__( 'You must be <a href="%s">logged in</a> to post a review.', 'rivet' ), array('a' => array('class' => array(), 'href' => array())) ), esc_url( $account_page_url ) ) . '</p>';
                    }

                    if ( wc_review_ratings_enabled() && is_user_logged_in() ) {
                        $comment_form['comment_field'] = '<p class="comment-form-rating d-flex align-items-center"><label for="rating">' . esc_html__( 'Your Rating', 'rivet' ) .'</label><select name="rating" id="rating">
                            <option value="">' . esc_html__( 'Rate&hellip;', 'rivet' ) . '</option>
                            <option value="5">' . esc_html__( 'Perfect', 'rivet' ) . '</option>
                            <option value="4">' . esc_html__( 'Good', 'rivet' ) . '</option>
                            <option value="3">' . esc_html__( 'Average', 'rivet' ) . '</option>
                            <option value="2">' . esc_html__( 'Not that bad', 'rivet' ) . '</option>
                            <option value="1">' . esc_html__( 'Very Poor', 'rivet' ) . '</option>
                        </select></p>';
                    }

                    $comment_form['comment_field'] .= '<div class="form-group space-comment">
                    <label>'.esc_attr__( 'Review', 'rivet' ).'</label>
                    <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" placeholder="'.esc_attr__( 'Your Review', 'rivet' ).'" aria-required="true"></textarea>
                        </div>';

                    $comment_form['class_form'] = 'rivet-woo-comment-form';
                    comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                ?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'rivet' ); ?></p>
	<?php endif; ?>

	<div class="clear"></div>
</div>

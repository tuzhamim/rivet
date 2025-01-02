<?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>

<ul class="rivet-social-share-icons-wrapper">
	<?php do_action( 'rivet_social_share_items_before' ); ?>

	<?php if ( rivet_set_value( 'linkedin_share', true ) ) : ?>
 		<li class="rivet-social-share-each-icon linkedin">
			<a class="rivet-social-share-link" href="https://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="<?php esc_attr_e( 'Share on LinkedIn', 'rivet' ); ?>">
				<i class="ri-linkedin-fill"></i>
			</a>
 		</li>
	<?php endif; ?>
	
	<?php if ( rivet_set_value( 'facebook_share', true ) ) : ?>
		<li class="rivet-social-share-each-icon facebook">
			<a class="rivet-social-share-link" href="https://www.facebook.com/sharer.php?s=100&u=<?php the_permalink(); ?>&i=<?php echo urlencode($full_image ? $full_image[0] : ''); ?>" target="_blank" title="<?php esc_attr_e( 'Share on facebook', 'rivet' ); ?>">
				<i class="ri-facebook-fill"></i>
			</a>
	 	</li>
	<?php endif; ?>
	<?php if ( rivet_set_value( 'twitter_share', true ) ) : ?>
 		<li class="rivet-social-share-each-icon twitter">
			<a class="rivet-social-share-link" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" title="<?php esc_attr_e( 'Share on Twitter', 'rivet' ); ?>">
				<i class="ri-twitter-fill"></i>
			</a>
 		</li>
	<?php endif; ?>

	<?php if ( rivet_set_value( 'pinterest_share', false ) ) : ?>
 		<li class="rivet-social-share-each-icon pinterest">
			<a class="rivet-social-share-link" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;description=<?php echo urlencode($post->post_title); ?>&amp;media=<?php echo urlencode( $full_image ? $full_image[0] : '' ); ?>" target="_blank" title="<?php esc_attr_e( 'Share on Pinterest', 'rivet' ); ?>">
				<i class="ri-pinterest-fill"></i>
			</a>
 		</li>
	<?php endif; ?>
	<?php do_action( 'rivet_social_share_items_after' ); ?>
</ul>
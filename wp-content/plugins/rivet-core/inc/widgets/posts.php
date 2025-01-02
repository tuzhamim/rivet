<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Rivet Recent Posts Widgets
 */ 
if( ! function_exists( 'rivet_register_recent_posts_widget' ) ) :
	function rivet_register_recent_posts_widget() {
	    register_widget( 'RivetCore_Recent_Posts_Widget' );
	}
endif;

add_action( 'widgets_init', 'rivet_register_recent_posts_widget' );

if( ! class_exists( 'RivetCore_Recent_Posts_Widget' ) ) :
	class RivetCore_Recent_Posts_Widget extends WP_Widget {

		function __construct() {
			parent::__construct(
				'RivetCore_Recent_Posts_Widget',
				__( 'Rivet Recent Post',  'rivet-core' ),
				array( 'description' => __( 'Rivet Recent Post Items',  'rivet-core' ), )
			);
		}

		public function widget( $args, $instance ) {

			extract( $args );
			extract( $instance );

			echo  $before_widget;

			if ( ! empty( $title ) ) {
				echo  $before_title . apply_filters( 'widget_title', $title ). $after_title;
			}

			$include = $include ? explode( ',', $include ) : array();
			$exclude = $exclude ? explode( ',', $exclude ) : array();

			$query = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'orderby'        => $orderby,
				'order'          => $order,
				'posts_per_page' => $number,
				'post__in'       => $include,
				'post__not_in'   => $exclude
			);  

			if ( 'yes' === $disable_sticky_posts ) :
				$query['ignore_sticky_posts'][] = true;
	        endif;

			$loop = new WP_Query( $query );
			echo '<div class="widget-posts recent-post-widget rivet-recent-post-widget">';
				if ( $loop->have_posts() ):
					while ( $loop->have_posts() ):
						$loop->the_post();

						$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
						if ( isset( $thumb_src ) && ! empty( $thumb_src ) ) :
							$thumb_url = $thumb_src[0];
						else :
							$thumb_url = get_template_directory_uri() . '/assets/images/no-image-found.png';
						endif;

						echo '<div class="rivet-recent-post-each-item">';
							if ( ! empty( $thumb_url) ) :
								echo '<div class="rivet-post-widget-thumb">';
									echo '<a href="' . esc_url( get_the_permalink() ) . '"><img src="' . esc_url( $thumb_url ) . '" alt="' . esc_attr( 'Thumb', 'rivet-core' ) . '"></a>';
								echo '</div>';
							endif;

							echo '<div class="media-body">';

								echo '<h5 class="entry-title">';
									echo '<a href="' . esc_url( get_the_permalink() ) . '" >' . esc_html( wp_trim_words( get_the_title(), $post_title_crop, '' ) ) . '</a>';
								echo '</h5>';

								echo '<div class="post-meta">';
									echo '<span class="meta-icon">';
										echo '<img class="svgInject" src="' . esc_url( get_template_directory_uri() . '/assets/img/icon/calendar-4.svg' ) . '" alt="' . esc_attr( 'Calender-Icon', 'rivet-core' ) . '">';
									echo '</span>';
									echo '<span class="post-meta-date"> ';
										echo get_the_date( 'd M, Y' );
									echo '</span>';
								echo '</div>';

							echo '</div>';
						echo '</div>';

					endwhile;
				else:
					echo '<div class="nopost_message">';
						echo '<p>' . __( 'No post avainable', 'rivet-core' ) . '</p>';
					echo '</div>';
				endif;
			echo '</div>';
			wp_reset_postdata();
 
			echo  $after_widget;
		}

		public function form( $instance ) {
			extract( $instance );
			$number               = isset( $number ) ? $number : 3;
			$orderby              = isset( $orderby ) ? $orderby : 'date';
			$order                = isset( $order ) ? $order : 'DESC';
			$include              = isset( $include ) ? $include : '';
			$exclude              = isset( $exclude ) ? $exclude : '';
			$post_title_crop      = isset( $post_title_crop ) ? $post_title_crop : 7;
			$disable_sticky_posts = isset( $instance['disable_sticky_posts'] ) ? $instance['disable_sticky_posts'] : 'no';
		?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'rivet-core' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php if( isset( $title ) ) echo esc_attr( $title ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Post Orderby:', 'rivet-core' ); ?></label> 
				<select class="widefat" id="<?php echo  $this->get_field_id( 'orderby' ); ?>" name="<?php echo  $this->get_field_name( 'orderby' ); ?>">
					<option value="date" <?php selected( $orderby, 'date' ) ?>><?php esc_html_e( 'Date', 'rivet-core' ); ?></option>
					<option value="ID" <?php selected( $orderby, 'ID' ) ?>><?php esc_html_e( 'ID', 'rivet-core' ); ?></option>
					<option value="author" <?php selected( $orderby, 'author' ) ?>><?php esc_html_e( 'Author', 'rivet-core' ); ?></option>
					<option value="title" <?php selected( $orderby, 'title' ) ?>><?php esc_html_e( 'Title', 'rivet-core' ); ?></option>
					<option value="name" <?php selected( $orderby, 'name' ) ?>><?php esc_html_e( 'Name', 'rivet-core' ); ?></option>
					<option value="rand" <?php selected( $orderby, 'rand' ) ?>><?php esc_html_e( 'Rand', 'rivet-core' ); ?></option>
					<option value="menu_order" <?php selected( $orderby, 'menu_order' ) ?>><?php esc_html_e( 'Menu order', 'rivet-core' ); ?></option>
					<option value="none" <?php selected( $orderby, 'none' ) ?>><?php esc_html_e( 'None', 'rivet-core' ); ?></option>
				</select>
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Post order:', 'rivet-core' ); ?></label> 
				<select class="widefat" id="<?php echo  $this->get_field_id( 'order' ); ?>" name="<?php echo  $this->get_field_name( 'order' ); ?>">
					<option value="DESC" <?php selected( $order, 'DESC' ) ?>><?php esc_html_e( 'Descending', 'rivet-core' ); ?></option>
					<option value="ASC" <?php selected( $order, 'ASC' ) ?>><?php esc_html_e( 'Ascending', 'rivet-core' ); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of Posts:', 'rivet-core' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php if( isset( $number ) ) echo esc_attr( $number ); ?>">
				<span class="rivet-widget-description"><?php esc_html_e( 'Number of posts to show. Default: 3', 'rivet-core' ); ?></span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'include' ) ); ?>"><?php esc_html_e( 'Include Post:', 'rivet-core' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'include' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'include' ) ); ?>" type="text" value="<?php if( isset( $include ) ) echo esc_attr( $include ); ?>">
				<span class="rivet-widget-description"><?php esc_html_e( 'Comma separated string of post IDs to include', 'rivet-core' ); ?></span>
			</p>			

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>"><?php esc_html_e( 'Exclude Post:', 'rivet-core' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" type="text" value="<?php if( isset( $exclude ) ) echo esc_attr( $exclude ); ?>">
				<span class="rivet-widget-description"><?php esc_html_e( 'Comma separated string of post IDs to exclude', 'rivet-core' ); ?></span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_title_crop' ) ); ?>"><?php esc_html_e( 'Post Title Crop:', 'rivet-core' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_title_crop' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_title_crop' ) ); ?>" type="text" value="<?php if( isset( $post_title_crop ) ) echo esc_attr( $post_title_crop ); ?>">
				<span class="rivet-widget-description"><?php esc_html_e( 'Number of words to show at post title.', 'rivet-core' ); ?></span>
			</p>

			<p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'disable_sticky_posts' ) ); ?>"><?php _e( 'Disable Sticky Posts:', 'rivet-core' ); ?></label>
	            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'disable_sticky_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'disable_sticky_posts' ) ); ?>" type="checkbox" value="yes" <?php checked( $disable_sticky_posts, 'yes', true ); ?>/>
	        </p>
			<?php 
		}

		public function update( $new_instance, $old_instance ) {
			$instance                         = array();
			$instance['title']                = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['number']               = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
			$instance['orderby']              = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
			$instance['order']                = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
			$instance['exclude']              = ( ! empty( $new_instance['exclude'] ) ) ? strip_tags( $new_instance['exclude'] ) : '';
			$instance['include']              = ( ! empty( $new_instance['include'] ) ) ? strip_tags( $new_instance['include'] ) : '';
			$instance['post_title_crop']      = ( ! empty( $new_instance['post_title_crop'] ) ) ? strip_tags( $new_instance['post_title_crop'] ) : '';
			$instance['disable_sticky_posts'] = ( ! empty( $new_instance['disable_sticky_posts'] ) ) ? strip_tags( $new_instance['disable_sticky_posts'] ) : '';
			return $instance;
		}

	}
endif;
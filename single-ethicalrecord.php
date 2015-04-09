<?php get_header(); ?>

	<div class="row article">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div <?php post_class('nine columns'); ?>>
		<?php if(has_term('book-reviews', 'section')) { ?>
			<div itemscope itemtype="http://schema.org/Review">
		<?php } ?>
		<?php if(has_term('talks-lectures', 'section')) { ?>
			<div itemscope itemtype="http://schema.org/Article">
		<?php } ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured'); ?></a>
				<small><?php the_post_thumbnail_caption(); ?></small>
			<?php } ?>

			<h2 class="entry-title" itemprop="name"><?php the_title(); ?></h2>
			<?php if(has_term('talks-lectures', 'section')) { ?>
			<h6><?php post_read_time(); ?></h6>
			<?php } ?>
			<?php if(has_term('book-reviews', 'section')) { ?>
			<h6><?php post_read_time(); ?></h6>
			<?php } ?>
			<?php
				if ( 'speaker' == get_post_type() ) {
			?>

			<?php } else { ?>
			<h6 class="entry-date"><meta itemprop="datePublished" content="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'l, jS M, Y' ); ?></meta></h6>
    		<?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); if( $date != '' ) :  ?>
    			<h6 class="entry-date">Lecture date: <?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); echo date('D, jS M, Y', strtotime($date))  ?></h6>
    		<?php endif; ?>
			<?php } ?>
    		<?php
				if ( function_exists( 'sharing_display' ) ) {
				    sharing_display( '', true );
				}
    		?>
			<?php global $post; $video = get_post_meta( $post->ID, '_cmb_video', true ); if( $video != '' ) :  ?>
				<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), $prefix . '_cmb_video', true ) );  ?>
			<?php endif; ?>

			<?php the_content(); ?>
			<?php global $post; $references = get_post_meta( $post->ID, '_cmb_ref', true ); if( $references != '' ) :  ?>
			<div class="references">
				<h5>References</h5>
				<p><?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), $prefix . '_cmb_ref', true ) );  ?></p>
			</div>
			<?php endif; ?>
			<?php if( has_tag() ) { ?>
			    <p><i class="icon-tag"></i><?php the_tags('', ', ', ''); ?></p>
			<?php } else { ?>

			<?php } ?>
			<?php
			$terms = get_the_terms( $post->ID, 'taxonomy' );
			if ( $terms && ! is_wp_error( $terms ) ) :
				$taxonomy_links = array();
				foreach ( $terms as $term ) {
					$taxonomy_links[] = '<a href="/taxonomy/'.$term->slug.'">'.$term->name.'</a>';
				}
				$taxonomy = join( ", ", $taxonomy_links );
			?>
			<p class="taxonomy">
				<i class="icon-address"></i><?php echo $taxonomy; ?>
			</p>
			<?php endif; ?>
			<?php
				if ( 'speaker' == get_post_type() ) {
			?>
				<h4>Talks/Lectures</h4>
			<?php
    			$args = array (
    				'connected_type' => 'lectures2speakers',
    				'connected_items' => get_queried_object(),
    				'nopaging' => true,
    			);
    			$lecture_speaker = new WP_Query( $args );
    			if ( $lecture_speaker->have_posts() ) {
    				while ( $lecture_speaker->have_posts() ) {
    					$lecture_speaker->the_post();
    		?>
			<div class="row article">
				<div class="twelve columns">
		    		<h5><a href="<?php the_permalink(); ?>"><i class="icon-comment"></i> <?php the_title(); ?></a></h5>
				</div>
			</div>
    		<?php
    				}
    			} else {
    				// no posts found
    			}
    			wp_reset_postdata();
    			}
    		?>
			<?php
				if ( function_exists( 'sharing_display' ) ) {
				    sharing_display( '', true );
				}
				if ( class_exists( 'Jetpack_Likes' ) ) {
				    $custom_likes = new Jetpack_Likes;
				    echo $custom_likes->post_likes( '' );
				}
    		?>
    		<?php if(has_term('lectures', 'book-reviews', 'videos')) { ?>
			<div class="relatedposts row article">
				<div class="twelve columns">
					<h4>Related posts</h4>
				</div>
			</div>
			<div class="relatedposts row article">
			<?php
				$orig_post = $post;
				global $post;
				$tags = wp_get_post_tags($post->ID);
				if ($tags) {
					$tag_ids = array();
					foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
					$args=array(
						'tag__in' => $tag_ids,
						'post__not_in' => array($post->ID),
						'posts_per_page'=>4, // Number of related posts to display.
						'caller_get_posts'=>1
					);
					$my_query = new wp_query( $args );
					while( $my_query->have_posts() ) {
						$my_query->the_post();
			?>
			<div class="relatedthumb three columns">
				<a rel="external" href="<?php the_permalink()?>"><?php the_post_thumbnail('article'); ?><small><?php the_post_thumbnail_caption(); ?></small>
					<h6>
						<?php if(has_term('talks-lectures', 'section')) { ?>
						<i class="icon-comment"></i>
						<?php } ?>
						<?php if(has_term('book-reviews', 'section')) { ?>
						<i class="icon-book"></i>
						<?php } ?>
						<?php if(has_term('videos', 'section')) { ?>
						<i class="icon-video"></i>
						<?php } ?>
						<?php the_title(); ?>
					</h6>
				</a>
			</div>

			<?php
					}
				}
				$post = $orig_post;
				wp_reset_query();
				?>
			</div>
			<?php } ?>
			<div class="row">
				<?php comments_template(); ?>
			</div>
		<?php if(has_term('book-reviews', 'section')) { ?>
			</div>
		<?php } ?>
		<?php if(has_term('talks-lectures', 'section')) { ?>
			</div>
		<?php } ?>
		</div>

		<div class="three columns side">

			<?php if(has_term('talks-lectures', 'section')) { ?>
			<div class="row">

				<?php
					$args = array (
						'connected_type' => 'lectures2speakers',
						'connected_items' => get_queried_object(),
						'nopaging' => true,
					);
					$lecture_speaker = new WP_Query( $args );
					if ( $lecture_speaker->have_posts() ) {
						while ( $lecture_speaker->have_posts() ) {
							$lecture_speaker->the_post();
				?>
				<div class="twelve columns">

					<div class="sidebar widget">

						<h5>Speaker:</h5>

						<h4 itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_title(); ?></span></h4>

						<div class="thumb">
							<?php if ( has_post_thumbnail() ) { ?>
								<p><?php the_post_thumbnail('speaker'); ?><br/><small><?php the_post_thumbnail_caption(); ?></small></p>
							<?php } ?>
						</div>
						<?php the_content(); ?>

					</div>

				</div>

				<?php
						}
					} else {
						// no posts found
					}
					wp_reset_postdata();
				?>
			</div>
			<?php } ?>
			<?php if(has_term('the-vaults', 'section')) { ?>
			<div class="row">

				<?php
					$args = array (
						'connected_type' => 'lectures2speakers',
						'connected_items' => get_queried_object(),
						'nopaging' => true,
					);
					$lecture_speaker = new WP_Query( $args );
					if ( $lecture_speaker->have_posts() ) {
						while ( $lecture_speaker->have_posts() ) {
							$lecture_speaker->the_post();
				?>
				<div class="twelve columns">

					<div class="sidebar widget">

						<h5>Writer:</h5>

						<h4 itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_title(); ?></span></h4>

						<div class="thumb">
							<?php if ( has_post_thumbnail() ) { ?>
								<p><?php the_post_thumbnail('speaker'); ?><br/><small><?php the_post_thumbnail_caption(); ?></small></p>
							<?php } ?>
						</div>
						<?php the_content(); ?>

					</div>

				</div>

				<?php
						}
					} else {
						// no posts found
					}
					wp_reset_postdata();
				?>
			</div>
			<?php } ?>
			<?php if(has_term('book-reviews', 'section')) { ?>
			<div class="row">
				<div class="twelve columns">

					<div class="sidebar widget">
						<h5>Book Review</h5>
						<?php global $post; $author = get_post_meta( $post->ID, '_cmb_author', true ); if( $author != '' ) :  ?>
							<p>By: <strong itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_author', true ); echo $publisher;  ?></span></strong>
							<?php global $post; $author = get_post_meta( $post->ID, '_cmb_publisher', true ); if( $author != '' ) :  ?>
								(<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><span itemprop="name"><?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_publisher', true ); echo $publisher;  ?></span></span>)
							<?php endif; ?>
							<?php global $post; $isbn = get_post_meta( $post->ID, '_cmb_publisher', true ); if( $isbn != '' ) :  ?>
								ISBN: <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><span itemprop="name"><?php global $post; $isbn = get_post_meta( $post->ID, '_cmb_isbn', true ); echo $isbn;  ?></span></span>
							<?php endif; ?>
							</p>
							<p itemprop="author" itemscope itemtype="http://schema.org/Person">Review by: <span itemprop="name"><?php global $post; $vpauthor = get_post_meta( $post->ID, '_cmb_vpauthor', true ); echo $vpauthor;  ?></span></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php } ?>




			<div class="row">
				<div class="twelve columns">
					<ul>
					<?php dynamic_sidebar( 'join' ); ?>
					<?php dynamic_sidebar( 'homepage' ); ?>
					</ul>
				</div>
			</div>

		</div>

		<?php endwhile; ?>
		<?php else: ?>

		<h2>Sorry, no posts matched your criteria.</h2>

		<?php endif; ?>
	</div>

<?php get_footer(); ?>
<?php get_header(); ?>

<div class="row">
	<div class="nine columns" id="scroll">
	<h2>Ethical Record <div class="alignright"><a href="/feed/"><i class="icon-rss"></i></a></div></h2>
		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array (
			'post_type' => 'ethicalrecord',
			'posts_per_page' => 5,
			'post__in'=>get_option('sticky_posts'),
			'tax_query' => array(
				array(
					'taxonomy' => 'section',
					'field' => 'slug',
					'terms' => array('talks-lectures', 'book-reviews', 'an-ethical-thirst')
				),
			),
			'paged' => $paged
		);
		$featured = new WP_Query( $args );
		?>
		<?php if ( $featured->have_posts() ) :  while ( $featured->have_posts() ) : $featured->the_post(); ?>
		<div class="row article">
			<div <?php post_class('twelve columns sticky'); ?>>
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured',array('itemprop'=>'image')); ?></a>
					<small><?php the_post_thumbnail_caption(); ?></small>
				<?php } ?>
				<?php if(has_term('talks-lectures','section')) { ?>
		    		<h5>Lecture</h5>
		    	<?php } ?>
		    	<?php if(has_term('book-reviews','section')) { ?>
		    		<h5>Book Review</h5>
		    	<?php } ?>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
    			<?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); if( $date != '' ) :  ?>
    				<h6>Lecture date: <?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); echo date('D, jS M, Y', strtotime($date))  ?></h6>
    			<?php endif; ?>
    			<h6><?php post_read_time(); ?></h6>
    			<?php if(has_term('talks-lectures','section')) { ?>
    				<?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); if( $abstract != '' ) :  ?>
    					<p><?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); echo $abstract;  ?> ...<a href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
    				<?php endif; ?>
					<?php
						$args = array (
							'connected_type' => 'lectures2speakers',
							'connected_items' => $post,
							'nopaging' => true,
						);
						$lecture_speaker = new WP_Query( $args );
						if ( $lecture_speaker->have_posts() ) {
							while ( $lecture_speaker->have_posts() ) {
								$lecture_speaker->the_post();
					?>
					<h6>Speaker: <?php the_title(); ?></h6>
					<?php
							}
						} else {
							// no posts found
						}
						wp_reset_postdata();
					?>
    			<?php } elseif (has_term('book_reviews')) { ?>
    				<?php global $post; $author = get_post_meta( $post->ID, '_cmb_author', true ); if( $author != '' ) :  ?>
    					<p>By: <strong><?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_author', true ); echo $publisher;  ?></strong>
    					<?php global $post; $author = get_post_meta( $post->ID, '_cmb_publisher', true ); if( $author != '' ) :  ?>
    						(<?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_publisher', true ); echo $publisher;  ?>)
    					<?php endif; ?>
    					</p>
    					<?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); if( $reviewer != '' ) :  ?>
		    				<p>Review by: <?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); echo $reviewer;  ?></p>
		    			<?php endif; ?>
    					<?php the_excerpt(); ?>
    				<?php endif; ?>
    			<?php } ?>
			</div>
		</div>
		<?php endwhile; ?>

		<?php else : ?>

		<?php endif; ?>
		<div class="row article">
			<div class="six columns">
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array (
					'post_type' => 'ethicalrecord',
					'ignore_sticky_posts' => 1,
					'post__not_in'=>get_option('sticky_posts'),
					'tax_query' => array(
						array(
							'taxonomy' => 'section',
							'field' => 'slug',
							'terms' => array('talks-lectures', 'book-reviews', 'an-ethical-thirst')
						),
					),					'paged' => $paged
				);
				$loop = new WP_Query( $args );
				?>
				<?php if ( $loop->have_posts() ) :  while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div class="row article">
					<div <?php post_class('twelve columns'); ?>>
					<?php $terms = get_the_terms( $post->ID, 'taxonomy' ); ?>
					<div class="<?php foreach( $terms as $term ) echo ' ' . $term->slug; ?>">
		    			<?php if(has_term('talks-lectures','section')) { ?>
		    			<h5>Lecture</h5>
		    			<?php } ?>
		    			<?php if(has_term('book-reviews','section')) { ?>
		    			<h5>Book Review</h5>
		    			<?php } ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured',array('itemprop'=>'image')); ?></a>
							<small><?php the_post_thumbnail_caption(); ?></small>
						<?php } ?>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

		    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
		    			<?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); if( $date != '' ) :  ?>
		    				<h6>Lecture date: <?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); echo date('D, jS M, Y', strtotime($date))  ?></h6>
		    			<?php endif; ?>
		    			<h6><?php post_read_time(); ?></h6>
		    			<?php if(has_term('talks-lectures','section')) { ?>
		    				<?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); if( $abstract != '' ) :  ?>
		    					<p><?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); echo $abstract;  ?>..<a href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
								<?php
									$args = array (
										'connected_type' => 'lectures2speakers',
										'connected_items' => $post,
										'nopaging' => true,
									);
									$lecture_speaker = new WP_Query( $args );
									if ( $lecture_speaker->have_posts() ) {
										while ( $lecture_speaker->have_posts() ) {
											$lecture_speaker->the_post();
								?>
								<h6>Speaker: <?php the_title(); ?></h6>
								<?php
										}
									} else {
										// no posts found
									}
									wp_reset_postdata();
								?>
		    				<?php endif; ?>
		    			<?php } elseif (has_term('book-reviews','section')) { ?>
		    				<?php global $post; $author = get_post_meta( $post->ID, '_cmb_author', true ); if( $author != '' ) :  ?>
		    					<p>By: <strong><?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_author', true ); echo $publisher;  ?></strong>
		    					<?php global $post; $author = get_post_meta( $post->ID, '_cmb_publisher', true ); if( $author != '' ) :  ?>
		    						(<?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_publisher', true ); echo $publisher;  ?>)
		    					<?php endif; ?>
		    					</p>
		    					<?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); if( $reviewer != '' ) :  ?>
				    				<p>Review by: <?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); echo $reviewer;  ?></p>
				    			<?php endif; ?>
		    					<?php the_excerpt(); ?>
		    				<?php endif; ?>
		    			<?php } ?>
					</div>
					</div>
				</div>
				<?php endwhile; ?>
		<div class="twelve columns">
			<?php wp_pagenavi(); ?>
		</div>
				<?php else : ?>

				<?php endif; ?>
			</div>
			<div class="six columns">
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array (
					'post_type' => 'ethicalrecord',
					'ignore_sticky_posts' => 1,
					'post__not_in'=>get_option('sticky_posts'),
					'tax_query' => array(
						array(
							'taxonomy' => 'section',
							'field' => 'slug',
							'terms' => array('videos')
						),
					),
					'posts_per_page' => 5,
					'paged' => $paged
				);
				$loop = new WP_Query( $args );
				?>
				<?php if ( $loop->have_posts() ) :  while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div class="row article">
					<div <?php post_class('twelve columns'); ?>>
		    			<?php if(has_term('videos','section')) { ?>
		    			<h5>Video</h5>
		    			<?php } ?>
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

		    			<?php global $post; $video = get_post_meta( $post->ID, '_cmb_video', true ); if( $video != '' ) :  ?>
							<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), $prefix . '_cmb_video', true ) );  ?>
						<?php endif; ?>
					</div>
				</div>
				<?php endwhile; ?>

				<?php else : ?>

				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="three columns">
		<div class="row">
			<div class="twelve columns">
				<ul>
					<?php dynamic_sidebar( 'join' ); ?>
					<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
			</div>
		</div>
	</div>

</div>


<?php get_footer(); ?>
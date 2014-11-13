<?php get_header(); ?>

<div class="row">

	<div class="nine columns">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>	
		<?php the_content(); ?>
		
					<?php
						$args = array (
							'post_type' => 'tribe_events',
							'posts_per_page' => '5',
							'tax_query' => array(
								array(
									'taxonomy' => 'tribe_events_cat',
									'field' => 'slug',
									'terms' => array('sunday-concerts'),
								)
							),
						);
						$sunday_posts = new WP_Query( $args );
						if ( $sunday_posts->have_posts() ) {
							while ( $sunday_posts->have_posts() ) {
								$sunday_posts->the_post();
						?>
						<div <?php post_class('sticky'); ?>>
							<div class="row">
								<div class="twelve columns ">
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<?php echo tribe_events_event_schedule_details( $event_id, '<h5>', '</h5>' ); ?>
								</div>
							</div>
							<div class="row">
								<div class="five columns">
									<a href="<?php the_permalink(); ?>" class="th"><?php the_post_thumbnail('article'); ?></a>
								</div>
								<div class="seven columns">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</div>
						<?php
							}
						} else {
						
						}
						wp_reset_postdata();							
					?>
					<p><a href="<?php echo tribe_get_events_link() ?>"> <?php _e( '&laquo; All Events', 'tribe-events-calendar' ) ?></a></p>

	
	<?php endwhile; ?>
	
	<?php endif; ?>
	
	</div>	
	
	<div class="three columns side">
		
		<div class="row">
			<div class="twelve columns">
				<ul>
					<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
			</div>
		</div>		

	</div>

</div>

<?php get_footer(); ?>
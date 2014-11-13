<?php get_header(); ?>

<div class="row">

	<div class="nine columns">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>	
		<?php the_content(); ?>

		<?php
		// WP_Query arguments
		$args = array (
			'post_type' => 'jobs',
		);
		// The Query
		$room_hire = new WP_Query( $args );
		// The Loop
		if ( $room_hire->have_posts() ) {
			while ( $room_hire->have_posts() ) {
				$room_hire->the_post();
		?>
		<div class="sticky">
			<div class="row">
				<div class="twelve columns">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php the_excerpt(); ?>
					<p>Posted in: <?php the_category(', '); ?></p>
				</div>
			</div>
		</div>
		<?php
			}
		} else {
			// no posts found
		}
		// Restore original Post Data
		wp_reset_postdata();	
		?>
	
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
<?php get_header(); ?>

<div class="row">

	<div <?php post_class('nine columns'); ?> role="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>	
		<h5><?php the_time( 'D, jS M, Y' ); ?></h5>
		<?php the_content(); ?>

	<?php endwhile; ?>
	<div class="row">
		<div class="six columns">
			<?php previous_post('&laquo; %', '', 'yes'); ?>
		</div>
		<div class="six columns">
			<?php next_post('% &raquo; ', '', 'yes'); ?>
		</div>
	</div>	
	<?php endif; ?>
	<div class="row">
		<?php comments_template(); ?>
	</div>
	</div>	
	
	<div class="three columns side" role="complementary">
		
		<div class="row">
			<div class="twelve columns">
				<ul>
					<?php
					// Find connected pages
					$connected = new WP_Query( array(
						'connected_type' => 'pdf_to_job',
						'connected_items' => get_queried_object(),
						'nopaging' => true,
					) );
					
					// Display connected pages
					if ( $connected->have_posts() ) :
					?>
					<li class="widget">
					<h5 class="widget">Related Documents:</h3>
					<ul class="menu related">
					<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
					    <li><a href="<?php global $post; $text = get_post_meta( $post->ID, '_cmb_pdf', true ); echo $text; ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					</ul>
					</li>
					<?php 
					// Prevent weirdness
					wp_reset_postdata();
					
					endif;
					?>	
					<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
			</div>
		</div>		

	</div>

</div>

<?php get_footer(); ?>
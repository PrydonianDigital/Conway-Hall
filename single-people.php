<?php get_header(); ?>

<div class="row hfeed">

	<div <?php post_class('nine columns h-entry'); ?> role="main" itemscope itemtype="http://schema.org/BlogPosting">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2 itemprop="name headline" class="entry-title p-name"><?php the_title(); ?></h2>	
		<a href="https://plus.google.com/+ConwayhallOrgUk1929" rel="publisher"></a>
		<div itemprop="articleBody" class="e-content">
			<div class="alignleft">
				<?php the_post_thumbnail('speaker'); ?>
			</div>	
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>

	<?php endif; ?>

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
					    <li><a href="<?php global $post; $text = get_post_meta( $post->ID, '_cmb_pdf', true ); echo $text; ?>" download><?php the_title(); ?></a></li>
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
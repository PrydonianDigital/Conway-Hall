<?php get_header(); ?>

<div class="row">

	<div class="nine columns" role="main">
		
		<div class="row">
			<div class="twelve columns">
				<h2><?php echo $wp_query->found_posts; ?> results for: "<?php the_search_query(); ?>"</h2>
			</div>
		</div>
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div <?php post_class('sticky'); ?>>
			<div class="row">
				<div class="twelve columns">
					<h4><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="summary entry-title"><?php the_title(); ?></a></h4>
					<?php if ( tribe_get_cost() ) : ?>
						<div class="tribe-events-event-cost">
							<span><?php echo tribe_get_cost( null, true ); ?></span>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="five columns">
					<a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo get_the_post_thumbnail($page->ID);?></a>
				</div>
				<div class="seven columns">
					<?php the_excerpt(); ?>	
				</div>
			</div>
		</div>	
			
		<?php endwhile; ?>
		<?php wp_pagenavi(); ?>
		<?php endif; ?>
	
	</div>	
	
	<div class="three columns side" role="complementary">
		
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
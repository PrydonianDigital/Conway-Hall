<?php get_header(); ?>
	
	<div class="row">
	
		<div class="nine columns">
			<h2>Speakers<div class="alignright"><a href="feed/"><i class="icon-rss"></i></a></div></h2>
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array (
				'post_type' => 'speaker',
				'paged' => $paged
			);
			$speaker = new WP_Query( $args );
			?>	
			<?php if ( $speaker->have_posts() ) :  while ( $speaker->have_posts() ) : $speaker->the_post(); ?>
		
			<div class="row article">
			
				<div <?php post_class('twelve columns'); ?>>
					<div class="row article">
					<?php if ( has_post_thumbnail() ) { ?>
    					<div class="four columns">
    						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('speaker'); ?></a><small><?php the_post_thumbnail_caption(); ?></small>
    					</div>
    					<div class="eight columns">
    						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    						<?php the_excerpt(); ?>
    					</div>
    				<?php } else { ?>
    					<div class="twelve columns">
    						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    						<?php the_excerpt(); ?>
    					</div>
    				<?php } ?>		
					</div>					
				</div>
				
			</div>

			<?php endwhile; ?>
			<div class="twelve columns">
				<?php wp_pagenavi(); ?>		
			</div>				
				<?php else : ?>
				<h4>Sorry, no speakers have been found.</h4>
				<?php endif; ?>			
			
			
		</div>
		
		<div class="three columns">
		
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
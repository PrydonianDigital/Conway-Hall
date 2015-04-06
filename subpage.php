<?php
/*
Template Name: Sub Pages
*/
get_header(); ?>

<div class="row">

	<div class="nine columns" role="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>	
		<?php the_content(); ?>
		<?php
			$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc', 'parent' => $post->ID ) );
		
			foreach( $mypages as $page ) {		
				$content = $page->post_excerpt;
				if ( ! $content ) // Check for empty excerpt content & fallback to full content
				    $content = $page->post_content;
				if ( ! $content ) // Check for empty page
				    continue;
				$content = apply_filters( 'the_excerpt', $content );
			?>
			<div <?php post_class('sticky'); ?>>
				<div class="row">
					<div class="twelve columns">
						<h3><a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo $page->post_title; ?></a></h3>
					</div>
				</div>
				<div class="row">
					<div class="five columns">
						<a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo get_the_post_thumbnail($page->ID);?></a>
					</div>
					<div class="seven columns">
						<?php echo $content; ?>	
					</div>
				</div>
			</div>
		<?php
			}	
		?>	
	<?php endwhile; ?>
	
	<?php endif; ?>
	
	</div>	
	
	<div class="three columns side" role="complementary">
		
		<div class="row">
			<div class="twelve columns">
				<ul>			
					<?php dynamic_sidebar( 'join' ); ?>
				</ul>
				<ul>
					<?php
					// Find connected pages
					$connected = new WP_Query( array(
						'connected_type' => 'pdf_to_page',
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
<?php
/*
Template Name: Sub Pages
*/
get_header(); ?>

<div class="row">

	<div class="nine columns">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>	
		<?php the_content(); ?>
		<?php
			$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );
		
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
<?php get_header(); ?>

<div class="row">

	<div class="nine columns">

		<?php
		$id = 356;
		$p = get_page($id);
		echo apply_filters('the_content', $p->post_content);
		?>

		<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array (
				'post_type' => 'product',
				'posts_per_page' => '9',
				'paged' => $paged
			);
			$speaker = new WP_Query( $args );
		?>	
		<?php if ( $speaker->have_posts() ) :  while ( $speaker->have_posts() ) : $speaker->the_post(); ?>
		
			<div class="shop_item">
				<?php //echo get_the_term_list( $post->ID, 'type', 'Type: ', ', ', '' ); ?>
				<?php global $post; $text = get_post_meta( $post->ID, '_cmb_asin', true ); ?>
				<?php echo do_shortcode( '[asa book]' . $text . '[/asa]' ); ?>		
			</div>
		<?php endwhile; ?>
		<div class="row">
			<div class="twelve columns">
				<?php wp_pagenavi(); ?>		
			</div>	
		</div>			
		<?php else : ?>
			<h4>Sorry, no products have been found.</h4>
		<?php endif; ?>
		
	
	</div>	
	
	<div class="three columns side">
		
		<div class="row">
			<div class="twelve columns">
				<ul>
					<li class="widget">
					<h5 class="widget">Categories</h5>
					<ul class="menu">
				<?php
					$taxonomy = 'type';
					$tax_terms = get_terms($taxonomy);
				?>
				<?php
					foreach ($tax_terms as $tax_term) {
					echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
					}
				?>
				</ul>
					</li>
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
<?php get_header(); ?>

<div class="row">

	<div class="nine columns" role="main">
	<h2><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?></h2>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('shop_item'); ?>>
		<?php global $post; $text = get_post_meta( $post->ID, '_cmb_asin', true ); ?>
		<?php echo do_shortcode( '[asa book]' . $text . '[/asa]' ); ?>
		</div>
	<?php endwhile; ?>
		<div class="row">
			<div class="twelve columns">
				<?php wp_pagenavi(); ?>		
			</div>	
		</div>		
	<?php endif; ?>
	
	</div>	
	
	<div class="three columns side" role="complementary">
		
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
					<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
			</div>
		</div>		

	</div>

</div>

<?php get_footer(); ?>
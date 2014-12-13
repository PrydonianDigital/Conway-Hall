<?php get_header(); ?>

<div class="row">

	<div class="nine columns" role="main">
	<h2><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?></h2>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div <?php post_class('sticky'); ?>>
				<div class="row">
					<div class="twelve columns">
						<h3><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<h5><?php global $post; $text = get_post_meta( $post->ID, '_cmb_author', true ); if($text !='') : ?>By <?php global $post; $text = get_post_meta( $post->ID, '_cmb_author', true ); echo $text; ?><?php endif; ?></h5>

					</div>
				</div>
				<div class="row">
					<div class="five columns">
						<a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_post_thumbnail('speaker'); ?></a>
					</div>
					<div class="seven columns">
						<?php the_excerpt(); ?>	
						<p><?php global $post; $text = get_post_meta( $post->ID, '_cmb_url', true ); if($text !='') : ?><a href="<?php global $post; $text = get_post_meta( $post->ID, '_cmb_url', true ); echo $text; ?>" target="blank"><img src="<?php bloginfo('template_url'); ?>/img/amazon_buy.gif"></a><?php endif; ?></p>
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
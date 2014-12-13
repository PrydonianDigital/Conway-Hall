<?php get_header(); ?>

<div class="row">

	<div <?php post_class('nine columns'); ?> role="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>	
		<h5><?php global $post; $text = get_post_meta( $post->ID, '_cmb_author', true ); if($text !='') : ?>By <?php global $post; $text = get_post_meta( $post->ID, '_cmb_author', true ); echo $text; ?><?php endif; ?></h5>
		<div class="alignleft">
			<?php the_post_thumbnail('article'); ?>
		</div>
		<?php the_content(); ?>
		<p><?php global $post; $text = get_post_meta( $post->ID, '_cmb_url', true ); if($text !='') : ?><a href="<?php global $post; $text = get_post_meta( $post->ID, '_cmb_url', true ); echo $text; ?>" target="blank"><img src="<?php bloginfo('template_url'); ?>/img/amazon_buy.gif"></a><?php endif; ?></p>

	<?php endwhile; ?>
	
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
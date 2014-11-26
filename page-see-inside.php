<?php get_header(); ?>

<div class="row">

	<div class="twelve columns" role="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php the_content(); ?>
		
	<?php endwhile; ?>
	
	<?php endif; ?>
	
	</div>
	
</div>

<div class="row">	

	<div <?php post_class('nine columns'); ?>>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>
		
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
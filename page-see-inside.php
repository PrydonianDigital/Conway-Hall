<?php get_header(); ?>

<div class="row">

	<div class="twelve columns" role="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php the_content(); ?>
		
	<?php endwhile; ?>
	
	<?php endif; ?>
	<p><div class="medium secondary btn"><a href="/about/">&laquo; Back</a></div></p>
	
	</div>
	
</div>

<?php get_footer(); ?>
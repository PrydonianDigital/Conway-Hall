<?php get_header(); ?>

<div class="row">

	<div class="twelve columns">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php the_content(); ?>
		
	<?php endwhile; ?>
	
	<?php endif; ?>
	
	</div>
	
</div>

<div class="row">	

	<div class="nine columns">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>
		
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
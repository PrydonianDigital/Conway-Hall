<?php get_header(); ?>

<div class="row">

	<div <?php post_class('twelve columns'); ?> role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h2><?php the_title(); ?></h2>

	<?php endwhile; ?>

	<?php endif; ?>
	</div>
</div>

<div id="foyer"><div id="planit"></div></div>

<?php get_footer(); ?>
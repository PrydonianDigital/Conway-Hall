<?php get_header(); ?>

<div class="row">

	<div <?php post_class('nine columns'); ?> role="main">
	
	<h2>Page not found</h2>	
	<p>The page you were looking for has either been deleted or moved. Please use the menu above to go to another section of the site</p>
	
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
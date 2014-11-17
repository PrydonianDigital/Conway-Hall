<?php get_header(); ?>

<div class="row">

	<div class="nine columns">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>	
		<?php the_content(); ?>
		
		<section class="tabs">
		
		    <ul class="tab-nav">
		        <li class="active"><a href="#">Map</a></li>
		        <li><a href="#">Central Line</a></li>
		        <li><a href="#">Piccadilly Line</a></li>
		    </ul>
		    
		    <div class="tab-content active">
				<div id="map"></div>
		    </div>
		    <div class="tab-content">
				<div id="holbornStationC"><div id="loading"></div></div>
		    </div>
		    <div class="tab-content">
				<div id="holbornStationP"><div id="loading"></div></div>
		    </div>
		
		</section>
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
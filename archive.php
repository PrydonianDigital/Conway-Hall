<?php get_header(); ?>

<div class="row">

	<div class="nine columns hfeed" role="main">
	<h2 class="<?php echo get_queried_object()->slug; ?>"><?php echo get_queried_object()->name; ?></h2>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div <?php post_class('sticky'); ?> itemscope itemtype="http://schema.org/BlogPosting">
			<div class="row">
				<div class="twelve columns ">
					<h4 itemprop="name headline" class="entry-title p-name"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h4>
					<h5 datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished" class="updated dtstart"><?php the_time( 'D, jS M, Y' ); ?></h5>
					<a href="https://plus.google.com/+ConwayhallOrgUk1929" rel="publisher"></a>
				</div>
			</div>
			<div class="row">
				<div class="five columns">
				<?php
					if ( get_the_post_thumbnail($post_id) != '' ) {
						echo '<a href="'; the_permalink(); echo '" rel="permalink" class="th">';
						the_post_thumbnail('speaker');
						echo '</a>';
					} else {
						echo '<a href="'; the_permalink(); echo '" rel="permalink" class="th">';
						echo '<img src="';
						echo catch_that_image();
						echo '" alt="" />';
						echo '</a>';
					}
				?>
				</div>
				<div class="seven columns p-summary" itemprop="articleBody">
					<?php the_excerpt(); ?>
					<p>By: <span class="vcard author"><span class="fn"><?php the_author('nicename'); ?></span></span></p>
					<p><?php the_tags(); ?></p>
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
					<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
			</div>
		</div>		

	</div>

</div>

<?php get_footer(); ?>
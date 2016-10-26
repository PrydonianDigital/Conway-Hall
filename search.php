<?php get_header(); ?>

<div class="row">

	<div class="nine columns" role="main">

		<div class="row">
			<div class="twelve columns">

				<form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">
					<label>
						<span class="offscreen"><?php echo _x( 'Search for:', 'label' ) ?></span>
						<input type="search" class="search-field" placeholder="Search..." value="<?php echo get_search_query() ?>" name="s" data-swplive="true" />
					</label>
					<input type="submit" class="search-submit" value=" Search ">
				</form>

				<h2><?php echo $wp_query->found_posts; ?> results for: "<?php the_search_query(); ?>"</h2>

			</div>
		</div>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class('sticky'); ?>>
			<div class="row">
				<div class="twelve columns">
					<h4><a href="<?php the_permalink(); ?>" rel="permalink" class="summary entry-title"><?php the_title(); ?></a></h4>
					<?php if ( tribe_get_cost() ) : ?>
						<div class="tribe-events-event-cost">
							<span><?php echo tribe_get_cost( null, true ); ?></span>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="five columns">
					<a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>">
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
					</a>
				</div>
				<div class="seven columns">
					<?php the_excerpt(); ?>
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
<?php get_header(); ?>

<div class="row">

	<div <?php post_class('nine columns'); ?> role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h2><?php the_title(); ?></h2>

		<?php the_content(); ?>

		<?php
			$temp = $wp_query;
			$portfolio_query = null;
			$portfolio_query = new WP_Query();
			$portfolio_query->query('showposts=10&post_type=sunday_concerts&order=ASC'.'&paged='.$paged);
			while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
		?>
				<div <?php post_class('sticky'); ?>>
					<div class="row">
						<div class="twelve columns">
							<h3><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="entry-title"><?php the_title(); ?></a></h3>
							<h5 datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished" class="updated dtstart"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_time( 'D, jS M, Y' ); ?></a></h5>
							<h3><span class="vcard author"><span class="fn"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php global $post; $text = get_post_meta( $post->ID, '_cmb_speaker', true ); echo $text; ?></a></span></span></h3>
							<meta itemprop="url" content="<?php the_permalink(); ?>">
						</div>
					</div>
					<div class="row">
						<div class="four columns">
							<a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_post_thumbnail('lecture'); ?></a>
						</div>
						<div class="eight columns">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
		<?php endwhile; ?>
		<?php
		$portfolio_query = null;
		$portfolio_query = $temp;
		?>
		<?php wp_pagenavi(); ?>

	<?php endwhile; ?>

	<?php endif; ?>

	</div>

	<div class="three columns side" role="complementary">

		<div class="row">
			<div class="twelve columns">
				<ul>
					<?php dynamic_sidebar( 'join' ); ?>
				</ul>
				<ul>
					<?php
					// Find connected pages
					$connected = new WP_Query( array(
						'connected_type' => 'pdf_to_page',
						'connected_items' => get_queried_object(),
						'nopaging' => true,
					) );

					// Display connected pages
					if ( $connected->have_posts() ) :
					?>
					<li class="widget">
					<h5 class="widget">Related Documents:</h3>
					<ul class="menu related">
					<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
					    <li><a href="<?php global $post; $text = get_post_meta( $post->ID, '_cmb_pdf', true ); echo $text; ?>" download><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					</ul>
					</li>
					<?php
					// Prevent weirdness
					wp_reset_postdata();

					endif;
					?>
					<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
			</div>
		</div>

	</div>

</div>

<?php get_footer(); ?>
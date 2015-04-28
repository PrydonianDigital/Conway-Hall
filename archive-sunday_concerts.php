<?php get_header(); ?>

<div class="row">

	<div class="nine columns hfeed" role="main">
		<?php
		$id = 150;
		$p = get_page($id);
		echo apply_filters('the_content', $p->post_content);
		?>
		<h2><?php post_type_archive_title(); ?></h2>
		<h5><?php $obj = get_post_type_object( 'memorial_lecture' ); echo $obj->description;  ?> </h5>
		<?php
			$temp = $wp_query;
			$portfolio_query = null;
			$portfolio_query = new WP_Query();
			$portfolio_query->query('showposts=10&post_type=sunday_converts&order=ASC'.'&paged='.$paged);
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

	</div>

	<div class="three columns side" role="complementary">

		<div class="row">
			<div class="twelve columns">
				<ul>
					<?php dynamic_sidebar( 'join' ); ?>
				</ul>
				<ul>
					<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
			</div>
		</div>

	</div>

</div>

<?php get_footer(); ?>
<?php
/*
Template Name: Full Issue Archive
*/
get_header(); ?>

	<div class="row">

		<div class="nine columns">
			<!-- foo -->
			<h2>Issues<div class="alignright"><a href="feed/"><i class="icon-rss"></i></a></div></h2>
			<?php
				$day = date( 'D' );
				$week = date( 'W' );
				$year = date( 'Y' );
				$my_query = new WP_Query(
					array(
						'post_type' => 'issue',
						'posts_per_page' => '25',
						'paged' => get_query_var('paged'),
					)
				);
				while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

			<div class="row article">
				<div class="twelve columns">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h6><?php the_time( 'M Y' ); ?></h6>
					<?php global $post; $issue = get_post_meta( $post->ID, '_cmb_issue', true ); if( $issue != '' ) :  ?>
	        			<p><i class="icon-download"></i>Download PDF version of <a href="<?php global $post; $issue = get_post_meta( $post->ID, '_cmb_issue', true ); echo $issue;  ?>"><?php the_title(); ?></a></p>
					<?php else: ?>
						<p><i class="icon-monitor"></i>Read <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
					<?php endif; ?>
				</div>
			</div>

			<?php endwhile; ?>
			<div class="row article">
				<div class="twelve columns">
					<?php wp_pagenavi(array( 'query' => $my_query )); ?>
				</div>
			</div>

		</div>
		<div class="three columns">

			<div class="row">

				<div class="twelve columns">
				<ul>
					<?php dynamic_sidebar( 'join' ); ?>
					<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
				</div>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
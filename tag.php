<?php get_header(); ?>

<div class="row">

	<div class="nine columns hfeed" role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class('sticky'); ?> itemscope itemtype="http://schema.org/BlogPosting">
			<div class="row">
				<div class="twelve columns ">
					<?php if ( 'tribe_events' == get_post_type() ) { ?>
						<?php if ( tribe_get_cost() ) : ?>
							<div class="tribe-events-event-cost">
								<span><?php echo tribe_get_cost( null, true ); ?></span>
							</div>
						<?php endif; ?>
						<?php global $post; $tix = get_post_meta( $post->ID, '_cmb_tickets', true ); if( $tix != '' ) :  ?>
							<div class="tribe-events-event-cost">
								<span>
									<?php global $post; $tix = get_post_meta( $post->ID, '_cmb_tickets', true ); echo $tix;  ?>
								</span>
							</div>
						<?php endif; ?>
						<h3 class="tribe-events-single-section-title"><?php echo tribe_get_organizer() ?> presents: </h3>
						<h4 itemprop="name headline" class="entry-title p-name"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<?php echo tribe_events_event_schedule_details( $event_id, '<h5>', '</h5>' ); ?>
					<?php } else {
					?>
						<h4 itemprop="name headline" class="entry-title p-name"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<h5 datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished" class="updated dtstart"><?php the_time( 'D, jS M, Y' ); ?></h5>
					<?php
					} ?>


					<a href="https://plus.google.com/+ConwayhallOrgUk1929" rel="publisher"></a>
				</div>
			</div>
			<div class="row">
				<div class="five columns">
				<?php the_post_thumbnail('speaker'); ?>
				</div>
				<div class="seven columns p-summary" itemprop="articleBody">
					<?php the_excerpt(); ?>
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
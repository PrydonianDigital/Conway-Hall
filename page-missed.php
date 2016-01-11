<?php get_header(); ?>

<div class="row">

	<div <?php post_class('nine columns '); ?> role="main">

		    <div class="tab-content active">
		        <h3>You've Just Missed</h3>
					<?php
						$args = array (
							'post_type' => 'tribe_events',
							'posts_per_page' => '20',
							'start_date'     => date( 'Y-m-d H:i:s', strtotime( '-5 years' ) ),
							'end_date'       => date( 'Y-m-d H:i:s', strtotime( '-1 day' ) ),
							'eventDisplay' => 'past',
							'orderby' => 'date',
							'order'   => 'ASC',
						);
						$event_posts = new WP_Query( $args );
						if ( $event_posts->have_posts() ) {
							while ( $event_posts->have_posts() ) {
								$event_posts->the_post();
						?>
						<div <?php post_class('sticky vevent hentry'); ?> itemscope itemtype="http://schema.org/Event">
							<div class="row">
								<div class="twelve columns ">
									<h5 class="tribe-events-single-section-title"><?php echo tribe_get_organizer() ?> presents: </h5>
									<h4 itemprop="name"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="summary entry-title"><span itemprop="summary"><?php the_title(); ?></span></a></h4>
									<a href="https://plus.google.com/+ConwayhallOrgUk1929" rel="publisher"></a>
									<time itemprop="startDate" datetime="<?php echo tribe_get_start_date( $post->ID, false, 'c' ); ?>"><?php the_time('D, jS M, Y'); ?></time>
									<h5><?php echo tribe_events_event_schedule_details(); ?></h5>
									<meta itemprop="url" content="<?php the_permalink(); ?>">
									<meta itemprop="startDate" content="<?php echo tribe_get_start_date( $post->ID, false, 'c' ); ?>">
									<span class="updated dtstart" datetime="<?php the_date( 'c' ); ?>"><?php the_time('D, jS M, Y'); ?></span>
								</div>
							</div>
							<div class="row">
								<div class="four columns">
									<a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="th"><?php the_post_thumbnail('speaker'); ?></a>
								</div>
								<div class="eight columns entry-content description summary" itemprop="description">
									<?php the_excerpt(); ?>
									<span itemprop="location" itemscope itemtype="http://schema.org/Place">
										<meta itemprop="name" content="Conway Hall">
											<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
												<meta itemprop="streetAddress" content="25 Red Lion Square">
												<meta itemprop="addressLocality" content="London">
												<meta itemprop="postalCode" content="WC1R 4RL">
											</span>
										</span>
									<div class="row">
										<div class="six columns eventCategory">
											<?php echo tribe_get_event_categories(); ?>
										</div>
										<div class="six columns">
											<h6>Organiser:</h6>
											<ul class="tribe-event-categories">
												<li><span class="vcard author"><span class="fn"><?php echo tribe_get_organizer_link() ?></span></span></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
							wp_pagenavi();
						} else {

						}
						wp_reset_postdata();
					?>

		    </div>

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
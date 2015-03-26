<?php get_header(); ?>

<div class="row">

	<div class="nine columns hfeed" role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if( tribe_is_past() || tribe_is_upcoming() && is_tax() ) { ?>
<div <?php post_class('sticky vevent hentry'); ?> itemscope itemtype="http://schema.org/Event">
							<div class="row">
								<div class="twelve columns ">
									<?php if ( tribe_get_cost() ) : ?>
										<div class="tribe-events-event-cost">
											<span><?php echo tribe_get_cost( null, true ); ?></span>
										</div>																		
									<?php endif; ?>
									<?php global $post; $free = get_post_meta( $post->ID, '_cmb_free', true ); if( $free == 'on' ) : ?>
										<div class="tribe-events-event-cost">
											<span>Free</span>
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
			<?php } else { ?>
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
			<?php } ?>
	
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
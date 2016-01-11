<?php
/*
Template Name: Home Page
*/
	get_header();
	require_once 'Mobile_Detect.php';
	$detect = new Mobile_Detect;
?>

<div class="row">

	<div class="twelve columns homePage" role="main">
		<div id="ch-carousel" class="owl-carousel">
			<?php
			// WP_Query arguments
			$args = array (
				'post_type' => 'carousel',
				'posts_per_page' => '10',
				'orderby' => 'menu_order'
			);
			// The Query
			$carousel = new WP_Query( $args );
			// The Loop
			if ( $carousel->have_posts() ) {
				while ( $carousel->have_posts() ) {
					$carousel->the_post();
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>
			<div class="item"><a href="<?php global $post; $text = get_post_meta( $post->ID, '_cmb_url', true ); echo $text; ?>"><img class="lazyOwl" data-src="<?php echo $url; ?>" alt="<?php the_title(); ?>"></a>
				<div class="ic_caption">
					<h3><?php the_title(); ?></h3>
					<?php the_excerpt(); ?>
				</div>
			</div>
			<?php
				}
			} else {
				// no posts found
			}

			// Restore original Post Data
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>

<div class="row">
	<div class="twelve columns homePage" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; ?>
		<?php endif; ?>
	</div>

</div>

<div class="row">

	<div class="nine columns" role="main">

		<section class="tabs">
		<?php if( $detect->isMobile() && !$detect->isTablet() ){ ?>
		<section class="tabs pill">
		    <ul class="tab-nav">
		        <li class="active"><a href="#">Events</a></li>
		        <li> <a href="#">Venue Hire</a></li>
		        <li><a href="#">Library</a></li>
		    </ul>
		<?php } else { ?>
		<section class="tabs">
		    <ul class="tab-nav">
		        <li class="active"><a href="#">Events</a></li>
		        <li> <a href="#">Venue Hire</a></li>
		        <li><a href="#">Library</a></li>
		        <li><a href="#">London Thinks</a></li>
		        <li><a href="#">Ethical Record</a></li>
		    </ul>
		<?php } ?>
		<?php if( $detect->isMobile() && !$detect->isTablet() ){ ?>

		    <div class="tab-content active">
		        <h3>Upcoming Events</h3>
					<?php
						$args = array (
							'post_type' => 'tribe_events',
							'posts_per_page' => '10',
						);
						$event_posts = new WP_Query( $args );
						if ( $event_posts->have_posts() ) {
							while ( $event_posts->have_posts() ) {
								$event_posts->the_post();
						?>
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
									<h4 itemprop="name"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="entry-title"><?php the_title(); ?></a></h4>
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
						} else {

						}
						wp_reset_postdata();
					?>
					<p><a href="<?php echo tribe_get_events_link() ?>"> <?php _e( '&laquo; All Events', 'tribe-events-calendar' ) ?></a></p>
		    </div>
		    <div class="tab-content">
		        <h3>Venue Hire</h3>
		        <?php
					// WP_Query arguments
					$args = array (
						'page_id' => '11',
					);
					// The Query
					$library = new WP_Query( $args );
					// The Loop
					if ( $library->have_posts() ) {
						while ( $library->have_posts() ) {
							$library->the_post();
					$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );

					foreach( $mypages as $page ) {
						$content = $page->post_excerpt;
						if ( ! $content ) // Check for empty excerpt content & fallback to full content
						    $content = $page->post_content;
						if ( ! $content ) // Check for empty page
						    continue;
						$content = apply_filters( 'the_excerpt', $content );
					?>
					<div <?php post_class('sticky'); ?>>
						<div class="row">
							<div class="twelve columns">
								<h3><a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo $page->post_title; ?></a></h3>
							</div>
						</div>
						<div class="row">
							<div class="five columns">
								<a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo get_the_post_thumbnail($page->ID);?></a>
							</div>
							<div class="seven columns">
								<?php echo $content; ?>
							</div>
						</div>
					</div>
				<?php
					}
						}
					} else {
						// no posts found
					}

					// Restore original Post Data
					wp_reset_postdata();
				?>
		    </div>
		    <div class="tab-content">
		        <h3>Library</h3>
		        <?php
					// WP_Query arguments
					$args = array (
						'page_id' => '13',
					);
					// The Query
					$library = new WP_Query( $args );
					// The Loop
					if ( $library->have_posts() ) {
						while ( $library->have_posts() ) {
							$library->the_post();
					the_content();
					$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc', 'parent' => $post->ID ) );

					foreach( $mypages as $page ) {
						$content = $page->post_excerpt;
						if ( ! $content ) // Check for empty excerpt content & fallback to full content
						    $content = $page->post_content;
						if ( ! $content ) // Check for empty page
						    continue;
						$content = apply_filters( 'the_excerpt', $content );
					?>
					<div <?php post_class('sticky'); ?>>
						<div class="row">
							<div class="twelve columns">
								<h3><a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo $page->post_title; ?></a></h3>
							</div>
						</div>
						<div class="row">
							<div class="five columns">
								<a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo get_the_post_thumbnail($page->ID);?></a>
							</div>
							<div class="seven columns">
								<?php echo $content; ?>
							</div>
						</div>
					</div>
				<?php
					}
						}
					} else {
						// no posts found
					}

					// Restore original Post Data
					wp_reset_postdata();
				?>
		    </div>
		<?php } else { ?>

		    <div class="tab-content active">
		        <h3>Upcoming Events</h3>
					<?php
						$args = array (
							'post_type' => 'tribe_events',
							'posts_per_page' => '10',
						);
						$event_posts = new WP_Query( $args );
						if ( $event_posts->have_posts() ) {
							while ( $event_posts->have_posts() ) {
								$event_posts->the_post();
						?>
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
									<h4 itemprop="name"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="entry-title"><?php the_title(); ?></a></h4>
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
									<span itemprop="location" itemscope itemtype="http://schema.org/Place" class="location vcard">
									<meta itemprop="name" content="Conway Hall" />
										<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="adr">
											<meta itemprop="streetAddress" content="25 Red Lion Square" class="locality" />
											<meta itemprop="addressLocality" content="London" />
											<meta itemprop="postalCode" content="WC1R 4RL" />
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
						} else {

						}
						wp_reset_postdata();
					?>
					<p><a href="<?php echo tribe_get_events_link() ?>"> <?php _e( '&laquo; All Events', 'tribe-events-calendar' ) ?></a></p>
		    </div>
		    <div class="tab-content">
		        <h3>Venue Hire</h3>
		        <?php
					// WP_Query arguments
					$args = array (
						'page_id' => '11',
					);
					// The Query
					$library = new WP_Query( $args );
					// The Loop
					if ( $library->have_posts() ) {
						while ( $library->have_posts() ) {
							$library->the_post();
					$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );

					foreach( $mypages as $page ) {
						$content = $page->post_excerpt;
						if ( ! $content ) // Check for empty excerpt content & fallback to full content
						    $content = $page->post_content;
						if ( ! $content ) // Check for empty page
						    continue;
						$content = apply_filters( 'the_excerpt', $content );
					?>
					<div <?php post_class('sticky'); ?>>
						<div class="row">
							<div class="twelve columns">
								<h3><a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo $page->post_title; ?></a></h3>
							</div>
						</div>
						<div class="row">
							<div class="five columns">
								<a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo get_the_post_thumbnail($page->ID);?></a>
							</div>
							<div class="seven columns">
								<?php echo $content; ?>
							</div>
						</div>
					</div>
				<?php
					}
						}
					} else {
						// no posts found
					}

					// Restore original Post Data
					wp_reset_postdata();
				?>
		    </div>
		    <div class="tab-content">
		        <h3>Library</h3>
		        <?php
					// WP_Query arguments
					$args = array (
						'page_id' => '13',
					);
					// The Query
					$library = new WP_Query( $args );
					// The Loop
					if ( $library->have_posts() ) {
						while ( $library->have_posts() ) {
							$library->the_post();
					the_content();
					$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc', 'parent' => $post->ID ) );

					foreach( $mypages as $page ) {
						$content = $page->post_excerpt;
						if ( ! $content ) // Check for empty excerpt content & fallback to full content
						    $content = $page->post_content;
						if ( ! $content ) // Check for empty page
						    continue;
						$content = apply_filters( 'the_excerpt', $content );
					?>
					<div <?php post_class('sticky'); ?>>
						<div class="row">
							<div class="twelve columns">
								<h3><a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo $page->post_title; ?></a></h3>
							</div>
						</div>
						<div class="row">
							<div class="five columns">
								<a href="<?php echo get_permalink( $page->ID); ?>" rel="permalink" title="Permalink to <?php echo $page->post_title; ?>"><?php echo get_the_post_thumbnail($page->ID);?></a>
							</div>
							<div class="seven columns">
								<?php echo $content; ?>
							</div>
						</div>
					</div>
				<?php
					}
						}
					} else {
						// no posts found
					}

					// Restore original Post Data
					wp_reset_postdata();
				?>
		    </div>
		    <div class="tab-content">
		        <h3>London Thinks</h3>
					<?php
						$args = array (
							'post_type' => 'tribe_events',
							'posts_per_page' => '10',
							'tax_query' => array(
								array(
									'taxonomy' => 'tribe_events_cat',
									'field' => 'slug',
									'terms' => array('london-thinks'),
								)
							)
						);
						$event_posts = new WP_Query( $args );
						if ( $event_posts->have_posts() ) {
							while ( $event_posts->have_posts() ) {
								$event_posts->the_post();
						?>
						<div <?php post_class('sticky vevent hentry'); ?> itemscope itemtype="http://schema.org/Event">
							<div class="row">
								<div class="twelve columns ">
									<?php if ( tribe_get_cost() ) : ?>
										<div class="tribe-events-event-cost">
											<span><?php echo tribe_get_cost( null, true ); ?></span>
										</div>
									<?php endif; ?>
									<h3 class="tribe-events-single-section-title"><?php echo tribe_get_organizer() ?> presents: </h3>
									<h4 itemprop="name"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="entry-title"><?php the_title(); ?></a></h4>
									<a href="https://plus.google.com/+ConwayhallOrgUk1929" rel="publisher"></a>
									<time itemprop="startDate" datetime="<?php echo tribe_get_start_date( $post->ID, false, 'c' ); ?>"><?php the_time('D, jS M, Y'); ?></time>
									<?php echo tribe_events_event_schedule_details( $event_id, '<h5>', '</h5>' ); ?>
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
									<span itemprop="location" itemscope itemtype="http://schema.org/Place" class="location vcard">
									<meta itemprop="name" content="Conway Hall" />
										<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="adr">
											<meta itemprop="streetAddress" content="25 Red Lion Square" class="locality" />
											<meta itemprop="addressLocality" content="London" />
											<meta itemprop="postalCode" content="WC1R 4RL" />
										</span>
									</span>
									<div class="row">
										<div class="six columns eventCategory">
											<?php echo tribe_get_event_categories( $event_id ); ?>
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
						} else {
						?>
						<h2>Nothing found</h2>
						<?php
						}
						wp_reset_postdata();
					?>
					<p><a href="<?php echo tribe_get_events_link() ?>"> <?php _e( '&laquo; All Events', 'tribe-events-calendar' ) ?></a></p>
		    </div>

		    <div class="tab-content">
		        <h3>Ethical Record</h3>
				<?php
				$args = array (
					'post_type' => 'ethicalrecord',
					'posts_per_page' => 10,
				);
				$featured = new WP_Query( $args );
				?>
				<?php if ( $featured->have_posts() ) :  while ( $featured->have_posts() ) : $featured->the_post(); ?>
				<div class="row">
					<div <?php post_class('twelve columns sticky'); ?>>
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured'); ?></a>
							<small><?php the_post_thumbnail_caption(); ?></small>
						<?php } ?>
						<?php if(has_term('talks-lectures', 'section')) { ?>
				    		<h5>Lecture</h5>
				    	<?php } ?>
				    	<?php if(has_term('book-reviews', 'section')) { ?>
				    		<h5>Book Review</h5>
				    	<?php } ?>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

		    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
		    			<?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); if( $date != '' ) :  ?>
		    				<h6>Lecture date: <?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); echo date('D, jS M, Y', strtotime($date))  ?></h6>
		    			<?php endif; ?>
		    			<h6><?php post_read_time(); ?></h6>
		    			<?php if(has_term('talks-lectures', 'section')) { ?>
		    				<?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); if( $abstract != '' ) :  ?>
		    					<p><?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); echo $abstract;  ?> ...<a href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
		    				<?php endif; ?>
							<?php
								$args = array (
									'connected_type' => 'lectures2speakers',
									'connected_items' => $post,
									'nopaging' => true,
								);
								$lecture_speaker = new WP_Query( $args );
								if ( $lecture_speaker->have_posts() ) {
									while ( $lecture_speaker->have_posts() ) {
										$lecture_speaker->the_post();
							?>
							<h6>Speaker: <?php the_title(); ?></h6>
							<?php
									}
								} else {
									// no posts found
								}
								wp_reset_postdata();
							?>
		    			<?php } elseif (has_term('book-reviews', 'section')) { ?>
		    				<?php global $post; $author = get_post_meta( $post->ID, '_cmb_author', true ); if( $author != '' ) :  ?>
		    					<p>By: <strong><?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_author', true ); echo $publisher;  ?></strong>
		    					<?php global $post; $author = get_post_meta( $post->ID, '_cmb_publisher', true ); if( $author != '' ) :  ?>
		    						(<?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_publisher', true ); echo $publisher;  ?>)
		    					<?php endif; ?>
		    					</p>
		    					<?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); if( $reviewer != '' ) :  ?>
				    				<p>Review by: <?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); echo $reviewer;  ?></p>
				    			<?php endif; ?>
		    					<?php the_excerpt(); ?>
		    				<?php endif; ?>
		    			<?php } ?>
					</div>
				</div>
				<?php endwhile; ?>

				<?php else : ?>

				<?php endif; ?>
				<p><a href="http://ethicalrecord.org.uk" target="_blank">More from the Ethical Record</a></p>
		    </div>
		<?php } ?>

		</section>

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
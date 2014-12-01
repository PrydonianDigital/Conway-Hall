<?php get_header(); ?>

<div class="row">
	
	<div class="twelve columns homePage" role="main">
		<div id="ch-carousel" class="owl-carousel">
			<?php
			// WP_Query arguments
			$args = array (
				'post_type' => 'carousel',
				'posts_per_page' => '10',
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
		
		    <ul class="tab-nav">
		        <li class="active"><a href="#">Events</a></li>
		        <li> <a href="#">Venue Hire</a></li>
		        <li><a href="#">Library</a></li>
		        <li><a href="#">Exhibitions</a></li>
		        <li><a href="#">A2R Blog</a></li>
		    </ul>
		
		    <div class="tab-content active">
		        <h3>Upcoming Events</h3>
					<?php
						$args = array (
							'post_type' => 'tribe_events',
							'posts_per_page' => '5',
						);
						$event_posts = new WP_Query( $args );
						if ( $event_posts->have_posts() ) {
							while ( $event_posts->have_posts() ) {
								$event_posts->the_post();
						?>
						<div <?php post_class('sticky vevent hentry'); ?>>
						<div class="row">
							<div class="twelve columns ">
								<?php if ( tribe_get_cost() ) : ?>
									<div class="tribe-events-event-cost">
										<span><?php echo tribe_get_cost( null, true ); ?></span>
									</div>
								<?php endif; ?>
								<h4><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="summary entry-title"><?php the_title(); ?></a></h4>
								<?php echo tribe_events_event_schedule_details( $event_id, '<h5>', '</h5>' ); ?>
							</div>
						</div>
						<div class="row">
							<div class="four columns">
								<a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="th"><?php the_post_thumbnail('speaker'); ?></a>
							</div>
							<div class="eight columns entry-content description">
								<?php the_excerpt(); ?>
								<div class="row">
									<div class="six columns eventCategory">
										<?php echo tribe_get_event_categories( $event_id ); ?>
									</div>
									<div class="six columns">
										<h6>Organiser:</h6>
										<ul class="tribe-event-categories">
											<li><?php echo tribe_get_organizer() ?></li>
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
		        <h3>Exhibitions</h3>
					<?php
						$args = array (
							'post_type' => 'tribe_events',
							'posts_per_page' => '5',
							'tax_query' => array(
								array(
									'taxonomy' => 'tribe_events_cat',
									'field' => 'slug',
									'terms' => array('exhibitions'),
								)
							),
						);
						$sunday_posts = new WP_Query( $args );
						if ( $sunday_posts->have_posts() ) {
							while ( $sunday_posts->have_posts() ) {
								$sunday_posts->the_post();
						?>
						<div <?php post_class('sticky vevent hentry'); ?>>
							<div class="row">
								<div class="twelve columns ">
									<?php if ( tribe_get_cost() ) : ?>
										<div class="tribe-events-event-cost">
											<span><?php echo tribe_get_cost( null, true ); ?></span>
										</div>
									<?php endif; ?>
									<h4><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h4>
									<?php echo tribe_events_event_schedule_details( $event_id, '<h5>', '</h5>' ); ?>
								</div>
							</div>
							<div class="row">
								<div class="four columns">
									<a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="th"><?php the_post_thumbnail('speaker'); ?></a>
								</div>
								<div class="eight columns">
									<?php the_excerpt(); ?>
								<div class="row">
									<div class="six columns eventCategory">
										<?php echo tribe_get_event_categories( $event_id ); ?>
									</div>
									<div class="six columns">
										<h6>Organiser:</h6>
										<ul class="tribe-event-categories">
											<li><?php echo tribe_get_organizer() ?></li>
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
		        <h3>Alternatives to Religion Blog</h3>
					<?php
						$args = array (
							'post_type' => 'post',
							'posts_per_page' => '5',
						);
						$sunday_posts = new WP_Query( $args );
						if ( $sunday_posts->have_posts() ) {
							while ( $sunday_posts->have_posts() ) {
								$sunday_posts->the_post();
						?>
						<div <?php post_class('sticky'); ?>>
							<div class="row">
								<div class="twelve columns ">
									<h4><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h4>
									<h5><?php the_time( 'D, jS M, Y' ); ?></h5>
								</div>
							</div>
							<div class="row">
								<div class="five columns">
									<a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="th"><?php the_post_thumbnail('speaker'); ?></a>
								</div>
								<div class="seven columns">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</div>
						<?php
							}
						} else {
						
						}
						wp_reset_postdata();							
					?>
					<p><a href="/library/alternatives-to-religion/the-a2r-blog/"><?php _e( '&laquo; The Alternatives to Religion Blog', 'ch' ) ?></a></p>
		    </div>
		
		</section>		
	
	</div>	
	
	<div class="three columns side" role="complementary">
		
		<div class="row">
			<div class="twelve columns">
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
					    <li><a href="<?php global $post; $text = get_post_meta( $post->ID, '_cmb_pdf', true ); echo $text; ?>"><?php the_title(); ?></a></li>
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
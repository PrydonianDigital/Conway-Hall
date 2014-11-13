<?php get_header(); ?>

<div class="row">
	
	<div class="twelve columns homePage">
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
	<div class="twelve columns homePage">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; ?>
		<?php endif; ?>
	</div>
	
</div>

<div class="row">

	<div class="nine columns">
	
		<section class="tabs">
		
		    <ul class="tab-nav">
		        <li class="active"><a href="#">Events</a></li>
		        <li> <a href="#">Venue Hire</a></li>
		        <li><a href="#">Library</a></li>
		        <li><a href="#">Sunday Concerts</a></li>
		        <li><a href="#">Exhibitions</a></li>
		    </ul>
		
		    <div class="tab-content active">
		        <h2>Upcoming Events</h2>
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
						<div <?php post_class('sticky'); ?>>
						<div class="row">
							<div class="twelve columns ">
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<?php echo tribe_events_event_schedule_details( $event_id, '<h5>', '</h5>' ); ?>
							</div>
						</div>
						<div class="row">
							<div class="five columns">
								<a href="<?php the_permalink(); ?>" class="th"><?php the_post_thumbnail('article'); ?></a>
							</div>
							<div class="seven columns">
								<?php the_excerpt(); ?>
								<?php echo tribe_get_event_categories( $event_id ); ?>
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
		        <h2>Venue Hire</h2>
				<?php
				// WP_Query arguments
				$args = array (
					'post_type' => 'venue',
				);
				// The Query
				$room_hire = new WP_Query( $args );
				// The Loop
				if ( $room_hire->have_posts() ) {
					while ( $room_hire->have_posts() ) {
						$room_hire->the_post();
				?>
				<div <?php post_class('sticky'); ?>>
					<div class="row">
						<div class="twelve columns">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</div>
					</div>
					<div class="row">
						<div class="five columns">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('article'); ?></a>
						</div>
						<div class="seven columns">
							<?php the_excerpt(); ?>
						</div>
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
		    <div class="tab-content">
		        <h2>Library</h2>
		    </div>
		    <div class="tab-content">
		        <h2>Sunday Concerts</h2>
					<?php
						$args = array (
							'post_type' => 'tribe_events',
							'posts_per_page' => '5',
							'tax_query' => array(
								array(
									'taxonomy' => 'tribe_events_cat',
									'field' => 'slug',
									'terms' => array('sunday-concerts'),
								)
							),
						);
						$sunday_posts = new WP_Query( $args );
						if ( $sunday_posts->have_posts() ) {
							while ( $sunday_posts->have_posts() ) {
								$sunday_posts->the_post();
						?>
						<div <?php post_class('sticky'); ?>>
						<div class="row">
							<div class="twelve columns ">
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<?php echo tribe_events_event_schedule_details( $event_id, '<h5>', '</h5>' ); ?>
							</div>
						</div>
						<div class="row">
							<div class="five columns">
								<a href="<?php the_permalink(); ?>" class="th"><?php the_post_thumbnail('article'); ?></a>
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
					<p><a href="<?php echo tribe_get_events_link() ?>"> <?php _e( '&laquo; All Events', 'tribe-events-calendar' ) ?></a></p>
		    </div>
		    <div class="tab-content">
		        <h2>Exhibitions</h2>
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
						<div <?php post_class('sticky'); ?>>
						<div class="row">
							<div class="twelve columns ">
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<?php echo tribe_events_event_schedule_details( $event_id, '<h5>', '</h5>' ); ?>
							</div>
						</div>
						<div class="row">
							<div class="five columns">
								<a href="<?php the_permalink(); ?>" class="th"><?php the_post_thumbnail('article'); ?></a>
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
					<p><a href="<?php echo tribe_get_events_link() ?>"> <?php _e( '&laquo; All Events', 'tribe-events-calendar' ) ?></a></p>
		    </div>
		
		</section>		
	
	</div>	
	
	<div class="three columns side">
		
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
<?php get_header(); ?>

<div class="row">

	<div class="nine columns" role="main">

		<div class="row">
			<div class="twelve columns">

				<form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">
					<label>
						<span class="offscreen"><?php echo _x( 'Search for:', 'label' ) ?></span>
						<input type="search" class="search-field" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
					</label>
					<input type="submit" class="search-submit" value=" Search ">
					<p>If you want to search our extensive document library, please use our dedicated <br /><strong><a href="/pdf-search/?docsearch=<?php echo get_search_query(); ?>">PDF Search</a></strong> page.</p>
				</form>

				<h4><?php echo $wp_query->found_posts; ?> results for "<?php the_search_query(); ?>"</h4>

			</div>
		</div>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php
			global $post;
			$lecspeaker = get_post_meta( $post->ID, '_cmb_lecspeaker', true );
			$date = get_post_meta( $post->ID, '_cmb_lecdate', true );
			$abstract = get_post_meta( $post->ID, '_cmb_abstract', true );
			$author = get_post_meta( $post->ID, '_cmb_author', true );
			$publisher = get_post_meta( $post->ID, '_cmb_publisher', true );
			$reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true );
			$lead = get_post_meta( $post->ID, '_project_lead', true );
			$bio = get_post_meta( $post->ID, '_project_bio', true );
			$jobtitle = get_post_meta( $post->ID, '_cmb_title', true );
			$searchwp_doc_content = wp_get_attachment_metadata( $post->ID, 'searchwp_doc_content', true );
			$price = get_post_meta( $post->ID, '_cmb_tickets', true );
			$free = get_post_meta( $post->ID, '_cmb_free', true );
		?>

		<div <?php post_class('sticky'); ?>>
			<div class="row">
				<div class="twelve columns">
					<?php
						$post_type = get_post_type( $post->ID );
						switch( $post_type ) {
						    case 'post':
						         echo '<h6>Post</h6>';
						    break;
						    case 'page':
						         echo '<h6>Page</h6>';
						    break;
						    case 'tribe_events':
						         echo '<h6>Event</h6>';
						    break;
						    case 'ethicalrecord':
						         echo '<h6>Ethical Record</h6>';
						    break;
						    case 'issue':
						         echo '<h6>Issue</h6>';
						    break;
						    case 'jobs':
						         echo '<h6>Job</h6>';
						    break;
						    case 'project':
						         echo '<h6>Project</h6>';
						    break;
						    case 'memorial_lecture':
						         echo '<h6>Conway Memorial Lecture</h6>';
						    break;
						    case 'sunday_concerts':
						         echo '<h6>Sunday Concert</h6>';
						    break;
						}
					?>
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
					<?php if($lecspeaker != '') { ?>
						<h6>Speaker: <?php echo $lecspeaker; ?></h6>
					<?php } ?>
					<?php if($date != '') { ?>
						<h6>Lecture Date: <?php echo $date; ?></h6>
					<?php } ?>
					<?php if($lead != '') { ?>
						<h6>Project Lead: <?php echo $lead; ?></h6>
					<?php } ?>
					<?php if($searchwp_doc_content != '') { ?>
						<?php echo $searchwp_doc_content; ?>
					<?php } ?>
					<?php if ( $free === 'on' ) : ?>
						<div class="tribe-events-event-cost">
							<span>Free</span>
						</div>
					<?php endif; ?>
					<?php if ( $price != '' ) : ?>
						<div class="tribe-events-event-cost">
							<span><?php echo $price; ?></span>
						</div>
					<?php endif; ?>
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
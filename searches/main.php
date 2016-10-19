<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	$post_type = get_post_type_object($post->post_type);
	if ( get_post_status ( $ID ) == 'draft' ) {} else {
?>
		<div <?php post_class('sticky'); ?>>
			<div class="row">
				<div class="twelve columns">
					<h4><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>" class="summary entry-title"><?php the_title(); ?></a></h4>
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
					<?php global $post; $issue = get_post_meta( $post->ID, '_cmb_issue', true ); if( $issue != '' ) :  ?>
						<h6><?php the_time( 'M Y' ); ?></h6>
	        			<p><i class="icon-download"></i>Download PDF version of <a href="<?php global $post; $issue = get_post_meta( $post->ID, '_cmb_issue', true ); echo $issue;  ?>"><?php the_title(); ?></a></p>
					<?php else: ?>
						<p><i class="icon-monitor"></i>Read <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
					<?php endif; ?>
					<?php the_excerpt(); ?>
				</div>
			</div>
		</div>

<?php
	}
	endwhile;
	else :
	echo '<p>Sorry, no results matched your search.</p>';

	endif;
	wp_reset_query();
?>
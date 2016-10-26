<?php

/* Template Name: PDF Search Page */

global $post;
$query = isset( $_REQUEST['docsearch'] ) ? sanitize_text_field( $_REQUEST['docsearch'] ) : '';
$doc = isset( $_REQUEST['doc'] ) ? absint( $_REQUEST['doc'] ) : 1;
if ( class_exists( 'SWP_Query' ) ) {
	$engine = 'pdf';
	$swp_query = new SWP_Query(
		array(
			's'      => $query,
			'engine' => $engine,
			'page'   => $doc,
		)
	);
	$pagination = paginate_links( array(
		'format'  => '?doc=%#%',
		'current' => $doc,
		'total'   => $swp_query->max_num_pages,
	) );
}
get_header();
?>

<div class="row">

	<div class="nine columns" role="main">

		<div class="row">
			<div class="twelve columns">

				<h2><?php the_title(); ?></h2>

				<form role="search" method="get" class="searchform group" action="<?php echo esc_html( get_permalink() ); ?>">
					<label>
						<span class="offscreen"><?php echo _x( 'Search PDFs for:', 'label' ) ?></span>
						<input type="search" class="search-field" placeholder="Search..." value="<?php echo $query; ?>" name="docsearch" />
					</label>
					<input type="submit" class="search-submit" value=" Search ">
				</form>

				<?php if ( ! empty( $query ) ) : ?>
				<h4><?php echo $swp_query->found_posts; ?> results for "<?php echo $query; ?>"</h4>
				<?php endif; ?>

			</div>
		</div>

		<?php
			if ( ! empty( $query ) && isset( $swp_query ) && ! empty( $swp_query->posts ) ) {
				foreach ( $swp_query->posts as $post ) {
					setup_postdata( $post );
		?>

		<?php
			global $post;
			$pdf_content = get_post_meta( $post->ID, 'searchwp_content', true )
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
					<?php echo substr($pdf_content, 0, 250); ?>...
				</div>
			</div>
		</div>

		<?php
				}

				wp_reset_postdata();
				if ( $swp_query->max_num_pages > 1 ) {
		?>
					<div class="navigation pagination" role="navigation">
						<h2 class="screen-reader-text">Posts navigation</h2>
						<div class="nav-links">
							<?php echo wp_kses_post( $pagination ); ?>
						</div>
					</div>
		<?php
				}
			} else {}
		?>

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
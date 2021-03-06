<?php get_header(); ?>

<div class="row">

	<div class="nine columns hfeed" role="main">

	<?php $today = current_time( 'timestamp' ); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h2><?php the_title(); ?></h2>

		<?php the_content(); ?>

		<?php
		$args = array (
			'post_type'				=> array( 'project' ),
			'posts_per_page'		=> -1,
			'orderby'				=> 'menu_order',
			'order'					=> 'ASC',
			'meta_query'			=> array(
				 'start_date'		=> array(
					 array(
						 'key'		=> '_project_enddate',
						 'value'	=> current_time('timestamp'),
						 'type'		=> 'numeric',
						 'compare'	=> '<'
					)
				)
			),
		);
		$project_current = new WP_Query( $args );
		?>

		<?php if ($project_current->have_posts()) : while ($project_current->have_posts()) : $project_current->the_post(); ?>

			<div <?php post_class('sticky'); ?> itemscope itemtype="http://schema.org/BlogPosting">
				<div class="row">
					<div class="twelve columns ">
						<h4 itemprop="name headline" class="entry-title p-name"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<?php
							date_default_timezone_set('Europe/London');
							$start = get_post_meta( get_the_ID(), '_project_startdate', true );
							$end = get_post_meta( get_the_ID(), '_project_enddate', true );
							$ongoing = get_post_meta( get_the_ID(), '_project_ongoing', true );
							$lead = get_post_meta( get_the_ID(), '_project_lead', true );
						?>

						<?php if($ongoing != ''){ ?>
							<h6>Ongoing</h6>
						<?php } else { ?>
							<?php if($start != '' && $end != ''){ ?>
								<h6>From: <?php echo date_i18n( 'jS F Y', $start ); ?> - <?php echo date_i18n( 'jS F Y', $end ); ?><?php if($today > $end){ echo ' (Project Ended)'; } ?></h6>
							<?php } else { ?>
								<?php if($start != ''){ ?>
									<h6>Start Date: <?php echo date_i18n( 'jS F Y', $start ); ?></h6>
								<?php } ?>
								<?php if($end != ''){ ?>
									<h6>End Date: <?php echo date_i18n( 'jS F Y', $end ); ?><?php if($today > $end){ echo ' (Project Ended)'; } ?></h6>
								<?php } ?>
							<?php } ?>
						<?php } ?>

						<p class="meta">Project categories: <?php echo wpdocs_custom_taxonomies_terms_links(); ?></p>
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

						<?php if($lead != ''){ ?>
							<h6>Project led by: <?php echo $lead; ?></h6>
						<?php } ?>

					</div>
				</div>
			</div>

		<?php endwhile; ?>
		<?php wp_pagenavi(); ?>
		<?php endif; ?>

	<?php endwhile; ?>

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
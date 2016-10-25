<?php get_header(); ?>

<div class="row hfeed">

	<div <?php post_class('nine columns h-entry'); ?> role="main" itemscope itemtype="http://schema.org/BlogPosting">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<h2 itemprop="name headline" class="entry-title p-name"><?php the_title(); ?></h2>

			<?php
				date_default_timezone_set('Europe/London');
				$start = get_post_meta( $post->ID, '_project_startdate', true );
				$end = get_post_meta( $post->ID, '_project_enddate', true );
				$ongoing = get_post_meta( $post->ID, '_project_ongoing', true );
				$lead = get_post_meta( $post->ID, '_project_lead', true );
				$leadpic = get_post_meta( $post->ID, '_project_leadpic', true );
				$bio = get_post_meta( $post->ID, '_project_bio', true );
			?>
			<?php if($ongoing != ''){ ?>
				<h6>Ongoing</h6>
			<?php } else { ?>
				<?php if($start != '' && $end != ''){ ?>
					<h6>From: <?php echo date_i18n( 'jS F Y', $start ); ?> - <?php echo date_i18n( 'jS F Y', $end ); ?></h6>
				<?php } else { ?>
					<?php if($start != ''){ ?>
						<h6>Start Date: <?php echo date_i18n( 'jS F Y', $start ); ?></h6>
					<?php } ?>
					<?php if($end != ''){ ?>
						<h6>End Date: <?php echo date_i18n( 'jS F Y', $end ); ?></h6>
					<?php } ?>
				<?php } ?>
			<?php } ?>

			<p class="meta">Project categories: <?php echo wpdocs_custom_taxonomies_terms_links(); ?></p>

			<div itemprop="articleBody" class="e-content">
				<?php the_content(); ?>
				<?php if($lead != ''){ ?>
					<h3><?php echo $lead; ?></h3>
				<?php } ?>
				<?php if($leadpic != ''){ ?>
					<img src="<?php echo $leadpic; ?>" class="alignleft" width="250" />
				<?php } ?>
				<?php if($bio != ''){ ?>
					<?php echo $bio; ?>
				<?php } ?>

			</div>

		<?php endwhile; ?>

		<?php endif; ?>

	</div>

	<div class="three columns side" role="complementary">

		<div class="row">
			<div class="twelve columns">
				<ul>
					<?php
					// Find connected pages
					$connected = new WP_Query( array(
						'connected_type' => 'pdf_to_job',
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
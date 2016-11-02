<?php get_header(); ?>

	<div class="row">

		<div class="nine columns">

			<?php $term = get_queried_object(); ?>

			<h2 class="<?php echo $term->slug; ?>"><?php echo $term->name; ?><div class="alignright"><a href="feed/"><i class="icon-rss"></i></a></div></h2>

			<?php
				$today = current_time( 'timestamp' );
				$args = array(
					'post_type'				=> 'project',
					'orderby'				=> 'menu_order',
					'order'					=> 'ASC',
					'project_category'		=> $term->slug
				);
				$query = new WP_Query( $args );
			?>

			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

				<div class="row article">

					<div <?php post_class('twelve columns sticky'); ?>>

					<?php if ( has_post_thumbnail() ) { ?>

						<div class="row">

							<div class="four columns">

								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('lecture',array('itemprop'=>'image')); ?></a>
								<small><?php the_post_thumbnail_caption(); ?></small>

							</div>

							<div class="eight columns">

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
												<?php
													if($today > $end){
														echo '<h6>Project Ended</h6>';
													} else {
												?>
														<h6>End Date: <?php echo date_i18n( 'jS F Y', $end ); ?></h6>
												<?php
													}
												?>
											<?php } ?>
										<?php } ?>
									<?php } ?>

								<?php the_excerpt(); ?>

								<?php if($lead != ''){ ?>
									<h6>Project led by: <?php echo $lead; ?></h6>
								<?php } ?>

							</div>

						</div>

						<?php } else { ?>

							<h4 itemprop="name headline" class="entry-title p-name"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h4>

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
										<?php
											if($today > $end){
												echo '<h6>Project Ended</h6>';
											} else {
										?>
												<h6>End Date: <?php echo date_i18n( 'jS F Y', $end ); ?></h6>
										<?php
											}
										?>
									<?php } ?>
								<?php } ?>
							<?php } ?>

							<?php the_excerpt(); ?>

						<?php } ?>

					</div>

				</div>

			<?php endwhile; ?>

				<div class="twelve columns">
					<?php wp_pagenavi(); ?>
				</div>

			<?php else : ?>

				<h4>Sorry, no posts are tagged under <?php echo $term->name; ?>.</h4>

			<?php endif; ?>


		</div>

		<div class="three columns">

			<div class="row">

				<div class="twelve columns">

				<ul>
				<?php dynamic_sidebar( 'join' ); ?>
				<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
				</div>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
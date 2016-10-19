<?php get_header(); ?>

<div class="row">

	<div class="nine columns hfeed" role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class('sticky'); ?> itemscope itemtype="http://schema.org/BlogPosting">
			<div class="row">
				<div class="twelve columns ">
					<h4 itemprop="name headline" class="entry-title p-name"><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h4>
					<?php echo tribe_events_event_schedule_details( $event_id, '<h5>', '</h5>' ); ?>
					<a href="https://plus.google.com/+ConwayhallOrgUk1929" rel="publisher"></a>
				</div>
			</div>
			<div class="row">
				<div class="five columns">
				<?php the_post_thumbnail('speaker'); ?>
				</div>
				<div class="seven columns p-summary" itemprop="articleBody">
					<?php the_excerpt(); ?>
					<p><?php the_tags(); ?></p>
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
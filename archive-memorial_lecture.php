<?php get_header(); ?>

<div class="row">

	<div class="nine columns" role="main">
		<h2><?php post_type_archive_title(); ?></h2>
		<h5><?php $obj = get_post_type_object( 'memorial_lecture' ); echo $obj->description;  ?> </h5>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div <?php post_class('sticky'); ?>>
				<div class="row">
					<div class="twelve columns">
						<h3><a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<h5><?php the_time( 'D, jS M, Y' ); ?></h5>
						<h3><?php global $post; $text = get_post_meta( $post->ID, '_cmb_speaker', true ); echo $text; ?></h3>
					</div>
				</div>
				<div class="row">
					<div class="five columns">
						<a href="<?php the_permalink(); ?>" rel="permalink" title="Permalink to <?php the_title(); ?>"><?php the_post_thumbnail('speaker'); ?></a>
					</div>
					<div class="seven columns">
						<?php the_excerpt(); ?>	
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
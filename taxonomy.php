<?php
/*
Template Name: Taxonomy Archive
*/
get_header(); ?>
	
	<div class="row article">
			
		<div class="nine columns">
			<ul class="taxonomies">
			<?php  
				$taxonomy = 'taxonomy';
				$orderby = 'name';
				$show_count = 0;
				$pad_counts = 0;
				$hierarchical = 1;
				$title = '';
				
				$args = array (
					'taxonomy' => $taxonomy,
					'orderby' => $orderby,
					'show_count' => $show_count,
					'pad_counts' => $pad_counts,
					'hierarchical' => $hierarchical,
					'title_li' => $title,
					'hide_empty' => 0
				);
				wp_list_categories($args) 
			?>
			</ul>			
		</div>
		<div class="three columns">
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
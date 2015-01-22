<?php get_header(); ?>
	
	<div class="row">
	
		<div class="nine columns">
			<h2><?php the_title(); ?></h2>
			<h6><?php the_time( 'M Y' ); ?></h6>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php global $post; $issue = get_post_meta( $post->ID, '_cmb_issue', true ); if( $issue != '' ) :  ?>
				<?php the_content(); ?>
	        	<p>Download PDF version of <a href="<?php global $post; $issue = get_post_meta( $post->ID, '_cmb_issue', true ); echo $issue;  ?>"><?php the_title(); ?></a></p>
	        <?php endif; ?>
			<?php
    			$args = array (
    				'connected_type' => 'issue2post',
    				'connected_items' => $post,
    				'nopaging' => true,
    			);
    			$lecture_speaker = new WP_Query( $args );
    			if ( $lecture_speaker->have_posts() ) {
    				while ( $lecture_speaker->have_posts() ) {
    					$lecture_speaker->the_post();
    		?>			
			<div class="row article">
				<div <?php post_class('twelve columns'); ?>>
					<?php if( has_tag() ) { ?>
					    <p><i class="icon-tag"></i><?php the_tags('', ', ', ''); ?></p>
					<?php } else { ?>
					
					<?php } ?>
					<h4>
						<?php if(in_category('lectures')) { ?>
						<i class="icon-comment"></i>
						<?php } ?>
						<?php if(in_category('book-reviews')) { ?>
						<i class="icon-book"></i>
						<?php } ?>
						<?php if(in_category('videos')) { ?>
						<i class="icon-video"></i>
						<?php } ?>						
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    				<?php global $post; $author = get_post_meta( $post->ID, '_cmb_author', true ); if( $author != '' ) :  ?>
    					<h6>By: <strong><?php global $post; $author = get_post_meta( $post->ID, '_cmb_author', true ); echo $author;  ?></strong> 
    					<?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_publisher', true ); if( $publisher != '' ) :  ?>
    						(<?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_publisher', true ); echo $publisher;  ?>)
    					<?php endif; ?>
    					</h6>
    					<h6>Review by: <?php global $post; $vpauthor = get_post_meta( $post->ID, '_cmb_vpauthor', true ); echo $vpauthor;  ?></h6>
    				<?php endif; ?>	
					<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
		    		<?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); if( $date != '' ) :  ?>
		    			<h6 class="entry-date">Lecture date: <?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); echo date('D, jS M, Y', strtotime($date))  ?></h6>
		    		<?php endif; ?>
					<?php
    	    			$args = array (
    	    				'connected_type' => 'lectures2speakers',
    	    				'connected_items' => $post,
    	    				'nopaging' => true,
    	    			);
    	    			$speaker = new WP_Query( $args );
    	    			if ( $speaker->have_posts() ) {
    	    				while ( $speaker->have_posts() ) {
    	    					$speaker->the_post();
    	    		?>
    				<h6><i class="icon-user"></i><?php the_title(); ?></h6>
    	    		<?php
    	    				}
    	    			} else {
    	    				// no posts found
    	    			}
    	    			wp_reset_postdata();	
    	    		?>	
				</div>
			</div>
    		<?php
    				}
    			} else {
    				// no posts found
    			}
    			wp_reset_postdata();				
    		?>			
			<?php endwhile; else: ?>
			<h2>There are no issues published</h2>
			<?php endif; ?>

		</div>
		<div class="three columns">
		
			<div class="row">
			
				<div class="twelve columns">
				
				<ul>
					<?php dynamic_sidebar( 'ersubmenu' ); ?>
					<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
				</div>
				
			</div>
			
		</div>

	</div>

<?php get_footer(); ?>
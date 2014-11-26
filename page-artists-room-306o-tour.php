<?php get_header(); ?>

<div class="row">
	
	<div <?php post_class('twelve columns'); ?> role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>
	
	<?php endwhile; ?>
	
	<?php endif; ?>
		<div id="artists360" class="pano">
			<div id="alternate_content">
				<p>If you can see this message rather than a virtual tour then please <a href="http://www.adobe.com/go/getflashplayer/" target="_blank">click here to install the adobe flash player.</a><br />If you are still unable to view the virtual tour then you may need to enable javascript in your browser <a href="http://www.google.com/support/bin/answer.py?hl=en&answer=23852" target="_blank">(click here for instructions)</a>.<br /> If you are still encountering issues then please email Panaround Ltd at <a href="mailto:enquiry@panaround.co.uk">enquiry@panaround.co.uk</a></p>
			</div>
		</div>
	</div>
	
</div>


<?php get_footer(); ?>
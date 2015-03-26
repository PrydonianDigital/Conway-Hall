<?php get_header(); ?>

<div class="row">
	
	<div <?php post_class('twelve columns'); ?> role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>
	
	<?php endwhile; ?>
	
	<?php endif; ?>
<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;	
if( $detect->isMobile() ){
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/360tour/assets/html5/p2q-embed-object.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/360tour/assets/html5/pano2vr-player.js"></script>	
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/360tour/assets/html5/skin.js"></script>        
<script type="text/javascript">
document.writeln('<div id="container" class="pano" style="width:100%;height:100%;"></div>');
pano = new pano2vrPlayer("container");
skin = new pano2vrSkin(pano);
pano.readConfigUrl("<?php bloginfo('template_url'); ?>/360tour/artists-room/assets/html5/tour.xml");
</script>
<noscript>
	<p><b>Please enable Javascript!</b></p>
</noscript>
<?php } else { ?>	
		<a href="http://panaround.co.uk/" target="_blank" rel="external"><img src="<?php bloginfo('template_url'); ?>/360tour/assets/img/ui/produced-by-panaround.jpg" alt=""></a>
		<div id="artists360" class="pano">
			<div id="alternate_content">
				<p>If you can see this message rather than a virtual tour then please <a href="http://www.adobe.com/go/getflashplayer/" target="_blank">click here to install the adobe flash player.</a><br />If you are still unable to view the virtual tour then you may need to enable javascript in your browser <a href="http://www.google.com/support/bin/answer.py?hl=en&answer=23852" target="_blank">(click here for instructions)</a>.<br /> If you are still encountering issues then please email Panaround Ltd at <a href="mailto:enquiry@panaround.co.uk">enquiry@panaround.co.uk</a></p>
			</div>
		</div>
<?php } ?>
		<p><div class="medium secondary btn"><a href="/venue-hire/artists-room/">&laquo; Back</a></div></p>
	</div>
	
</div>


<?php get_footer(); ?>
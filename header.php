<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage"> <!--<![endif]-->
<head>
<!--base href="https://conwayhall.org.uk/"-->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="DC.title" content="Conway Hall" />
<meta name="ICBM" content="51.51972, -0.118386" />
<meta name="geo.position" content="51.51972, -0.118386" />
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<script type="application/ld+json">
{
   "@context": "http://schema.org",
   "@type": "WebSite",
   "name" : "Conway Hall",
   "alternateName" : "Conway Hall • The landmark of London's independent intellectual, political and cultural life",
   "url": "http://conwayhall.org.uk/",
   "potentialAction": {
     "@type": "SearchAction",
     "target": "http://conwayhall.org.uk/?s={search_term_string}",
     "query-input": "required name=search_term_string"
   }
}
</script>
<?php
$background_color = get_background_color();
$background_image = get_background_image();
?>
<style type="text/css" id="custom-css">
.header { background: #<?php echo $background_color; ?> url("<?php header_image(); ?>") no-repeat center center; background-size: cover;}
</style>
</head>

<body <?php body_class(); ?>>
<?php if(is_single()) { ?>
<progress max="1" value="0"></progress>
<?php } ?>
<!--div class="secondary alert" id="cookie">This site uses cookies to improve user experience. <a href="#" id="cookieOK">Click here</a> to dismiss this warning.</div-->
<div class="navbar" id="nav1" role="navigation">
	<div class="row">
		<a class="toggle" gumby-trigger="#nav1 ul.menu" href="#"><i class="icon-menu"></i></a>
		<?php wp_nav_menu( array( 'theme_location' => 'chmenu', 'container' => false, 'walker' => new Walker_Page_Custom ) ); ?>
	</div>
</div>
<div class="header" role="banner">
	<div class="row">
		<div class="twelve columns">
			<h1><a href="<?php bloginfo( 'url' ); ?>"><i class="ch-logo"></i></a></h1>
		</div>
	</div>
</div>
<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
if( $detect->isMobile() && !$detect->isTablet() ){
?>
<div id="subBar">
	<div class="row" id="subBarToggle">
		<a class="toggle" href="#" id="subToggle"><i class="icon-menu"></i></a>
	</div>
	<div class="row" id="subBarContent">
		<ul>
			<?php dynamic_sidebar( 'homepage' ); ?>
		</ul>
	</div>
</div>
<?php } ?>
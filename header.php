<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/favicon-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/favicon-32x32.png" sizes="32x32">
<meta name="msapplication-TileColor" content="#0078ae">
<meta name="msapplication-TileImage" content="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/mstile-144x144.png">
<meta name="msapplication-config" content="//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/icons/browserconfig.xml">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<?php
$background_color = get_background_color();
$background_image = get_background_image();
?>
<style type="text/css" id="custom-css">
.header { background: #<?php echo $background_color; ?> url("<?php header_image(); ?>") no-repeat center center; background-size: cover;}
</style>
</head>

<body <?php body_class(); ?>>
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
			<h1><a href="<?php bloginfo( 'url' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/img/header/logo.png"></a></h1>
		</div>
	</div>
</div>

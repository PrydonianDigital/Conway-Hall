<?php

add_filter( 'searchwp_missing_integration_notices', '__return_false' );

function mySearchWPXpdfPath() {
	return '/var/www/vhosts/conwayhall.org.uk/pdftotext';
}
add_filter( 'searchwp_xpdf_path', 'mySearchWPXpdfPath' );

function my_searchwp_process_term_limit() {
	return 500;
}
add_filter( 'searchwp_process_term_limit', 'my_searchwp_process_term_limit' );

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

// Init CMB2
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'metabox/init.php' );
	}
}
if ( file_exists(  __DIR__ . '/metabox_new/init.php' ) ) {
  require_once  __DIR__ . '/metabox_new/init.php';
} elseif ( file_exists(  __DIR__ . '/metabox_new/init.php' ) ) {
  require_once  __DIR__ . '/metabox_new/init.php';
}

// Require functions
require_once('functions/theme.php');
require_once('functions/post_types.php');
require_once('functions/taxonomies.php');
require_once('functions/meta.php');
require_once('functions/p2p.php');
require_once('functions/widgets.php');
require_once('functions/events.php');

add_filter( 'the_permalink', function( $permalink, $post ){
	if ( is_page('pdf-search') && 'application/pdf' == get_post_mime_type( $post->ID ) ) {
		$permalink = wp_get_attachment_url( $post->ID );
	}
	return esc_url( $permalink );
}, 10, 2 );

add_filter( 'searchwp_force_wp_query', '__return_true' );

function my_searchwp_return_orderby_date( $order_by_date, $engine ) {
	if ( 'pdf' == $engine ) {
		$order_by_date = true;
	}
	return $order_by_date;
}
add_filter( 'searchwp_return_orderby_date', 'my_searchwp_return_orderby_date', 10, 2 );

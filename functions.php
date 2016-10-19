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
if ( file_exists( dirname( __FILE__ ) . '/metabox/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/metabox/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/metabox/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/metabox/init.php';
}

// Require functions
require_once('wp-advanced-search/wpas.php');
require_once('functions/theme.php');
require_once('functions/post_types.php');
require_once('functions/taxonomies.php');
require_once('functions/meta.php');
require_once('functions/p2p.php');
require_once('functions/widgets.php');
require_once('functions/events.php');

// Searches
function main_search() {
	$args = array();
	$args['wp_query'] = array(
		'post_type' => array('page', 'post', 'tribe_events', 'memorial_lecture', 'pdf', 'sunday_concerts', 'ethicalrecord', 'issue'),
		'orderby' => 'title',
		'order' => 'ASC'
	);
	$args['form'] = array(
		'auto_submit' => false
	);
	$args['form']['ajax'] = array(
		'enabled' => true,
		'show_default_results' => false,
		'results_template' => 'searches/main.php',
		'button_text' => 'Load More Results'
	);
	$args['fields'][] = array(
		'type' => 'search',
		'placeholder' => 'Enter search terms'
	);
	$args['fields'][] = array(
		'type' => 'submit',
		'class' => 'button',
		'value' => 'Search'
	);
	$args['fields'][] = array(
		'type' => 'reset',
		'class' => 'button',
		'value' => 'Reset'
	);
	$args['fields'][] = array(
		'type' => 'post_type',
		'format' => 'checkbox',
		'label' => 'Search by:',
		'values' => array('page' => 'Pages', 'post' => 'Posts', 'tribe_events' => 'Events', 'tribe_events' => 'Events', 'pdf' => 'PDFs', 'sunday_concerts' => 'Sunday Concerts', 'ethicalrecord' => 'Ethical Record', 'issue' => 'Ethical Record Issue') ,
		'default_all' => true
	);
	$args['fields'][] = array(
		'type' => 'date',
		'format' => 'date',
		'label' => 'Year:',
		'date_type' => 'year',
		'date_format' => 'Y',
		'value' => ''
	);
	$args['fields'][] = array(
		'type' => 'posts_per_page',
		'format' => 'select',
		'label' => 'Results per page',
		'values' => array(10=>10, 20=>20, 50=>50, 100=>100),
		'default' => 10
	);
	register_wpas_form('mainsearch', $args);
}
add_action('init', 'main_search');
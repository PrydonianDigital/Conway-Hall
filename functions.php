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
		'post_type' => array('page', 'post', 'tribe_events', 'memorial_lecture', 'sunday_concerts', 'ethicalrecord', 'issue', 'attachment'),
		'orderby' => 'title',
		'order' => 'ASC'
	);
	$args['form'] = array(
		'auto_submit' => false
	);
	$args['form']['ajax'] = array(
		'enabled' => true,
		'show_default_results' => true,
		'results_template' => 'searches/main.php',
		'button_text' => 'Load More Results'
	);
	$args['fields'][] = array(
		'type' => 'search',
		'placeholder' => 'Enter search terms',
		'pre_html' => '<div class="row"><div class="twelve columns">',
		'post_html' => '<div id="optionsSearchMain" class="closed"></div></div></div>'
	);
	$args['fields'][] = array(
		'type' => 'post_type',
		'format' => 'checkbox',
		'label' => 'Search by post type',
		'values' => array(
			'page' => 'Pages',
			'post' => 'Posts',
			'tribe_events' => 'Events',
			'memorial_lecture' => 'Memorial Lectures',
			'attachment' => 'PDFs',
			'sunday_concerts' => 'Sunday Concerts',
			'ethicalrecord' => 'Ethical Record',
			'issue' => 'Issues'
		) ,
		'default_all' => true
	);
	$args['fields'][] = array(
		'type' => 'date',
		'format' => 'number',
		'label' => 'Search by year',
		'date_type' => 'year',
		'date_format' => 'Y',
		'default' => ''
	);

	$args['fields'][] = array(
		'type' => 'orderby',
		'format' => 'select',
		'label' => 'Order by',
		'values' => array(
			'title' => 'Title',
			'date' => 'Date'
		)
	);
	$args['fields'][] = array(
		'type' => 'order',
		'format' => 'select',
		'label' => 'Order',
		'values' => array(
			'ASC' => 'ASC',
			'DESC' => 'DESC'
		),
		'default' => 'ASC'
	);
	$args['fields'][] = array(
		'type' => 'posts_per_page',
		'format' => 'select',
		'label' => 'Results per page',
		'values' => array(10=>10, 20=>20, 50=>50, 100=>100),
		'default' => 10
	);
	$args['fields'][] = array(
		'type' => 'submit',
		'class' => 'button',
		'value' => 'Submit'
	);
	register_wpas_form('mainsearch', $args);
}
add_action('init', 'main_search');

function aside_search() {
	$args = array();
	$args['wp_query'] = array(
		'post_type' => array('page', 'post', 'tribe_events', 'memorial_lecture', 'sunday_concerts', 'ethicalrecord', 'issue', 'attachment'),
		'orderby' => 'title',
		'order' => 'ASC'
	);
	$args['form'] = array(
		'action' => get_bloginfo('url') . '/test-search',
		'method' => 'GET',
		'auto_submit' => false,
		'enabled' => false,
		'show_default_results' => false
	);
	$args['fields'][] = array(
		'type' => 'search',
		'placeholder' => 'Enter search terms',
		'pre_html' => '<div class="row"><div class="twelve columns">',
		'post_html' => '<div id="optionsSearch" class="closed"></div></div></div>'
	);
	$args['fields'][] = array(
		'type' => 'post_type',
		'format' => 'checkbox',
		'label' => 'Search by:',
		'values' => array('page' => 'Pages', 'post' => 'Posts', 'tribe_events' => 'Events', 'tribe_events' => 'Events', 'sunday_concerts' => 'Sunday Concerts', 'ethicalrecord' => 'Ethical Record', 'issue' => 'Issues', 'attachment' => 'PDFs') ,
		'default_all' => true
	);
	$args['fields'][] = array(
		'type' => 'orderby',
		'format' => 'select',
		'label' => 'Order by',
		'values' => array(
			'title' => 'Title',
			'date' => 'Date'
		)
	);
	$args['fields'][] = array( 'type' => 'order',
		'format' => 'select',
		'label' => 'Order',
		'values' => array(
			'ASC' => 'Ascending',
			'DESC' => 'Descending'
		),
		'default' => 'ASC'
	);
	$args['fields'][] = array(
		'type' => 'posts_per_page',
		'format' => 'select',
		'label' => 'Results per page',
		'values' => array(10=>10, 20=>20, 50=>50, 100=>100),
		'default' => 10
	);
	$args['fields'][] = array(
		'type' => 'submit',
		'class' => 'button',
		'value' => 'Search'
	);
	register_wpas_form('asidesearch', $args);
}
add_action('init', 'aside_search');

add_filter( 'the_permalink', function( $permalink, $post ){
	if ( is_search() && 'application/pdf' == get_post_mime_type( $post->ID ) ) {
		$permalink = wp_get_attachment_url( $post->ID );
	}
	return esc_url( $permalink );
}, 10, 2 );

add_filter( 'searchwp_force_wp_query', '__return_true' );
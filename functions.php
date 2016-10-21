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
		'post_type' => array('page', 'post', 'tribe_events', 'memorial_lecture', 'pdf', 'sunday_concerts', 'ethicalrecord', 'issue', 'attachment'),
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
			'pdf' => 'PDFs',
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
		'post_type' => array('page', 'post', 'tribe_events', 'memorial_lecture', 'pdf', 'sunday_concerts', 'ethicalrecord', 'issue'),
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
		'values' => array('page' => 'Pages', 'post' => 'Posts', 'tribe_events' => 'Events', 'tribe_events' => 'Events', 'sunday_concerts' => 'Sunday Concerts', 'ethicalrecord' => 'Ethical Record', 'issue' => 'Issues') ,
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

function maybe_append_searchwp_pdf_excerpt( $excerpt ) {
	global $post;
	$pdf_excerpt_length = 15;	// number of words in PDF excerpt
	if ( is_search() && ! post_password_required() ) {
		// prep our 'environment'
		// set up common words
		$common_words = array();
		if ( class_exists( 'SearchWP' ) ) {
			$searchwp = SearchWP::instance();
			$common_words = $searchwp->common;
		}
		// grab the terms
		$terms = explode( ' ', get_search_query() );
		$terms = array_map( 'sanitize_text_field', $terms );
		// if we're on a search page, we want to check to see if the current result
		// has a PDF with any of the search terms in the content
		// first we need to backtrack and find all of the PDFs that are attached to this post
		// since their weight has been attributed to this post
		$attached_pdfs = get_attached_media( 'application/pdf', $post->ID );
		foreach ( $attached_pdfs as $attached_pdf ) {
			// check to make sure there is file content to scan
			if ( $pdf_content = get_post_meta( $attached_pdf->ID, 'searchwp_content', true ) ) {
				// find the first applicable search term (based on character length)
				$flag = false;
				foreach ( $terms as $termkey => $term ) {
					if ( ! in_array( $term, $common_words ) && absint( apply_filters( 'searchwp_minimum_word_length', 3 ) ) <= strlen( $term ) ) {
						$flag = $term;
						break;
					}
				}
				// our haystack is the PDF content
				$haystack = explode( ' ', $pdf_content );
				$pdf_excerpt = '';
				// build our contextual excerpt
				foreach ( $haystack as $haystack_key => $haystack_term ) {
					preg_match( "/\b$flag\b(?!([^<]+)?>)/i", $haystack_term, $matches );
					if ( count( $matches ) ) {
						// our buffer is going to be 1/3 the total number of words in hopes of snagging one or two more
						// highlighted terms in the second and third thirds
						$buffer = floor( ( $pdf_excerpt_length - 1 ) / 3 ); // -1 to accommodate the search term itself
						// find the start point
						$start = 0;
						$underflow = 0;
						if ( $haystack_key < $buffer ) {
							// the match occurred too early to get a proper first buffer
							$underflow = $buffer - $haystack_key;
						} else {
							// there is enough room to grab a proper first buffer
							$start = $haystack_key - $buffer;
						}
						// find the end point
						$end = count( $haystack );
						if ( $end > ( $haystack_key + ( $buffer * 2 ) ) ) {
							$end = $haystack_key + ( $buffer * 2 );
						}
						// if we had an underflow (e.g. the first buffer wasn't fully included) grab more at the end
						$end += $underflow;
						$pdf_excerpt = array_slice( $haystack, $start, $end - $start );
						$pdf_excerpt = implode( ' ', $pdf_excerpt );
						break;
					}
				}
				// append our PDF-specific excerpt to the main excerpt
				if ( ! empty( $pdf_excerpt ) ) {
					$pdf_label = get_the_title( $attached_pdf->ID ); // the PDF label will be the title of the PDF post
					$excerpt .= '<br /><br /><strong>' . $pdf_label . '</strong>: ' . $pdf_excerpt;
				}
			}
		}
	}
	return $excerpt;
}
add_filter( 'get_the_excerpt', 'maybe_append_searchwp_pdf_excerpt' );
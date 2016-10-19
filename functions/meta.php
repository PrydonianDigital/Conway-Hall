<?php

function extra_info( $meta_boxes ) {
	$prefix = '_cmb_';
	$meta_boxes[] = array(
		'id' => 'meta',
		'title' => 'Meta Info',
		'pages' => array('ethicalrecord'),
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => 'Lectures',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . ''
			),
			array(
				'name' => 'Speaker',
				'desc' => 'Copy the name of the speaker here (for the eBooks option)',
				'type' => 'text',
				'id' => $prefix . 'lecspeaker'
			),
			array(
				'name' => 'Lecture Date',
				'desc' => '',
				'type' => 'text_date',
				'id' => $prefix . 'lecdate'
			),
			array(
				'name' => 'Lecture Abstract',
				'desc' => 'Try to limit to around 20 - 50 words.',
				'type' => 'textarea',
				'id' => $prefix . 'abstract'
			),
			array(
				'name' => 'Lecture References/Footnotes',
				'desc' => '',
				'type' => 'wysiwyg',
				'options' => array(
					'wpautop' => true, // use wpautop?
					'media_buttons' => true, // show insert/upload button(s)
				//	'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
					'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
					'tabindex' => '',
					'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
					'editor_class' => '', // add extra class(es) to the editor textarea
					'teeny' => true, // output the minimal editor config used in Press This
					'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
					'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
					'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
				),
				'id' => $prefix . 'ref'
			),
			array(
				'name' => 'Lecture Video',
				'desc' => 'Enter a YouTube, Vimeo, etc URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds" target="_blank">http://codex.wordpress.org/Embeds</a>.',
				'type' => 'oembed',
				'id' => $prefix . 'lecture_video'
			),
			array(
				'name' => 'Book Reviews',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . ''
			),
			array(
				'name' => 'Book Author(s)',
				'desc' => '',
				'type' => 'text',
				'id' => $prefix . 'author'
			),
			array(
				'name' => 'Book Publisher',
				'desc' => '',
				'type' => 'text',
				'id' => $prefix . 'publisher'
			),
			array(
				'name' => 'ISBN',
				'desc' => '',
				'type' => 'text',
				'id' => $prefix . 'isbn'
			),
			array(
				'name' => 'Review Author',
				'desc' => '',
				'type' => 'text',
				'id' => $prefix . 'vpauthor'
			),
			array(
				'name' => 'Videos',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . ''
			),
			array(
				'name' => 'Video',
				'desc' => 'Enter a YouTube, Vimeo, etc URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds" target="_blank">http://codex.wordpress.org/Embeds</a>.',
				'type' => 'oembed',
				'id' => $prefix . 'video'
			),
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'extra_info' );

function archive_issue( $meta_boxes ) {
	$prefix = '_cmb_';
	$meta_boxes[] = array(
		'id' => 'meta',
		'title' => 'Meta Info',
		'pages' => array('issue'),
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => 'PDF Archive Issue',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . ''
			),
			array(
				'name' => 'URL',
				'desc' => '',
				'type' => 'file',
				'id' => $prefix . 'issue'
			)
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'archive_issue' );

function free_events( $meta_boxes ) {
	$prefix = '_cmb_';
	$meta_boxes[] = array(
		'id' => 'meta',
		'title' => 'Free Event?',
		'pages' => array('tribe_events'),
		'context' => 'side',
		'priority' => 'high',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => 'Tick if a free event',
				'desc' => '',
				'type' => 'checkbox',
				'id' => $prefix . 'free'
			),
			array(
				'name' => 'Non-EventBrite ticket costs',
				'desc' => '',
				'type' => 'text',
				'id' => $prefix . 'tickets'
			)
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'free_events' );

function my_connection_types() {
		p2p_register_connection_type( array(
				'name' => 'pdf_to_page',
				'from' => 'pdf',
				'to' => 'page'
		) );
}
add_action( 'p2p_init', 'my_connection_types' );

function job_pdf() {
		p2p_register_connection_type( array(
				'name' => 'pdf_to_job',
				'from' => 'pdf',
				'to' => 'jobs'
		) );
}
add_action( 'p2p_init', 'job_pdf' );

function lecture_pdf() {
		p2p_register_connection_type( array(
				'name' => 'pdf_to_lecture',
				'from' => 'pdf',
				'to' => 'memorial_lecture'
		) );
}
add_action( 'p2p_init', 'lecture_pdf' );

function concert_pdf() {
		p2p_register_connection_type( array(
				'name' => 'pdf_to_concert',
				'from' => 'pdf',
				'to' => 'sunday_concerts'
		) );
}
add_action( 'p2p_init', 'concert_pdf' );

function post_pdf() {
		p2p_register_connection_type( array(
				'name' => 'pdf_to_post',
				'from' => 'pdf',
				'to' => 'post'
		) );
}
add_action( 'p2p_init', 'post_pdf' );

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
		 add_post_type_support( 'page', 'excerpt' );
}

function amazon_link( $meta_boxes ) {
	$prefix = '_cmb_';
	$meta_boxes[] = array(
		'id' => 'amazon',
		'title' => 'Amazon Link',
		'pages' => array('amazon_product'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => __( 'Author', 'ch' ),
				'id' => $prefix . 'author',
				'type' => 'text',
			),
			array(
				'name' => __( 'Link to Amazon', 'ch' ),
				'id' => $prefix . 'url',
				'type' => 'text_url',
			),
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'amazon_link' );

function carousel_link( $meta_boxes ) {
	$prefix = '_cmb_';
	$meta_boxes[] = array(
		'id' => 'meta',
		'title' => 'Carousel Link',
		'pages' => array('carousel'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => __( 'Link to page', 'ch' ),
				'id' => $prefix . 'url',
				'type' => 'text_url',
			),
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'carousel_link' );

function job_title( $meta_boxes ) {
	$prefix = '_cmb_';
	$meta_boxes[] = array(
		'id' => 'meta',
		'title' => 'Job title',
		'pages' => array('people'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => __( 'Job title', 'ch' ),
				'id' => $prefix . 'title',
				'type' => 'text',
			),
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'job_title' );

function pdf_box( $meta_boxes ) {
	$prefix = '_cmb_';
	$meta_boxes[] = array(
		'id' => 'meta',
		'title' => 'PDF',
		'pages' => array('pdf'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => __( 'PDF file', 'ch' ),
				'id' => $prefix . 'pdf',
				'type' => 'file',
			),
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'pdf_box' );

function memorial_speaker( $meta_boxes ) {
	$prefix = '_cmb_';
	$meta_boxes[] = array(
		'id' => 'meta',
		'title' => 'Speaker',
		'pages' => array('memorial_lecture'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => __( 'Speaker', 'ch' ),
				'id' => $prefix . 'speaker',
				'type' => 'text',
			),
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'memorial_speaker' );

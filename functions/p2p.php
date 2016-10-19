<?php

function lectureSpeaker() {
	p2p_register_connection_type( array(
		'name' => 'lectures2speakers',
		'from' => 'speaker',
		'to' => 'ethicalrecord'
	) );
}
add_action( 'p2p_init', 'lectureSpeaker' );

function issuePost() {
	p2p_register_connection_type( array(
		'name' => 'issue2post',
		'from' => 'issue',
		'to' => 'ethicalrecord'
	) );
}
add_action( 'p2p_init', 'issuePost' );

function projectEvent() {
	p2p_register_connection_type( array(
		'name' => 'project2event',
		'from' => 'project',
		'to' => 'tribe_events'
	) );
}
add_action( 'p2p_init', 'projectEvent' );

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
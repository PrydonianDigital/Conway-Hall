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
<?php

	add_action( 'cmb2_admin_init', 'extra_info2' );
	function extra_info2() {
		$prefix = '_cmb_';
		$cmb_ethicalrecord = new_cmb2_box( array(
			'id' => $prefix . 'meta',
			'title' => __( 'Ethical Record Info', 'ch' ),
			'object_types' => array( 'ethicalrecord' ),
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Lectures',
			'id'   => $prefix . '',
			'type' => 'title',
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Speaker',
			'id'   => $prefix . 'lecspeaker',
			'type' => 'text',
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Lecture Date',
			'id'   => $prefix . 'lecdate',
			'type' => 'text_date',
			'date_format' => 'd/m/Y'
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Lecture Abstract',
			'desc' => 'Try to limit to around 20 - 50 words.',
			'id'   => $prefix . 'abstract',
			'type' => 'textarea',
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Lecture References/Footnotes',
			'desc' => 'Try to limit to around 20 - 50 words.',
			'id'   => $prefix . 'ref',
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
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Lecture Video',
			'desc' => 'Enter a YouTube, Vimeo, etc URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds" target="_blank">http://codex.wordpress.org/Embeds</a>.',
			'id'   => $prefix . 'lecture_video',
			'type' => 'oembed',
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Book Reviews',
			'id'   => $prefix . 'br',
			'type' => 'title',
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Book Author(s)',
			'id'   => $prefix . 'author',
			'type' => 'text',
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Book Publisher',
			'id'   => $prefix . 'publisher',
			'type' => 'text',
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'ISBN',
			'id'   => $prefix . 'isbn',
			'type' => 'text',
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Review Author',
			'id'   => $prefix . 'vpauthor',
			'type' => 'text',
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Videos',
			'id'   => $prefix . 'vr',
			'type' => 'title',
		) );
		$cmb_ethicalrecord->add_field( array(
			'name' => 'Video',
			'desc' => 'Enter a YouTube, Vimeo, etc URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds" target="_blank">http://codex.wordpress.org/Embeds</a>.',
			'id'   => $prefix . 'video',
			'type' => 'oembed',
		) );
	}

	add_action( 'cmb2_admin_init', 'issue_info' );
	function issue_info() {
		$prefix = '_cmb_';
		$cmb = new_cmb2_box( array(
			'id'			=> 'test_metabox',
			'title'		 => 'Issue Info',
			'object_types'  => array( 'issue' ),
		) );
		$cmb->add_field( array(
			'name'	   => 'PDF',
			'id'		 => $prefix . 'issue',
			'type'	   => 'file',
		) );
	}

	add_action( 'cmb2_admin_init', 'free_events2' );
	function free_events2() {
		$prefix = '_cmb_';
		$cmb_event = new_cmb2_box( array(
			'id'			=> 'event_meta',
			'title'		 => 'Free Event?',
			'object_types'  => array( 'tribe_events' ),
			'context' => 'side',
			'priority' => 'high',
			'show_names' => true,
		) );
		$cmb_event->add_field( array(
			'name'	   => 'Tick if a free event',
			'id'		 => $prefix . 'free',
			'type'	   => 'checkbox',
		) );
		$cmb_event->add_field( array(
			'name'	   => 'Non-EventBrite ticket costs',
			'id'		 => $prefix . 'tickets',
			'type'	   => 'text_small',
		) );
	}

	add_action( 'cmb2_admin_init', 'amazon_link2' );
	function amazon_link2() {
		$prefix = '_cmb_';
		$cmb_amazon = new_cmb2_box( array(
			'id'			=> 'amazon',
			'title'		 => 'Amazon Link',
			'object_types'  => array( 'amazon_product' ),
		) );
		$cmb_amazon->add_field( array(
			'name'	   => 'Author',
			'id'		 => $prefix . 'author',
			'type'	   => 'text',
		) );
		$cmb_amazon->add_field( array(
			'name'	   => 'Link to Amazon',
			'id'		 => $prefix . 'url',
			'type'	   => 'text_url',
		) );
	}

	add_action( 'cmb2_admin_init', 'carousel_link2' );
	function carousel_link2() {
		$prefix = '_cmb_';
		$cmb_carousel = new_cmb2_box( array(
			'id'			=> 'carousel',
			'title'		 => 'Link',
			'object_types'  => array( 'carousel' ),
		) );
		$cmb_carousel->add_field( array(
			'name'	   => 'Link to page',
			'id'		 => $prefix . 'url',
			'type'	   => 'text_url',
		) );
	}

	add_action( 'cmb2_admin_init', 'job_title2' );
	function job_title2() {
		$prefix = '_cmb_';
		$cmb_job = new_cmb2_box( array(
			'id'			=> 'job',
			'title'		 => 'Job Title',
			'object_types'  => array( 'people' ),
		) );
		$cmb_job->add_field( array(
			'name'	   => 'Job Title',
			'id'		 => $prefix . 'title',
			'type'	   => 'text',
		) );
	}

	add_action( 'cmb2_admin_init', 'pdf_box2' );
	function pdf_box2() {
		$prefix = '_cmb_';
		$cmb_pdf = new_cmb2_box( array(
			'id'			=> 'pdf',
			'title'		 => 'PDF',
			'object_types'  => array( 'pdf' ),
		) );
		$cmb_pdf->add_field( array(
			'name'	   => 'PDF File',
			'id'		 => $prefix . 'pdf',
			'type'	   => 'file',
		) );
	}

	add_action( 'cmb2_admin_init', 'memorial_speaker2' );
	function memorial_speaker2() {
		$prefix = '_cmb_';
		$cmb_memorial = new_cmb2_box( array(
			'id'			=> 'memorial_speaker',
			'title'		 => 'Speaker',
			'object_types'  => array( 'memorial_lecture' ),
		) );
		$cmb_memorial->add_field( array(
			'name'	   => 'Speaker',
			'id'		 => $prefix . 'speaker',
			'type'	   => 'text',
		) );
	}

	add_action( 'cmb2_admin_init', 'project_meta2' );
	function project_meta2() {
		$prefix = '_project_';
		$cmb_project = new_cmb2_box( array(
			'id'			=> 'project',
			'title'		 => 'Project Details',
			'object_types'  => array( 'project' ),
		) );
		$cmb_project->add_field( array(
			'name'	   => 'Start Date',
			'id'		 => $prefix . 'startdate',
			'type'	   => 'text_date_timestamp',
			'date_format' => 'd m Y',
		) );
		$cmb_project->add_field( array(
			'name'	   => 'End Date',
			'id'		 => $prefix . 'enddate',
			'type'	   => 'text_date_timestamp',
			'date_format' => 'd m Y',
		) );
		$cmb_project->add_field( array(
			'name'	   => 'Ongoing?',
			'id'		 => $prefix . 'ongoing',
			'type'	   => 'checkbox',
		) );
		$cmb_project->add_field( array(
			'name'	   => 'Project Lead',
			'id'		 => $prefix . 'ptitle',
			'type'	   => 'title',
		) );
		$cmb_project->add_field( array(
			'name'	   => 'Project Lead Name',
			'id'		 => $prefix . 'lead',
			'type'	   => 'text',
		) );
		$cmb_project->add_field( array(
			'name'	   => 'Project Lead Photo',
			'id'		 => $prefix . 'leadpic',
			'type'	   => 'file',
		) );
		$cmb_project->add_field( array(
			'name'	   => 'Project Lead Bio',
			'id'		 => $prefix . 'bio',
			'type'	   => 'wysiwyg',
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
		) );
	}


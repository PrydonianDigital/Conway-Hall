<?php

// Product Types Taxonomy
function type() {
	$labels = array(
		'name' => _x( 'Product Types', 'Taxonomy General Name', 'ch' ),
		'singular_name' => _x( 'Product Type', 'Taxonomy Singular Name', 'ch' ),
		'menu_name' => __( 'Product Types', 'ch' ),
		'all_items' => __( 'All Types', 'ch' ),
		'parent_item' => __( 'Parent Type', 'ch' ),
		'parent_item_colon' => __( 'Parent Type:', 'ch' ),
		'new_item_name' => __( 'New Type', 'ch' ),
		'add_new_item' => __( 'Add New Type', 'ch' ),
		'edit_item' => __( 'Edit Type', 'ch' ),
		'update_item' => __( 'Update Types', 'ch' ),
		'separate_items_with_commas' => __( 'Separate Types with commas', 'ch' ),
		'search_items' => __( 'Search Types', 'ch' ),
		'add_or_remove_items' => __( 'Add or remove Types', 'ch' ),
		'choose_from_most_used'		 => __( 'Choose from the most used Types', 'ch' ),
		'not_found' => __( 'Not Found', 'ch' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
	);
	register_taxonomy( 'type', array( 'amazon_product' ), $args );
}
// Hook into the 'init' action
add_action( 'init', 'type', 0 );

// Register Custom Jobs Taxonomy
function job_type() {
	$labels = array(
		'name' => _x( 'Job Types', 'Taxonomy General Name', 'ch' ),
		'singular_name' => _x( 'Job Type', 'Taxonomy Singular Name', 'ch' ),
		'menu_name' => __( 'Job Types', 'ch' ),
		'all_items' => __( 'All Job Types', 'ch' ),
		'parent_item' => __( 'Parent Job Type', 'ch' ),
		'parent_item_colon' => __( 'Parent Job Type:', 'ch' ),
		'new_item_name' => __( 'New Job Type', 'ch' ),
		'add_new_item' => __( 'Add New Job Type', 'ch' ),
		'edit_item' => __( 'Edit Job Type', 'ch' ),
		'update_item' => __( 'Update Job Types', 'ch' ),
		'separate_items_with_commas' => __( 'Separate Job Types with commas', 'ch' ),
		'search_items' => __( 'Search Job Types', 'ch' ),
		'add_or_remove_items' => __( 'Add or remove Job Types', 'ch' ),
		'choose_from_most_used'		 => __( 'Choose from the most used Job Types', 'ch' ),
		'not_found' => __( 'Not Found', 'ch' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
	);
	register_taxonomy( 'job_type', array( 'jobs' ), $args );
}
// Hook into the 'init' action
add_action( 'init', 'job_type', 0 );

// Register ER Sections Taxonomy
function er_post_tax() {
	$labels = array(
		'name'		   => _x( 'Sections', 'Taxonomy General Name', 'ch' ),
		'singular_name'			  => _x( 'Section', 'Taxonomy Singular Name', 'ch' ),
		'menu_name'	  => __( 'Sections', 'ch' ),
		'all_items'	  => __( 'All Sections', 'ch' ),
		'parent_item'	=> __( 'Parent Section', 'ch' ),
		'parent_item_colon'		  => __( 'Parent Section:', 'ch' ),
		'new_item_name'			  => __( 'New Section', 'ch' ),
		'add_new_item'			   => __( 'Add New Section', 'ch' ),
		'edit_item'	  => __( 'Edit Section', 'ch' ),
		'update_item'	=> __( 'Update Section', 'ch' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'ch' ),
		'search_items'			   => __( 'Search Sections', 'ch' ),
		'add_or_remove_items'		=> __( 'Add or remove items', 'ch' ),
		'choose_from_most_used'	  => __( 'Choose from the most used items', 'ch' ),
		'not_found'	  => __( 'Not Found', 'ch' ),
	);
	$args = array(
		'labels'		 => $labels,
		'hierarchical'			   => true,
		'public'		 => true,
		'show_ui'		=> true,
		'show_admin_column'		  => true,
		'show_in_nav_menus'		  => true,
		'show_tagcloud'			  => true,
	);
	register_taxonomy( 'section', array( 'ethicalrecord' ), $args );
}
add_action( 'init', 'er_post_tax', 0 );

// Register ER Taxonomy Taxonomy
function er_tax() {
	$labels = array(
		'name'		   => _x( 'Taxonomies', 'Taxonomy General Name', 'ch' ),
		'singular_name'			  => _x( 'Taxonomy', 'Taxonomy Singular Name', 'ch' ),
		'menu_name'	  => __( 'Taxonomy', 'ch' ),
		'all_items'	  => __( 'All Items', 'ch' ),
		'parent_item'	=> __( 'Parent Item', 'ch' ),
		'parent_item_colon'		  => __( 'Parent Item:', 'ch' ),
		'new_item_name'			  => __( 'New Item Name', 'ch' ),
		'add_new_item'			   => __( 'Add New Item', 'ch' ),
		'edit_item'	  => __( 'Edit Item', 'ch' ),
		'update_item'	=> __( 'Update Item', 'ch' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'ch' ),
		'search_items'			   => __( 'Search Items', 'ch' ),
		'add_or_remove_items'		=> __( 'Add or remove items', 'ch' ),
		'choose_from_most_used'	  => __( 'Choose from the most used items', 'ch' ),
		'not_found'	  => __( 'Not Found', 'ch' ),
	);
	$args = array(
		'labels'		 => $labels,
		'hierarchical'			   => true,
		'public'		 => true,
		'show_ui'		=> true,
		'show_admin_column'		  => true,
		'show_in_nav_menus'		  => true,
		'show_tagcloud'			  => true,
	);
	register_taxonomy( 'taxonomy', array( 'ethicalrecord' ), $args );
}
add_action( 'init', 'er_tax', 0 );

add_filter( 'post_class', 'er_taxonomy_post_class', 10, 3 );

function er_taxonomy_post_class( $classes, $class, $ID ) {
	$taxonomy = 'taxonomy';
	$terms = get_the_terms( (int) $ID, $taxonomy );
	if( !empty( $terms ) ) {
		foreach( (array) $terms as $order => $term ) {
			if( !in_array( $term->slug, $classes ) ) {
	$classes[] = $term->slug;
			}
		}
	}
	return $classes;
}

// Register Issue Taxonomy
function issue_tax() {
	$labels = array(
		'name'		   => _x( 'Decade', 'Taxonomy General Name', 'ch' ),
		'singular_name'			  => _x( 'Decade', 'Taxonomy Singular Name', 'ch' ),
		'menu_name'	  => __( 'Decade', 'ch' ),
		'all_items'	  => __( 'All Decades', 'ch' ),
		'parent_item'	=> __( 'Parent Decade', 'ch' ),
		'parent_item_colon'		  => __( 'Parent Decade:', 'ch' ),
		'new_item_name'			  => __( 'New Decade', 'ch' ),
		'add_new_item'			   => __( 'Add New Decade', 'ch' ),
		'edit_item'	  => __( 'Edit Decade', 'ch' ),
		'update_item'	=> __( 'Update Decade', 'ch' ),
		'separate_items_with_commas' => __( 'Separate decades with commas', 'ch' ),
		'search_items'			   => __( 'Search Decade', 'ch' ),
		'add_or_remove_items'		=> __( 'Add or remove decades', 'ch' ),
		'choose_from_most_used'	  => __( 'Choose from the most used decades', 'ch' ),
		'not_found'	  => __( 'Not Found', 'ch' ),
	);
	$args = array(
		'labels'		 => $labels,
		'hierarchical'			   => true,
		'public'		 => true,
		'show_ui'		=> true,
		'show_admin_column'		  => true,
		'show_in_nav_menus'		  => true,
		'show_tagcloud'			  => true,
	);
	register_taxonomy( 'decade', array( 'issue' ), $args );
}
add_action( 'init', 'issue_tax', 0 );
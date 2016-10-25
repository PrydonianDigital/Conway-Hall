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

// Register Project Taxonomy
function project_tax() {
	$labels = array(
		'name'		   => _x( 'Project Category', 'Taxonomy General Name', 'ch' ),
		'singular_name'			  => _x( 'Project Category', 'Taxonomy Singular Name', 'ch' ),
		'menu_name'	  => __( 'Project Category', 'ch' ),
		'all_items'	  => __( 'All Project Categories', 'ch' ),
		'parent_item'	=> __( 'Parent Project Category', 'ch' ),
		'parent_item_colon'		  => __( 'Parent Project Category:', 'ch' ),
		'new_item_name'			  => __( 'New Project Category', 'ch' ),
		'add_new_item'			   => __( 'Add New Project Category', 'ch' ),
		'edit_item'	  => __( 'Edit Project Category', 'ch' ),
		'update_item'	=> __( 'Update Project Category', 'ch' ),
		'separate_items_with_commas' => __( 'Separate Project Categories with commas', 'ch' ),
		'search_items'			   => __( 'Search Project Category', 'ch' ),
		'add_or_remove_items'		=> __( 'Add or remove Project Categories', 'ch' ),
		'choose_from_most_used'	  => __( 'Choose from the most used Project Categories', 'ch' ),
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
	register_taxonomy( 'project_category', array( 'project' ), $args );
}
add_action( 'init', 'project_tax', 0 );

// Register PDF Taxonomy
function pdf_tax() {
	$labels = array(
		'name'		   => _x( 'PDF Category', 'Taxonomy General Name', 'ch' ),
		'singular_name'			  => _x( 'PDF Category', 'Taxonomy Singular Name', 'ch' ),
		'menu_name'	  => __( 'PDF Category', 'ch' ),
		'all_items'	  => __( 'All PDF Categories', 'ch' ),
		'parent_item'	=> __( 'Parent PDF Category', 'ch' ),
		'parent_item_colon'		  => __( 'Parent PDF Category:', 'ch' ),
		'new_item_name'			  => __( 'New PDF Category', 'ch' ),
		'add_new_item'			   => __( 'Add New PDF Category', 'ch' ),
		'edit_item'	  => __( 'Edit PDF Category', 'ch' ),
		'update_item'	=> __( 'Update PDF Category', 'ch' ),
		'separate_items_with_commas' => __( 'Separate PDF Categories with commas', 'ch' ),
		'search_items'			   => __( 'Search PDF Category', 'ch' ),
		'add_or_remove_items'		=> __( 'Add or remove PDF Categories', 'ch' ),
		'choose_from_most_used'	  => __( 'Choose from the most used PDF Categories', 'ch' ),
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
	register_taxonomy( 'pdf_category', array( 'pdf' ), $args );
}
add_action( 'init', 'pdf_tax', 0 );

	function wpdocs_custom_taxonomies_terms_links() {
	    // Get post by post ID.
	    $post = get_post( $post->ID );

	    // Get post type by post.
	    $post_type = $post->post_type;

	    // Get post type taxonomies.
	    $taxonomies = get_object_taxonomies( $post_type, 'objects' );

	    $out = array();

	    foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
	        $terms = get_the_terms( $post->ID, $taxonomy_slug );
	        if ( ! empty( $terms ) ) {
	            foreach ( $terms as $term ) {
	                $out[] = sprintf( '<a href="%1$s">%2$s</a>',
	                    esc_url( get_term_link( $term->slug, $taxonomy_slug ) ),
	                    esc_html( $term->name )
	                );
	            }
	        }
	    }
	    return implode( ', ', $out );
	}
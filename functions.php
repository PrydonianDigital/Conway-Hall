<?php

function conway_hall_init()  {
	remove_action( 'wp_head', 'wp_generator' );
	show_admin_bar( false );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 700, 394, true );
	add_image_size( 'featured', 700, 394, true );
	add_image_size( 'article', 350, 197, false );
	add_image_size( 'speaker', 290, 290, true );
	$defaults = array(
		'default-image'          => get_template_directory_uri() . '/img/header/header.png',
		'random-default'         => true,
		'width'                  => 1920,
		'height'                 => 200,
		'flex-height'            => false,
		'flex-width'             => false,
		'default-text-color'     => '',
		'header-text'            => false,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $defaults );
	add_editor_style( 'editor-style.css' );	
	$markup = array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', );
	add_theme_support( 'html5', $markup );	
}
add_action( 'after_setup_theme', 'conway_hall_init' );

function ch_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', false, '1.11.1', true );
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', false, '2.8.1', false );
	wp_register_script( 'gumby', get_template_directory_uri() . '/js/libs/gumby.min.js', false, '2.6', true );
	wp_register_script( 'cookie', get_template_directory_uri() . '/js/libs/cookie.js', false, '1.4.1', true );
	wp_register_script( 'owl', get_template_directory_uri() . '/owl-carousel/owl.carousel.min.js', false, '1.4.1', true );
	wp_register_script( 'capslide', get_template_directory_uri() . '/js/capSlide.js', false, '1.4.1', true );
	wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', false, '2.6', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'gumby' );
	wp_enqueue_script( 'owl' );
	wp_enqueue_script( 'capslide' );
	wp_enqueue_script( 'cookie' );
	wp_enqueue_script( 'main' );
}
add_action( 'wp_enqueue_scripts', 'ch_scripts' );

function ch_styles() {
	wp_register_style( 'base', get_template_directory_uri() . '/css/base.css', false, '2.6' );
	wp_register_style( 'normalise', get_template_directory_uri() . '/css/normalize.css', false, '3.0.1' );
	wp_register_style( 'owl', get_template_directory_uri() . '/owl-carousel/owl.carousel.css', false, '3.0.1' );
	wp_register_style( 'theme', get_template_directory_uri() . '/owl-carousel/owl.theme.css', false, '3.0.1' );
	wp_register_style( 'normalise', get_template_directory_uri() . '/css/normalize.css', false, '3.0.1' );
	wp_enqueue_style( 'normalise' );
	wp_enqueue_style( 'owl' );
	wp_enqueue_style( 'theme' );
	wp_enqueue_style( 'base' );
}
add_action( 'wp_enqueue_scripts', 'ch_styles' );

function ch_menu() {
	$locations = array(
		'chmenu' => __( 'Conway Hall Menu', 'ch' ),
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'ch_menu' );

add_filter('wp_nav_menu_args', 'prefix_nav_menu_args');
function prefix_nav_menu_args($args = ''){
    $args['container'] = false;
    return $args;
}

register_sidebar( array(
	'id' => 'homepage',
	'name' => __( 'Home Page Sidebar', 'ch' ),
	'description' => __( 'Sidebar for the home page/archives', 'ch' ),
	'before_title' => '<h5 class="widget">',
	'aftch_title' => '</h5>',
	'before_widget' => '<li id="%1$s" class="widget field %2$s">',
	'aftch_widget' => '</li>',
));

// Register Carousel Post Type
function carousel() {
	$labels = array(
		'name'                => _x( 'Carousels', 'Post Type General Name', 'ch' ),
		'singular_name'       => _x( 'Carousel', 'Post Type Singular Name', 'ch' ),
		'menu_name'           => __( 'Carousels', 'ch' ),
		'parent_item_colon'   => __( 'Parent Carousel:', 'ch' ),
		'all_items'           => __( 'All Carousels', 'ch' ),
		'view_item'           => __( 'View Carousel', 'ch' ),
		'add_new_item'        => __( 'Add New Carousel', 'ch' ),
		'add_new'             => __( 'Add New', 'ch' ),
		'edit_item'           => __( 'Edit Carousel', 'ch' ),
		'update_item'         => __( 'Update Carousel', 'ch' ),
		'search_items'        => __( 'Search Carousels', 'ch' ),
		'not_found'           => __( 'Not found', 'ch' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label'               => __( 'venue', 'ch' ),
		'description'         => __( 'Home page carousel', 'ch' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'page-attributes', 'excerpt' ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'carousel', $args );
}
// Hook into the 'init' action
add_action( 'init', 'carousel', 0 );

// Register Venue Post Type
function venue() {
	$labels = array(
		'name'                => _x( 'Venues', 'Post Type General Name', 'ch' ),
		'singular_name'       => _x( 'Venue', 'Post Type Singular Name', 'ch' ),
		'menu_name'           => __( 'Venues', 'ch' ),
		'parent_item_colon'   => __( 'Parent Venue:', 'ch' ),
		'all_items'           => __( 'All Venues', 'ch' ),
		'view_item'           => __( 'View Venue', 'ch' ),
		'add_new_item'        => __( 'Add New Venue', 'ch' ),
		'add_new'             => __( 'Add New', 'ch' ),
		'edit_item'           => __( 'Edit Venue', 'ch' ),
		'update_item'         => __( 'Update Venue', 'ch' ),
		'search_items'        => __( 'Search Venues', 'ch' ),
		'not_found'           => __( 'Not found', 'ch' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label'               => __( 'venue', 'ch' ),
		'description'         => __( 'List of rooms available to hire in Conway Hall', 'ch' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'venues', $args );
}
// Hook into the 'init' action
add_action( 'init', 'venue', 0 );

// Register People Post Type
function people() {
	$labels = array(
		'name'                => _x( 'People', 'Post Type General Name', 'ch' ),
		'singular_name'       => _x( 'Person', 'Post Type Singular Name', 'ch' ),
		'menu_name'           => __( 'People', 'ch' ),
		'parent_item_colon'   => __( 'Parent Person:', 'ch' ),
		'all_items'           => __( 'All People', 'ch' ),
		'view_item'           => __( 'View Person', 'ch' ),
		'add_new_item'        => __( 'Add New Person', 'ch' ),
		'add_new'             => __( 'Add New', 'ch' ),
		'edit_item'           => __( 'Edit Person', 'ch' ),
		'update_item'         => __( 'Update Person', 'ch' ),
		'search_items'        => __( 'Search People', 'ch' ),
		'not_found'           => __( 'Not found', 'ch' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label'               => __( 'people', 'ch' ),
		'description'         => __( 'Staff listings', 'ch' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'people', $args );
}
// Hook into the 'init' action
add_action( 'init', 'people', 0 );

// Register Jobs Post Type
function jobs() {
	$labels = array(
		'name'                => _x( 'Jobs', 'Post Type General Name', 'ch' ),
		'singular_name'       => _x( 'Job', 'Post Type Singular Name', 'ch' ),
		'menu_name'           => __( 'Jobs', 'ch' ),
		'parent_item_colon'   => __( 'Parent Job:', 'ch' ),
		'all_items'           => __( 'All Jobs', 'ch' ),
		'view_item'           => __( 'View Job', 'ch' ),
		'add_new_item'        => __( 'Add New Job', 'ch' ),
		'add_new'             => __( 'Add New', 'ch' ),
		'edit_item'           => __( 'Edit Job', 'ch' ),
		'update_item'         => __( 'Update Job', 'ch' ),
		'search_items'        => __( 'Search Jobs', 'ch' ),
		'not_found'           => __( 'Not found', 'ch' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label'               => __( 'jobs', 'ch' ),
		'description'         => __( 'Job/Volunteering listings', 'ch' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'taxonomies'          => array( 'category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'jobs', $args );
}
// Hook into the 'init' action
add_action( 'init', 'jobs', 0 );

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

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
				'id'   => $prefix . 'url',
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
				'id'   => $prefix . 'title',
				'type' => 'text',
			),
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'job_title' );



add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'metabox/init.php' );
	}
}

add_action( 'dashboard_glance_items', 'my_add_cpt_to_dashboard' );

function my_add_cpt_to_dashboard() {
	$showTaxonomies = 1;
	if ($showTaxonomies) {
		$taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' );
		foreach ( $taxonomies as $taxonomy ) {
			$num_terms  = wp_count_terms( $taxonomy->name );
			$num = number_format_i18n( $num_terms );
			$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name, $num_terms );
			$associated_post_type = $taxonomy->object_type;
			if ( current_user_can( 'manage_categories' ) ) {
			  $output = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $num . ' ' . $text .'</a>';
			}
			echo '<li class="taxonomy-count">' . $output . ' </li>';
		}
	}
	// Custom post types counts
	$post_types = get_post_types( array( '_builtin' => false ), 'objects' );
	foreach ( $post_types as $post_type ) {
		if($post_type->show_in_menu==false) {
			continue;
		}
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( $post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish );
		if ( current_user_can( 'edit_posts' ) ) {
			$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
		}
		echo '<li class="page-count ' . $post_type->name . '-count">' . $output . '</td>';
	}
}

function wpclean_add_metabox_menu_posttype_archive() {
	add_meta_box('wpclean-metabox-nav-menu-posttype', 'Custom Post Type Archives', 'wpclean_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default');
}
 
function wpclean_metabox_menu_posttype_archive() {
	$post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');
	if ($post_types) :
		$items = array();
		$loop_index = 999999;
		foreach ($post_types as $post_type) {
			$item = new stdClass();
			$loop_index++;
			$item->object_id = $loop_index;
			$item->db_id = 0;
			$item->object = 'post_type_' . $post_type->query_var;
			$item->menu_item_parent = 0;
			$item->type = 'custom';
			$item->title = $post_type->labels->name;
			$item->url = get_post_type_archive_link($post_type->query_var);
			$item->target = '';
			$item->attr_title = '';
			$item->classes = array();
			$item->xfn = '';
			$items[] = $item;
		}
		$walker = new Walker_Nav_Menu_Checklist(array());
		echo '<div id="posttype-archive" class="posttypediv">';
		echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
		echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
		echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
		echo '</ul>';
		echo '</div>';
		echo '</div>';
		echo '<p class="button-controls">';
		echo '<span class="add-to-menu">';
		echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'stop_ivory') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
		echo '<span class="spinner"></span>';
		echo '</span>';
		echo '</p>';
	endif;
}
add_action('admin_head-nav-menus.php', 'wpclean_add_metabox_menu_posttype_archive');

class Walker_Page_Custom extends Walker_Nav_menu{
		function start_lvl(&$output, $depth=0, $args=array()){
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<div class=\"dropdown\"><ul>\n";
		}
		function end_lvl(&$output , $depth=0, $args=array()){
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul></div>\n";
		}
	}
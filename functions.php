<?php

if ( ! isset( $content_width ) )
	$content_width = 700;

function conway_hall_init()	{
	remove_action( 'wp_head', 'wp_generator' );
	show_admin_bar( false );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'jetpack-responsive-videos' );
	add_theme_support( 'title-tag' );
	set_post_thumbnail_size( 700, 394, true );
	add_image_size( 'featured', 700, 394, true );
	add_image_size( 'full', 1000, 563, true );
	add_image_size( 'article', 350, 197, false );
	add_image_size( 'lecture', 220, 353, false );
	add_image_size( 'lecture', 220, 353, false );
	add_image_size( 'shop', 200, 350, true );
	add_image_size( 'calendar', 90, 90, true );
	$defaults = array(
		'default-image' => get_template_directory_uri() . '/img/header/header.png',
		'random-default' => true,
		'width' => 1920,
		'height' => 200,
		'flex-height' => false,
		'flex-width' => false,
		'default-text-color' => '',
		'header-text' => false,
		'uploads' => true,
		'wp-head-callback' => '',
		'admin-head-callback' => '',
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
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/libs/jquery-1.10.1.min.js', false, '1.10.1', true );
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', false, '2.8.1', false );
	wp_register_script( 'gumby', get_template_directory_uri() . '/js/libs/gumby.min.js', false, '2.6', true );
	wp_register_script( 'cookie', get_template_directory_uri() . '/js/libs/cookie.js', false, '1.4.1', true );
	wp_register_script( 'owl', get_template_directory_uri() . '/owl-carousel/owl.carousel.min.js', false, '1.4.1', true );
	wp_register_script( 'capslide', get_template_directory_uri() . '/js/capSlide.js', false, '1.4.1', true );
	wp_register_script( 'gmap', '//maps.googleapis.com/maps/api/js?sensor=false&region=GB', false, '6.0.0', true );
	wp_register_script( 'gmap3', get_template_directory_uri() . '/js/gmap3.js', false, '6.0.0', true );
	wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', false, '2.6', true );
	wp_register_script( 'planit', get_template_directory_uri() . '/planit/global/js/jquery.planit.js', false, '', true );
	wp_register_script( 'planittooltip', get_template_directory_uri() . '/roomplanner/planit/global/js/jquery.tooltip.js', false, '2.6', true );
	wp_register_script( 'planitcarousel', get_template_directory_uri() . '/roomplanner/planit/global/js/jquery.jcarousel.min.js', false, '2.6', true );
	wp_register_script( 'planitswf', get_template_directory_uri() . '/roomplanner/planit/global/js/swfobject.js', false, '2.6', true );
	wp_register_script( 'planitflash', get_template_directory_uri() . '/roomplanner/planit/global/js/flash-detection.js', false, '2.6', true );
	wp_register_script( 'planittour', get_template_directory_uri() . '/roomplanner/planit/global/tour.js', false, '2.6', true );
	wp_register_script( 'planitfancybox', get_template_directory_uri() . '/roomplanner/planit/global/lightwindow/jquery.fancybox.js', false, '2.6', true );
	wp_register_script( 'planitprint', get_template_directory_uri() . '/roomplanner/planit/global/js/jquery.printarea.js', false, '2.6', true );
	wp_register_script( 'planit', get_template_directory_uri() . '/roomplanner/planit/global/js/jquery.planit.js', false, '2.6', true );
	wp_register_script( 'swf', get_template_directory_uri() . '/360tour/js/swfobject.js', false, '2.6', true );
	wp_register_script( 'json2', get_template_directory_uri() . '/360tour/js/json2.js', false, '2.6', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'gumby' );
	wp_enqueue_script( 'owl' );
	wp_enqueue_script( 'capslide' );
	wp_enqueue_script( 'cookie' );
	wp_enqueue_script( 'gmap' );
	wp_enqueue_script( 'gmap3' );
	wp_enqueue_script( 'main' );
}
add_action( 'wp_enqueue_scripts', 'ch_scripts' );

function ch_styles() {
	wp_register_style( 'base', get_template_directory_uri() . '/css/base.css', false, '2.6' );
	wp_register_style( 'normalise', get_template_directory_uri() . '/css/normalize.css', false, '3.0.1' );
	wp_register_style( 'owl', get_template_directory_uri() . '/owl-carousel/owl.carousel.css', false, '3.0.1' );
	wp_register_style( 'theme', get_template_directory_uri() . '/owl-carousel/owl.theme.css', false, '3.0.1' );
	wp_register_style( 'normalise', get_template_directory_uri() . '/css/normalize.css', false, '3.0.1' );
	wp_register_style( 'planit', get_template_directory_uri() . '/roomplanner/planit/global/css/style.css', false, '2.6' );
	wp_register_style( 'planitskin', get_template_directory_uri() . '/roomplanner/planit/global/css/skin.css', false, '2.6' );
	wp_register_style( 'planitfancyboxcss', get_template_directory_uri() . '/roomplanner/planit/global/lightwindow/jquery.fancybox.css', false, '2.6' );
	wp_register_style( 'planitprint', get_template_directory_uri() . '/roomplanner/planit/global/css/print.css', false, '2.6', 'print' );
	wp_enqueue_style( 'normalise' );
	wp_enqueue_style( 'owl' );
	wp_enqueue_style( 'theme' );
	wp_enqueue_style( 'base' );
}
add_action( 'wp_enqueue_scripts', 'ch_styles' );

function room_planner() {
	if ( is_page(array('main-hall-room-planner', 'brockway-room-planner', 'balcony-room-planner', 'artists-room-planner', 'bertrand-russell-room-planner', 'foyer-room-planner', 'club-room-planner')) ) {
		wp_enqueue_script('planit');
	}
}
add_action('wp_enqueue_scripts', 'room_planner');

function tour() {
	if ( is_page(array('foyer-360o-tour', 'foyer-open-360o-tour', 'library-360o-tour', 'bertrand-russell-room-360o-tour', 'artists-room-360o-tour', 'brockway-room-360o-tour', 'main-hall-360o-tour', 'club-room-hollow-square-360o-tour', 'club-room-theatre-360o-tour')) ) {
		wp_enqueue_script('swf');
		wp_enqueue_script('json2');
	}
}
add_action('wp_enqueue_scripts', 'tour');

function ch_menu() {
	$locations = array(
		'chmenu' => __( 'Conway Hall Menu', 'ch' ),
		'chsubmenu' => __( 'Conway Hall SubMenu', 'ch' ),
		'ersubmenu' => __( 'Ethical Record SubMenu', 'ch' ),
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'ch_menu' );

add_filter('wp_nav_menu_args', 'prefix_nav_menu_args');
function prefix_nav_menu_args($args = ''){
	$args['container'] = false;
	return $args;
}

function the_post_thumbnail_caption() {
	global $post;
	$thumbnail_id = get_post_thumbnail_id($post->ID);
	$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));
	if ($thumbnail_image && isset($thumbnail_image[0])) {
		echo '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
	}
}

register_sidebar(
	array(
		'id' => 'homepage',
		'name' => __( 'Main Sidebar', 'ch' ),
		'description' => __( '', 'ch' ),
		'before_title' => '<h5 class="widget">',
		'aftch_title' => '</h5>',
		'before_widget' => '<li id="%1$s" class="widget field %2$s">',
		'after_widget' => '</li>',
	)
);

register_sidebar(
	array(
		'id' => 'join',
		'name' => __( 'Join/Donate', 'ch' ),
		'description' => __( '', 'ch' ),
		'before_title' => '<h5 class="widget">',
		'aftch_title' => '</h5>',
		'before_widget' => '<li id="%1$s" class="widget field %2$s">',
		'after_widget' => '</li>',
	)
);

define ('CH_member_pages', 'view_member_pages');
define ('CH_trustee_pages', 'view_trustee_pages');
define ('view_member_pages', 'page-members.php');
define ('view_trustee_pages', 'page-trustees.php');

$result = add_role(
	'member', 'UK Member',
	array(
		'read' => true,
		'edit_posts' => false,
		'delete_posts' => false,
		'CH_member_pages' => true,
	)
);
$result = add_role(
	'nonukmember', 'Non UK Member',
	array(
		'read' => true,
		'edit_posts' => false,
		'delete_posts' => false,
		'CH_member_pages' => true,
	)
);
$result = add_role(
	'nonukinstitution', 'Non UK Institution',
	array(
		'read' => true,
		'edit_posts' => false,
		'delete_posts' => false,
		'CH_member_pages' => true,
	)
);
$result = add_role(
	'trustee', 'Trustee',
	array(
		'read' => true,
		'edit_posts' => false,
		'delete_posts' => false,
		'CH_member_pages' => true,
		'CH_trustee_pages' => true,
	)
);
get_role('administrator')->add_cap('CH_member_pages', 'CH_trustee_pages');
get_role('editor')->add_cap('CH_member_pages', 'CH_trustee_pages');

add_action('init', 'my_custom_init');
	function my_custom_init() {
	add_post_type_support( 'tribe_events', 'publicize' );
}

// Register Carousel Post Type
function carousel() {
	$labels = array(
		'name' => _x( 'Carousels', 'Post Type General Name', 'ch' ),
		'singular_name' => _x( 'Carousel', 'Post Type Singular Name', 'ch' ),
		'menu_name' => __( 'Carousels', 'ch' ),
		'parent_item_colon' => __( 'Parent Carousel:', 'ch' ),
		'all_items' => __( 'All Carousels', 'ch' ),
		'view_item' => __( 'View Carousel', 'ch' ),
		'add_new_item' => __( 'Add New Carousel', 'ch' ),
		'add_new' => __( 'Add New', 'ch' ),
		'edit_item' => __( 'Edit Carousel', 'ch' ),
		'update_item' => __( 'Update Carousel', 'ch' ),
		'search_items' => __( 'Search Carousels', 'ch' ),
		'not_found' => __( 'Not found', 'ch' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label' => __( 'venue', 'ch' ),
		'description' => __( 'Home page carousel', 'ch' ),
		'labels' => $labels,
		'supports' => array( 'title', 'thumbnail', 'page-attributes', 'excerpt' ),
		'taxonomies' => array(),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	register_post_type( 'carousel', $args );
}
// Hook into the 'init' action
add_action( 'init', 'carousel', 0 );

// Register Custom Conway Memorial Lectures Type
function chml() {
	$labels = array(
		'name' => _x( 'Conway Memorial Lectures', 'Post Type General Name', 'ch' ),
		'singular_name' => _x( 'Conway Memorial Lecture', 'Post Type Singular Name', 'ch' ),
		'menu_name' => __( 'Conway Lecture', 'ch' ),
		'parent_item_colon' => __( 'Parent Conway Lecture:', 'ch' ),
		'all_items' => __( 'All Conway Lectures', 'ch' ),
		'view_item' => __( 'View Conway Lecture', 'ch' ),
		'add_new_item' => __( 'Add New Conway Lecture', 'ch' ),
		'add_new' => __( 'Add New', 'ch' ),
		'edit_item' => __( 'Edit Conway Lecture', 'ch' ),
		'update_item' => __( 'Update Conway Lecture', 'ch' ),
		'search_items' => __( 'Search Conway Lecture', 'ch' ),
		'not_found' => __( 'Not found', 'ch' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label' => __( 'memorial_lecture', 'ch' ),
		'description' => __( "<p>Every year guest lecturers have been invited to speak on subjects across disciplines such as philosophy, history, science, sociology and art, all wth the intent of presenting the latest thinking on those subjects by leading experts in their respective fields. Since 1910, a staggering portfolio of speakers and topics have been presented that is worthy of comparison to other such similar memorial lectures run by other institutions.</p><p>Bertrand Russell, Herbert Read, Gilbert Murray, Jonathan Miller, A J Ayer and Christopher Hill are some of those among the many who have given Conway Memorial Lectures. Those sitting in the Chair at these lectures have been equally illustrious, for example E M Forster chaired Edward Thompson's 1942 lecture on Ethical Ideals in India Today.</p><p>In hindsight, the decision taken in 1908 at a conference of friends and admirers of Dr Moncure Conway (1832 - 1907) to set up an endownment for an 'annual lecture or lectures perpetuating Dr. Conway's memory' rather than funding a medallion or statue of him has been borne out magnificently. Indeed, Edward Clodd, in his introduction to the inaugral lecture by John Russell must, as a respresentative of that group of 'friends and admirers', take credit for taking this course of action, even though as he stated an annual lecture series was 'more in line' with Conway's own wishes.</p><p>So, in memory of the man whom Barbara Wootton described, in her Chairman's introduction to Lord Chorley's 1953 Conway Memorial Lecture, as one 'who died in 1907 after a life-time spent fighting for freedom on both sides of the atlantic', we have significant body of work in the legacy that the Conway Memorial Lectures provide. And, as a modern day testament to that legacy Conway Hall is prioritising the digitising of every available lecture.</p>", 'ch' ),
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'publicize' ),
		'taxonomies' => array( ),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	register_post_type( 'memorial_lecture', $args );
}
// Hook into the 'init' action
add_action( 'init', 'chml', 0 );

// Register Amazon Product Post Type
function amazon_products() {
	$labels = array(
		'name' => _x( 'Amazon Products', 'Post Type General Name', 'ch' ),
		'singular_name' => _x( 'Amazon Product', 'Post Type Singular Name', 'ch' ),
		'menu_name' => __( 'Amazon Products', 'ch' ),
		'parent_item_colon' => __( 'Parent Amazon Product:', 'ch' ),
		'all_items' => __( 'All Amazon Products', 'ch' ),
		'view_item' => __( 'View Amazon Product', 'ch' ),
		'add_new_item' => __( 'Add New Amazon Product', 'ch' ),
		'add_new' => __( 'Add New', 'ch' ),
		'edit_item' => __( 'Edit Amazon Product', 'ch' ),
		'update_item' => __( 'Update Amazon Product', 'ch' ),
		'search_items' => __( 'Search Amazon Products', 'ch' ),
		'not_found' => __( 'Not found', 'ch' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label' => __( 'amazon_product', 'ch' ),
		'description' => __( 'Conway Hall shop products', 'ch' ),
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies' => array( 'type' ),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'amazon_product', $args );
}
// Hook into the 'init' action
add_action( 'init', 'amazon_products', 0 );

// Register Amazon Product Post Type
function am_products() {
	$labels = array(
		'name' => _x( 'Products', 'Post Type General Name', 'ch' ),
		'singular_name' => _x( 'Product', 'Post Type Singular Name', 'ch' ),
		'menu_name' => __( 'Products', 'ch' ),
		'parent_item_colon' => __( 'Parent Product:', 'ch' ),
		'all_items' => __( 'All Products', 'ch' ),
		'view_item' => __( 'View Product', 'ch' ),
		'add_new_item' => __( 'Add New Product', 'ch' ),
		'add_new' => __( 'Add New', 'ch' ),
		'edit_item' => __( 'Edit Product', 'ch' ),
		'update_item' => __( 'Update Product', 'ch' ),
		'search_items' => __( 'Search Products', 'ch' ),
		'not_found' => __( 'Not found', 'ch' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label' => __( 'product', 'ch' ),
		'description' => __( 'products', 'ch' ),
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies' => array( 'type' ),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'product', $args );
}
// Hook into the 'init' action
add_action( 'init', 'am_products', 0 );

// Register People Post Type
function people() {
	$labels = array(
		'name' => _x( 'People', 'Post Type General Name', 'ch' ),
		'singular_name' => _x( 'Person', 'Post Type Singular Name', 'ch' ),
		'menu_name' => __( 'People', 'ch' ),
		'parent_item_colon' => __( 'Parent Person:', 'ch' ),
		'all_items' => __( 'All People', 'ch' ),
		'view_item' => __( 'View Person', 'ch' ),
		'add_new_item' => __( 'Add New Person', 'ch' ),
		'add_new' => __( 'Add New', 'ch' ),
		'edit_item' => __( 'Edit Person', 'ch' ),
		'update_item' => __( 'Update Person', 'ch' ),
		'search_items' => __( 'Search People', 'ch' ),
		'not_found' => __( 'Not found', 'ch' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label' => __( 'people', 'ch' ),
		'description' => __( 'Staff listings', 'ch' ),
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'taxonomies' => array(),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	register_post_type( 'people', $args );
}
// Hook into the 'init' action
add_action( 'init', 'people', 0 );

// Register Jobs Post Type
function jobs() {
	$labels = array(
		'name' => _x( 'Jobs', 'Post Type General Name', 'ch' ),
		'singular_name' => _x( 'Job', 'Post Type Singular Name', 'ch' ),
		'menu_name' => __( 'Jobs', 'ch' ),
		'parent_item_colon' => __( 'Parent Job:', 'ch' ),
		'all_items' => __( 'All Jobs', 'ch' ),
		'view_item' => __( 'View Job', 'ch' ),
		'add_new_item' => __( 'Add New Job', 'ch' ),
		'add_new' => __( 'Add New', 'ch' ),
		'edit_item' => __( 'Edit Job', 'ch' ),
		'update_item' => __( 'Update Job', 'ch' ),
		'search_items' => __( 'Search Jobs', 'ch' ),
		'not_found' => __( 'Not found', 'ch' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label' => __( 'jobs', 'ch' ),
		'description' => __( 'Job/Volunteering listings', 'ch' ),
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'publicize' ),
		'taxonomies' => array( 'job_type' ),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	register_post_type( 'jobs', $args );
}
// Hook into the 'init' action
add_action( 'init', 'jobs', 0 );

// Register PDF Post Type
function pdf() {
	$labels = array(
		'name' => _x( 'PDFs', 'Post Type General Name', 'ch' ),
		'singular_name' => _x( 'PDF', 'Post Type Singular Name', 'ch' ),
		'menu_name' => __( 'PDFs', 'ch' ),
		'parent_item_colon' => __( 'Parent PDF:', 'ch' ),
		'all_items' => __( 'All PDFs', 'ch' ),
		'view_item' => __( 'View PDF', 'ch' ),
		'add_new_item' => __( 'Add New PDF', 'ch' ),
		'add_new' => __( 'Add PDF', 'ch' ),
		'edit_item' => __( 'Edit PDF', 'ch' ),
		'update_item' => __( 'Update PDF', 'ch' ),
		'search_items' => __( 'Search PDFs', 'ch' ),
		'not_found' => __( 'Not found', 'ch' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label' => __( 'pdf', 'ch' ),
		'description' => __( 'All PDFs for the site', 'ch' ),
		'labels' => $labels,
		'supports' => array( 'title', ),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	register_post_type( 'pdf', $args );
}
// Hook into the 'init' action
add_action( 'init', 'pdf', 0 );

// Register Custom Types Taxonomy
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

function sc_posts() {
	$labels = array(
		'name'	=> _x( 'Sunday Concerts', 'Post Type General Name', 'ch' ),
		'singular_name'	   => _x( 'Sunday Concert', 'Post Type Singular Name', 'ch' ),
		'menu_name'		   => __( 'Sunday Concerts', 'ch' ),
		'parent_item_colon'   => __( 'Parent Sunday Concert:', 'ch' ),
		'all_items'		   => __( 'All Sunday Concerts', 'ch' ),
		'view_item'		   => __( 'View Sunday Concert', 'ch' ),
		'add_new_item'		=> __( 'Add New Sunday Concert', 'ch' ),
		'add_new'			 => __( 'Add New', 'ch' ),
		'edit_item'		   => __( 'Edit Sunday Concert', 'ch' ),
		'update_item'		 => __( 'Update Sunday Concert', 'ch' ),
		'search_items'		=> __( 'Search Sunday Concerts', 'ch' ),
		'not_found'		   => __( 'Not found', 'ch' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label'			   => __( 'sunday_concerts', 'ch' ),
		'description'		 => __( 'Sunday Concert Posts', 'ch' ),
		'labels'			  => $labels,
		'supports'			=> array( 'title', 'editor', 'thumbnail', 'excerpt', 'publicize' ),
		'taxonomies'		  => array( ),
		'hierarchical'		=> false,
		'public'			  => true,
		'show_ui'			 => true,
		'show_in_menu'		=> true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'	   => 5,
		'menu_icon'		   => '',
		'can_export'		  => true,
		'has_archive'		 => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'	 => 'page',
	);
	register_post_type( 'sunday_concerts', $args );
}
add_action( 'init', 'sc_posts', 0 );

function er_posts() {
	$labels = array(
		'name'	=> _x( 'Ethical Record', 'Post Type General Name', 'ch' ),
		'singular_name'	   => _x( 'Ethical Record', 'Post Type Singular Name', 'ch' ),
		'menu_name'		   => __( 'Ethical Record', 'ch' ),
		'parent_item_colon'   => __( 'Parent ER Post:', 'ch' ),
		'all_items'		   => __( 'All ER Posts', 'ch' ),
		'view_item'		   => __( 'View ER Post', 'ch' ),
		'add_new_item'		=> __( 'Add New ER Post', 'ch' ),
		'add_new'			 => __( 'Add New', 'ch' ),
		'edit_item'		   => __( 'Edit ER Post', 'ch' ),
		'update_item'		 => __( 'Update ER Post', 'ch' ),
		'search_items'		=> __( 'Search ER Posts', 'ch' ),
		'not_found'		   => __( 'Not found', 'ch' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label'			   => __( 'ethicalrecord', 'ch' ),
		'description'		 => __( 'Ethical Record Posts', 'ch' ),
		'labels'			  => $labels,
		'supports'			=> array( 'title', 'editor', 'post_tag', 'tags', 'thumbnail', 'comments', 'publicize' ),
		'taxonomies'		  => array( 'post_tag', 'tags' ),
		'hierarchical'		=> false,
		'public'			  => true,
		'show_ui'			 => true,
		'show_in_menu'		=> true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'	   => 5,
		'menu_icon'		   => '',
		'can_export'		  => true,
		'has_archive'		 => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'	 => 'page',
	);
	register_post_type( 'ethicalrecord', $args );
}
add_action( 'init', 'er_posts', 0 );

function speaker() {
	$labels = array(
		'name'	=> _x( 'Speakers', 'Post Type General Name', 'ch' ),
		'singular_name'	   => _x( 'Speaker', 'Post Type Singular Name', 'ch' ),
		'menu_name'		   => __( 'Speakers', 'ch' ),
		'parent_item_colon'   => __( 'Parent Speaker:', 'ch' ),
		'all_items'		   => __( 'All Speakers', 'ch' ),
		'view_item'		   => __( 'View Speaker', 'ch' ),
		'add_new_item'		=> __( 'Add New Speaker', 'ch' ),
		'add_new'			 => __( 'Add New', 'ch' ),
		'edit_item'		   => __( 'Edit Speaker', 'ch' ),
		'update_item'		 => __( 'Update Speaker', 'ch' ),
		'search_items'		=> __( 'Search Speakers', 'ch' ),
		'not_found'		   => __( 'Not found', 'ch' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label'			   => __( 'speaker', 'ch' ),
		'description'		 => __( 'Lecture Speakers', 'ch' ),
		'labels'			  => $labels,
		'supports'			=> array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'		  => array(),
		'hierarchical'		=> false,
		'public'			  => true,
		'show_ui'			 => true,
		'show_in_menu'		=> true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'	   => 5,
		'menu_icon'		   => '',
		'can_export'		  => true,
		'has_archive'		 => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'	 => 'page',
	);
	register_post_type( 'speaker', $args );
}
add_action( 'init', 'speaker', 0 );

function issue() {
	$labels = array(
		'name'	=> _x( 'Issues', 'Post Type General Name', 'ch' ),
		'singular_name'	   => _x( 'Issue', 'Post Type Singular Name', 'ch' ),
		'menu_name'		   => __( 'Issues', 'ch' ),
		'parent_item_colon'   => __( 'Parent Issue:', 'ch' ),
		'all_items'		   => __( 'All Issues', 'ch' ),
		'view_item'		   => __( 'View Issue', 'ch' ),
		'add_new_item'		=> __( 'Add New Issue', 'ch' ),
		'add_new'			 => __( 'Add New', 'ch' ),
		'edit_item'		   => __( 'Edit Issue', 'ch' ),
		'update_item'		 => __( 'Update Issue', 'ch' ),
		'search_items'		=> __( 'Search Issues', 'ch' ),
		'not_found'		   => __( 'Not found', 'ch' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ch' ),
	);
	$args = array(
		'label'			   => __( 'issue', 'ch' ),
		'description'		 => __( 'Ethical Record Issue', 'ch' ),
		'labels'			  => $labels,
		'supports'			=> array( 'title', 'editor', 'post_tag', 'tags' , 'publicize'),
		'taxonomies'		  => array( 'post_tag', 'tags' ),
		'hierarchical'		=> false,
		'public'			  => true,
		'show_ui'			 => true,
		'show_in_menu'		=> true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'	   => 5,
		'menu_icon'		   => '',
		'can_export'		  => true,
		'has_archive'		 => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'	 => 'page',
	);
	register_post_type( 'issue', $args );
}
add_action( 'init', 'issue', 0 );

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
			$num_terms	= wp_count_terms( $taxonomy->name );
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

function custom_getarchives_where( $where ){
    remove_filter( 'getarchives_where', 'custom_getarchives_where' );
    $where = str_replace( "post_type = 'post'", "post_type in ( 'post', 'ethicalrecord' )", $where );
    return $where;
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

function be_subpages_load_widgets() {
	register_widget( 'BE_Subpages_Widget' );
}
add_action( 'widgets_init', 'be_subpages_load_widgets' );

/**
 * Subpages Widget Class
 *
 * @author			 Bill Erickson <bill@billerickson.net>
 * @copyright		Copyright (c) 2011, Bill Erickson
 * @license			http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class BE_Subpages_Widget extends WP_Widget {

		/**
		 * Constructor
		 *
		 * @return void
		 **/
	function BE_Subpages_Widget() {
		//load_plugin_textdomain( 'be-subpages', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		$widget_ops = array( 'classname' => 'widget_subpages', 'description' => __( 'Lists current section subpages', 'be-subpages' ) );
		$this->WP_Widget( 'subpages-widget', __( 'Subpages Widget', 'be-subpages' ), $widget_ops );
	}

		/**
		 * Outputs the HTML for this widget.
		 *
		 * @param array, An array of standard parameters for widgets in this theme
		 * @param array, An array of settings for this widget instance
		 * @return void Echoes it's output
		 **/
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		// Only run on hierarchical post types
		$post_types = get_post_types( array( 'hierarchical' => true ) );
		if ( !is_singular( $post_types ) && !apply_filters( 'be_subpages_widget_display_override', false ) )
			return;

		// Find top level parent and create path to it
		global $post;
		$parents = array_reverse( get_ancestors( $post->ID, 'page' ) );
		$parents[] = $post->ID;
		$parents = apply_filters( 'be_subpages_widget_parents', $parents );

		// Build a menu listing top level parent's children
		$args = array(
			'child_of' => $parents[0],
			'parent' => $parents[0],
			'sort_column' => 'menu_order',
			'post_type' => get_post_type(),
		);
		$depth = 1;
		$subpages = get_pages( apply_filters( 'be_subpages_widget_args', $args, $depth ) );

		// If there are pages, display the widget
		if ( empty( $subpages ) )
			return;

		echo $before_widget;

		global $be_subpages_is_first;
		$be_subpages_is_first = true;

		// Build title
		$title = esc_attr( $instance['title'] );
		if( 1 == $instance['title_from_parent'] ) {
			$title = get_the_title( $parents[0] );
			if( 1 == $instance['title_link'] )
				$title = '<a href="' . get_permalink( $parents[0] ) . '">' . apply_filters( 'be_subpages_widget_title', $title ) . '</a>';
		}

		if( !empty( $title ) )
			echo $before_title . $title . $after_title;

		if( !isset( $instance['deep_subpages'] ) )
			$instance['deep_subpages'] = 0;

		if( !isset( $instance['nest_subpages'] ) )
			$instance['nest_subpages'] = 0;

		// Print the tree
		$this->build_subpages( $subpages, $parents, $instance['deep_subpages'], $depth, $instance['nest_subpages'] );

		echo $after_widget;
	}

	/**
	 * Build the Subpages
	 *
	 * @param array $subpages, array of post objects
	 * @param array $parents, array of parent IDs
	 * @param bool $deep_subpages, whether to include current page's subpages
	 * @return string $output
	 */
	function build_subpages( $subpages, $parents, $deep_subpages = 0, $depth = 1, $nest_subpages = 0 ) {
		if( empty( $subpages ) )
			return;

		global $post, $be_subpages_is_first;
		// Build the page listing
		echo '<ul class="menu">';
		foreach ( $subpages as $subpage ) {
			$class = array();

			// Unique Identifier
			$class[] = 'menu-item-' . $subpage->ID;

			// Set special class for current page
			if ( $subpage->ID == $post->ID )
				$class[] = 'widget_subpages_current_page';

			// First menu item
			if( $be_subpages_is_first )
				$class[] .= 'first-menu-item';
			$be_subpages_is_first = false;

			$class = apply_filters( 'be_subpages_widget_class', $class, $subpage );
			$class = !empty( $class ) ? ' class="' . implode( ' ', $class ) . '"' : '';

			echo '<li' . $class . '><a href="' . get_permalink( $subpage->ID ) . '" rel="Permalink" title="Permalink to ' . apply_filters( 'be_subpages_page_title', $subpage->post_title, $subpage ) . '">' . apply_filters( 'be_subpages_page_title', $subpage->post_title, $subpage ) . '</a>';
			// If nesting supress the closing li
			if (!$nest_subpages)
				echo '</li>';

			do_action( 'be_subpages_widget_menu_extra', $subpage, $class );

			// Check if the subpage is in parent tree to go deeper
			if ( $deep_subpages && in_array( $subpage->ID, $parents ) ) {
				$args = array(
					'child_of' => $subpage->ID,
					'parent' => $subpage->ID,
					'sort_column' => 'menu_order',
					'post_type' => get_post_type(),
				);
				$deeper_pages = get_pages( apply_filters( 'be_subpages_widget_args', $args, $depth ) );
				$depth++;
				$this->build_subpages( $deeper_pages, $parents, $deep_subpages, $depth, $nest_subpages );
			}
			// If li was surpressed for nesting echo it now
			if ($nest_subpages)
				echo '</li>';

		}
		echo '</ul>';
	}

	/**
	 * Sanitizes form inputs on save
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array $new_instance
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['title_from_parent'] = (int) $new_instance['title_from_parent'];
		$instance['title_link'] = (int) $new_instance['title_link'];
		$instance['deep_subpages'] = (int) $new_instance['deep_subpages'];
		$instance['nest_subpages'] = (int) $new_instance['nest_subpages'];

		return $instance;
	}

	/**
	 * Build the widget's form
	 *
	 * @param array $instance, An array of settings for this widget instance
	 * @return null
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'title_from_parent' => 0, 'title_link' => 0, 'deep_subpages' => 0, 'nest_subpages' => 0 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'be-subpages' );?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['title_from_parent'], 1 ); ?> id="<?php echo $this->get_field_id( 'title_from_parent' ); ?>" name="<?php echo $this->get_field_name( 'title_from_parent' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'title_from_parent' ); ?>"><?php _e( 'Use top level page as section title.', 'be-subpages' );?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['title_link'], 1 ); ?> id="<?php echo $this->get_field_id( 'title_link' ); ?>" name="<?php echo $this->get_field_name( 'title_link' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'title_link' ); ?>"><?php _e( 'Make title a link', 'be-subpages' ); echo '<br /><em>('; _e( 'only if "use top level page" is checked', 'be-subpages' ); echo ')</em></label>';?>
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['deep_subpages'], 1 ); ?> id="<?php echo $this->get_field_id( 'deep_subpages' ); ?>" name="<?php echo $this->get_field_name( 'deep_subpages' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'deep_subpages' ); ?>"><?php _e( 'Include the current page\'s subpages', 'be-subpages' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['nest_subpages'], 1 ); ?> id="<?php echo $this->get_field_id( 'nest_subpages' ); ?>" name="<?php echo $this->get_field_name( 'nest_subpages' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'nest_subpages' ); ?>"><?php _e( 'Nest sub-page &lt;ul&gt; inside parent &lt;li&gt;', 'be-subpages' ); echo '<br /><em>('; _e( "only if &quot;Include the current page's subpages&quot; is checked", 'be-subpages' ); echo ')</em></label>';?></p>

		<?php
	}
}

function add_menu_icons_styles(){

	echo '<style>
	#adminmenu #menu-posts-carousel div.wp-menu-image:before, #dashboard_right_now .carousel-count a:before {
		content: "\f233";
	}
	#adminmenu #menu-posts-people div.wp-menu-image:before, #dashboard_right_now .people-count a:before {
		content: "\f307";
	}
	#adminmenu #menu-posts-jobs div.wp-menu-image:before, #dashboard_right_now .jobs-count a:before {
		content: "\f484";
	}
	#adminmenu #menu-posts-sunday_concerts div.wp-menu-image:before, #dashboard_right_now .sunday_concerts-count a:before {
		content: "\f127";
	}
	#dashboard_right_now .tribe_events-count a:before {
		content: "\f145";
	}
	#dashboard_right_now .feedback-count a:before {
		content: "\f175";
	}
	#dashboard_right_now .taxonomy-count a:before {
		content: "\f325";
	}
	#adminmenu #menu-posts-pdf div.wp-menu-image:before, #dashboard_right_now .pdf-count a:before {
		content: "\f497";
	}
	#adminmenu #menu-posts-product div.wp-menu-image:before, #dashboard_right_now .product-count a:before {
		content: "\f174";
	}
	#adminmenu #menu-posts-memorial_lecture div.wp-menu-image:before, #dashboard_right_now .memorial_lecture-count a:before {
		content: "\f473";
	}
	#adminmenu #menu-posts-amazon_product div.wp-menu-image:before, #dashboard_right_now .amazon_product-count a:before {
		content: "\f174";
	}
	#adminmenu .menu-icon-speaker div.wp-menu-image:before {
		content: "\f488";
	}
	#adminmenu .menu-icon-issue div.wp-menu-image:before {
		content: "\f331";
	}
	#adminmenu .menu-icon-contacts div.wp-menu-image:before {
		content: "\f336";
	}
	#adminmenu .menu-icon-ethicalrecord div.wp-menu-image:before {
		content: "\f464";
	}
	#dashboard_right_now .speaker-count a:before {
		content: "\f488";
	}
	#dashboard_right_now .issue-count a:before {
		content: "\f331";
	}
	#dashboard_right_now .taxonomy-count a:before {
		content: "\f325";
	}
	#dashboard_right_now .feedback-count a:before {
		content: "\f466";
	}
	#dashboard_right_now .ethicalrecord-count a:before {
		content: "\f464";
	}
	</style>';

}
add_action( 'admin_head', 'add_menu_icons_styles' );

function additional_admin_color_schemes() {
	$theme_dir = get_template_directory_uri();
	wp_admin_css_color( 'er', __( 'Ethical Record' ),
		$theme_dir . '/css/er_admin.css',
		array( '#ebebeb', '#ebf3f4', '#136972', '#ffffff' )
	);
}
add_action('admin_init', 'additional_admin_color_schemes');

function remove_footer_admin () {
	echo '&copy; 1787 - '. date('Y') . ' Conway Hall. Site built by <a href="https://www.prydonian.digital">Mark Duwe</a>.';
	echo '<style>#wp-admin-bar-updates,.update-plugins{display:none !important;}.category-adder {display: none !important;}</style>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

function rdc_add_views_column( $cols ) {
	$cols['pageviews'] = 'Views';
	return $cols;
}
add_filter( 'manage_edit-post_columns', 'rdc_add_views_column' );

function rdc_add_views_colurdc_data( $colname ) {
	global $post;
	if ( 'pageviews' !== $colname )
		return false;
	if ( ! ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'stats' ) ) ) {
		echo 'Error 101';
		return false;
	}
	if ( ! function_exists( 'stats_get_csv' ) ) {
		echo 'Error 102';
		return false;
	}
	$view_count = get_post_meta( $post->ID, '_jetpack_post_views_count', true );
	$view_count_created = absint( get_post_meta( $post->ID, '_jetpack_post_views_count_created', true ) );
	if ( ! $view_count || time() > $view_count_created + 3600 ) {
		$postviews = stats_get_csv( 'postviews', "post_id={$post->ID}" );
		if ( ! $postviews ) {
			echo 'Error 103';
			return false;
		}
		update_post_meta( $post->ID, '_jetpack_post_views_count', absint( $postviews[0]['views'] ) );
		update_post_meta( $post->ID, '_jetpack_post_views_count_created', absint( time() ) );
	}
	echo '<strong>' . number_format( absint( $postviews[0]['views'] ) ) . '</strong>';
}
add_action( 'manage_posts_custom_column', 'rdc_add_views_colurdc_data' );

function my_login_logo() { ?>
		<style type="text/css">
				body.login	{
				background: #fff;
			}
				body.login div#login h1 a {
						background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/header/logo.png);
						padding-bottom: 30px;
				background-position: center top;
				background-repeat: no-repeat;
				background-size: 257px auto;
				height: 99px;
				line-height: 1;
				margin: 0 auto 25px;
				outline: 0 none;
				overflow: hidden;
				padding: 0;
				text-decoration: none;
				text-indent: -9999px;
				width: 257px;
		}
		</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

add_action( 'tribe_eb_after_event_creation', 'my_change_tribe_eventbrite_currency', 10, 4 );

function my_change_tribe_eventbrite_currency( $eventbrite_id, $venue_id, $organizer_id, $post_id ) {
	$currency_acro = 'GBP';
	$parameters = 'id=' . $eventbrite_id . '&currency=' . $currency_acro;
	$success = Event_Tickets_PRO::instance()->sendEventBriteRequest( 'event_update', $parameters, $post_id, true, true, false );
	if ( !$success ) {
		add_filter( 'tribe_eb_error_message', 'my_change_tribe_eventbrite_currency_failed' );
	}
}
function my_change_tribe_eventbrite_currency_failed() {
	return 'Failed to update the currency.';
}

function my_wootickets_tribe_get_cost( $cost, $postId, $withCurrencySymbol ) {
	if ( empty($cost) && class_exists('TribeWooTickets') ) {
			// see if the event has tickets associated with it
		$wootickets = TribeWooTickets::get_instance();
		$ticket_ids = $wootickets->get_Tickets_ids( $postId );
		if ( empty($ticket_ids) ) {
			return '';
		}

		// see if any tickets remain, and what price range they have
		$max_price = 0;
		$min_price = 0;
		$sold_out = TRUE;
		foreach ( $ticket_ids as $ticket_id ) {
			$ticket = $wootickets->get_ticket($postId, $ticket_id);
			if ( $ticket->stock ) {
				$sold_out = FALSE;
				$price = $ticket->price;
				if ( $price > $max_price ) {
					$max_price = $price;
				}
				if ( empty($min_price) || $price < $min_price ) {
					$min_price = $price;
				}
			}
		}
		if ( $sold_out ) { // all of the tickets are sold out
			return __('Sold Out');
		}
		if ( empty($price) ) { // none of the tickets costs anything
			return __('Free');
		}

		// make a string showing the price (or range, if applicable)
		$currency = tribe_get_option( 'defaultCurrencySymbol', '£' );
		if ( empty($min_price) || $min_price == $max_price ) {
			return $currency . $max_price;
		}
		return $currency . $min_price . ' - ' . $currency . $max_price;
	}
	return $cost; // return the default, if nothing above returned
}
add_filter( 'tribe_get_cost', 'my_wootickets_tribe_get_cost', 10, 3 );

function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches[1][0];
	if(empty($first_img)) {
		$first_img = get_template_directory_uri() . '/img/ConwayHall.jpg';
	}
	return $first_img;
}
function tribe_get_event_website_button( $event = null, $label = 'Book Now' ) {
	$url = tribe_get_event_website_url( $event );
	if ( ! empty( $url ) ) {
		$label = is_null( $label ) ? $url : $label;
		$html  = sprintf(
			'<a href="%s" target="_blank">%s</a>',
			$url,
			'Book Now'
		);
	} else {
		$html = '';
	}
	return apply_filters( 'tribe_get_event_website_button', $html );
}

function custom_widget_featured_image() {
	global $post;
	echo tribe_event_featured_image( $post->ID, 'calendar' );
}
add_action( 'tribe_events_list_widget_before_the_event_title', 'custom_widget_featured_image' );

add_filter('wp_list_categories', 'add_slug_css_list_categories');
function add_slug_css_list_categories($list) {

$cats = get_categories(array('taxonomy' => 'taxonomy'));
	foreach($cats as $cat) {
	$find = 'cat-item-' . $cat->term_id . '"';
	$replace = 'category-' . $cat->slug . '"';
	$list = str_replace( $find, $replace, $list );
	$find = 'cat-item-' . $cat->term_id . ' ';
	$replace = 'category-' . $cat->slug . ' ';
	$list = str_replace( $find, $replace, $list );
	}

return $list;
}
add_action( 'save_post_tribe_events', 'force_cost_update' );

function force_cost_update( $event_id ) {
   TribeEventsAPI::update_event_cost( $event_id );
}

class TicketingCostConflict {
	static $original_cost;

	static function resolve() {
		add_filter( 'tribe_get_cost', array( __CLASS__, 'store_pre_eb' ), 5 );
		add_filter( 'tribe_get_cost', array( __CLASS__, 'maybe_undo_eb_change' ), 50, 2 );
	}

	static function store_pre_eb( $cost ) {
		self::$original_cost = $cost;
	}

	static function maybe_undo_eb_change( $cost, $event_id ) {
		if ( ! class_exists( 'Event_Tickets_PRO' ) ) return $cost;
		if ( Event_Tickets_PRO::instance()->getEventId( $event_id ) ) return $cost;
		return self::$original_cost;
	}
}

TicketingCostConflict::resolve();

function theme_options_panel(){
  add_menu_page('Conway Hall', 'Conway Hall', 'manage_options', 'conway-hall-admin', 'conway_hall_admin', 'dashicons-shield', 30);
  add_submenu_page( 'conway-hall-admin', 'Email Signature Generator', 'Email Signature', 'manage_options', 'email-signature', 'ch_email');
  add_submenu_page( 'conway-hall-admin', 'Secure Password Generator', 'Password Generator', 'manage_options', 'password-generator', 'ch_password');
}
add_action('admin_menu', 'theme_options_panel');

function conway_hall_admin(){
	echo '<div class="wrap">
		<h2><i class="dashicons dashicons-shield"></i> Conway Hall Admin</h2>
		<p>You can generate your email signature or a secure password from here.</p>
		<p><i class="dashicons dashicons-email-alt"></i> <a href="/wp-admin/admin.php?page=email-signature">Generate an email signature</a></p>
		<p><i class="dashicons dashicons-admin-network"></i> <a href="/wp-admin/admin.php?page=password-generator">Generate a secure password</a></p>
	</div>';
}
function ch_email(){
	include(get_template_directory().'/email-signature.php');
}
function ch_password(){
	include(get_template_directory().'/password-generator.php');
}

@ini_set( 'upload_max_size' , '32M' );
@ini_set( 'post_max_size', '32M');
@ini_set( 'max_execution_time', '300' );
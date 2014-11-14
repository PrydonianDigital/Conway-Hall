<?php

function conway_hall_init()  {
	remove_action( 'wp_head', 'wp_generator' );
	show_admin_bar( false );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 700, 394, true );
	add_image_size( 'featured', 700, 394, true );
	add_image_size( 'full', 1000, 563, true );
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
	wp_register_script( 'gmap', '//maps.googleapis.com/maps/api/js?sensor=false&region=GB', false, '6.0.0', true );
	wp_register_script( 'gmap3', get_template_directory_uri() . '/js/gmap3.js', false, '6.0.0', true );
	wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', false, '2.6', true );
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
	'name' => __( 'Main Sidebar', 'ch' ),
	'description' => __( '', 'ch' ),
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

function be_subpages_load_widgets() {
	register_widget( 'BE_Subpages_Widget' );
}
add_action( 'widgets_init', 'be_subpages_load_widgets' );

/**
 * Subpages Widget Class
 *
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
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
	#dashboard_right_now .tribe_events-count a:before {
	    content: "\f145";
	}
	#dashboard_right_now .feedback-count a:before {
	    content: "\f175";
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


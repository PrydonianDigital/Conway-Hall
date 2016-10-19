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
	//wp_register_script( 'planittooltip', get_template_directory_uri() . '/planit/global/js/jquery.tooltip.js', false, '2.6', true );
	//wp_register_script( 'planitcarousel', get_template_directory_uri() . '/planit/global/js/jquery.jcarousel.min.js', false, '2.6', true );
	//wp_register_script( 'planitswf', get_template_directory_uri() . '/planit/global/js/swfobject.js', false, '2.6', true );
	//wp_register_script( 'planitflash', get_template_directory_uri() . '/planit/global/js/flash-detection.js', false, '2.6', true );
	//wp_register_script( 'planittour', get_template_directory_uri() . '/planit/global/tour.js', false, '2.6', true );
	//wp_register_script( 'planitfancybox', get_template_directory_uri() . '/planit/global/lightwindow/jquery.fancybox.js', false, '2.6', true );
	//wp_register_script( 'planitprint', get_template_directory_uri() . '/planit/global/js/jquery.printarea.js', false, '2.6', true );
	//wp_register_script( 'planit', get_template_directory_uri() . '/planit/global/js/jquery.planit.js', false, '2.6', true );
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
	wp_register_style( 'planit', get_template_directory_uri() . '/planit/global/css/style.css', false, '2.6' );
	wp_register_style( 'planitskin', get_template_directory_uri() . '/planit/global/css/skin.css', false, '2.6' );
	wp_register_style( 'planitfancyboxcss', get_template_directory_uri() . '/planit/global/lightwindow/jquery.fancybox.css', false, '2.6' );
	wp_register_style( 'planitprint', get_template_directory_uri() . '/planit/global/css/print.css', false, '2.6', 'print' );
	wp_enqueue_style( 'normalise' );
	wp_enqueue_style( 'owl' );
	wp_enqueue_style( 'theme' );
	wp_enqueue_style( 'base' );
}
add_action( 'wp_enqueue_scripts', 'ch_styles' );

function room_planner() {
	wp_register_script( 'planit', get_template_directory_uri() . '/planit/global/js/jquery.planit.js', false, '4', true );
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

function my_post_queries( $query ) {

	if(is_tax()){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', 25);
    }
  }
add_action( 'pre_get_posts', 'my_post_queries' );

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
<?php

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

function events_calendar_remove_scripts() {
if (!is_admin() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {

        wp_dequeue_script( 'the-events-calendar');
        wp_dequeue_script( 'tribe-events-list');
        wp_dequeue_script( 'tribe-events-ajax-day');

}}
add_action('wp_print_scripts', 'events_calendar_remove_scripts' , 10);
add_action('wp_footer', 'events_calendar_remove_scripts' , 10);
<?php
/**
 * SDK Admin Assets
 *
 * @package Plugins/Site/Events/Admin/Assets
 */
namespace Sugar_Calendar\AddOn\SDK\Admin\Assets;

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

use Sugar_Calendar\AddOn\SDK\Plugin as Plugin;
use Sugar_Calendar\AddOn\SDK\Common\Assets as Assets;

/**
 * Register assets.
 *
 * @since 1.0.1
 */
function register() {

	// Get necessary asset vars
	$pre  = Plugin::instance()->prefix;
	$url  = Assets\get_url() . 'sc-addon-sdk/includes/admin/assets/';
	$ver  = Assets\get_version();
	$path = Assets\get_css_path();
	$deps = array();

	/** Scripts ***************************************************************/

	// Admin
	wp_register_script( $pre . '_admin_general', "{$url}js/general.js", $deps, $ver, false );

	/** Styles ****************************************************************/

	// General
	wp_register_style( $pre . '_admin_general', "{$url}css/{$path}general.css", $deps, $ver, 'all' );
}

/**
 * Enqueue assets.
 *
 * @since 2.0.0
 */
function enqueue() {

	// Get the prefix
	$pre = Plugin::instance()->prefix;

	// General
	wp_enqueue_script( $pre . '_admin_general' );
	wp_enqueue_style( $pre . '_admin_general' );

	// Settings Pages
	if ( \Sugar_Calendar\Admin\Settings\in() ) {

		// Settings
		wp_enqueue_script( $pre . '_admin_settings' );
		wp_enqueue_style( $pre . '_admin_settings' );
	}

	// Events Pages
	if ( sugar_calendar_admin_is_events_page() ) {

		// Events
		wp_enqueue_script( $pre . '_admin_events' );
		wp_enqueue_style( $pre . '_admin_events' );
	}
}

/**
 * Localize scripts
 *
 * @since 2.0.0
 */
function localize() {

	// Get the prefix
	$pre = Plugin::instance()->prefix;

	// General
	wp_localize_script( $pre . '_admin_general', $pre . '_vars', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	) );
}

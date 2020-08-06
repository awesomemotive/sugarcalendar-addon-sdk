<?php
/**
 * SDK Admin Assets
 *
 * @package Plugins/Site/Events/Admin/Assets
 */
namespace SC_Addon_SDK\Admin\Assets;

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

use SC_Addon_SDK\Plugin;

/**
 * Register assets.
 *
 * @since 1.0.1
 */
function register() {

	// Get version &  prefix
	$ver  = Plugin::instance()->version;
	$pre  = Plugin::instance()->prefix;

	// URL & Dependencies
	$url  = constant( strtoupper( $pre ) . '_PLUGIN_URL' ) . 'includes/admin/assets/';
	$deps = array();

	// Suffixes
	$debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;

	// Default CSS path
	$css_path = '';

	// Minify?
	if ( empty( $debug ) ) {
		$css_path = trailingslashit( 'min' );
	}

	// Right-to-Left?
	if ( is_rtl() ) {
		$css_path .= 'rtl';
	} else {
		$css_path .= 'ltr';
	}

	// Maybe add a trailing slash
	if ( ! empty( $css_path ) ) {
		$css_path = trailingslashit( $css_path );
	}

	/** Scripts ***************************************************************/

	// Admin
	wp_register_script( $pre . '_admin_general', "{$url}js/sc-admin.js", $deps, $ver, false );

	/** Styles ****************************************************************/

	// General
	wp_register_style( $pre . '_admin_general', "{$url}css/{$css_path}general.css", $deps, $ver, 'all' );
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

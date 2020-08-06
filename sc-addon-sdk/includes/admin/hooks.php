<?php
/**
 * SDK Admin Hooks
 *
 * @package Plugins/Site/Events/Admin/Hooks
 */
namespace SC_Addon_SDK\Admin;

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Admin assets
add_action( 'admin_init', __NAMESPACE__ . '\\Assets\\register' );

// Admin Scripts
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\Assets\\enqueue' );
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\Assets\\enqueue' );
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\Assets\\localize' );

// Hooks
add_action( 'init',                                         __NAMESPACE__ . '\\Meta\\register_meta' );
add_action( 'sugar_calendar_admin_meta_box_setup_sections', __NAMESPACE__ . '\\Meta\\add_section' );
add_filter( 'sugar_calendar_event_to_save',                 __NAMESPACE__ . '\\Meta\\save' );

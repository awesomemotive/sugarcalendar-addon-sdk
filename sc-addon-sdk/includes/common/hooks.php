<?php
/**
 * SDK Hooks
 *
 * @package Plugins/Site/Events/Hooks
 */
namespace Sugar_Calendar\AddOn\SDK;

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Meta
add_action( 'init', __NAMESPACE__ . '\\Meta\\register_meta' );

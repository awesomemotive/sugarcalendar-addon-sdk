<?php
/**
 * SDK Meta
 *
 * @package Plugins/Site/Events/Meta
 */
namespace SC_Addon_SDK\Meta;

/**
 * Register the meta keys and values.
 *
 * This means you don't need to sanitize these values yourself later!
 *
 * @since 1.0.1
 */
function register_meta() {

	\register_meta( 'sc_event', 'a-new-thing', array(
		'type'              => 'string',
		'description'       => '',
		'single'            => true,
		'sanitize_callback' => 'sanitize_text_field',
		'auth_callback'     => null,
		'show_in_rest'      => true
	) );

	\register_meta( 'sc_event', 'another-thing', array(
		'type'              => 'string',
		'description'       => '',
		'single'            => true,
		'sanitize_callback' => 'sanitize_text_field',
		'auth_callback'     => null,
		'show_in_rest'      => true
	) );
}

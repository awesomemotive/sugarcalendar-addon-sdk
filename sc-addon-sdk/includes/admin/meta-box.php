<?php
/**
 * SDK Admin Hooks
 *
 * @package Plugins/Site/Events/Admin/Hooks
 */
namespace SC_Addon_SDK\Admin\Meta;

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Hook this in to add the section.
 *
 * @since 1.0.1
 */
function add_section( $box = false ) {

	// Bail if box is empty
	if ( empty( $box ) ) {
		return;
	}

	// Exceptions
	$box->add_section( array(
		'id'       => 'sdk',
		'label'    => 'SDK',
		'icon'     => 'editor-code',
		'order'    => 22, // Experiment with this
		'callback' => __NAMESPACE__ . '\\box_contents'
	) );
}

/**
 * This contains the HTML.
 *
 * @since 1.0.1
 */
function box_contents( $event ) {

	// Get the meta
	$a_thing       = get_event_meta( $event->id, 'a-new-thing',   true );
	$another_thing = get_event_meta( $event->id, 'another-thing', true ); ?>

	<table class="form-table rowfat">
		<tbody>
			<tr>
				<th>
					<label for="a-new-thing">
						<?php esc_html_e( 'A thing', 'sc-addon-sdk' ); ?>
					</label>
				</th>

				<td>
					<input type="text" name="a-new-thing" id="a-new-thing" value="<?php echo esc_attr( $a_thing ); ?>" />
				</td>
			</tr>

			<tr>
				<th>
					<label for="another-thing">
						<?php esc_html_e( 'Another thing', 'sc-addon-sdk' ); ?>
					</label>
				</th>

				<td>
					<input type="text" name="another-thing" id="another-thing" value="<?php echo esc_attr( $another_thing ); ?>" />
				</td>
			</tr>
		</tbody>
	</table>

<?php
}

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

/**
 * Filter the event properties to be saved from a meta-box.
 *
 * Note: nonces and screen are already checked at this time, and you do not need
 * to sanitize your values here, as they get automatically sanitized before they
 * are saved because you registered your metadata earlier! Neat right?
 *
 * @since 1.0.1
 *
 * @param array $to_save
 * @return array
 */
function save( $to_save = array() ) {

	// A thing (do not sanitize here)
	$a_thing = ! empty( $_POST['a-new-thing'] )
		? $_POST['a-new-thing']
		: '';

	// Another thing (do not sanitize here)
	$another_thing = ! empty( $_POST['another-thing'] )
		? $_POST['another-thing']
		: '';

	// New data to merge with event data below
	$new = array(

		// These keys must match your registered meta keys above
		'a-new-thing'   => $a_thing,
		'another-thing' => $another_thing
	);

	// Merge the Event array with this custom one
	$retval = array_merge( $to_save, $new );

	// Return the array
	return $retval;
}

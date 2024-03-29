<?php
/**
 * Plugin Name:       Sugar Calendar - Addon SDK
 * Plugin URI:        https://sugarcalendar.com/downloads/addon-sdk
 * Description:       A Software Development Kit for Sugar Calendar Addons
 * Author:            Sandhills Development, LLC
 * Author URI:        https://sandhillsdev.com
 * License:           GNU General Public License v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sc-addon-sdk
 * Domain Path:       /sc-addon-sdk/includes/languages/
 * Requires PHP:      7.0.0
 * Requires at least: 5.7
 * Version:           0.1.0
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Hey there! If you're reading this, you've decided to use this Software
 * Development Kit rather than repeat yourself for the millionth time.
 *
 * All you need to do is follow the steps below, then code away as usual.
 *
 * 0. Fill out plugin header info above
 * 1. Replace "SC_Addon_SDK" with your unique PHP prefix and namespace
 * 2. Replace "'sc-addon-sdk'" with your unique plugin directory & text domain
 * 3. Replace strings and URLs in this file for your application
 * 4. Check the $requirements array and versions for your application
 * 5. Check the "Requires" headers above to make sure they match
 * 6. Check the assets in the "front-end" and "admin" directories
 * 7. Delete this documentation block
 * 8. Start coding!
 */

/**
 * This class_exists() check avoids fatal errors when this plugin is activated
 * in more than one way, and should not be removed.
 */
if ( ! class_exists( 'SC_Addon_SDK_Requirements_Check' ) ) :

/**
 * The main plugin requirements checker
 *
 * @since 1.0.0
 */
final class SC_Addon_SDK_Requirements_Check {

	/**
	 * Plugin file
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private $file = '';

	/**
	 * Plugin basename
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private $base = '';

	/**
	 * Plugin main class name
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private $main_class = 'Sugar_Calendar\\AddOn\\SDK\\Plugin';

	/**
	 * Public URI linking users to learn more about plugin requirements
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private $url = 'https://docs.sugarcalendar.com/category/2162-add-ons';

	/**
	 * Requirements array
	 *
	 * The minimum version numbers denoted here will be adjusted as needed.
	 *
	 * @var array
	 * @since 1.0.0
	 */
	private $requirements = array(

		// PHP
		'php' => array(
			'minimum' => '7.0.0',
			'name'    => 'PHP',
			'exists'  => true,
			'current' => false,
			'checked' => false,
			'met'     => false
		),

		// WordPress
		'wp' => array(
			'minimum' => '5.7.0',
			'name'    => 'WordPress',
			'exists'  => true,
			'current' => false,
			'checked' => false,
			'met'     => false
		),

		// Sugar Calendar
		'sc' => array(
			'minimum' => '2.1.10',
			'name'    => 'Sugar Calendar',
			'exists'  => false,
			'current' => false,
			'checked' => false,
			'met'     => false
		)
	);

	/** Links & Styles ********************************************************/

	/**
	 * Plugin specific URL for an external requirements page.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	private function unmet_requirements_url() {
		return $this->url;
	}

	/**
	 * Plugin specific string used in CSS to identify attribute IDs and classes.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	private function unmet_requirements_name() {

		// Underscores are not valid
		$hyphens = str_replace( '_', '-', __CLASS__ );

		// Lowercase is the standard
		$retval  = strtolower( $hyphens );

		// Return class name
		return $retval;
	}

	/** Strings ***************************************************************/

	/**
	 * Plugin specific text to quickly explain what's wrong.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	private function unmet_requirements_text() {
		esc_html_e( 'This plugin is not fully active.', 'sc-addon-sdk' );
	}

	/**
	 * Plugin specific text to describe a single unmet requirement.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	private function unmet_requirements_description_text() {
		return esc_html__( 'Requires %s (%s), but (%s) is installed.', 'sc-addon-sdk' );
	}

	/**
	 * Plugin specific text to describe a single missing requirement.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	private function unmet_requirements_missing_text() {
		return esc_html__( 'Requires %s (%s), but it appears to be missing.', 'sc-addon-sdk' );
	}

	/**
	 * Plugin specific text used to link to an external requirements page.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	private function unmet_requirements_link() {
		return esc_html__( 'Requirements', 'sc-addon-sdk' );
	}

	/**
	 * Plugin specific aria label text to describe the requirements link.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	private function unmet_requirements_label() {
		return esc_html__( 'Sugar Calendar Requirements', 'sc-addon-sdk' );
	}

	/**
	 * Plugin specific text-domain loader.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'sc-addon-sdk' );
	}

	/**
	 * Check if requirements are met, then load plugin or quit.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function load_plugin() {
		$this->met()
			? $this->load()
			: $this->quit();
	}

	/** Load ******************************************************************/

	/**
	 * Setup plugin requirements
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Setup file & base
		$this->file = __FILE__;
		$this->base = plugin_basename( $this->file );

		// Always load translations
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		// Always (try to) load the plugin
		add_action( 'plugins_loaded', array( $this, 'load_plugin' ) );
	}

	/**
	 * Quit without loading
	 *
	 * @since 1.0.0
	 */
	private function quit() {
		add_action( 'admin_head',                        array( $this, 'admin_head'        ) );
		add_filter( "plugin_action_links_{$this->base}", array( $this, 'plugin_row_links'  ) );
		add_action( "after_plugin_row_{$this->base}",    array( $this, 'plugin_row_notice' ) );
	}

	/** Specific Methods ******************************************************/

	/**
	 * Load normally
	 *
	 * @since 1.0.0
	 */
	private function load() {

		// Maybe include the bundled bootstrapper
		if ( ! class_exists( $this->main_class ) ) {
			require_once dirname( $this->file ) . '/sc-addon-sdk/sc-addon-sdk.php';
		}

		// Maybe hook-in the bootstrapper
		if ( ! class_exists( $this->main_class ) ) {
			return;
		}

		// Bootstrap to plugins_loaded (priority 40, so dependencies are loaded)
		add_action( 'plugins_loaded', array( $this, 'bootstrap' ), 40 );

		// Register the activation hook
		register_activation_hook( $this->file, array( $this, 'activate' ) );

		// Register the deactivation hook
		register_deactivation_hook( $this->file, array( $this, 'deactivate' ) );
	}

	/**
	 * Activate, usually on an activation hook.
	 *
	 * @since 1.0.0
	 */
	public function activate() {

		// Bootstrap to include all of the necessary files
		$this->bootstrap();

		// Installer
		call_user_func( array( $this->main_class, 'activate' ) );
	}

	/**
	 * Deactivate, usually on a deactivation hook.
	 *
	 * @since 1.0.0
	 */
	public function deactivate() {

		// Bootstrap to include all of the necessary files
		$this->bootstrap();

		// Uninstaller
		call_user_func( array( $this->main_class, 'deactivate' ) );
	}

	/**
	 * Bootstrap everything.
	 *
	 * @since 1.0.0
	 */
	public function bootstrap() {
		call_user_func( array( $this->main_class, 'instance' ), $this->file );
	}

	/** Multisite *************************************************************/

	/**
	 * Is plugin activation network wide?
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	private function is_network_wide() {
		return ! empty( $_GET['networkwide'] )
			? (bool) $_GET['networkwide']
			: false;
	}

	/** Helpers ***************************************************************/

	/**
	 * Helper method to re-determine if WordPress 5.5 is showing the auto-update
	 * column in the Plugins list table.
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	private function showing_auto_updates() {

		// Bail if auto updates do not exist
		if ( ! function_exists( 'wp_is_auto_update_enabled_for_type' ) ) {
			return false;
		}

		// Bail if not enabled
		if ( ! wp_is_auto_update_enabled_for_type( 'plugin' ) ) {
			return false;
		}

		// Bail if current user cannot update plugins
		if ( ! current_user_can( 'update_plugins' ) ) {
			return false;
		}

		// Bail if in blog admin
		if ( is_multisite() && is_blog_admin() ) {
			return false;
		}

		// Allowed auto-update statuses
		$allowed_statuses = array(
			'all',
			'active',
			'inactive',
			'recently_activated',
			'upgrade',
			'search',
			'paused',
			'auto-update-enabled',
			'auto-update-disabled'
		);

		// Status
		$status = ! empty( $_REQUEST['plugin_status'] )
			? sanitize_key( $_REQUEST['plugin_status'] )
			: 'all';

		// Is status allowed?
		$allowed = in_array( $status, $allowed_statuses, true );

		// Return if allowed
		return $allowed;
	}

	/**
	 * How many columns should the description column span?
	 *
	 * For plugin_row_notice()
	 *
	 * @since 1.0.0
	 */
	private function description_colspan() {
		return $this->showing_auto_updates()
			? 2
			: 1;
	}

	/** Agnostic Methods ******************************************************/

	/**
	 * Plugin agnostic method to output the additional plugin row
	 *
	 * @since 1.0.0
	 */
	public function plugin_row_notice() {
		?><tr class="active <?php echo esc_attr( $this->unmet_requirements_name() ); ?>-row">
		<th class="check-column">
			<span class="dashicons dashicons-warning"></span>
		</th>
		<td class="column-primary">
			<?php $this->unmet_requirements_text(); ?>
		</td>
		<td class="column-description" colspan="<?php echo absint( $this->description_colspan() ); ?>">
			<?php $this->unmet_requirements_description(); ?>
		</td>
		</tr><?php
	}

	/**
	 * Plugin agnostic method used to output all unmet requirement information
	 *
	 * @since 1.0.0
	 */
	private function unmet_requirements_description() {
		foreach ( $this->requirements as $properties ) {
			if ( empty( $properties['met'] ) ) {
				$this->unmet_requirement_description( $properties );
			}
		}
	}

	/**
	 * Plugin agnostic method to output specific unmet requirement information
	 *
	 * @since 1.0.0
	 * @param array $requirement
	 */
	private function unmet_requirement_description( $requirement = array() ) {

		// Requirement exists, but is out of date
		if ( ! empty( $requirement['exists'] ) ) {
			$text = sprintf(
				$this->unmet_requirements_description_text(),
				'<strong>' . esc_html( $requirement['name']    ) . '</strong>',
				'<strong>' . esc_html( $requirement['minimum'] ) . '</strong>',
				'<strong>' . esc_html( $requirement['current'] ) . '</strong>'
			);

		// Requirement could not be found
		} else {
			$text = sprintf(
				$this->unmet_requirements_missing_text(),
				'<strong>' . esc_html( $requirement['name']    ) . '</strong>',
				'<strong>' . esc_html( $requirement['minimum'] ) . '</strong>'
			);
		}

		// Output the description (unescaped, contains HTML)
		echo wpautop( $text );
	}

	/**
	 * Plugin agnostic method to output unmet requirements styling
	 *
	 * @since 1.0.0
	 */
	public function admin_head() {

		// Get the requirements row name
		$name = $this->unmet_requirements_name(); ?>

		<style id="<?php echo esc_attr( $name ); ?>">
			.plugins tr[data-plugin="<?php echo esc_html( $this->base ); ?>"] th,
			.plugins tr[data-plugin="<?php echo esc_html( $this->base ); ?>"] td,
			.plugins .<?php echo esc_html( $name ); ?>-row th,
			.plugins .<?php echo esc_html( $name ); ?>-row td {
				background: #fff5f5;
			}
			.plugins tr[data-plugin="<?php echo esc_html( $this->base ); ?>"] th {
				box-shadow: none;
			}
			.plugins .<?php echo esc_html( $name ); ?>-row th span {
				margin-left: 6px;
				color: #dc3232;
			}
			.plugins tr[data-plugin="<?php echo esc_html( $this->base ); ?>"] th,
			.plugins .<?php echo esc_html( $name ); ?>-row th.check-column {
				border-left: 4px solid #dc3232 !important;
			}
			.plugins .<?php echo esc_html( $name ); ?>-row .column-description p {
				margin: 0;
				padding: 0;
			}
			.plugins .<?php echo esc_html( $name ); ?>-row .column-description p:not(:last-of-type) {
				margin-bottom: 8px;
			}
		</style>
		<?php
	}

	/**
	 * Plugin agnostic method to add the "Requirements" link to row actions
	 *
	 * @since 1.0.0
	 * @param array $links
	 * @return array
	 */
	public function plugin_row_links( $links = array() ) {

		// Add the Requirements link
		$links['requirements'] =
			'<a href="' . esc_url( $this->unmet_requirements_url() ) . '" aria-label="' . esc_attr( $this->unmet_requirements_label() ) . '">'
			. esc_html( $this->unmet_requirements_link() )
			. '</a>';

		// Return links with Requirements link
		return $links;
	}

	/** Checkers **************************************************************/

	/**
	 * Plugin specific requirements checker
	 *
	 * @since 1.0.0
	 */
	private function check() {

		// Loop through requirements
		foreach ( $this->requirements as $dependency => $properties ) {

			// Which dependency are we checking?
			switch ( $dependency ) {

				// PHP
				case 'php' :
					$version = phpversion();
					$met     = is_php_version_compatible( $properties['minimum'] );
					break;

				// WP
				case 'wp' :
					$version = get_bloginfo( 'version' );
					$met     = is_wp_version_compatible( $properties['minimum'] );
					break;

				// Sugar Calendar
				case 'sc' :
					$version = defined( 'SC_PLUGIN_VERSION' )
						? SC_PLUGIN_VERSION
						: false;
					$met     = version_compare( $version, $properties['minimum'], '>=' );
					break;

				/**
				 * Insert your own requirements checks here as needed for any
				 * plugin or theme code that this plugin will depend on, then
				 * delete this paragraph.
				 */

				// Unknown
				default :
					$version = false;
					$met     = false;
					break;
			}

			// Merge to original array
			if ( ! empty( $version ) ) {
				$this->requirements[ $dependency ] = array_merge( $this->requirements[ $dependency ], array(
					'checked' => true,
					'current' => $version,
					'met'     => $met
				) );
			}
		}
	}

	/**
	 * Have all requirements been met?
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	public function met() {

		// Run the check
		$this->check();

		// Default to true (any false below wins)
		$retval  = true;
		$to_meet = wp_list_pluck( $this->requirements, 'met' );

		// Look for unmet dependencies, and exit if so
		foreach ( $to_meet as $met ) {
			if ( empty( $met ) ) {
				$retval = false;
				continue;
			}
		}

		// Return
		return $retval;
	}
}

// Invoke the checker
new SC_Addon_SDK_Requirements_Check();

endif;

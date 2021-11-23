<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.cedcommerce.com
 * @since             1.0.0
 * @package           Woo_Soldbadge
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce SoldBadge
 * Plugin URI:        https://www.cedcommerce.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Faiq Masood
 * Author URI:        https://www.cedcommerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-soldbadge
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOO_SOLDBADGE_VERSION', '1.0.0' );

/**
* Check for the existence of WooCommerce and any other requirements
*/
function woosold_check_woo_requirements() {
	include_once(ABSPATH.'wp-admin/includes/plugin.php');
    if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        return true;
    } else {
        add_action( 'admin_notices', 'woosold_missing_wc_notice' );
        return false;
    }
}

/**
* Display a message advising WooCommerce is required
*/
function woosold_missing_wc_notice() { 
    $class = 'notice notice-error';
    $message = 'WooCommerce Sold Badge Plugin requires WooCommerce to be installed.';
    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-soldbadge-activator.php
 */
function activate_woo_soldbadge() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-soldbadge-activator.php';
	Woo_Soldbadge_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-soldbadge-deactivator.php
 */
function deactivate_woo_soldbadge() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-soldbadge-deactivator.php';
	Woo_Soldbadge_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_soldbadge' );
register_deactivation_hook( __FILE__, 'deactivate_woo_soldbadge' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-soldbadge.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_soldbadge() {
	if (woosold_check_woo_requirements()) {
		$plugin = new Woo_Soldbadge();
		$plugin->run();
	}	

}
run_woo_soldbadge();

<?php
/**
 * @link              http://www.netagence.com/
 * @since             1.0.0
 * @package           Wpati_xiti
 *
 * @wordpress-plugin
 * Plugin Name:       WPATI_Xiti
 * Plugin URI:        http://www.netagence.com/
 * Description:       WPATI_Xiti permet le marquage automatique des pages de WordPress avec le code de suivi AT Internet.
 * Version:           1.0.0
 * Author:            Pierre Mobian
 * Author URI:        http://www.netagence.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpati_xiti
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpati_xiti-activator.php
 */
function activate_wpati_xiti() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpati_xiti-activator.php';
	Wpati_xiti_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpati_xiti-deactivator.php
 */
function deactivate_wpati_xiti() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpati_xiti-deactivator.php';
	Wpati_xiti_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpati_xiti' );
register_deactivation_hook( __FILE__, 'deactivate_wpati_xiti' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpati_xiti.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpati_xiti() {
	$plugin = new Wpati_xiti();
	$plugin->run();
}

run_wpati_xiti();
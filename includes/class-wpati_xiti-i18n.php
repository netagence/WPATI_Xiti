<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.netagence.com/
 * @since      1.0.0
 *
 * @package    Wpati_xiti
 * @subpackage Wpati_xiti/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wpati_xiti
 * @subpackage Wpati_xiti/includes
 * @author     Pierre Mobian <pmobian@netagence.com>
 */
class Wpati_xiti_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'wpati_xiti',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

}

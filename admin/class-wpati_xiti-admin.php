<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpati_xiti
 * @subpackage Wpati_xiti/admin
 * @author     Pierre Mobian <pmobian@netagence.com>
 */
class Wpati_xiti_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since    1.0.0
	 * @access    private
	 * @var    string $option_name Option name of this plugin
	 */
	private $option_name = 'wpati_xiti';

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpati_xiti_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpati_xiti_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpati_xiti-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpati_xiti_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpati_xiti_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpati_xiti-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'WPATI_Xiti Settings', 'wpati_xiti' ),
			__( 'WPATI_Xiti', 'wpati_xiti' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/wpati_xiti-admin-display.php';
	}

	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'wpati_xiti' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		add_settings_field(
			$this->option_name . '_account',
			__( 'Account number', 'wpati_xiti' ),
			array( $this, $this->option_name . '_account_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_account' )
		);

		add_settings_field(
			$this->option_name . '_is_secure',
			__( 'Use secure tracking?', 'wpati_xiti' ),
			array( $this, $this->option_name . '_is_secure_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_is_secure' )
		);

		add_settings_field(
			$this->option_name . '_hide_for_logged',
			__( 'Do not log connected users?', 'wpati_xiti' ),
			array( $this, $this->option_name . '_hide_for_logged_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_hide_for_logged' )
		);

		register_setting( $this->plugin_name, $this->option_name . '_account', array(
			$this,
			$this->option_name . '_sanitize_account'
		) );

		register_setting( $this->plugin_name, $this->option_name . '_is_secure', array(
			$this,
			$this->option_name . '_sanitize_is_secure'
		) );

		register_setting( $this->plugin_name, $this->option_name . '_hide_for_logged', array(
			$this,
			$this->option_name . '_sanitize_hide_for_logged'
		) );
	}

	/**
	 * Applied to the list of links to display on the plugins page (beside the activate/deactivate links).
	 *
	 * @since  1.0.0
	 */
	public function add_action_links( $links ) {
		$mylinks = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __( 'Settings' ) . '</a>',
		);

		return array_merge( $links, $mylinks );
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function wpati_xiti_general_cb() {
		echo '<p>' . __( 'Enter your infos and preferences here', 'wpati_xiti' ) . '</p>';
		echo '<p>' . __( 'You may get your account ID and details in your <a href="https://apps.atinternet-solutions.com/">AT Internet account</a>', 'wpati_xiti' ) . '</p>';
	}

	/**
	 * Render the radio input field for account option
	 *
	 * @since  1.0.0
	 */
	public function wpati_xiti_account_cb() {
		$account = get_option( $this->option_name . '_account' );

		echo '<input type="text" name="' . $this->option_name . '_account' . '" id="' . $this->option_name . '_account' . '" value="' . esc_attr( $account ) . '">';
	}

	/**
	 * Render the treshold is_secure input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function wpati_xiti_is_secure_cb() {
		$is_secure = get_option( $this->option_name . '_is_secure', 1 );

		?>
		<input type="checkbox" name="<?php echo $this->option_name . '_is_secure' ?>"
		       id="<?php echo $this->option_name . '_is_secure' ?>" value="1" <?php checked( $is_secure, 1 ); ?>>
		<?php
	}

	/**
	 * Render the treshold hide_for_logged input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function wpati_xiti_hide_for_logged_cb() {
		$hide_for_logged = get_option( $this->option_name . '_hide_for_logged', 1 );

		?>
		<input type="checkbox" name="<?php echo $this->option_name . '_hide_for_logged' ?>"
		       id="<?php echo $this->option_name . '_hide_for_logged' ?>"
		       value="1" <?php checked( $hide_for_logged, 1 ); ?>>
		<?php
	}

	/**
	 * Sanitize the "account" value before being saved to database
	 *
	 * @param  string $value $_POST value
	 *
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function wpati_xiti_sanitize_account( $value ) {
		$value = wp_strip_all_tags( $value );

		return $value;
	}

	/**
	 * Sanitize the "is_secure" value before being saved to database
	 *
	 * @param  string $value $_POST value
	 *
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function wpati_xiti_sanitize_is_secure( $value ) {
		$value = $value ? 1 : 0;

		return $value;
	}

	/**
	 * Sanitize the "hide_for_logged" value before being saved to database
	 *
	 * @param  string $value $_POST value
	 *
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function wpati_xiti_sanitize_hide_for_logged( $value ) {
		$value = $value ? 1 : 0;

		return $value;
	}
}
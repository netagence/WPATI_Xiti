<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.netagence.com/
 * @since      1.0.0
 *
 * @package    Wpati_xiti
 * @subpackage Wpati_xiti/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpati_xiti
 * @subpackage Wpati_xiti/public
 * @author     Pierre Mobian <pmobian@netagence.com>
 */
class Wpati_xiti_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpati_xiti-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpati_xiti-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Add tracking code to the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	function wp_footer() {
		// Load options
		$account         = get_option( 'wpati_xiti_account' );
		$is_secure       = get_option( 'wpati_xiti_is_secure' ) ? 'TRUE' : 'FALSE';
		$hide_for_logged = get_option( 'wpati_xiti_hide_for_logged' );

		// Check if we have account number
		if ( empty( $account ) ) {
			return;
		}


		// Prepare and show tracking code
		?>
		<!-- AT Internet -->
		<?php
		if ( $hide_for_logged && is_user_logged_in() ) {
			echo __( 'AT Internet tracking code here, hidden because you are a connected, non-tracked user', 'wpati_xiti' );
			echo "\n";
		} else {
			?>
			<script type="text/javascript" src="//tag.aticdn.net/smarttag.js"></script>
			<script>
				var ATTag = new ATInternet.Tracker.Tag({
					log: "logc407",
					logSSL: "logs1407",
					secure: "<?php echo $is_secure; ?>",
					site: "<?php echo $account; ?>",
					domain: "xiti.com"
				});
				ATTag.page.send({
					name: "<?php echo esc_url( basename( get_permalink() ) ); ?>"
				});
			</script>
			<?php
		}
		?>
		<!-- End AT Internet -->
		<?php
	}

}

<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://startnet.co.uk
 * @since      1.0.0
 *
 * @package    Only_admin_access
 * @subpackage Only_admin_access/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Only_admin_access
 * @subpackage Only_admin_access/admin
 * @author     Startnet Ltd <info@startnet.co.uk>
 */
class Only_admin_access_Admin {


	private $option_name = 'only_admin_access';

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		 * defined in Only_admin_access_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Only_admin_access_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/only_admin_access-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/only_admin_access-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	public function add_plugin_admin_menu() {
	}
	
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Only Admin Access', 'only_admin_access' ),
			__( 'Only Admin Access', 'only_admin_access' ),
			'manage_options',
			$this->plugin_name."_settings",
			array( $this, 'display_options_page' )
		);		
	}

	public function display_options_page() {
		include_once 'partials/only_admin_access-display-options.php';
	}

	public function register_setting() {

	// COURT BOOKINGS fields

	// add court bookings section
	add_settings_section(
		$this->option_name . '_only_admin_access',
		__( 'Settings', 'only_admin_access' ),
		array( $this, $this->option_name . '_info_cb' ),
		$this->plugin_name
	);

	add_settings_field(
		$this->option_name . '_enable',
		__( 'Turn on Only Admin Access', 'only_admin_access' ),
		array( $this, $this->option_name . '_enable_cb' ),
		$this->plugin_name,
		$this->option_name . '_only_admin_access',
		array( 'label_for' => $this->option_name . '_enable' )
	);
	add_settings_field(
		$this->option_name . '_homepage',
		__( 'Page to redirect all non-admin visitors to', 'only_admin_access' ),
		array( $this, $this->option_name . '_homepage_cb' ),
		$this->plugin_name,
		$this->option_name . '_only_admin_access',
		array( 'label_for' => $this->option_name . '_homepage' )
	);
	add_settings_field(
		$this->option_name . '_send404s',
		__( 'Send all 404s to this page as well?', 'only_admin_access' ),
		array( $this, $this->option_name . '_send404s_cb' ),
		$this->plugin_name,
		$this->option_name . '_only_admin_access',
		array( 'label_for' => $this->option_name . '_send404s' )
	);	
	
	register_setting( $this->plugin_name, $this->option_name . '_enable');
	register_setting( $this->plugin_name, $this->option_name . '_homepage');
	register_setting( $this->plugin_name, $this->option_name . '_send404s');

	// DEFAULT SETTINGS FOR OPTIONS
	// add_option does not change anything if the option already exists
	
	add_option($this->option_name . '_enable',"0");

	$homepage=get_option( 'page_on_front' );
	if (!is_null($homepage)) { add_option($this->option_name . '_homepage',$homepage); }

	add_option($this->option_name . '_send404s',"1");
	
	}
	
	public function only_admin_access_remove() {
	
		unregister_setting( $this->plugin_name, $this->option_name . '_enable');
		unregister_setting( $this->plugin_name, $this->option_name . '_homepage');
		unregister_setting( $this->plugin_name, $this->option_name . '_send404s');
	}

	public function only_admin_access_info_cb() {
		echo '<p>'.__( 'Here are the settings for the plugin.', 'only_admin_access' ).'</p>';
	}

	public function only_admin_access_enable_cb() {
		$enable = get_option( $this->option_name . '_enable' );
		?>
			<fieldset>
				<label><?php _e(''); ?></label>
				<input type="checkbox" id="<?php echo $this->option_name . '_enable'; ?>" value="1" <?php checked($enable); ?> name="<?php echo  $this->option_name. '_enable'; ?>" />
			</fieldset>
		<?php
	}

	public function only_admin_access_homepage_cb() {
		$homepage = get_option( $this->option_name . '_homepage' );
		wp_dropdown_pages(array('id'=>$homepage,
		'name'=>$this->option_name . '_homepage',
		'id'=>$this->option_name . '_homepage',
		'selected'=>$homepage
		));
	}


	public function only_admin_access_send404s_cb() {
		$send404s = get_option( $this->option_name . '_send404s' );
		?>
			<fieldset>
				<label><?php _e(''); ?></label>
				<input type="checkbox" id="<?php echo $this->option_name . '_send404s'; ?>" value="1" <?php checked($send404s); ?> name="<?php echo  $this->option_name. '_send404s'; ?>" />
			</fieldset>
		<?php
	}
	
	
	public function non_admin_to_homepage()
	{
		$enable = get_option( $this->option_name . '_enable' );
		$homepage = get_option( $this->option_name . '_homepage' );
		$send404s = get_option( $this->option_name . '_send404s' );
		
		$homepage_url=home_url();
		$homepage_url=get_permalink($homepage);
		
		$page_id = get_queried_object_id();
		
		if ($enable!="1") { return; }
		
		if (is_404()) {
			if ($send404s=="1") { exit( wp_redirect( $homepage_url, 307 ) ); }
			return;
		}
		
		$pass=true;
		//if ( is_home() || is_front_page() ) { return; }
		if ($page_id==$homepage) { return; }
		
		if ( (!is_user_logged_in()) && (!is_admin()) ) { $pass=false; }
		
		if ($pass===false) { exit( wp_redirect( $homepage_url, 307 ) ); }
	}

}

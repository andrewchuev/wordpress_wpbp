<?php

class Plugin_Name {
	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'plugin-name';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_common_hooks();
	}

	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-plugin-name-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-plugin-name-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-plugin-name-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-plugin-name-public.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'common/class-plugin-name-common.php';

		$this->loader = new Plugin_Name_Loader();

	}

	private function set_locale() {
		$plugin_i18n = new Plugin_Name_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}


	private function define_admin_hooks() {
		$plugin_admin = new Plugin_Name_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	private function define_public_hooks() {
		$plugin_public = new Plugin_Name_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	private function define_common_hooks() {
		$plugin_common = new Plugin_Name_Common( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_filter( 'acf/settings/url', $plugin_common, 'acf_settings_url' );
		$this->loader->add_filter( 'acf/settings/show_admin', $plugin_common, 'acf_settings_show_admin' );

		/*$this->loader->add_action( 'admin_enqueue_scripts', $plugin_common, 'enqueue_styles', 2 );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_common, 'enqueue_scripts', 2 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_common, 'enqueue_styles', 2 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_common, 'enqueue_scripts', 2 );
		$this->loader->add_shortcode( 'test_shortcode', $plugin_common, 'test_shortcode' );*/
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}

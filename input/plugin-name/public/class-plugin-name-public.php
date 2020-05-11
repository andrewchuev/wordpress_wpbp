<?php
class Plugin_Name_Public {


	private $plugin_name;


	private $version;


	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	public function enqueue_styles() {



		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plugin-name-public.css', [], time(), 'all' );

	}


	public function enqueue_scripts() {



		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', ['jquery' ], time(), false );

	}

}

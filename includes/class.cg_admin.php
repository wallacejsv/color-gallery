<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ){
	die;
}

class CG_Admin {

	/**
	 * Variable holding the capability to use the plugin
	 *
	 * @since 0.1
	 *
	 * @var string
	 */
	public $capability = 'edit_posts';

	/**
	 * Variable holding the plugin name
	 *
	 * @since 0.1
	 *
	 * @var string
	 */
	public $plugin_name = 'Color Gallery';

	/**
	 * Static method to include all the Hooks for WordPress
	 * There is a safe conditional here, it can only be triggered once!
	 *
	 * @uses add_action
	 * @uses add_filter
	 *
	 * @since 0.1
	 *
	 * @return null Construct never returns
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'cg_add_menu_page' ) );
		add_action( 'admin_menu', array( $this, 'cg_add_submenu_pages' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'cg_include_assets' ) );
	}

	public function cg_include_assets() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'cg-admin', CG__URL . '/assets/js/admin.js', array( 'wp-color-picker', 'jquery' ), CG__VERSION, false );
	}

	public function cg_add_menu_page() {
		add_menu_page( $this->plugin_name, $this->plugin_name, $this->capability, 'color-gallery', array( $this, 'cg_main_view' ), 'dashicons-art', 4 );
	}

	public function cg_add_submenu_pages() {
		add_submenu_page( 'color-gallery', __( 'Colors', 'color-gallery' ), __( 'Colors', 'color-gallery' ), $this->capability, 'cg-colors', array( $this, 'cg_colors_view' ) );
	}

	public function cg_main_view() {
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'new' ) {
			require_once CG__PATH . '/views/add-new.php';
		} else {
			require_once CG__PATH . '/views/gallery.php';
		}
	}

	public function cg_colors_view() {
		require_once CG__PATH . '/views/colors.php';
	}

}
new CG_Admin;
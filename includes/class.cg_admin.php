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
		add_action( 'admin_init', array( $this, 'cg_save_gallery' ) );
	}

	/**
	 * Method that include all required assets by plugin
	 *
	 * @uses wp_enqueue_script
	 * @uses wp_enqueue_style
	 * @uses wp_enqueue_media
	 *
	 * @since 0.1
	 *
	 * @return null
	 */

	public function cg_include_assets() {
		//scripts
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'cg-js', CG__URL . '/assets/js/cg-admin.js', array( 'wp-color-picker', 'jquery' ), CG__VERSION, true );

		//styles
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'cg-css', CG__URL . '/assets/css/cg-admin.css' );

		//both
		wp_enqueue_media();
	}

	public function cg_save_gallery() {
		$save = self::cg_filter( $_POST, 'cg_save_gallery' );
		$title = self::cg_filter( $_POST, 'cg_title' );
		$action = self::cg_filter( $_GET, 'action' );
		$id = self::cg_filter( $_GET, 'id' );

		if ( ! $save || ! $title || ! $action )
			return;

		if ( $action == 'new' ) {
			$params = array(
				'post_title' => $title,
				'post_type' => 'color_gallery',
				'post_author' => get_current_user_id()
			);

			$gallery = wp_insert_post( $params );

			$redirect = admin_url() . 'admin.php?page=color-gallery&action=edit&id=' . $gallery;

			if ( $gallery > 0 ) {
				exit( wp_redirect( $redirect ) );
			}
		} else if ( $action == 'edit' ) {
			$gallery = get_post( $id );
		} else {
			return false;
		}
	}

	public function cg_add_menu_page() {
		add_menu_page( $this->plugin_name, $this->plugin_name, $this->capability, 'color-gallery', array( $this, 'cg_main_view' ), 'dashicons-art', 4 );
	}

	public function cg_add_submenu_pages() {
		add_submenu_page( 'color-gallery', __( 'Colors', 'color-gallery' ), __( 'Colors', 'color-gallery' ), $this->capability, 'cg-colors', array( $this, 'cg_colors_view' ) );
	}

	public function cg_filter( $type, $key, $value = null ) {
		if ( ! $type || ! isset( $type[$key] ) || empty( $type[$key] ) )
			return false;

		if ( $value && $type[$key] !== $value )
			return false;

		if ( $value ) {
			return sanitize_text_field( $value ); 
		}

		return sanitize_text_field( $type[$key] );
	}

	public function cg_get_gallery() {
		$action = self::cg_filter( $_GET, 'action', 'edit' );
		$id = self::cg_filter( $_GET, 'id' );
		if ( ! $action || ! $id ) {
			return false;
		}
		$gallery = get_post( $id );
		if ( $gallery && $gallery->post_type == 'color_gallery' ) {
			return $gallery;
		}
		return false;
	}

	public function cg_main_view() {
		$action = self::cg_filter( $_GET, 'action' );
		if ( $action && ( $action == 'new' || $action == 'edit' ) ) {
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
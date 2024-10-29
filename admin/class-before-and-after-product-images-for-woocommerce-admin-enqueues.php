<?php

// Exit if accessed directly

if( !defined( 'ABSPATH' ) ) {
	exit;
}

// Enqueues

if( !class_exists( 'BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Admin_Enqueues' ) ) {

	class BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Admin_Enqueues {

		public function __construct() {

			// Enqueue styles/scripts

			add_action( 'admin_enqueue_scripts', array( $this, 'baapifwc_enqueue_js' ) );

		}

		public function baapifwc_enqueue_js( $hook ) {

			// If this is the product edit or new product screen

			if( get_post_type() == 'product' && ( $hook == 'post.php' || $hook == 'post-new.php' ) ) {

				// Enqueue media

				wp_enqueue_media();
		 
				// Registers and enqueues the required javascript.

				wp_enqueue_script( 'baapifwc-select-image', plugin_dir_url( __FILE__ ) . 'assets/js/select-image.js', array( 'jquery' ) );

			}

		}

	}

}
<?php

// Exit if accessed directly

if( !defined( 'ABSPATH' ) ) {
	exit;
}

// Enqueues

if( !class_exists( 'BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Public_Enqueues' ) ) {

	class BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Public_Enqueues {

		public function __construct() {

			// Enqueue styles/scripts

			add_action( 'wp_enqueue_scripts', array( $this, 'baapifwc_enqueue_public_js' ) );

		}

		public function baapifwc_enqueue_public_js( $hook ) {

			// If this is the product page

			if( is_product() ) {

				wp_enqueue_script( 'baapifwc-twentytwenty-jquery-event-move', plugin_dir_url( __FILE__ ) . 'assets/js/twentytwenty/js/jquery.event.move.js', array( 'jquery' ) );
				wp_enqueue_script( 'baapifwc-twentytwenty-script', plugin_dir_url( __FILE__ ) . 'assets/js/twentytwenty/js/jquery.twentytwenty.js', array( 'jquery' ) );
				wp_enqueue_style( 'baapifwc-twentytwenty-styles', plugin_dir_url( __FILE__ ) . 'assets/js/twentytwenty/css/twentytwenty.css' );

			}

		}

	}

}
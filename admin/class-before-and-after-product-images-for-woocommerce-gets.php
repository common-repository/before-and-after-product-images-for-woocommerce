<?php

// Exit if accessed directly

if( !defined( 'ABSPATH' ) ) {
	exit;
}

// Gets

if( !class_exists( 'BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Gets' ) ) {

	class BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Gets {

		public function baapifwc_get_before_after_product_images( $product_id ) {

			return get_post_meta( $product_id, 'baapifwc_before_and_after_images', true );

		}

		public function baapifwc_get_settings() {

			return get_option( 'baapifwc_settings' );

		}

	}

}
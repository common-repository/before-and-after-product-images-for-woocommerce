<?php

/*
Plugin Name: Before and After Product Images for WooCommerce
Plugin URI:  https://nplugins.com/
Description: Add before and after product images to WooCommerce products.
Version: 1.0.3
Author: N Plugins
Author URI: https://nplugins.com/
Text Domain: nplugins-before-and-after-product-images-for-woocommerce
Domain Path: languages
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Auto Deactivate Free Version

if ( !function_exists( 'baapifwc_fs' ) ) {
    // START FREEMIUS
    // Create a helper function for easy SDK access.
    function baapifwc_fs()
    {
        global  $baapifwc_fs ;
        
        if ( !isset( $baapifwc_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $baapifwc_fs = fs_dynamic_init( array(
                'id'             => '1992',
                'slug'           => 'before-and-after-product-images-for-woocommerce',
                'type'           => 'plugin',
                'public_key'     => 'pk_1c285e5e3840235ec164c1e3bb5da',
                'is_premium'     => false,
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'slug' => 'baapifwc_settings',
            ),
                'is_live'        => true,
            ) );
        }
        
        return $baapifwc_fs;
    }
    
    // Init Freemius.
    baapifwc_fs();
    // Signal that SDK was initiated.
    do_action( 'baapifwc_fs_loaded' );
    // END FREEMIUS
    // WooCommerce check
    
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        // Before and After Product Images for WooCommerce
        
        if ( !class_exists( 'BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce' ) ) {
            class BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce
            {
                public function __construct()
                {
                    // Requires
                    require_once plugin_dir_path( __FILE__ ) . 'admin/class-before-and-after-product-images-for-woocommerce-admin-enqueues.php';
                    require_once plugin_dir_path( __FILE__ ) . 'admin/class-before-and-after-product-images-for-woocommerce-meta-boxes.php';
                    require_once plugin_dir_path( __FILE__ ) . 'admin/class-before-and-after-product-images-for-woocommerce-settings.php';
                    require_once plugin_dir_path( __FILE__ ) . 'admin/class-before-and-after-product-images-for-woocommerce-gets.php';
                    require_once plugin_dir_path( __FILE__ ) . 'public/class-before-and-after-product-images-for-woocommerce-display.php';
                    require_once plugin_dir_path( __FILE__ ) . 'public/class-before-and-after-product-images-for-woocommerce-public-enqueues.php';
                    // Instantiate Classes
                    $before_and_after_product_images_for_woocommerce_admin_enqueues = new BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Admin_Enqueues();
                    $before_and_after_product_images_for_woocommerce_meta_boxes = new BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Meta_Boxes();
                    $before_and_after_product_images_for_woocommerce_settings = new BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Settings();
                    $before_and_after_product_images_for_woocommerce_gets = new BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Gets();
                    $before_and_after_product_images_for_woocommerce_display = new BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Display();
                    $before_and_after_product_images_for_woocommerce_public_enqueues = new BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Public_Enqueues();
                }
            
            }
            // Initial Instantiate
            $before_and_after_product_images_for_woocommerce = new BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce();
        }
    
    } else {
        function baapifwc_woocommerce_install_activate_notice()
        {
            ?>
		
			<div class="notice notice-error is-dismissible">
				<p><?php 
            _e( 'Before and After Product Images for WooCommerce requires WooCommerce to be installed and activated.', 'nplugins-before-and-after-product-images-for-woocommerce' );
            ?></p>
			</div>
		
		<?php 
        }
        
        add_action( 'admin_notices', 'baapifwc_woocommerce_install_activate_notice' );
    }

}

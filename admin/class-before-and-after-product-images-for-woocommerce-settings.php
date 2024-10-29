<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Settings
if ( !class_exists( 'BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Settings' ) ) {
    class BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Settings
    {
        public function __construct()
        {
            add_action( 'admin_menu', array( $this, 'baapifwc_add_menu' ) );
            add_action( 'admin_init', array( $this, 'baapifwc_settings' ) );
        }
        
        public function baapifwc_add_menu()
        {
            add_menu_page(
                'Before and After Product Images for WooCommerce',
                'Before and After Product Images',
                'manage_options',
                'baapifwc_settings',
                array( $this, 'baapifwc_settings_page' ),
                'dashicons-images-alt2',
                56
            );
        }
        
        public function baapifwc_settings()
        {
            register_setting( 'baapifwc_settings_group', 'baapifwc_settings' );
            add_settings_section(
                'baapifwc_settings_group_getting_started',
                __( 'Getting Started', 'nplugins-before-and-after-product-images-for-woocommerce' ),
                array( $this, 'baapifwc_settings_group_getting_started_callback' ),
                'baapifwc_settings_group'
            );
            add_settings_section(
                'baapifwc_settings_group_customization',
                __( 'Customization', 'nplugins-before-and-after-product-images-for-woocommerce' ),
                array( $this, 'baapifwc_settings_group_customization_callback' ),
                'baapifwc_settings_group'
            );
            add_settings_field(
                'baapifwc_slider_width',
                __( 'Slider width', 'nplugins-before-and-after-product-images-for-woocommerce' ),
                array( $this, 'baapifwc_text_field_renderer' ),
                'baapifwc_settings_group',
                'baapifwc_settings_group_customization',
                array(
                'field'       => 'baapifwc_slider_width',
                'label_for'   => 'baapifwc_slider_width',
                'description' => 'Width of the slider (Example: 50% or 200px).',
            )
            );
        }
        
        public function baapifwc_text_field_renderer( $args )
        {
            $field_prefixed = $args['field'];
            $field_no_prefix = str_replace( 'baapifwc_', '', $field_prefixed );
            $settings = BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Gets::baapifwc_get_settings();
            $description = $args['description'];
            
            if ( !empty($settings) ) {
                $field_data = $settings[$field_no_prefix];
            } else {
                $field_data = '';
            }
            
            echo  '<input type="text" name="baapifwc_settings[' . $field_no_prefix . ']" id="' . $field_prefixed . '" value="' . $field_data . '">' ;
            if ( !empty($description) ) {
                echo  '<p class="description">' . $description . '</p>' ;
            }
        }
        
        public function baapifwc_checkbox_field_renderer( $args )
        {
            $settings = BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Gets::baapifwc_get_settings();
            $field_prefixed = $args['field'];
            $field_no_prefix = str_replace( 'baapifwc_', '', $field_prefixed );
            $description = $args['description'];
            
            if ( !empty($settings) ) {
                $field_data = $settings[$field_no_prefix];
            } else {
                $field_data = '';
            }
            
            echo  '<input type="checkbox" name="baapifwc_settings[' . $field_no_prefix . ']" id="' . $field_prefixed . '" value="1" ' . checked( 1, $field_data, false ) . '>' ;
            if ( !empty($description) ) {
                echo  '<p class="description">' . $description . '</p>' ;
            }
        }
        
        public function baapifwc_select_field_renderer( $args )
        {
            $settings = BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Gets::baapifwc_get_settings();
            $field_prefixed = $args['field'];
            $field_no_prefix = str_replace( 'baapifwc_', '', $field_prefixed );
            $description = $args['description'];
            $options = $args['options'];
            
            if ( !empty($settings) ) {
                $field_data = $settings[$field_no_prefix];
            } else {
                $field_data = '';
            }
            
            echo  '<select name="baapifwc_settings[' . $field_no_prefix . ']" id="' . $field_prefixed . '">' ;
            foreach ( $options as $option ) {
                echo  '<option value="' . $option . '" ' . selected( $option, $field_data, false ) . '>' . ucfirst( $option ) . '</option>' ;
            }
            echo  '</select>' ;
            if ( !empty($description) ) {
                echo  '<p class="description">' . $description . '</p>' ;
            }
        }
        
        public function baapifwc_settings_group_getting_started_callback()
        {
            echo  sprintf( __( 'To get started simply <a href="%s">edit a product</a> and add your images under the Before and After Product Images section. We recommend choosing images with the same dimensions. Once you have added your images they will now appear on the product page under the before and after tab.', 'nplugins-before-and-after-product-images-for-woocommerce' ), admin_url( 'edit.php?post_type=product' ) ) ;
        }
        
        public function baapifwc_settings_group_customization_callback()
        {
            _e( 'Configure the plugin using the options below.', 'nplugins-before-and-after-product-images-for-woocommerce' );
        }
        
        public function baapifwc_settings_page()
        {
            ?>

			<form action='options.php' method='post'>

				<h2><?php 
            echo  get_admin_page_title() ;
            ?></h2>

				<?php 
            settings_fields( 'baapifwc_settings_group' );
            do_settings_sections( 'baapifwc_settings_group' );
            submit_button();
            ?>

			</form>

			<?php 
        }
    
    }
}
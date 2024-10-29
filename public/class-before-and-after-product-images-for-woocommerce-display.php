<?php

// Exit if accessed directly

if( !defined( 'ABSPATH' ) ) {
	exit;
}

// Enqueues

if( !class_exists( 'BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Display' ) ) {

	class BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Display {

		public function __construct() {

			add_filter( 'woocommerce_product_tabs', array( $this, 'baapifwc_add_product_tab' ) );

		}

		public function baapifwc_add_product_tab( $tabs ) {

			$before_and_after_product_images = BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Gets::baapifwc_get_before_after_product_images( get_the_id() );
			$settings = BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Gets::baapifwc_get_settings();

			if( !empty( $before_and_after_product_images ) ) {

				if( !empty( $settings['tab_title'] ) ) {

					$tab_title = $settings['tab_title'];

				} else {

					$tab_title = __( 'Before and After', 'nplugins-before-and-after-product-images-for-woocommerce' );

				}

				// Adds the new tab
			
				$tabs['baapifwc_before_and_after_product_images_tab'] = array(
					'title' 	=> $tab_title,
					'priority' 	=> 50,
					'callback' 	=> array( $this, 'baapifwc_product_tab_content' )
				);

			}

			return $tabs;

		}
		
		public function baapifwc_product_tab_content() {

			$before_and_after_product_images = BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Gets::baapifwc_get_before_after_product_images( get_the_id() );
			$settings = BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Gets::baapifwc_get_settings();

			if( !empty( $settings['slider_width'] ) ) {

				$styles = 'width: ' . $settings['slider_width'] . ';';

			}

			if( !empty( $settings['tab_heading'] ) ) {

				echo '<h2>' . $settings['tab_heading'] . '</h2>';

			} else {

				echo '<h2>' . __( 'Before and After', 'nplugins-before-and-after-product-images-for-woocommerce' ) . '</h2>';

			}

			if( !empty( $settings['tab_description'] ) ) {

				echo '<p>' . $settings['tab_description'] . '</p>';

			} else {

				echo '<p>' . __( 'Move the slider to view before and after.', 'nplugins-before-and-after-product-images-for-woocommerce' ) . '</p>';

			}

			echo '<div id="baapifwc-twenty-twenty" class="twentytwenty-container" style="' . $styles . '">';
			echo wp_get_attachment_image( $before_and_after_product_images[0]['before'], 'full' );
			echo wp_get_attachment_image( $before_and_after_product_images[0]['after'], 'full' );
			echo '</div>'; ?>

			<script>
				jQuery( "#tab-title-baapifwc_before_and_after_product_images_tab a" ).live( "click", function() {

					jQuery( '#baapifwc-twenty-twenty' ).twentytwenty( {

						<?php if( !empty( $settings['default_offset'] ) ) { ?>
							default_offset_pct: <?php echo $settings['default_offset']; ?>,
						<?php } ?>

						<?php if( !empty( $settings['orientation'] ) ) { ?>
							orientation: '<?php echo $settings['orientation']; ?>',
						<?php } ?>

						<?php if( !empty( $settings['before_label'] ) ) { ?>
							before_label: '<?php echo $settings['before_label']; ?>',
						<?php } ?>

						<?php if( !empty( $settings['after_label'] ) ) { ?>
							after_label: '<?php echo $settings['after_label']; ?>',
						<?php } ?>

						<?php if( !empty( $settings['no_overlay'] ) ) { ?>
							no_overlay: <?php echo $settings['no_overlay'] == 1 ? 'true' : 'false'; ?>,
						<?php } ?>

						<?php if( !empty( $settings['move_slider_on_hover'] ) ) { ?>
							move_slider_on_hover: <?php echo $settings['move_slider_on_hover'] == 1 ? 'true' : 'false'; ?>,
						<?php } ?>

						<?php if( !empty( $settings['move_with_handle_only'] ) ) { ?>
							move_with_handle_only: <?php echo $settings['move_with_handle_only'] == 1 ? 'true' : 'false'; ?>,
						<?php } ?>

					} );

				});
			</script>

		<?php }

	}

}






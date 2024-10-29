<?php

// Exit if accessed directly

if( !defined( 'ABSPATH' ) ) {
	exit;
}

// Meta Boxes

if( !class_exists( 'BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Meta_Boxes' ) ) {

	class BAAPIFWC_Before_and_After_Product_Images_for_WooCommerce_Meta_Boxes {

		public function __construct() {

			add_action( 'add_meta_boxes', array( $this, 'baapifwc_add_meta_boxes' ) );
			add_action( 'save_post_product', array( $this, 'baapifwc_save_before_and_after_product_images' ) );

		}

		public function baapifwc_add_meta_boxes() {

			// Add before and after product images meta box

			add_meta_box(
				'baapifwc-before-and-after-product-images',
				__( 'Before and After Product Images', 'nplugins-before-and-after-product-images-for-woocommerce' ),
				array( $this, 'baapifwc_before_and_after_product_images_meta_box' ),
				'product',
				'side',
				'default'
			);

		}

		public function baapifwc_before_and_after_product_images_meta_box( $post ) {
				
			$before_after_images = get_post_meta( $post->ID, 'baapifwc_before_and_after_images', true ); ?>

			<ul id="baapifwc-select-images">

				<li class="baapifwc-select-image" id="baapifwc-before-0">

					<p class="baapifwc-image-header"><?php _e( 'Before image:', 'nplugins-before-and-after-product-images-for-woocommerce' ); ?></p>

					<div class="baapifwc-image-thumbnail">
						<?php echo wp_get_attachment_image( $before_after_images[0]['before'] ); ?>
					</div>
					
					<a href="#" class="baapifwc-select-image"><?php _e( 'Select image', 'nplugins-before-and-after-product-images-for-woocommerce' )?></a>
					<?php _e( ' / '); ?>
					<a href="#" class="baapifwc-remove-image"><?php _e( 'Remove', 'nplugins-before-and-after-product-images-for-woocommerce' )?></a>
					<input class="baapifwc-image-id" type="hidden" name="baapifwc_before_and_after_images[0][before]" value="<?php echo $before_after_images[0][before]; ?>" />

				</li>

				<li class="baapifwc-select-image" id="baapifwc-afer-0">

					<p class="baapifwc-image-header"><?php _e( 'After image:', 'nplugins-before-and-after-product-images-for-woocommerce' ); ?></p>

					<div class="baapifwc-image-thumbnail">
						<?php echo wp_get_attachment_image( $before_after_images[0]['after'] ); ?>
					</div>
					
					<a href="#" class="baapifwc-select-image"><?php _e( 'Select image', 'nplugins-before-and-after-product-images-for-woocommerce' )?></a>
					<?php _e( ' / '); ?>
					<a href="#" class="baapifwc-remove-image"><?php _e( 'Remove', 'nplugins-before-and-after-product-images-for-woocommerce' )?></a>
					<input class="baapifwc-image-id" type="hidden" name="baapifwc_before_and_after_images[0][after]" value="<?php echo $before_after_images[0][after]; ?>" />

				</li>
			
			<ul>

		<?php }

		public function baapifwc_save_before_and_after_product_images( $post_id ) {

			// Get before and after images

			$before_after_images = $_POST['baapifwc_before_and_after_images'];

			// Start count of empty images

			$before_after_images_empty = 0;

			foreach ($before_after_images as $before_after_image ) {

				// If a product images values are both empty

				if( empty( $before_after_image['before'] ) && empty( $before_after_image['after'] ) ) {

					// Add to count

					$before_after_images_empty++;

				}

			}

			// If the total number of before and after images matches the number of empty then there are no before and after images

			if( count( $before_after_images ) == $before_after_images_empty ) {

				// Delete the meta

				delete_post_meta( $post_id, 'baapifwc_before_and_after_images' );

			} else {

				// Update the meta

				update_post_meta( $post_id, 'baapifwc_before_and_after_images', $before_after_images );

			}
			
		}

	}

}
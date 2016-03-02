<?php
/**
 * Bundle add-to-cart button template.
 *
 * Override this template by copying it to 'yourtheme/woocommerce/single-product/add-to-cart/bundle-button.php'.
 *
 * @version 4.7.4
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

?><button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>

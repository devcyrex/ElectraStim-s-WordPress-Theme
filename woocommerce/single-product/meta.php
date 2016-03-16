<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

/* Note: This file has been altered by Laborator
	Note: Again edited by James Hudson, added EAN Code*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<div class="product_meta">

	<?php

		do_action( 'woocommerce_product_meta_start' );

//		getting $ean code.
		$ean = get_post_meta($post->ID, 'Product EAN Code', true);

		if(empty($ean)){

			$ean = __( 'N/A', 'aurum' );
		}

	?>

<!--  Added EAN Code.	-->
	<span class="ean_wrapper">
		<?php echo 'EAN: <span class="ean" itemprop="ean">'. $ean . '</span>';?>
	</span>
<!--  EAN Code End.	-->

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'REF:', 'aurum' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'aurum' ); ?></span>.</span>

	<?php endif; ?>

	<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'aurum' ) . ' ', '.</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'aurum' ) . ' ', '.</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
</div>
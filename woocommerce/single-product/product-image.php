<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product, $product_images, $has_gallery;

# start: modified by Arlind Nushi

	# Nivo Lightbox
	wp_enqueue_script('nivo-lightbox');
	wp_enqueue_style('nivo-lightbox-default');

$product_images = $product->get_gallery_attachment_ids();
$has_gallery = count($product_images) > 0;


	# Owl Carousel
	wp_enqueue_script('owl-carousel');
	wp_enqueue_style('owl-carousel');


$autoswitch = get_data('shop_single_auto_rotate_image');

if( ! is_numeric($autoswitch))
	$autoswitch = 5;

$shop_magnifier = get_data('shop_magnifier');
$shop_magnifier_zoom_view_size = get_data('shop_magnifier_zoom_view_size');
$shop_magnifier_zoom_level = get_data('shop_magnifier_zoom_level');

$shop_magnifier_zoom_view_size = explode("x", preg_match("/^[0-9]+x[0-9]+$/", $shop_magnifier_zoom_view_size) ? $shop_magnifier_zoom_view_size : "480x395");
$shop_magnifier_zoom_level = is_numeric($shop_magnifier_zoom_level) ? $shop_magnifier_zoom_level : 1.925;

$product_thumbnails_placing = get_data('shop_product_thumbnails_placing');
$horizontal_gallery = $product_thumbnails_placing == 'horizontal'; 
# end: modified by Arlind Nushi

?>
<div class="row">

	<?php if($has_gallery && $horizontal_gallery == false): ?>
	<div class="col-lg-2 col-md-2 hidden-sm hidden-xs">

		<?php do_action( 'woocommerce_product_thumbnails' ); ?>

	</div>
	<?php endif; ?>

	<div class="<?php echo $has_gallery && $horizontal_gallery == false ? 'col-lg-10 col-md-10' : 'col-lg-12'; ?>">

		<?php
		# start: modified by Arlind Nushi
		woocommerce_show_product_sale_flash();
		# end: modified by Arlind Nushi
		?>
		<div class="images hidden">
			<div class="thumbnails"></div>
		</div>

		<?php
		?>
		<div class="product-images nivo<?php echo $shop_magnifier ? ' magnify-active' : ''; ?>" data-autoswitch="<?php echo 1000 * absint($autoswitch); ?>"<?php if($shop_magnifier): ?> data-zoom-viewsize="<?php echo implode(',', $shop_magnifier_zoom_view_size); ?>" data-zoom-level="<?php echo $shop_magnifier_zoom_level; ?>"<?php endif; ?>>

			<?php
				if ( has_post_thumbnail() ) {

					$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
					$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop-thumb-main' ), array(
						'title' => $image_title
						) );
						
					$image_link = apply_filters( 'single_product_large_image_link', $image_link, get_post_thumbnail_id() );

					$attachment_count = count( $product->get_gallery_attachment_ids() );

					$gallery = '';

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom item-image-big" title="%s" data-lightbox-gallery="shop-gallery">%s</a>', $image_link, $image_title, $image ), $post->ID );

					# start: modified by Arlind Nushi
					foreach($product_images as $attachment_id)
					{

						$image_link = wp_get_attachment_url( $attachment_id );

						if ( ! $image_link )
							continue;

						$attachment_url = wp_get_attachment_image_src($attachment_id, 'original');

						echo '<a href="' . apply_filters( 'single_product_large_image_link', $attachment_url[0], $attachment_id ) .'" class="item-image-big hidden" data-lightbox-gallery="shop-gallery">';
							echo wp_get_attachment_image($attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop-thumb-main' ));
						echo '</a>';
					}
					# end: modified by Arlind Nushi

				} else {

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

				}
			?>


		</div>
		
		<?php if($has_gallery && $horizontal_gallery): ?>
		<div class="horizontal-product-gallery">
	
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	
		</div>
		<?php endif; ?>
	</div>
</div>
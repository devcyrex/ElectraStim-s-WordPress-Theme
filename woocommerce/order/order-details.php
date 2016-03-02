<?php
/**
 * Order details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order = wc_get_order( $order_id );
?>
<?php # start: modified by Arlind Nushi ?>
<div class="row order-details">
	<div class="col-sm-12">

		<div class="cart_totals">
<?php # end: modified by Arlind Nushi ?>
		
			<h2><?php _e( 'Order Details', 'woocommerce' ); ?></h2>
			<table class="shop_table order_details">
				<thead>
					<tr>
						<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
						<td class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></td>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach( $order->get_items() as $item_id => $item ) {
							wc_get_template( 'order/order-details-item.php', array(
								'order'   => $order,
								'item_id' => $item_id,
								'item'    => $item,
								'product' => apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item )
							) );
						}
					?>
					<?php do_action( 'woocommerce_order_items_table', $order ); ?>
				</tbody>
				<tfoot>
					<?php
						foreach ( $order->get_order_item_totals() as $key => $total ) {
							?>
							<tr>
								<th scope="row"><?php echo $total['label']; ?></th>
								<td><?php echo $total['value']; ?></td>
							</tr>
							<?php
						}
					?>
				</tfoot>
			</table>

<?php # start: modified by Arlind Nushi ?>
		</div>
	
	</div>
</div>
<?php # end: modified by Arlind Nushi ?>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<?php wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) ); ?>

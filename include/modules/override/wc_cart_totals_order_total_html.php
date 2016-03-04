<?php

namespace modules\override;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class OrderTotalHTML{

  public function wc_cart_totals_order_total_html_child() {
    $value = '<strong>' . WC()->cart->get_total() . '</strong> ';

    // If prices are tax inclusive, show taxes here
    if ( wc_tax_enabled() && WC()->cart->tax_display_cart == 'incl' ) {
      $tax_string_array = array();

      if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) {
        foreach ( WC()->cart->get_tax_totals() as $code => $tax )
          $tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
      } else {
        $tax_string_array[] = sprintf( '%s %s', wc_price( WC()->cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
      }

      if ( ! empty( $tax_string_array ) ) {
        // $value .= '<small class="includes_tax">' . sprintf( __( '(Includes %s)', 'woocommerce' ), implode( ', ', $tax_string_array ) ) . '</small>';
      }
    }

    echo apply_filters( 'woocommerce_cart_totals_order_total_html', $value );
  }
}
?>
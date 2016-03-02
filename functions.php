<?php

// require_once get_template_directory() . '-child/library/ReCaptcha.php';

add_action('wp_enqueue_scripts', 'add_res');

function add_res(){

	$workingDir = get_template_directory_uri() . "-child/assets/";

	wp_enqueue_style('custom-css', $workingDir . 'css/screen.css', array('aurum-main'), null);

	// wp_register_script('child-custom-js', $workingDir . 'js/main.js', null, null);
	// wp_enqueue_script('child-custom-js');
	
	if(wp_is_mobile()){

		wp_enqueue_style('mobile', $workingDir . 'css/mobile.css', array('custom-css'));
	}else{

    wp_enqueue_style('desktop', $workingDir . 'css/desktop.css', array('custom-css'));
  }

	if (is_page(266)) {
		
	 	wp_enqueue_style('home_page_modfir', $workingDir . 'css/home.css', array('custom-css'));
	}
}

function lab_get_svg_child($svg_path, $id = null, $size = array(24, 24), $is_asset = true){

  if($is_asset)
    $svg_path = get_template_directory() . '-child/assets/' .  $svg_path;

  if( ! $id)
    $id = sanitize_title(basename($svg_path));

  if(is_numeric($size))
    $size = array($size, $size);

  ob_start();

  echo file_get_contents($svg_path);

  $svg = ob_get_clean();

  $svg = preg_replace(
    array(
      '/^.*<svg/s',
      '/id=".*?"/i',
      '/width=".*?"/',
      '/height=".*?"/'
    ),
    array(
      '<svg', 'id="'.$id.'"',
      'width="'.$size[0].'px"',
      'height="'.$size[0].'px"'
    ),
    $svg
  );

  return $svg;
}

function wc_cart_totals_order_total_html_child() {
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

add_filter( 'woocommerce_countries_ex_tax_or_vat', 'rem_ex_tax' );

function rem_ex_tax( $remove ) {
    $countries = array( 'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GB', 'GR', 'HU', 'HR', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK', 'MC', 'IM' );
    $remove = in_array( 'US', $countries ) ? __( '', 'woocommerce' ) : __( '', 'woocommerce' );

}

function previewEmail() {

    if (is_admin()) {

        $default_path = WC()->plugin_path() . '/templates/';

        $files = scandir($default_path . 'emails');
        $exclude = array( '.', '..', 'email-header.php', 'email-footer.php','plain' );
        $list = array_diff($files,$exclude);

        ?>

        <form method="get" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php">
            <input type="hidden" name="order" value="<?php echo (isset($_GET["order"])) ? $_GET["order"] : ''; ?>">
            <input type="hidden" name="action" value="previewemail">
            <select name="file">
        <?php
        foreach( $list as $item ){ ?>
            <option value="<?php echo $item; ?>"><?php echo str_replace('.php', '', $item); ?></option>
        <?php } ?>
            </select><input type="submit" value="Go"></form>

        <?php

        global $order;
        $order = new WC_Order($_GET['order']);
        wc_get_template( 'emails/email-header.php', array( 'order' => $order ) );


        wc_get_template( 'emails/'.$_GET['file'], array( 'order' => $order ) );
        wc_get_template( 'emails/email-footer.php', array( 'order' => $order ) );

    }
    return null; 
}

 add_action('wp_ajax_previewemail', 'previewEmail');
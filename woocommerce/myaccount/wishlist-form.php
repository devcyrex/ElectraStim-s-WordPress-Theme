<?php
/**
 * Wishlist
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.7
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

# start: modified by Arlind Nushi
include locate_template( 'tpls/woocommerce-account-tabs-before.php' );
# end: modified by Arlind Nushi

the_content();
echo do_shortcode('[yith_wcwl_wishlist]');

# start: modified by Arlind Nushi
include locate_template( 'tpls/woocommerce-account-tabs-after.php' );
# end: modified by Arlind Nushi

get_footer();
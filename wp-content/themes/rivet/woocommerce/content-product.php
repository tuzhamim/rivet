<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) :
	return;
endif;
$woo_desktop_cols  = 12/rivet_set_value( 'woo_product_columns', 4 );
$product_col_class = 'rivet-single-product-item rivet-col-lg-' . esc_attr( $woo_desktop_cols ) . ' rivet-col-md-4 rivet-col-sm-6';
?>
<div <?php wc_product_class( $product_col_class ); ?>>
	<?php wc_get_template( 'custom/product-block/block.php' ); ?>
</div>

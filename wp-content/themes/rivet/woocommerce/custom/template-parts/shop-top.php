<?php
/**
 * @author  DevsVibe
 * @since   1.0.0
 * @version 1.0.0
 */

if ( ! woocommerce_products_will_display() ) :
	return;
endif;
?>
<div class="rivet-woocommerce-shop-top">
	<div class="rivet-woocommerce-shop-top-count">
		<?php woocommerce_result_count();?>
	</div>
	<div class="rivet-woocommerce-shop-top-order">
		<?php woocommerce_catalog_ordering();?>
	</div>
</div>
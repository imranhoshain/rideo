<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<section class="cart-page section-padding">
<div class="container">
<div class="row">
<div class="col-xs-12">
<div class="table-responsive table-one margin-minus section-padding-bottom">
	

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table_responsive spacing-table text-center cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-thumbnail">&nbsp;Product Image</th>				
				<th class="product-name"><?php esc_html_e( 'Product Name', 'woocommerce' ); ?></th>				
				<th class="product-price"><?php esc_html_e( 'Unit Price', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Sub Total', 'woocommerce' ); ?></th>
				<th class="product-remove">&nbsp;Product Remove</th>	
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="td-img text-left"><?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail;
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
						}
						?></td>

						<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>"><?php
						if ( ! $product_permalink ) {
							echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
						} else {
							echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
						}

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item );

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
						}
						?></td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>"><?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input( array(
								'input_name'    => "cart[{$cart_item_key}][qty]",
								'input_value'   => $cart_item['quantity'],
								'max_value'     => $_product->get_max_purchase_quantity(),
								'min_value'     => '0',
								'product_name'  => $_product->get_name(),
							), $_product, false );
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?></td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>
						<td class="product-remove text-center">
							<?php
								// @codingStandardsIgnoreLine
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i title="Remove this product" class="fa fa-trash"></i></a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>
			<tr class="cart-bottom">
				<td colspan="6" class="actions">
						
					<div class="col-sm-4">
						<div class="estimate-text text-left">
							<h3>Estimate Shipping And Tax</h3>
							<p>Enter your destination to get shipping &amp; tax</p>
							<form method="post" action="mail.php">
								<div class="single-select">
									<label>Country *</label>
									<div class="custom-select">
										<select class="form-control">
											<option>Options</option>
											<option>Aruba</option>
											<option>Australia </option>
											<option>Bahrain</option>
											<option>Bangladesh</option>
											<option>Chile</option>
										</select>
									</div>
								</div>
								<div class="single-select">
									<label>State/Province *</label>
									<div class="custom-select">
										<select class="form-control">
											<option>Options</option>
											<option>Kerala</option>
											<option>Madhya</option>
											<option>Manipur</option>
											<option>Dhaka</option>
											<option>Chili</option>
										</select>
									</div>
								</div>
								<div class="single-select">
									<label>Zip/Postal Code</label>
									<div class="input-text">
										<input type="text" name="zip">
									</div>
									<div class="submit-text quotes">
										<input type="submit" value="Get A Quote" name="submit">
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="estimate-text coupon text-left">
							<h3>Discount Code</h3>
							<p>Enter your coupon code if you have one</p>
							<?php if ( wc_coupons_enabled() ) { ?>
						
							 
							<div class="input-text">
							<input type="text" name="coupon_code" class="" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
							</div>
							<div class="submit-text">
							 <input type="submit" class="" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" />
							</div>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						
					<?php } ?>							
						</div>
					</div>
					<div class="col-sm-4">
						<div class="estimate-text responsive">
							<?php
								/**
								 * Cart collaterals hook.
								 *
								 * @hooked woocommerce_cross_sell_display
								 * @hooked woocommerce_cart_totals - 10
								 */
								do_action( 'woocommerce_cart_collaterals' );	?>
							
						</div>
					</div>
							

				<!-- No need update cart
					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button> 
				-->

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart' ); ?>
				</td>
			</tr>


			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>


</div></div></div></div></section>

<?php do_action( 'woocommerce_after_cart' ); ?>

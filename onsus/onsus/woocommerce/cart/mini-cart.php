<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
	
	<div class="minicar-body">
		
		<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
			<?php
			do_action( 'woocommerce_before_mini_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
						<?php
						echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'woocommerce_cart_item_remove_link',
							sprintf(
								'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
								esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								esc_attr__( 'Remove this item', 'onsus' ),
								esc_attr( $product_id ),
								esc_attr( $cart_item_key ),
								esc_attr( $_product->get_sku() )
							),
							$cart_item_key
						);
						?>
						<?php if ( empty( $product_permalink ) ) : ?>
							<?php echo sprintf('%s',$thumbnail) . '<span>'. wp_kses_post( $product_name ) .'</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php else : ?>
							<a href="<?php echo esc_url( $product_permalink ); ?>">
								<?php echo sprintf('%s',$thumbnail) . '<span>'.wp_kses_post( $product_name ).'</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</a>
						<?php endif; ?>
						<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s ', $product_price ) . '</span> <div class="quantity-number">'. sprintf( ' &times; %s', $cart_item['quantity'] ) . '</div>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</li>
					<?php
				}
			}

			do_action( 'woocommerce_mini_cart_contents' );
			?>
		</ul>
	</div>
	<div class="minicar-footer">
		<p class="woocommerce-mini-cart__total total">
			<?php
			/**
			 * Hook: woocommerce_widget_shopping_cart_total.
			 *
			 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
			 */
			do_action( 'woocommerce_widget_shopping_cart_total' );
			?>
		</p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

		<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
		<?php
			$amount   = 0;
			$requires = '';
			$discount = false;
			$cart     = WC()->cart;
			if ( $cart ) {
				$packages = $cart->get_shipping_packages();
				$package  = reset( $packages );
				$zone     = wc_get_shipping_zone( $package );
				foreach ( $zone->get_shipping_methods( true ) as $key => $method ) {
					if ( 'free_shipping' === $method->id ) {
						$instance = isset( $method->instance_settings ) ? $method->instance_settings : null;
						$amount   = isset( $instance['min_amount'] ) ? $instance['min_amount'] : 0;
						$requires = isset( $instance['requires'] ) ? $instance['requires'] : '';
						$discount = isset( $instance['ignore_discounts'] ) && 'yes' === $instance['ignore_discounts'] ? true : false;
						break;
					}
				}


				$cart_total    = $cart->get_displayed_subtotal();
				// $discount      = $cart->get_discount_total();
				// $discount_tax  = $cart->get_discount_tax();
				// $price_inc_tax = $cart->display_prices_including_tax();
				// $price_decimal = wc_get_price_decimals();

				$remaining = $amount - $cart_total;
				if($amount != 0) {
					$percent   = 100 - ( $remaining / $amount ) * 100;
				}
				// $percent   = 100 - ( $remaining / $amount ) * 100;
				$initial_text  ="Get free shipping for orders over <span> $" . $amount. '</span>';
				$progress_text ="You're <span> $" .$remaining . "</span> away from free shipping.";
				$success_text  = "Your order qualifies for free shipping!";

				$shipping_bar = '';
				if($amount != 0) {
					if ( $cart_total < $amount ) {
						if ( 50 >= $percent ) {
							$progress_text = $initial_text;
						}
						$shipping_bar .= '<div class="tf-progessbar ">';
						$shipping_bar .= '<div class="tf-progressbar-content">';
						$shipping_bar .= '<span class="tf-amount" style="width:' . esc_attr( $percent ) . '%;"></span>';
						$shipping_bar .= '</div>';
						$shipping_bar .= '<div class="tf-notice"><svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6.5 13H4.5C4.224 13 4 12.776 4 12.5C4 12.224 4.224 12 4.5 12H6.5C6.776 12 7 12.224 7 12.5C7 12.776 6.776 13 6.5 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M22.7499 13H21.4999C21.2239 13 20.9999 12.776 20.9999 12.5C20.9999 12.224 21.2239 12 21.4999 12H22.3349L23.0089 8.40801C22.9999 6.57 21.4299 5 19.4999 5H16.2169L14.6259 12H17.4999C17.7759 12 17.9999 12.224 17.9999 12.5C17.9999 12.776 17.7759 13 17.4999 13H13.9999C13.8479 13 13.7039 12.931 13.6089 12.812C13.5139 12.694 13.4779 12.538 13.5119 12.39L15.3299 4.39C15.3819 4.161 15.5839 4 15.8179 4H19.4999C21.9809 4 23.9999 6.019 23.9999 8.50001L23.2409 12.592C23.1969 12.829 22.9909 13 22.7499 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M19.5 15C18.122 15 17 13.879 17 12.5C17 11.121 18.122 10 19.5 10C20.878 10 22 11.121 22 12.5C22 13.879 20.878 15 19.5 15ZM19.5 11C18.673 11 18 11.673 18 12.5C18 13.327 18.673 14 19.5 14C20.327 14 21 13.327 21 12.5C21 11.673 20.327 11 19.5 11Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M8.5 15C7.122 15 6 13.879 6 12.5C6 11.121 7.122 10 8.5 10C9.878 10 11 11.121 11 12.5C11 13.879 9.878 15 8.5 15ZM8.5 11C7.673 11 7 11.673 7 12.5C7 13.327 7.673 14 8.5 14C9.327 14 10 13.327 10 12.5C10 11.673 9.327 11 8.5 11Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M6.5 4.00001H2.5C2.224 4.00001 2 3.776 2 3.5C2 3.224 2.224 3 2.5 3H6.5C6.776 3 7 3.224 7 3.5C7 3.776 6.776 4.00001 6.5 4.00001Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M6.5 6.99999H1.5C1.224 6.99999 1 6.77599 1 6.5C1 6.224 1.224 6 1.5 6H6.5C6.776 6 7 6.224 7 6.5C7 6.77599 6.776 6.99999 6.5 6.99999Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M6.49999 9.99999H0.5C0.224 9.99999 0 9.77599 0 9.5C0 9.224 0.224 9 0.5 9H6.49999C6.77599 9 6.99999 9.224 6.99999 9.5C6.99999 9.77599 6.77599 9.99999 6.49999 9.99999Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M14 13H10.5C10.224 13 10 12.776 10 12.5C10 12.224 10.224 12 10.5 12H13.601L15.873 2H4.5C4.224 2 4 1.776 4 1.5C4 1.224 4.224 1 4.5 1H16.5C16.652 1 16.796 1.069 16.891 1.188C16.986 1.306 17.022 1.462 16.988 1.61L14.488 12.61C14.436 12.839 14.233 13 14 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						</svg>' . wp_kses_post( $progress_text);
						$shipping_bar .= '</div></div>';
					} else {
						$shipping_bar .= '<div class="tf-progessbar ">';
						$shipping_bar .= '<div class="tf-progressbar-content">';
						$shipping_bar .= '<span class="tf-amount" style="width:100%;"></span>';
						$shipping_bar .= '</div>';
						$shipping_bar .= '<div class="tf-notice"><svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6.5 13H4.5C4.224 13 4 12.776 4 12.5C4 12.224 4.224 12 4.5 12H6.5C6.776 12 7 12.224 7 12.5C7 12.776 6.776 13 6.5 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M22.7499 13H21.4999C21.2239 13 20.9999 12.776 20.9999 12.5C20.9999 12.224 21.2239 12 21.4999 12H22.3349L23.0089 8.40801C22.9999 6.57 21.4299 5 19.4999 5H16.2169L14.6259 12H17.4999C17.7759 12 17.9999 12.224 17.9999 12.5C17.9999 12.776 17.7759 13 17.4999 13H13.9999C13.8479 13 13.7039 12.931 13.6089 12.812C13.5139 12.694 13.4779 12.538 13.5119 12.39L15.3299 4.39C15.3819 4.161 15.5839 4 15.8179 4H19.4999C21.9809 4 23.9999 6.019 23.9999 8.50001L23.2409 12.592C23.1969 12.829 22.9909 13 22.7499 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M19.5 15C18.122 15 17 13.879 17 12.5C17 11.121 18.122 10 19.5 10C20.878 10 22 11.121 22 12.5C22 13.879 20.878 15 19.5 15ZM19.5 11C18.673 11 18 11.673 18 12.5C18 13.327 18.673 14 19.5 14C20.327 14 21 13.327 21 12.5C21 11.673 20.327 11 19.5 11Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M8.5 15C7.122 15 6 13.879 6 12.5C6 11.121 7.122 10 8.5 10C9.878 10 11 11.121 11 12.5C11 13.879 9.878 15 8.5 15ZM8.5 11C7.673 11 7 11.673 7 12.5C7 13.327 7.673 14 8.5 14C9.327 14 10 13.327 10 12.5C10 11.673 9.327 11 8.5 11Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M6.5 4.00001H2.5C2.224 4.00001 2 3.776 2 3.5C2 3.224 2.224 3 2.5 3H6.5C6.776 3 7 3.224 7 3.5C7 3.776 6.776 4.00001 6.5 4.00001Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M6.5 6.99999H1.5C1.224 6.99999 1 6.77599 1 6.5C1 6.224 1.224 6 1.5 6H6.5C6.776 6 7 6.224 7 6.5C7 6.77599 6.776 6.99999 6.5 6.99999Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M6.49999 9.99999H0.5C0.224 9.99999 0 9.77599 0 9.5C0 9.224 0.224 9 0.5 9H6.49999C6.77599 9 6.99999 9.224 6.99999 9.5C6.99999 9.77599 6.77599 9.99999 6.49999 9.99999Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						<path d="M14 13H10.5C10.224 13 10 12.776 10 12.5C10 12.224 10.224 12 10.5 12H13.601L15.873 2H4.5C4.224 2 4 1.776 4 1.5C4 1.224 4.224 1 4.5 1H16.5C16.652 1 16.796 1.069 16.891 1.188C16.986 1.306 17.022 1.462 16.988 1.61L14.488 12.61C14.436 12.839 14.233 13 14 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
						</svg>' . wp_kses_post( $success_text ) . '</div>';
						$shipping_bar .= '</div>';
					}
					echo $shipping_bar;
				}
			}

			
		?>
	</div>

<?php else : ?>

	<svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M80.6344 72.6641H33.3641C32.8541 72.6646 32.3525 72.5345 31.907 72.2864C31.4615 72.0383 31.0869 71.6803 30.8188 71.2465C30.5507 70.8127 30.398 70.3176 30.3753 69.8081C30.3526 69.2987 30.4606 68.7919 30.6891 68.336L33.4656 62.7844C33.6401 62.4347 33.678 62.0325 33.5719 61.6563L22.0563 21.361C21.7786 20.4019 21.1977 19.5587 20.4005 18.9575C19.6033 18.3564 18.6328 18.0298 17.6344 18.0266H7.78282C7.36822 18.0266 6.97059 18.1913 6.67742 18.4845C6.38425 18.7777 6.21954 19.1753 6.21954 19.5899C6.21954 20.0045 6.38425 20.4021 6.67742 20.6953C6.97059 20.9885 7.36822 21.1532 7.78282 21.1532H17.6359C17.9554 21.1542 18.2658 21.2587 18.5208 21.4511C18.7758 21.6436 18.9615 21.9135 19.05 22.2204L30.3984 61.9313L27.8922 66.9391C27.4257 67.8717 27.2054 68.9081 27.2523 69.9497C27.2991 70.9914 27.6115 72.0038 28.1598 72.8908C28.7081 73.7777 29.4741 74.5098 30.3849 75.0173C31.2958 75.5249 32.3213 75.7911 33.3641 75.7907H80.6344C81.0488 75.7907 81.4462 75.6261 81.7392 75.333C82.0323 75.04 82.1969 74.6426 82.1969 74.2282C82.1969 73.8138 82.0323 73.4163 81.7392 73.1233C81.4462 72.8303 81.0488 72.6641 80.6344 72.6641Z" fill="#73787D"/>
		<path d="M93.175 25.3828C92.8884 24.9852 92.5114 24.6615 92.0751 24.4382C91.6388 24.2149 91.1557 24.0984 90.6656 24.0984H27.7266C27.3122 24.0984 26.9147 24.263 26.6217 24.556C26.3287 24.8491 26.1641 25.2465 26.1641 25.6609C26.1641 26.0753 26.3287 26.4727 26.6217 26.7657C26.9147 27.0588 27.3122 27.2234 27.7266 27.2234L90.625 27.1718L85.5781 42.3125H32.9312C32.5168 42.3125 32.1194 42.4771 31.8264 42.7701C31.5334 43.0631 31.3687 43.4606 31.3687 43.875C31.3687 44.2894 31.5334 44.6868 31.8264 44.9798C32.1194 45.2728 32.5168 45.4375 32.9312 45.4375H84.5359L79.5078 60.5234H38.1375C37.7229 60.5234 37.3253 60.6881 37.0321 60.9813C36.7389 61.2744 36.5742 61.6721 36.5742 62.0867C36.5742 62.5013 36.7389 62.8989 37.0321 63.1921C37.3253 63.4852 37.7229 63.6499 38.1375 63.6499H80.6344C80.9624 63.65 81.2822 63.5468 81.5484 63.355C81.8145 63.1632 82.0135 62.8925 82.1172 62.5812L93.5875 28.1671C93.7438 27.7037 93.7879 27.2099 93.7162 26.7261C93.6445 26.2423 93.459 25.7809 93.175 25.3828ZM32.0672 78.7343C21.9781 79.0562 21.9797 93.6843 32.0672 94.0031C42.1562 93.6828 42.1531 79.0515 32.0672 78.7343ZM32.0672 90.8765C30.8716 90.8765 29.7251 90.4016 28.8797 89.5562C28.0343 88.7108 27.5594 87.5642 27.5594 86.3687C27.5594 85.1732 28.0343 84.0266 28.8797 83.1812C29.7251 82.3358 30.8716 81.8609 32.0672 81.8609C33.2627 81.8609 34.4093 82.3358 35.2547 83.1812C36.1001 84.0266 36.575 85.1732 36.575 86.3687C36.575 87.5642 36.1001 88.7108 35.2547 89.5562C34.4093 90.4016 33.2627 90.8765 32.0672 90.8765ZM74.5625 78.7343C64.4734 79.0546 64.475 93.6843 74.5625 94.0031C84.6531 93.6828 84.65 79.0531 74.5625 78.7343ZM74.5625 90.8765C73.367 90.8765 72.2204 90.4016 71.375 89.5562C70.5296 88.7108 70.0547 87.5642 70.0547 86.3687C70.0547 85.1732 70.5296 84.0266 71.375 83.1812C72.2204 82.3358 73.367 81.8609 74.5625 81.8609C75.758 81.8609 76.9046 82.3358 77.75 83.1812C78.5954 84.0266 79.0703 85.1732 79.0703 86.3687C79.0703 87.5642 78.5954 88.7108 77.75 89.5562C76.9046 90.4016 75.758 90.8765 74.5625 90.8765Z" fill="#73787D"/>
		<path d="M57.8016 15.375C58.216 15.375 58.6134 15.2103 58.9064 14.9173C59.1995 14.6243 59.3641 14.2269 59.3641 13.8125V7.55933C59.3641 7.14492 59.1995 6.7475 58.9064 6.45447C58.6134 6.16145 58.216 5.99683 57.8016 5.99683C57.3872 5.99683 56.9897 6.16145 56.6967 6.45447C56.4037 6.7475 56.2391 7.14492 56.2391 7.55933V13.8125C56.2391 14.2269 56.4037 14.6243 56.6967 14.9173C56.9897 15.2103 57.3872 15.375 57.8016 15.375ZM43.4328 20.4109C43.578 20.5561 43.7503 20.6712 43.94 20.7498C44.1297 20.8284 44.333 20.8688 44.5383 20.8688C44.7436 20.8688 44.9469 20.8284 45.1366 20.7498C45.3262 20.6712 45.4986 20.5561 45.6438 20.4109C45.7889 20.2657 45.9041 20.0934 45.9827 19.9037C46.0612 19.714 46.1017 19.5107 46.1017 19.3054C46.1017 19.1001 46.0612 18.8968 45.9827 18.7071C45.9041 18.5175 45.7889 18.3451 45.6438 18.2L41.2219 13.7796C40.9287 13.4867 40.5311 13.3221 40.1166 13.3223C39.7022 13.3224 39.3047 13.4872 39.0117 13.7804C38.7188 14.0736 38.5542 14.4712 38.5544 14.8857C38.5545 15.3001 38.7193 15.6976 39.0125 15.9906L43.4328 20.4109ZM71.0656 20.8687C71.2708 20.8689 71.4741 20.8286 71.6637 20.75C71.8532 20.6714 72.0254 20.5562 72.1703 20.4109L76.5922 15.989C76.8852 15.6958 77.0497 15.2983 77.0495 14.8838C77.0494 14.4693 76.8846 14.0718 76.5914 13.7789C76.2982 13.4859 75.9007 13.3214 75.4862 13.3215C75.0717 13.3217 74.6742 13.4865 74.3813 13.7796L69.9594 18.2015C69.746 18.4221 69.6018 18.7002 69.5445 19.0017C69.4872 19.3032 69.5194 19.6148 69.6369 19.8983C69.7545 20.1817 69.9524 20.4246 70.2062 20.597C70.4601 20.7695 70.7588 20.8639 71.0656 20.8687Z" fill="#73787D"/>
	</svg>

	<h4 class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'Your cart is curently empty', 'onsus' ); ?></h4>
	<h4 class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'Let up help you find the perfect item', 'onsus' ); ?></h4>
	<?php $url = home_url( '/' ); ?>
	<a class="btn-shop-all themesflat-button" href="<?php echo esc_attr($url).'shop' ?>./shop"><?php esc_html_e( 'Shop All', 'onsus' ); ?></a>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>

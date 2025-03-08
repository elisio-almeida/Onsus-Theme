<?php
// Cart Icon
if ( class_exists( 'woocommerce' ) ) { ?>
    <div class="header-cart-wrapper">
        <a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ) ?>">
            <div class="icon"><?php echo themesflat_svg('cart_all'); ?></div>
            <?php if ( $items_count = WC()->cart->get_cart_contents_count() ): ?>
                <span class="shopping-cart-items-count"><?php echo esc_html( $items_count ) ?></span>
            <?php else: ?>
                <span class="shopping-cart-items-count">0</span>
            <?php endif ?>
            
        </a>
        <div class="text"><?php echo esc_html__('Your cart:', 'onsus') ?></div>

        <div class="minicar-overlay"></div>
        <div class="nav-shop-cart">            
            <div class="minicar-header">
                <span class="title"><?php echo esc_html__('Your cart', 'onsus') ?></span>
                <span class="minicart-close"></span>     
            </div> 
            <div class="widget_shopping_cart_content">      	
                <?php woocommerce_mini_cart(); ?>
            </div>
        </div>
    </div>

<?php  } ?>

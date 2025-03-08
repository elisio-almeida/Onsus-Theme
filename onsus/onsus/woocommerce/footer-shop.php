<?php 

?>
<div class="footer-shop">
    <div class="item">
        <?php $url = home_url( '/' ); ?>
        <a href="<?php echo  $url.'shop';?>" class="link">
            <?php echo themesflat_svg( 'shopft' ); ?>
            <div class="text"><?php esc_html_e( 'Shop', 'onsus' ); ?></div>
        </a>
    </div>
    <div class="item">
        <?php if ( class_exists( 'YITH_WCWL' ) ) { ?>
            <div class="header-wishlist-wrapper">
                <a class="nav-wishlist-trigger" href="<?php echo esc_url( htmlspecialchars( YITH_WCWL()->get_wishlist_url() ) ); ?>" >
                    <div>
                        <?php echo themesflat_svg( 'wishlistft' ); ?>
                        
                        <?php if ( yith_wcwl_count_all_products() ): ?>
                            <span class="wishlist-items-count"><?php echo yith_wcwl_count_all_products(); ?></span>
                        <?php else: ?>
                            <span class="wishlist-items-count">0</span>
                        <?php endif ?>
                    </div>
                    <div class="text"><?php esc_html_e( 'Wishlist', 'onsus' ); ?></div>
                </a>
            </div>

        <?php  } ?>
    </div>
    <div class="item cart">
    <?php
        // Cart Icon
        if ( class_exists( 'woocommerce' ) ) { ?>
            <div class="header-cart-wrapper">
                <a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ) ?>">
                    <div>
                        <?php echo themesflat_svg( 'cartft' ); ?>
                        <?php if ( $items_count = WC()->cart->get_cart_contents_count() ): ?>
                            <span class="shopping-cart-items-count"><?php echo esc_html( $items_count ) ?></span>
                        <?php else: ?>
                            <span class="shopping-cart-items-count">0</span>
                        <?php endif ?>
                    </div>
                    
                </a>
                <div class="text"><?php esc_html_e( 'Cart', 'onsus' ); ?></div>

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
    </div>
    <div class="item account">
        

        <?php global $current_user; wp_get_current_user(); ?>

        <?php $url = home_url( '/' ); ?>
        
        <?php
            if ( is_user_logged_in() ) { 
                echo '<div class="sign-in">'
                .themesflat_svg( 'accountft' ).'
                        <a class="text" href="'. $url.'my-account'.'">' . esc_html__('Account', 'onsus') .'</a>
                    </div>';
                
            } else {
                
                echo '<div class="sign-in">'
                .themesflat_svg( 'accountft' ).'
                        <div class="text" >' . esc_html__('Account', 'onsus') .'</div>
                    </div>';
            }
        ?>
    </div>
    <div class="item">
        <a href="#" class="link btn-search">
            <?php echo themesflat_svg( 'searchft' ); ?>
            <div class="text"><?php esc_html_e( 'Search', 'onsus' ); ?></div>
        </a>
    </div>
</div>
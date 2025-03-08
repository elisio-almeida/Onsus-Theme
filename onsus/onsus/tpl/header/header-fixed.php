<?php 
$header_search_box = themesflat_get_opt('header_search_box');
if (themesflat_get_opt_elementor('header_search_box') != '') {
    $header_search_box = themesflat_get_opt_elementor('header_search_box');
}

$header_cart_icon = themesflat_get_opt('header_cart_icon');
if (themesflat_get_opt_elementor('header_cart_icon') != '') {
    $header_cart_icon = themesflat_get_opt_elementor('header_cart_icon');
}

$header_compare_icon = themesflat_get_opt('header_compare_icon');
if (themesflat_get_opt_elementor('header_compare_icon') != '') {
    $header_compare_icon = themesflat_get_opt_elementor('header_compare_icon');
}


$header_wishlist_icon = themesflat_get_opt('header_wishlist_icon');
if (themesflat_get_opt_elementor('header_wishlist_icon') != '') {
    $header_wishlist_icon = themesflat_get_opt_elementor('header_wishlist_icon');
}


$header_sidebar_toggler = themesflat_get_opt('header_sidebar_toggler');
if (themesflat_get_opt_elementor('header_sidebar_toggler') != '') {
    $header_sidebar_toggler = themesflat_get_opt_elementor('header_sidebar_toggler');
}

$header_button_show = themesflat_get_opt('header_button_show');
if (themesflat_get_opt_elementor('header_button_show') != '') {
    $header_button_show = themesflat_get_opt_elementor('header_button_show');
}
?>
<div id="header-fixed-wrap" class="header-fixed-wrap">
    <div class="inner-header">  
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-wrap clearfix">
                        <div class="header-ct-left">
                            <?php get_template_part( 'tpl/header/brand-fixed'); ?>
                        </div>
                        <div class="header-ct-center">
                            <?php if ( $header_search_box == 1 ) :?>                                
                                <?php get_template_part( 'tpl/header/search-form'); ?>
                            <?php endif;?>
                        </div>
                        <div class="header-ct-right">
                            
                           <div class="list-wrap-btn">
                                
                                <?php if ( $header_wishlist_icon == 1 ) :?>
                                    <div class="wishlist-btn">
                                        <?php get_template_part( 'tpl/header/header-wishlist'); ?>
                                    </div>
                                <?php endif;?>

                                <?php global $current_user; wp_get_current_user(); 

                                $url = home_url( '/' );
                                    if ( is_user_logged_in() ) { 
                                        echo '<div class="sign-in login">
                                                <a class="icon" href="'. $url.'my-account'.'">'.themesflat_svg('admin_all').'</a>
                                            </div>';
                                        
                                    } else {
                                        
                                        echo '<div class="sign-in">
                                                <div class="icon">'.themesflat_svg('admin_all').'</div>
                                            </div>';
                                    }
                                ?>
                               
                                <?php if ( $header_cart_icon == 1 ) :?>
                                <?php    if ( class_exists( 'woocommerce' ) ) { ?>
                                    <div class="header-cart-wrapper">
                                        <a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ) ?>">
                                            <div class="icon"><?php echo themesflat_svg('cart_all'); ?></div>
                                            <?php if ( $items_count = WC()->cart->get_cart_contents_count() ): ?>
                                                <span class="shopping-cart-items-count"><?php echo esc_html( $items_count ) ?></span>
                                            <?php else: ?>
                                                <span class="shopping-cart-items-count">0</span>
                                            <?php endif ?>
                                            
                                        </a>
                                        <div class="minicar-overlay"></div>
                                        <div class="nav-shop-cart">            
                                            <div class="minicar-header">
                                                <span class="title"><?php echo esc_html__('Shop Cart', 'onsus') ?></span>
                                                <span class="minicart-close"></span>     
                                            </div> 
                                            <div class="widget_shopping_cart_content">      	
                                                <?php woocommerce_mini_cart(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php  } ?>
                            <?php endif;?>
                           </div>

                           

                            <div class="btn-menu btn-toogle-bottom">
                                <span class="line-1"></span>
                            </div><!-- //mobile menu button -->

                            <div class="btn-menu">
                                <span class="line-1"></span>
                            </div><!-- //mobile menu button -->
                        </div>
                    </div>                
                </div><!-- /.col-md-12 -->
                
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
    <div class="header-bottom">  
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-bottom-inner clearfix">
                        <div class="header-ct-left">
                            <?php get_template_part( 'tpl/header/category-menu'); ?>

                        </div>
                        <div class="header-ct-center">                            
                            <?php get_template_part( 'tpl/header/navigator'); ?>
                        </div>
                        <div class="header-ct-right">
                           
                            <div class="header-infor">
                                <div class="icon"><i class="onsus-icon-support"></i></div>
                                <div class="content">
                                    
                                        <?php if(themesflat_get_opt_elementor('header_info_phone_number') != '' || themesflat_get_opt('header_info_phone_number') != '' ): ?>
                                        <div class="phone">
                                            <?php echo wp_kses(themesflat_get_opt('header_info_phone_text'), themesflat_kses_allowed_html()); ?>
                                            <span><?php  if (themesflat_get_opt_elementor('header_info_phone_number') != '') {
                                                echo themesflat_get_opt_elementor('header_info_phone_number');
                                            }else {
                                                echo themesflat_get_opt('header_info_phone_number');
                                            }  ?></span>
                                        </div>
                                        <?php endif; ?>

                                        <?php if(themesflat_get_opt_elementor('header_email') != '' || themesflat_get_opt('header_email') != '' ): ?>
                                        <div class="email">
                                            <?php echo wp_kses(themesflat_get_opt('header_email_label'), themesflat_kses_allowed_html()); ?>
                                            <span><?php
                                            if (themesflat_get_opt_elementor('header_email') != '') {
                                                echo themesflat_get_opt_elementor('header_email');
                                            }else {
                                                echo themesflat_get_opt('header_email');
                                            }  ?></span>
                                        </div>
                                        <?php endif; ?>
                                </div>
                            </div>
                           

                            
                        </div>
                    </div>                
                </div><!-- /.col-md-12 -->
                
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
</div><!-- /.header fixed --> 
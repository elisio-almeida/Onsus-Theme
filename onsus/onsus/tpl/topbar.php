<?php 

$style_header = themesflat_get_opt('style_header');
if (themesflat_get_opt_elementor('style_header') != '') {
    $style_header = themesflat_get_opt_elementor('style_header');
}
$topbar = themesflat_get_opt('topbar_show');
if (themesflat_get_opt_elementor('topbar_show') != '') {
    $topbar = themesflat_get_opt_elementor('topbar_show');
}

$header_currency = themesflat_get_opt('header_currency');
if (themesflat_get_opt_elementor('header_currency') != '') {
    $header_currency = themesflat_get_opt_elementor('header_currency');
}

$menu_topbar = themesflat_get_opt('menu_topbar');
if (themesflat_get_opt_elementor('menu_topbar') != '') {
    $menu_topbar = themesflat_get_opt_elementor('menu_topbar');
}

$profile_topbar = themesflat_get_opt('profile_topbar');
if (themesflat_get_opt_elementor('profile_topbar') != '') {
    $profile_topbar = themesflat_get_opt_elementor('profile_topbar');
}

$language_topbar = themesflat_get_opt('language_topbar');
if (themesflat_get_opt_elementor('language_topbar') != '') {
    $language_topbar = themesflat_get_opt_elementor('language_topbar');
}


$currency_topbar = themesflat_get_opt('currency_topbar');
if (themesflat_get_opt_elementor('currency_topbar') != '') {
    $currency_topbar = themesflat_get_opt_elementor('currency_topbar');
}

$ship_topbar = themesflat_get_opt('ship_topbar');
if (themesflat_get_opt_elementor('ship_topbar') != '') {
    $ship_topbar = themesflat_get_opt_elementor('ship_topbar');
}

if (themesflat_get_opt_elementor('topbar_ship') != '') {
    $ship_topbar_text = themesflat_get_opt_elementor('topbar_ship');
}else {
    $ship_topbar_text = themesflat_get_opt('topbar_ship');
}


if ( $topbar != 1 ) return;
?>
<!-- Topbar -->
    <div class="themesflat-top">    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-inside">
                        <div class="content-left">
                            <ul class="flat-information">
                               
                                <?php if(themesflat_get_opt_elementor('topbar_phone') != '' || themesflat_get_opt('topbar_phone') != '' ): ?>
                                <li class="phone">
                                    <?php echo wp_kses(themesflat_get_opt('topbar_phone_label'), themesflat_kses_allowed_html()); ?>
                                    <span><?php
                                    if (themesflat_get_opt_elementor('topbar_phone') != '') {
                                        echo themesflat_get_opt_elementor('topbar_phone');
                                    }else {
                                        echo themesflat_get_opt('topbar_phone');
                                    }  ?></span>
                                </li>
                                <?php endif; ?>
                                <?php //if(themesflat_get_opt_elementor('topbar_email') != '' || themesflat_get_opt('topbar_email') != '' ): ?>
                                <!-- <li class="phone">
                                    <?php //echo wp_kses(themesflat_get_opt('topbar_email_label'), themesflat_kses_allowed_html()); ?>
                                    <span><?php  //if (themesflat_get_opt_elementor('topbar_email') != '') {
                                       // echo themesflat_get_opt_elementor('topbar_email');
                                   // }else {
                                       // echo themesflat_get_opt('topbar_email');
                                    //}  ?></span>
                                </li> -->
                                <?php //endif; ?>
                                <?php if ( $ship_topbar == 1 || themesflat_get_opt_elementor('topbar_ship') != ''): ?>
                                <li>
                                    <?php
                                    if ( class_exists( 'woocommerce' ) ) { 
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
                                            $initial_text  = $ship_topbar_text . "<span> $" . $amount. '</span>';

                                            $shipping_bar = '';
                                            if($amount != 0) {
                                                // if ( $cart_total < $amount ) {
                                                
                                                    $shipping_bar .= '<div class="tf-notice"><svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6.5 13H4.5C4.224 13 4 12.776 4 12.5C4 12.224 4.224 12 4.5 12H6.5C6.776 12 7 12.224 7 12.5C7 12.776 6.776 13 6.5 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
                                                    <path d="M22.7499 13H21.4999C21.2239 13 20.9999 12.776 20.9999 12.5C20.9999 12.224 21.2239 12 21.4999 12H22.3349L23.0089 8.40801C22.9999 6.57 21.4299 5 19.4999 5H16.2169L14.6259 12H17.4999C17.7759 12 17.9999 12.224 17.9999 12.5C17.9999 12.776 17.7759 13 17.4999 13H13.9999C13.8479 13 13.7039 12.931 13.6089 12.812C13.5139 12.694 13.4779 12.538 13.5119 12.39L15.3299 4.39C15.3819 4.161 15.5839 4 15.8179 4H19.4999C21.9809 4 23.9999 6.019 23.9999 8.50001L23.2409 12.592C23.1969 12.829 22.9909 13 22.7499 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
                                                    <path d="M19.5 15C18.122 15 17 13.879 17 12.5C17 11.121 18.122 10 19.5 10C20.878 10 22 11.121 22 12.5C22 13.879 20.878 15 19.5 15ZM19.5 11C18.673 11 18 11.673 18 12.5C18 13.327 18.673 14 19.5 14C20.327 14 21 13.327 21 12.5C21 11.673 20.327 11 19.5 11Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
                                                    <path d="M8.5 15C7.122 15 6 13.879 6 12.5C6 11.121 7.122 10 8.5 10C9.878 10 11 11.121 11 12.5C11 13.879 9.878 15 8.5 15ZM8.5 11C7.673 11 7 11.673 7 12.5C7 13.327 7.673 14 8.5 14C9.327 14 10 13.327 10 12.5C10 11.673 9.327 11 8.5 11Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
                                                    <path d="M6.5 4.00001H2.5C2.224 4.00001 2 3.776 2 3.5C2 3.224 2.224 3 2.5 3H6.5C6.776 3 7 3.224 7 3.5C7 3.776 6.776 4.00001 6.5 4.00001Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
                                                    <path d="M6.5 6.99999H1.5C1.224 6.99999 1 6.77599 1 6.5C1 6.224 1.224 6 1.5 6H6.5C6.776 6 7 6.224 7 6.5C7 6.77599 6.776 6.99999 6.5 6.99999Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
                                                    <path d="M6.49999 9.99999H0.5C0.224 9.99999 0 9.77599 0 9.5C0 9.224 0.224 9 0.5 9H6.49999C6.77599 9 6.99999 9.224 6.99999 9.5C6.99999 9.77599 6.77599 9.99999 6.49999 9.99999Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
                                                    <path d="M14 13H10.5C10.224 13 10 12.776 10 12.5C10 12.224 10.224 12 10.5 12H13.601L15.873 2H4.5C4.224 2 4 1.776 4 1.5C4 1.224 4.224 1 4.5 1H16.5C16.652 1 16.796 1.069 16.891 1.188C16.986 1.306 17.022 1.462 16.988 1.61L14.488 12.61C14.436 12.839 14.233 13 14 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
                                                    </svg>' . wp_kses_post( $initial_text);
                                                    $shipping_bar .= '</div>';
                                                // } 
                                                echo $shipping_bar;
                                            }
                                        }

                                    }
                                    
                                    ?>
                                </li>
                                <?php  endif; ?> 

                                
                            </ul>
                        </div><!-- content-left -->

                        <div class="content-right">
                            <?php if ( $currency_topbar == 1 ): ?>
                            <?php if(class_exists('XCurrency')) { ?>
                                <div class="tf-money">
                                    <span class="icon"><i class="onsus-icon-usd"></i></span>
                                    <span><?php echo esc_html__('Currency:', 'onsus') ?></span>
                                    <?php //themesflat_money_switch(); ?>                                
                                    <?php echo do_shortcode($header_currency)?>
                                </div>
                            <?php } ?>
                            <?php  endif; ?> 
                            <?php if ( $language_topbar == 1 ): ?>
                            <div class="tf-language">
                                <span class="icon"><i class="onsus-icon-language"></i></span>
                                <span><?php echo esc_html__('Language:', 'onsus') ?></span>
                                <?php themesflat_language_switch(); ?>
                            </div>
                            <?php  endif; ?> 

                            <?php if ( $profile_topbar == 1 ): ?>
                            <div class="tf-account">
                                <?php global $current_user; wp_get_current_user(); ?>

                                <?php $url = home_url( '/' ); ?>
                                
                                <?php
                                    if ( is_user_logged_in() ) { 
                                        echo '<div class="sign-in">
                                                <span class="icon">'.themesflat_svg('admin_all').'</i></span> 
                                                <a class="text" href="'. $url.'my-account'.'">' . esc_html__('Welcome,', 'onsus') . '<span>' . $current_user->display_name . "" .'</span></a>
                                            </div>';
                                        
                                    } else {
                                        
                                        echo '<div class="sign-in">
                                                <span class="icon">'.themesflat_svg('admin_all').'</span>
                                                <a class="text" href="#">' . esc_html__('Sign In', 'onsus') .'</a>
                                            </div>';
                                    }
                                ?>

                                <!-- <div class="flat-language account">
                                    <?php //$url = home_url( '/' ); ?>
                                    <ul class="unstyled">
                                        <li class="current"> 
                                            <a href="<?php //echo esc_attr($url).'my-account' ?>"> <?php //echo esc_html__("My account",'onsus');?></a>  
                                            <ul class="unstyled-child">
                                            <li >
                                                <a href="<?php //echo esc_attr($url).'my-account' ?>"> <?php //echo esc_html__("My account",'onsus');?></a>  
                                            </li>
                                            <li >
                                                <a href="<?php //echo esc_attr($url).'my-account/orders' ?>"> <?php //echo esc_html__("My orders",'onsus');?></a>  
                                            </li>
                                            <li>
                                                <a href="<?php //echo esc_attr($url).'wishlist' ?>"> <?php //echo esc_html__("My wishlist",'onsus');?></a>   
                                            </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>   -->
                            </div>
                            <?php  endif; ?> 

                            <?php  
                                if ( themesflat_get_opt('social_topbar') == 1 ):
                                    themesflat_render_social();    
                                endif;
                            ?>
                            <?php  
                            if ( $menu_topbar == 1 ): ?>
                            <div class="nav-wrap">
                                <nav id="topbar-menu" class="topbar-menu" role="navigation">
                                    <?php
                                        wp_nav_menu( array( 'theme_location' => 'topbar', 'fallback_cb' => 'themesflat_menu_fallback', 'container' => false ) );
                                    ?>
                                </nav><!-- #site-navigation -->  
                            </div><!-- /.nav-wrap -->   
                            <?php  endif; ?>                            
        
                        </div><!-- content-right -->
                    </div><!-- /.container-inside -->
                </div>
            </div>
        </div><!-- /.container -->        
    </div><!-- /.topbar -->

<?php 
$header_search_box = themesflat_get_opt('header_search_box');
if (themesflat_get_opt_elementor('header_search_box') != '') {
    $header_search_box = themesflat_get_opt_elementor('header_search_box');
}

$header_category = themesflat_get_opt('header_category');
if (themesflat_get_opt_elementor('header_category') != '') {
    $header_category = themesflat_get_opt_elementor('header_category');
}

$header_cart_icon = themesflat_get_opt('header_cart_icon');
if (themesflat_get_opt_elementor('header_cart_icon') != '') {
    $header_cart_icon = themesflat_get_opt_elementor('header_cart_icon');
}

$header_cart_icon2 = themesflat_get_opt('header_cart_icon2');
if (themesflat_get_opt_elementor('header_cart_icon2') != '') {
    $header_cart_icon2 = themesflat_get_opt_elementor('header_cart_icon2');
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

$ship_header = themesflat_get_opt('ship_header');
if (themesflat_get_opt_elementor('ship_header') != '') {
    $ship_header = themesflat_get_opt_elementor('ship_header');
}

if (themesflat_get_opt_elementor('header_ship') != '') {
    $ship_header_text = themesflat_get_opt_elementor('header_ship');
}else {
    $ship_header_text = themesflat_get_opt('header_ship');
}

?>
<?php get_template_part( 'tpl/topbar'); ?>
<header id="header" class="header header-03 <?php echo themesflat_get_opt_elementor('extra_classes_header'); ?>">
    <div class="inner-header">  
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-wrap clearfix">
                        <div class="header-ct-left">
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
                               <?php if ( $ship_header == 1 || themesflat_get_opt_elementor('ship_header') != ''): ?>
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
                                           $initial_text  = $ship_header_text . "<span> $" . $amount. '</span>';

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
                        </div>
                        <div class="header-ct-center">

                            <?php get_template_part( 'tpl/header/brand'); ?>
                        </div>
                        <div class="header-ct-right">
                           
                            
                            
                        <?php if ( $header_compare_icon == 1 ) :?>
                            <?php    if ( class_exists( 'WPCleverWoosc' ) ) { ?>
                            <div class="header-shop-compare woosc-menu-item menu-item-type-woosc"> <?php $url = home_url( '/' ); ?><a href="<?php echo esc_attr($url).'wishlist' ?>" class="open-compare-btn " data-label="Compare"><?php echo themesflat_svg('compare2'); ?><span class="woosc-menu-item-inner" data-count=""></span></a></div>
                            <?php  } ?>
                            <?php endif;?>

                            <?php if ( $header_wishlist_icon == 1 ) :?>
                            <?php get_template_part( 'tpl/header/header-wishlist'); ?>
                            <?php endif;?>

                            <a href="#" class="link btn-search">
                                    <i class="onsus-icon-search"></i>
                                </a>

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


                            <?php global $current_user; wp_get_current_user(); ?>

                            <?php $url = home_url( '/' ); ?>
                            
                            <?php
                                if ( is_user_logged_in() ) { 
                                    echo '<div class="sign-in">
                                            <a class="icon" href="'. $url.'my-account'.'">'.themesflat_svg('admin_all').'</a>
                                        </div>';
                                    
                                } else {
                                    
                                    echo '<div class="sign-in">
                                            <div class="icon">'.themesflat_svg('admin_all').'</div>
                                        </div>';
                                }
                            ?>
                           

                            <?php if ( $header_sidebar_toggler == 1 ) :?>
                                <div class="header-modal-menu-left-btn">
                                    <div class="modal-menu-left-btn">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.66699 4.00002C1.66699 3.38118 1.91282 2.78769 2.35041 2.3501C2.78799 1.91252 3.38149 1.66669 4.00033 1.66669H6.33366C6.9525 1.66669 7.54599 1.91252 7.98357 2.3501C8.42116 2.78769 8.66699 3.38118 8.66699 4.00002V6.33335C8.66699 6.95219 8.42116 7.54568 7.98357 7.98327C7.54599 8.42085 6.9525 8.66669 6.33366 8.66669H4.00033C3.38149 8.66669 2.78799 8.42085 2.35041 7.98327C1.91282 7.54568 1.66699 6.95219 1.66699 6.33335V4.00002ZM13.3337 4.00002C13.3337 3.38118 13.5795 2.78769 14.0171 2.3501C14.4547 1.91252 15.0482 1.66669 15.667 1.66669H18.0003C18.6192 1.66669 19.2127 1.91252 19.6502 2.3501C20.0878 2.78769 20.3337 3.38118 20.3337 4.00002V6.33335C20.3337 6.95219 20.0878 7.54568 19.6502 7.98327C19.2127 8.42085 18.6192 8.66669 18.0003 8.66669H15.667C15.0482 8.66669 14.4547 8.42085 14.0171 7.98327C13.5795 7.54568 13.3337 6.95219 13.3337 6.33335V4.00002ZM1.66699 15.6667C1.66699 15.0478 1.91282 14.4544 2.35041 14.0168C2.78799 13.5792 3.38149 13.3334 4.00033 13.3334H6.33366C6.9525 13.3334 7.54599 13.5792 7.98357 14.0168C8.42116 14.4544 8.66699 15.0478 8.66699 15.6667V18C8.66699 18.6189 8.42116 19.2123 7.98357 19.6499C7.54599 20.0875 6.9525 20.3334 6.33366 20.3334H4.00033C3.38149 20.3334 2.78799 20.0875 2.35041 19.6499C1.91282 19.2123 1.66699 18.6189 1.66699 18V15.6667ZM13.3337 15.6667C13.3337 15.0478 13.5795 14.4544 14.0171 14.0168C14.4547 13.5792 15.0482 13.3334 15.667 13.3334H18.0003C18.6192 13.3334 19.2127 13.5792 19.6502 14.0168C20.0878 14.4544 20.3337 15.0478 20.3337 15.6667V18C20.3337 18.6189 20.0878 19.2123 19.6502 19.6499C19.2127 20.0875 18.6192 20.3334 18.0003 20.3334H15.667C15.0482 20.3334 14.4547 20.0875 14.0171 19.6499C13.5795 19.2123 13.3337 18.6189 13.3337 18V15.6667Z" stroke="#010C29" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                    </div>
                                </div><!-- /.header-modal-menu-left-btn --> 
                            <?php endif;?>

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
                        <?php if ( $header_category == 1 ) :?>
                            <?php get_template_part( 'tpl/header/category-menu'); ?>
                            <?php endif;?>
                        </div>
                        <div class="header-ct-center">
                            <?php get_template_part( 'tpl/header/navigator'); ?>
                        </div>
                        <div class="header-ct-right">
                            

                            <?php if ( $header_search_box == 1 ) :?>
                                <?php  if ( class_exists( 'woocommerce' ) ) {  ?>
                                    <div class="search-form-inner" id="form_search_inner">
                                        <form action="<?php echo esc_url( home_url( '/' ) ); ?>"  method="get" class="search-form products-search searchform ajax-search" >
                                            
                                            <label>
                                                <input type="search" value="<?php get_search_query() ?>" name="s" class="s search-field input-search" placeholder="<?php echo esc_html__( "Search for products", "onsus" ) ?>" autocomplete="off" />
                                                <input type="hidden" name="post_type" value="product">
                                            </label>
                                            <button type="submit" class="search-submit"><i class="onsus-icon-search"></i><?php echo esc_html__( "Search", "onsus" ) ?></button>    
                                            <ul class="result-search-products" ></ul>
                                            <div class='clear-input'><i class='onsus-icon-close'></i></div>
                                        </form>
                                    </div>
                                <?php  } ?>
                            <?php endif;?>
                        </div>
                    </div>                
                </div><!-- /.col-md-12 -->
                
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>

    <div class="canvas-nav-wrap">
        <div class="overlay-canvas-nav"><div class="canvas-menu-close"><span></span></div></div>
        <div class="inner-canvas-nav">
            <?php get_template_part( 'tpl/header/brand-mobile'); ?>
            <div class="tf-tabs-menu" >
                <?php if(has_nav_menu('category')) {  ?>   
                <div class="tf-tabnav">
                    <ul>
                        <li class="tablinks active" >						
                            <span class="tab-title-text"><?php esc_html_e( 'Menu', 'onsus' ); ?></span>
                        </li>
                        <li class="tablinks" >						
                            <span class="tab-title-text"><?php esc_html_e( 'Categories', 'onsus' ); ?></span>
                        </li>
                    </ul>
                </div>
                <?php } ?>
                <div class="tf-tabcontent">
                    <div class=" tf-tabcontent-inner active">
                        <nav id="mainnav_canvas" class="mainnav_canvas" role="navigation">
                            <?php
                                wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'themesflat_menu_fallback', 'container' => false ) );
                            ?>
                        </nav><!-- #mainnav_canvas -->      
                    </div>
                    <?php if(has_nav_menu('category')) {  ?> 
                    <div class=" tf-tabcontent-inner inactive">
                        <nav id="category" class="mainnav_canvas" role="navigation">
                            <?php
                                // wp_nav_menu( array( 'theme_location' => 'category', 'fallback_cb' => 'themesflat_menu_fallback', 'container' => false ) );
                                // $submenu_icon = '<i class="icon-monal-arrow-right-2" aria-hidden="true"></i>';
                                $args = array(
                                    'theme_location' => 'category',
                                    'container_class' => '',
                                    'menu_class' => 'megamenu',
                                    'fallback_cb' => '',
                                    'menu_id' => 'primary-menu',
                                    // 'link_after'      => $submenu_icon,
                                    // 'walker' => new Onsus_Nav_Menu()
                                );
                                wp_nav_menu($args);
                            ?>
                        </nav><!-- #site-navigation -->        
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div><!-- /.canvas-nav-wrap --> 
</header><!-- /.header --> 
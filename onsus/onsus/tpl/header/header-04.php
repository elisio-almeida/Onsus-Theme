<?php 
$header_search_box = themesflat_get_opt('header_search_box');
if (themesflat_get_opt_elementor('header_search_box') != '') {
    $header_search_box = themesflat_get_opt_elementor('header_search_box');
}

$header_cart_icon = themesflat_get_opt('header_cart_icon');
if (themesflat_get_opt_elementor('header_cart_icon') != '') {
    $header_cart_icon = themesflat_get_opt_elementor('header_cart_icon');
}

$header_sidebar_toggler = themesflat_get_opt('header_sidebar_toggler');
if (themesflat_get_opt_elementor('header_sidebar_toggler') != '') {
    $header_sidebar_toggler = themesflat_get_opt_elementor('header_sidebar_toggler');
}

$header_button_show = themesflat_get_opt('header_button_show');
if (themesflat_get_opt_elementor('header_button_show') != '') {
    $header_button_show = themesflat_get_opt_elementor('header_button_show');
}
$header_wishlist_icon = themesflat_get_opt('header_wishlist_icon');
if (themesflat_get_opt_elementor('header_wishlist_icon') != '') {
    $header_wishlist_icon = themesflat_get_opt_elementor('header_wishlist_icon');
}
?>
<?php get_template_part( 'tpl/topbar'); ?>
<header id="header" class="header header-04 <?php echo themesflat_get_opt_elementor('extra_classes_header'); ?>">
    <div class="inner-header">  
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-wrap clearfix">
                        <div class="header-ct-left">
                            <?php get_template_part( 'tpl/header/brand'); ?>
                        </div>
                        <div class="header-ct-center">
                            <?php if ( $header_search_box == 1 ) :?>
                                <a href="#" class="link btn-search">
                                    <i class="onsus-icon-search"></i>
                                </a>
                                <?php get_template_part( 'tpl/header/search-form'); ?>
                            <?php endif;?>
                        </div>
                        <div class="header-ct-right">

                            <?php if ( $header_wishlist_icon == 1 ) :?>
                            <?php get_template_part( 'tpl/header/header-wishlist'); ?>
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
                           
                            
                           

                            <?php if ( $header_cart_icon == 1 ) :?>
                                <?php if ( class_exists( 'woocommerce' ) ) { ?>
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
                                                <span class="title"><?php echo esc_html__('Your cart', 'onsus') ?></span>
                                                <span class="minicart-close"></span>     
                                            </div> 
                                            <div class="widget_shopping_cart_content">      	
                                                <?php woocommerce_mini_cart(); ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php  }  ?>
                            <?php endif;?>

                            <?php if ( $header_button_show == 1 ) :?>

                            <?php if ( themesflat_get_opt('header_button_text') != '' && themesflat_get_opt('header_button_url') != '' ) :?>
                            <div class="wrap-btn-header draw-border">
                                <a class="btn-header" href="<?php echo esc_url(themesflat_get_opt('header_button_url')) ?>"><?php echo themesflat_get_opt('header_button_text'); ?></a> 
                            </div>
                            <?php endif;?>
                            <?php endif;?>

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
                            <?php get_template_part( 'tpl/header/category-menu'); ?>
                            <?php get_template_part( 'tpl/header/navigator'); ?>
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
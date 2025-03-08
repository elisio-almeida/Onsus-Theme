<?php
// Register action to declare required plugins
add_action('tgmpa_register', 'themesflat_recommend_plugin');
function themesflat_recommend_plugin() {
    
    $plugins = array(
        array(
            'name' => esc_html__('Elementor', 'onsus'),
            'slug' => 'elementor',
            'required' => true
        ),
        array(
            'name' => esc_html__('Themesflat Core', 'onsus'),
            'slug' => 'themesflat-core',
            'source' => THEMESFLAT_DIR . 'inc/plugins/themesflat-core.zip',
            'required' => false
        ),  

        array(
            'name' => esc_html__('Contact Form 7', 'onsus'),
            'slug' => 'contact-form-7',
            'required' => false
        ),    
        array(
            'name' => esc_html__('Mailchimp', 'onsus'),
            'slug' => 'mailchimp-for-wp',
            'required' => false
        ),        
        array(
            'name' => esc_html__('WooCommerce', 'onsus'),
            'slug' => 'woocommerce',
            'required' => false
        ),
        array(
            'name' => esc_html__('One Click Demo Import', 'onsus'),
            'slug' => 'one-click-demo-import',
            'required' => false
        ),
        array(
            'name' => esc_html__('YITH WooCommerce Wishlist', 'onsus'),
            'slug' => 'yith-woocommerce-wishlist',
            'required' => false
        ),
        array(
            'name' => esc_html__('YITH WooCommerce Quick View', 'onsus'),
            'slug' => 'yith-woocommerce-quick-view',
            'required' => false
        ),
        array(
            'name' => esc_html__('YITH WooCommerce Frequently Bought Together', 'onsus'),
            'slug' => 'yith-woocommerce-frequently-bought-together',
            'required' => false
        ),
        array(
            'name' => esc_html__('WPC Smart Compare for WooCommerce', 'onsus'),
            'slug' => 'woo-smart-compare',
            'required' => false
        ), 
        array(
            'name' => esc_html__('Variation Swatches for WooCommerce', 'onsus'),
            'slug' => 'woo-variation-swatches',
            'required' => false
        ),
        array(
            'name' => esc_html__('X-Currency', 'onsus'),
            'slug' => 'x-currency',
            'required' => false
        ),
        array(
            'name' => esc_html__('Product Video Gallery for Woocommerce', 'onsus'),
            'slug' => 'product-video-gallery-slider-for-woocommerce',
            'required' => false
        ),
    );
    
    tgmpa($plugins);
}


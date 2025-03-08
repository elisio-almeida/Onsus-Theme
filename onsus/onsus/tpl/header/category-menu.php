<?php
$submenu_icon = '<i class="icon-monal-arrow-right-2" aria-hidden="true"></i>';
$args = array(
    'theme_location' => 'category',
    'container_class' => '',
    'menu_class' => 'megamenu',
    'fallback_cb' => '',
    'menu_id' => 'primary-menu',
    'link_after'      => $submenu_icon,
    // 'walker' => new Onsus_Nav_Menu()
);

if ( function_exists( 'wp_nav_menu' ) ) {
    if(has_nav_menu('category')) {
?>


<div class="nav-wrap-category" id="nav-wrap-category">
    <div class="title-menu"><i class="onsus-icon-toogle" ></i> <span class="text-title"><?php echo esc_html__('All Categories', 'onsus') ?></span></div>
    <nav id="category" class="category-menu" role="navigation">
        <?php
            wp_nav_menu($args);
        ?>
    </nav><!-- #site-navigation -->  
</div><!-- /.nav-wrap -->   
<?php } } ?>

<?php  if ( class_exists( 'woocommerce' ) ) {  ?>
<div class="search-form-inner" id="form_search_inner">
    <form action="<?php echo esc_url( home_url( '/' ) ); ?>"  method="get" class="search-form products-search searchform ajax-search" >
        <?php 
            $args = array(
                'show_count' => 0,
                'hierarchical' => true,
                'show_uncategorized' => 0,
                'hide_empty'        => 1,
                'selected' => false,
                'parent' => 0,
                'show_option_none'   => __( 'All categories', 'onsus' ),
            );
             
            echo '<span class="select-category">';
                wc_product_dropdown_categories( $args );
            echo '</span>';
           
        ?>
        <label>
            <input type="search" value="<?php get_search_query() ?>" name="s" class="s search-field input-search" placeholder="<?php echo esc_html__( "Search for products", "onsus" ) ?>" autocomplete="off" />
            <input type="hidden" name="post_type" value="product">
            <ul class="result-search-products" ></ul>
        </label>
        <button type="submit" class="search-submit"><i class="onsus-icon-search"></i></button>    
        
        <div class='clear-input'><i class='onsus-icon-close'></i></div>
    </form>
</div>
<?php  } ?>
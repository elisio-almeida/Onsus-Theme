<?php
/**
 * Woocommerce
 *
 * @package onsus
 * @version 5.6.0
 */

// Disable WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove breadcrumb (we're using the WooFramework default breadcrumb)
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Removes the "shop" title on the main shop page
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Remove Heading Text Tab
add_filter( 'woocommerce_product_description_heading', '__return_false' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );


// Change gravatar size
add_filter( 'woocommerce_review_gravatar_size', 'themesflat_woocommerce_gravatar_size', 10 );
function themesflat_woocommerce_gravatar_size() { return 100; }

// Adjust markup on all WooCommerce pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Fix html on item product 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

add_action( 'woocommerce_before_shop_loop_item', 'themesflat_before_shop_loop_item' );
add_action( 'themesflat_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'themesflat_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
add_filter('yith_add_quick_view_button_html', '__return_false');

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', -5 );


add_action( 'wp_ajax_flat_search_products',  'themesflat_instance_search_result'  );
add_action( 'wp_ajax_nopriv_flat_search_products',  'themesflat_instance_search_result'  );


if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    } 
}



if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {   
    function woocommerce_get_product_thumbnail( $size = 'image-540' ) {
        global $post, $woocommerce;
		$output= '';

        if ( has_post_thumbnail() ) {               
            $output .= get_the_post_thumbnail( $post->ID, $size );
        } else {
             $output .= '';
            
        }                      
        return $output;
    }
}

function tf_sale_countdown() {
	ob_start();
	global $product;
	$product_id = $product->get_id();
	$time_sale = get_post_meta( $product_id, '_sale_price_dates_to', true );
            if ( $time_sale ) { ?>
                <div class="time-wrapper">
                    <div class="tf-countdown clearfix" 
                        data-date="<?php echo  esc_attr( date( 'Y-m-d H:i:s', $time_sale ) )  ; ?>">
                    </div>
                </div>
            <?php } ?>
    <?php
    $output = ob_get_clean();
    return $output;
}

function tf_progessbar() {
	ob_start();
	global $product;
	$product_id = $product->get_id();
	$stock_sold = ( $total_sales = get_post_meta( $product_id, 'total_sales', true ) ) ? round( $total_sales ) : 0;
	$stock_available = ( $stock = get_post_meta( $product_id, '_stock', true ) ) ? round( $stock ) : 0;
	$total_stock = $stock_sold + $stock_available;
	$percentage = ( $stock_available > 0 ? round($stock_sold/$total_stock * 100) : 0 );
    ?>
	<?php if ( $stock_available > $stock_sold) { ?>
        <div class="special-progress">
			<div class="progress">
                <span class="progress-bar" style="<?php echo esc_attr('width:' . $percentage . '%'); ?>"></span>
            </div>
            <div class="infor-sold">
                <div class="left">
                    <?php echo esc_html__('Sold: ','onsus').'<span class="text-theme">'.$stock_sold.'</span>'; ?>
                </div>
                <div class="right">
                    <?php echo esc_html__('Available: ','onsus').'<span class="text-theme">'.$stock_available.'</span>'; ?>
                </div>
            </div>
            
        </div>
    <?php } ?>
    <?php
    $output = ob_get_clean();
    return $output;
}
function tf_product_thumb() {
	ob_start();
	global $product;
	$product_id = $product->get_id();
	
	$featured_image_url = get_the_post_thumbnail_url($product_id,'image-540'); 
	$featured_image_url2 = get_the_post_thumbnail_url($product_id,'image-84'); 
	$attachment_ids = $product->get_gallery_image_ids();
	if (isset($attachment_ids)) {$count = count($attachment_ids);} else $count = 0;

	if($count != 0) {
	?>
	<ul class="product-option">
        <li class="thumb active" data-src="<?php echo esc_attr($featured_image_url); ?>"><img src="<?php echo esc_attr($featured_image_url2); ?>" alt="Image"></li>
        <?php
        // $attachment_ids = $product->get_gallery_image_ids();
        // $count = count($attachment_ids);
        $j = $count -2;
        $i = 1; 
		if(isset($attachment_ids)) {
            foreach( $attachment_ids as $attachment_id ) { 
                $image_link = wp_get_attachment_image_url( $attachment_id,'image-84');
                $image_link2 = wp_get_attachment_image_url( $attachment_id,'image-540');?>
                <?php
                if($i >= 3 && $j > 0 ) { ?>
                    <li class="load-more"><a href="<?php echo get_permalink($product_id) ?>">+<?php echo esc_attr($j); ?></a></li> 
                    <?php break; } else
                if ($i < 3  ) { ?>
                <li class="thumb" data-src="<?php echo esc_attr($image_link2); ?>"><img src="<?php echo esc_attr($image_link); ?>" alt="Image"></li>
                <?php $i = $i + 1 ;}  } ;
		}
        ?>
    </ul>
	<?php
	}
	$output = ob_get_clean();
    return $output;
	
}

function tf_delivery() {
	ob_start();
	global $product;
	$product_id = $product->get_id();
	$time_delivery = get_post_meta( $product_id, '_delivery', true );
            if ( $time_delivery ) { ?>
                <div class="time-delivery">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(.clip0_1753_25723)">
					<path d="M6.5 19H4.5C4.224 19 4 18.776 4 18.5C4 18.224 4.224 18 4.5 18H6.5C6.776 18 7 18.224 7 18.5C7 18.776 6.776 19 6.5 19Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
					<path d="M22.7499 19H21.4999C21.2239 19 20.9999 18.776 20.9999 18.5C20.9999 18.224 21.2239 18 21.4999 18H22.3349L23.0089 14.408C22.9999 12.57 21.4299 11 19.4999 11H16.2169L14.6259 18H17.4999C17.7759 18 17.9999 18.224 17.9999 18.5C17.9999 18.776 17.7759 19 17.4999 19H13.9999C13.8479 19 13.7039 18.931 13.6089 18.812C13.5139 18.694 13.4779 18.538 13.5119 18.39L15.3299 10.39C15.3819 10.161 15.5839 10 15.8179 10H19.4999C21.9809 10 23.9999 12.019 23.9999 14.5L23.2409 18.592C23.1969 18.829 22.9909 19 22.7499 19Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
					<path d="M19.5 21C18.122 21 17 19.879 17 18.5C17 17.121 18.122 16 19.5 16C20.878 16 22 17.121 22 18.5C22 19.879 20.878 21 19.5 21ZM19.5 17C18.673 17 18 17.673 18 18.5C18 19.327 18.673 20 19.5 20C20.327 20 21 19.327 21 18.5C21 17.673 20.327 17 19.5 17Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
					<path d="M8.5 21C7.122 21 6 19.879 6 18.5C6 17.121 7.122 16 8.5 16C9.878 16 11 17.121 11 18.5C11 19.879 9.878 21 8.5 21ZM8.5 17C7.673 17 7 17.673 7 18.5C7 19.327 7.673 20 8.5 20C9.327 20 10 19.327 10 18.5C10 17.673 9.327 17 8.5 17Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
					<path d="M6.5 10H2.5C2.224 10 2 9.776 2 9.5C2 9.224 2.224 9 2.5 9H6.5C6.776 9 7 9.224 7 9.5C7 9.776 6.776 10 6.5 10Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
					<path d="M6.5 13H1.5C1.224 13 1 12.776 1 12.5C1 12.224 1.224 12 1.5 12H6.5C6.776 12 7 12.224 7 12.5C7 12.776 6.776 13 6.5 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
					<path d="M6.49999 16H0.5C0.224 16 0 15.776 0 15.5C0 15.224 0.224 15 0.5 15H6.49999C6.77599 15 6.99999 15.224 6.99999 15.5C6.99999 15.776 6.77599 16 6.49999 16Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
					<path d="M14 19H10.5C10.224 19 10 18.776 10 18.5C10 18.224 10.224 18 10.5 18H13.601L15.873 8H4.5C4.224 8 4 7.776 4 7.5C4 7.224 4.224 7 4.5 7H16.5C16.652 7 16.796 7.069 16.891 7.188C16.986 7.306 17.022 7.462 16.988 7.61L14.488 18.61C14.436 18.839 14.233 19 14 19Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
					</g>
					<defs>
					<clipPath  class="clip0_1753_25723">
					<rect width="24" height="24" fill="white"/>
					</clipPath>
					</defs>
				</svg>
				<span class="text"><?php echo  esc_attr($time_delivery) ; ?></span>


                </div>
            <?php } ?>
    <?php
    $output = ob_get_clean();
    return $output;
}
/* Archive Product 
--------------------------------------------------------------------------*/
// Relayout shop item
function themesflat_before_shop_loop_item() {
	
	global $product;
	echo '<div class="left-content">';

	echo '<div class="product-thumbnail">';
	
	echo '<a class="woocommerce_loop_product_link" href="' . get_the_permalink($product->get_id()) . '">'; 
	do_action( 'themesflat_before_shop_loop_item' );
	echo '</a>';
	echo '<div class="product-footer">';
	if ( themesflat_get_opt('show_configuration') == 1 ) :
	echo tf_configuration();
	endif;
	if ( themesflat_get_opt('show_delivery') == 1 ) :
	echo tf_delivery();
	endif;	
	echo '</div>';
	echo themesflat_product_action_btn();	
	echo themesflat_product_add_to_cart_btn();
	echo '</div>'; if ( themesflat_get_opt('show_thumb') == 1 ) : echo tf_product_thumb() ; endif; echo '</div>';
	echo '<div class="product-content"><div class="product-info">';

	echo  '<div class="product-category">' . wc_get_product_category_list( $product->get_id() ) . '</div>';
	echo '<a class="woocommerce_loop_product_link" href="' . get_the_permalink($product->get_id()) . '">';
	do_action( 'woocommerce_shop_loop_item_title' );
	echo '</a>';
}
add_action( 'woocommerce_after_shop_loop_item', function() {
	echo '</div>';
	if ( themesflat_get_opt('show_progress') == 1 ) :
	echo tf_progessbar();
	endif;	
	if ( themesflat_get_opt('show_cowndown') == 1 ) :
	echo tf_sale_countdown();
	endif;
	echo '<div class="product-footer product-footer-hide">';
	if ( themesflat_get_opt('show_configuration') == 1 ) :
	echo tf_configuration();
	endif;
	if ( themesflat_get_opt('show_delivery') == 1 ) :
	echo tf_delivery();
	endif;	
	echo '</div>';
	echo '</div>';
	
}, 99 );


function themesflat_product_add_to_cart_btn() {
    ob_start();
    global $product;
    ?>
    <?php if ( $product->is_type( 'variable' ) ) { ?>
		<div class="btn-add-to-cart">
			<?php if (  ! $product->is_in_stock() ) { ?>
				<div class="out-stock" >
					<?php echo esc_html__( 'Out Of Stock', 'onsus' ) ?> 
				</div>		
			<?php } else { ?>
				<div class="select_option button" >
					<a href="<?php echo get_the_permalink($product->get_id()) ?>">
						<?php echo esc_html__( 'Select Option', 'onsus' ) ?> 
					</a>
				</div>					
			<?php } ?>
		</div>
		

		<?php
	} else {
		?>
		<div class="btn-add-to-cart">
			<?php if (  ! $product->is_in_stock() ) { ?>
				<div class="out-stock" >
					<?php echo esc_html__( 'Out Of Stock', 'onsus' ) ?> 
				</div>	
			<?php } else { ?>
				<div class="add_to_cart button" data-product_id="<?php the_ID(); ?>">
					<span class="check icon-monal-check-mark"></span><?php echo esc_html__( 'Add to cart', 'onsus' ) ?> 
				</div>
			<?php } ?>
		</div>

		<?php
	} ?>

    <?php
    $output = ob_get_clean();
    return $output;
}

function themesflat_product_action_btn() {
    ob_start();
    global $product;
    ?>
    <div class="wrap-btn-action">

        <?php if (function_exists('yith_wcqv_init')): ?>
			<div class="tf-tooltip">
				<p class="tooltiptext"><?php echo esc_html__('Quick View','onsus')?></p>
				<div class="tf-btn-quickview">				
					<span class="tf-call-quickview button" data-product_id="<?php the_ID(); ?>"><?php echo themesflat_svg( 'quickview' ); ?></span>
				</div>
			</div>
            
        <?php endif; ?>

		<?php if (class_exists('YITH_WCWL')): ?>  
			<div class="tf-tooltip tf-btn-wishlist">
				<p class="tooltiptext"><?php echo esc_html__('Wishlist','onsus')?></p>
				<?php echo do_shortcode('[yith_wcwl_add_to_wishlist link_classes="add_to_wishlist" label="" product_added_text="" browse_wishlist_text="" already_in_wishslist_text="" icon="onsus-icon-wishlish"]');  ?>
			</div>
        <?php endif; ?>

		<?php if (class_exists('WPCleverWoosc')): ?>  
		<div class="tf-tooltip tf-btn-compare">	 
			<p class="tooltiptext"><?php echo esc_html__('Compare','onsus')?></p>
			<div class="woocommerce product compare-button">
				<?php echo themesflat_svg( 'compare' ); ?>
				<div class=" compare button woosc-btn" data-id="<?php the_ID(); ?>" ></div>
			</div>
		</div>
		<?php endif; ?>

    </div>

    <?php
    $output = ob_get_clean();
    return $output;
}

function themesflat_product_action_btn_2() {
    ob_start();
    global $product;
    ?>
    <div class="wrap-btn-action style-2">

        <?php if (function_exists('yith_wcqv_init')): ?>
			<div class="tf-tooltip">
				<p class="tooltiptext tooltip-top"><?php echo esc_html__('Quick View','onsus')?></p>
				<div class="tf-btn-quickview">				
					<span class="tf-call-quickview button" data-product_id="<?php the_ID(); ?>"><?php echo themesflat_svg( 'quickview' ); ?></span>
				</div>
			</div>
            
        <?php endif; ?>

		<?php if (class_exists('YITH_WCWL')): ?>  
			<div class="tf-tooltip tf-btn-wishlist">
				<p class="tooltiptext tooltip-top"><?php echo esc_html__('Wishlist','onsus')?></p>
				<?php echo do_shortcode('[yith_wcwl_add_to_wishlist link_classes="add_to_wishlist" label="" product_added_text="" browse_wishlist_text="" already_in_wishslist_text="" icon="onsus-icon-wishlish"]');  ?>
			</div>
        <?php endif; ?>

		<?php if (class_exists('WPCleverWoosc')): ?>  
		<div class="tf-tooltip tf-btn-compare">	 
			<p class="tooltiptext tooltip-top"><?php echo esc_html__('Compare','onsus')?></p>
			<div class="woocommerce product compare-button">
				<?php echo themesflat_svg( 'compare' ); ?>
				<div class=" compare button woosc-btn" data-id="<?php the_ID(); ?>" ></div>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $product->is_type( 'variable' ) ) { ?>
			<div class="tf-tooltip btn-add-to-cart">
				<p class="tooltiptext tooltip-top"><?php echo esc_html__('Select Option','onsus')?></p>
				<?php if ( ! $product->managing_stock() && ! $product->is_in_stock() ) { ?>
							
				<?php } else { ?>
					<div class="add_to_cart select_option button" >
						<a href="<?php echo get_the_permalink($product->get_id()) ?>">
							</span><?php echo themesflat_svg( 'cart_all' ); ?> 
						</a>
					</div>					
				<?php } ?>
			</div>
			<?php
		} else {
			?>
			<div class="tf-tooltip btn-add-to-cart">
				<p class="tooltiptext tooltip-top"><?php echo esc_html__('Add to cart','onsus')?></p>
				<?php if ( ! $product->managing_stock() && ! $product->is_in_stock() ) { ?>
							
				<?php } else { ?>
					<div class="add_to_cart button" data-product_id="<?php the_ID(); ?>">
						</span><?php echo themesflat_svg( 'cart_all' ); ?> 
					</div>
				<?php } ?>
			</div>

			<?php
		} ?>


    </div>

    <?php
    $output = ob_get_clean();
    return $output;
}

// Display products per page
add_filter( 'loop_shop_per_page', 'themesflat_products_per_page', 20 );
function themesflat_products_per_page() {
	if ( ! $items = themesflat_get_opt('shop_products_per_page') ) {
		return 9;
	} else {
		return $items;
	}
}

// Change columns in product loop
add_filter( 'loop_shop_columns', 'themesflat_shop_loop_columns', 20 );
function themesflat_shop_loop_columns() {
	if ( ! $cols = themesflat_get_opt('shop_columns') ) {
		return 3;
	} else {
		if ( $cols == '1' ) return 1;
		if ( $cols == '2' ) return 2;
		if ( $cols == '3' ) return 3;
		if ( $cols == '4' ) return 4;
		if ( $cols == '5' ) return 5;
	}
}
 
/* Single Product 
--------------------------------------------------------------------------*/

remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );

remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_rating', 10 );

remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 45 );

add_action( 'woocommerce_single_product_summary', function() {	echo tf_progessbar();}, 43 );
add_action( 'woocommerce_single_product_summary', function() {	echo tf_sale_countdown();}, 44 );

// add_action( 'woocommerce_after_single_product', 'woocommerce_template_single_excerpt', 10 );


// Add tab to product single

add_filter( 'woocommerce_product_tabs', 'tf_tab_new' );
function tf_tab_new( $tabs ) { 

  $tabs['new_tab'] = array(
    'title' 	=> __( 'Review', 'onsus' ),
    'priority' 	=> 50,
    'callback' 	=> 'tf_tab_new_content' );

  return $tabs; }

 // The new tab content
function tf_tab_new_content() {
	tf_show_reviews();
}

remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40 );

remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_meta', 40 );

remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_sharing', 50 );




add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Change columns in related products output to 4
add_filter( 'woocommerce_output_related_products_args', 'themesflat_related_products' );
function themesflat_related_products() {
	$args = array(
		'posts_per_page' => themesflat_get_opt('related_products_columns'),
		'columns'        => themesflat_get_opt('related_products_columns'),
	);
	return $args;
}

// Custom product thumbnails columns
add_filter('woocommerce_product_thumbnails_columns','themesflat_custom_storefront_gallery' );
function themesflat_custom_storefront_gallery( $column ) {
	$column  = 6;
	return $column ;
}

function themesflat_display_product_cat($product_id) {
    $terms = get_the_terms( $product_id, 'product_cat' );
    if ( !empty($terms) ) { ?>
        <div class="product-cats">
        <?php foreach ( $terms as $term ) {
            echo '<a href="' . get_term_link( $term->term_id ) . '">' . $term->name . '</a>';
            break;
        } ?>
        </div>
    <?php
    }
}

add_action( 'woocommerce_single_product_summary', 'tf_display_category', 3 );

function tf_display_category() {
	global $product;
	echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="product-category"><span class="title">' . _n( 'Categories:', 'Categories:', count( $product->get_category_ids() ), 'onsus' ) . '</span> ', '</span>' ); 
}

// add_filter( 'woocommerce_single_product_summary', 'tf_display_shipping', 11 );
function tf_display_shipping() {
	$WC_Cart = new WC_Cart();
	$WC_Cart->get_cart_shipping_total();
	// echo WC()->cart->get_cart_shipping_total();
	echo $WC_Cart->get_cart_shipping_total();
}
/* Mini Cart
--------------------------------------------------------------------------*/
// Update the number on cart icon
add_filter( 'woocommerce_add_to_cart_fragments', 'themesflat_woocommerce_cart_link_fragment' );
if ( ! function_exists( 'themesflat_woocommerce_cart_link_fragment' ) ) {
	// Ensure cart contents update when products are added to the cart via AJAX
	function themesflat_woocommerce_cart_link_fragment( $fragments ) {
		global $woocommerce;
		ob_start(); ?>

		
			<?php
			$item_count = sprintf(
				_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'onsus' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="shopping-cart-items-count"><?php echo esc_html( $item_count ); ?></span>
				

		<?php $fragments['a.nav-cart-trigger .shopping-cart-items-count'] = ob_get_clean();

		return $fragments;
	}
}

// Output the script placeholder for cart updater
add_action( 'wp_footer', 'themesflat_cart_fragments_placeholder', 100 );
function themesflat_cart_fragments_placeholder() {
	echo '<script id="shopping-cart-items-updater" type="text/javascript"></script>';
}

/* Wish List
--------------------------------------------------------------------------*/
if( class_exists( 'YITH_WCWL' ) && ! function_exists( 'themesflat_yith_wcwl_disable_title' ) ){
	function themesflat_yith_wcwl_disable_title( $params ) {
		$params['page_title'] = '';

		return $params;
	}
	add_filter( 'yith_wcwl_wishlist_params', 'themesflat_yith_wcwl_disable_title' );
}

if ( class_exists( 'YITH_WCWL' ) && ! function_exists( 'tf_yith_wcwl_ajax_update_count' ) ) {
  function tf_yith_wcwl_ajax_update_count() {
    wp_send_json( array(
      'count' => yith_wcwl_count_all_products()
    ) );
  }
  add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'tf_yith_wcwl_ajax_update_count' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'tf_yith_wcwl_ajax_update_count' );
}

if ( class_exists( 'YITH_WCWL' ) && ! function_exists( 'themesflat_yith_wcwl_enqueue_custom_script' ) ) {
    function themesflat_yith_wcwl_enqueue_custom_script() {
        wp_add_inline_script(
            'jquery-yith-wcwl',
            "jQuery( function( $ ) {
                    $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
                        $.get( yith_wcwl_l10n.ajax_url, {
                            action: 'yith_wcwl_update_wishlist_count'
                        }, function( data ) {
                            $('.wishlist-items-count').html( data.count );
                        } );
                    } );
            } );"
        );
    }
    add_action( 'wp_enqueue_scripts', 'themesflat_yith_wcwl_enqueue_custom_script', 20 );
}

/* Quick View
--------------------------------------------------------------------------*/
add_action( 'template_redirect', 'yith_wcqv_remove_from_wishlist' );
function yith_wcqv_remove_from_wishlist(){
	if( function_exists( 'YITH_WCQV_Frontend' ) && defined('YITH_WCQV_FREE_INIT') ) {
	remove_action( 'yith_wcwl_table_after_product_name', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
	}
}

if ( ! function_exists( 'tf_wc_products_per_page' ) ) {
    function tf_wc_products_per_page() {
        global $wp_query;

        $action = '';
        $cat                = $wp_query->get_queried_object();
        $return_to_first    = apply_filters( 'tf_wc_ppp_return_to_first', false );
        $total              = $wp_query->found_posts;
        $per_page           = $wp_query->get( 'posts_per_page' );
        $_per_page          = themesflat_get_opt('shop_products_per_page');

        // Generate per page options
        $products_per_page_options = array();
        while ( $_per_page < $total ) {
            $products_per_page_options[] = $_per_page;
            $_per_page = $_per_page * 2;
        }

        if ( empty( $products_per_page_options ) ) {
            return;
        }

        $products_per_page_options[] = -1;

        $query_string = ! empty( $_GET['QUERY_STRING'] ) ? '?' . add_query_arg( array( 'ppp' => false ), $_GET['QUERY_STRING'] ) : null;

        if ( isset( $cat->term_id ) && isset( $cat->taxonomy ) && $return_to_first ) {
            $action = get_term_link( $cat->term_id, $cat->taxonomy ) . $query_string;
        } elseif ( $return_to_first ) {
            $action = get_permalink( wc_get_page_id( 'shop' ) ) . $query_string;
        }

        if ( ! woocommerce_products_will_display() ) {
            return;
        }
        ?>
        <form method="POST" action="<?php echo esc_url( $action ); ?>" class="form-tf-ppp">
            <?php
            foreach ( $_GET as $key => $value ) {
                if ( 'ppp' === $key || 'submit' === $key ) {
                    continue;
                }
                if ( is_array( $value ) ) {
                    foreach( $value as $i_value ) {
                        ?>
                        <input type="hidden" name="<?php echo esc_attr( $key ); ?>[]" value="<?php echo esc_attr( $i_value ); ?>" />
                        <?php
                    }
                } else {
                    ?><input type="hidden" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" /><?php
                }
            }
            ?>

            <select name="ppp" onchange="this.form.submit()" class="tf-wc-wppp-select">
                <?php foreach( $products_per_page_options as $key => $value ) { ?>
                    <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $per_page ); ?>><?php
                        $ppp_text = apply_filters( 'tf_wc_ppp_text', esc_html__( 'Show: %s', 'onsus' ), $value );
                        esc_html( printf( $ppp_text, $value == -1 ? esc_html__( 'All', 'onsus' ) : $value ) );
                    ?></option>
                <?php } ?>
            </select>
        </form>
        <?php
    }
}


function themesflat_instance_search_result() {
	if ( apply_filters( 'check_ajax_referer', true ) ) {
		check_ajax_referer( '_flat_nonce', 'nonce' );
	}
	$response = array();
	if (isset( $_POST['search_type'] )) {
		$response = themesflat_instance_search_products_result();
	}
	
	if ( empty( $response ) ) {
		$response[] = sprintf( '%s', esc_html__( 'Nothing found', 'onsus' ) );
	}

	$output = sprintf( '%s', implode( ' ', $response ) );

	wp_send_json_success( $output );
	die();
}
function themesflat_instance_search_products_result() {
		$response      = array();
		$result_number = intval(5);
		$args_sku      = array(
			'post_type'        => 'product',
			'posts_per_page'   => $result_number,
			'meta_query'       => array(
				array(
					'key'     => '_sku',
					'value'   => trim( $_POST['term'] ),
					'compare' => 'like',
				),
			),
			'suppress_filters' => 0,
		);

		$args_variation_sku = array(
			'post_type'        => 'product_variation',
			'posts_per_page'   => $result_number,
			'meta_query'       => array(
				array(
					'key'     => '_sku',
					'value'   => trim( $_POST['term'] ),
					'compare' => 'like',
				),
			),
			'suppress_filters' => 0,
		);

		$args = array(
			'post_type'        => 'product',
			'posts_per_page'   => $result_number,
			's'                => trim( $_POST['term'] ),
			'suppress_filters' => 0,
		);

		if ( function_exists( 'wc_get_product_visibility_term_ids' ) ) {
			$product_visibility_term_ids = wc_get_product_visibility_term_ids();
			$args['tax_query'][]         = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['exclude-from-search'],
				'operator' => 'NOT IN',
			);
		}
		if ( isset( $_POST['cat'] ) && $_POST['cat'] != '0' ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $_POST['cat'],
			);

			$args_sku['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $_POST['cat'],
				),

			);
		}

		$products_sku           = get_posts( $args_sku );
		$products_s             = get_posts( $args );
		$products_variation_sku = get_posts( $args_variation_sku );

		$products    = array_merge( $products_sku, $products_s, $products_variation_sku );
		$product_ids = array();
		foreach ( $products as $product ) {
			$id = $product->ID;
			if ( ! in_array( $id, $product_ids ) ) {
				$product_ids[] = $id;

				$productw   = wc_get_product( $id );
				$response[] = sprintf(
					'<li class="item-search">' .
					'<a class="item-image" href="%s">' .
					'%s' .
					'</a>' .
					'<div class="item-content">' .
					'<a class="title-item" href="%s">' .
					'%s' .
					'</a>' .
					'<div class="price-item">%s</div>' .
					'</div>' .
					'</li>',
					esc_url( $productw->get_permalink() ),
					$productw->get_image( 'themesflat-thumb-small' ),
					esc_url( $productw->get_permalink() ),
					$productw->get_title(),
					$productw->get_price_html()
				);
			}
		}

		return $response;
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}


// Add metabox Product Properties

// add_action( 'add_meta_boxes', 'tf_custom_meta_box' );
if ( ! function_exists( 'tf_custom_meta_box' ) )
{
    function tf_custom_meta_box()
    {
        add_meta_box(
            'tf_custom_product_meta_box',
            __( 'Product Properties ', 'onsus' ),
            'add_custom_content_meta_box',
            'product',
            'normal',
            'default'
        );
		
    }
}

if ( ! function_exists( 'add_custom_content_meta_box' ) ){
    function add_custom_content_meta_box( $post ){
        $prefix = '_tf_'; 
        $ingredients = get_post_meta($post->ID, $prefix.'overview_wysiwyg', true) ? get_post_meta($post->ID, $prefix.'overview_wysiwyg', true) : '';
        $args['textarea_rows'] = 6;
        wp_editor( $ingredients, 'overview_wysiwyg', $args );
        echo '<input type="hidden" name="custom_product_field_nonce" value="' . wp_create_nonce() . '">';
    }
}

add_action( 'save_post', 'save_custom_content_meta_box', 10, 1 );
if ( ! function_exists( 'save_custom_content_meta_box' ) )
{
    function save_custom_content_meta_box( $post_id ) {
        $prefix = '_tf_'; 
        if ( ! isset( $_POST[ 'custom_product_field_nonce' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'custom_product_field_nonce' ];
        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }
       
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        if ( 'product' == $_POST[ 'post_type' ] ){
            if ( ! current_user_can( 'edit_product', $post_id ) )
                return $post_id;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return $post_id;
        }
        update_post_meta( $post_id, $prefix.'overview_wysiwyg', wp_kses_post($_POST[ 'overview_wysiwyg' ]) );
    }
}

// add_action( 'woocommerce_single_product_summary', 'tf_product_properties', 15 );
function tf_product_properties() {
    global $post;
    $product_ingredients = get_post_meta( $post->ID, '_tf_overview_wysiwyg', true );
 	if ( ! empty( $product_ingredients ) ) {
         echo apply_filters( 'the_content', $product_ingredients );
    }
 	?>
	<?php
}

// Add metabox Product configuration

add_action( 'add_meta_boxes', 'tf_custom_meta_box_configuration' );
if ( ! function_exists( 'tf_custom_meta_box_configuration' ) )
{
    function tf_custom_meta_box_configuration()
    {
        add_meta_box(
            'tf_custom_configuration_product_meta_box',
            __( 'Product Configuration ', 'onsus' ),
            'add_custom_content_configuration_meta_box',
            'product',
            'normal',
            'default'
        );
		
    }
}

if ( ! function_exists( 'add_custom_content_configuration_meta_box' ) ){
    function add_custom_content_configuration_meta_box( $post ){
        $prefix = '_tf_'; 
        $ingredients = get_post_meta($post->ID, $prefix.'configuration', true) ? get_post_meta($post->ID, $prefix.'configuration', true) : '';
        $args['textarea_rows'] = 6;
        wp_editor( $ingredients, 'configuration', $args );
        echo '<input type="hidden" name="custom_product_field_nonce" value="' . wp_create_nonce() . '">';
    }
}

add_action( 'save_post', 'save_custom_content_configuration_meta_box', 10, 1 );
if ( ! function_exists( 'save_custom_content_configuration_meta_box' ) )
{
    function save_custom_content_configuration_meta_box( $post_id ) {
        $prefix = '_tf_'; 
        if ( ! isset( $_POST[ 'custom_product_field_nonce' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'custom_product_field_nonce' ];
        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }
       
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        if ( 'product' == $_POST[ 'post_type' ] ){
            if ( ! current_user_can( 'edit_product', $post_id ) )
                return $post_id;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return $post_id;
        }
        update_post_meta( $post_id, $prefix.'configuration', wp_kses_post($_POST[ 'configuration' ]) );
    }
}


add_action( 'woocommerce_single_product_summary', 'tf_configuration', 16 );
function tf_configuration() {
    global $post;
    $product_ingredients = get_post_meta( $post->ID, '_tf_configuration', true );
	if ( ! empty( $product_ingredients ) ) {
        echo apply_filters( 'the_content', $product_ingredients );
    }
	?>
	<?php
}



// Add metabox Product Information

// add_action( 'add_meta_boxes', 'tf_custom_meta_box_infor' );
if ( ! function_exists( 'tf_custom_meta_box_infor' ) )
{
    function tf_custom_meta_box_infor()
    {
        add_meta_box(
            'tf_custom_product_meta_box_infor',
            __( 'Product Information ', 'onsus' ),
            'add_custom_content_meta_box_infor',
            'product',
            'normal',
            'default'
        );
		
    }
}

if ( ! function_exists( 'add_custom_content_meta_box_infor' ) ){
    function add_custom_content_meta_box_infor( $post ){
        $prefix = '_tf_'; 
        $ingredients = get_post_meta($post->ID, $prefix.'information', true) ? get_post_meta($post->ID, $prefix.'information', true) : '';
        $args['textarea_rows'] = 6;
        wp_editor( $ingredients, 'information', $args );
        echo '<input type="hidden" name="custom_product_field_nonce" value="' . wp_create_nonce() . '">';
    }
}

// add_action( 'save_post', 'save_custom_content_meta_box_infor', 10, 1 );
if ( ! function_exists( 'save_custom_content_meta_box_infor' ) )
{
    function save_custom_content_meta_box_infor( $post_id ) {
        $prefix = '_tf_'; 
        if ( ! isset( $_POST[ 'custom_product_field_nonce' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'custom_product_field_nonce' ];
        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }
       
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        if ( 'product' == $_POST[ 'post_type' ] ){
            if ( ! current_user_can( 'edit_product', $post_id ) )
                return $post_id;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return $post_id;
        }
        update_post_meta( $post_id, $prefix.'information', wp_kses_post($_POST[ 'information' ]) );
    }
}

// add_action( 'woocommerce_single_product_summary', 'tf_product_information_field',50 );
function tf_product_information_field() {
    global $post;
    $product_ingredients = get_post_meta( $post->ID, '_tf_information', true );
	if ( ! empty( $product_ingredients ) ) {
		?>
		<div class="accordion-item">
			<div class="accordion-heading">
				<h3><?php echo sprintf(__("Information", "onsus"));?></h3>	
			</div>
			<div class="accordion-content">
				<?php
					echo apply_filters( 'the_content', $product_ingredients );
				?>
			</div>
		</div>
		<?php
    }
	?>
	<?php
}


add_action( 'woocommerce_variable_add_to_cart', 'tf_update_price_with_variation_price' );

  
function tf_update_price_with_variation_price() {
	global $product;
	
	$product_variations = $product->get_available_variations();
	foreach ($product_variations as $key => $value){
		if($value['display_price'] < $value['display_regular_price']){
			$sale_price = $value['display_price'];
			$regular_price = $value['display_regular_price'];
		}
	}
 
	wc_enqueue_js( "      
	 $(document).on('found_variation', 'form.cart', function( event, variation ) {   
		 if(variation.price_html) $('.summary > p.price').html(variation.price_html);
		 $('.woocommerce-variation-price').hide();
		 
	 });
	   $(document).on('hide_variation', 'form.cart', function( event, variation ) {   
	   });
	" );
}

add_action( 'woocommerce_single_product_summary', 'tf_single_rating', 10 );
function tf_single_rating(){
	 global $wpdb;
	 global $post;
	 global $product;
	 $count = $wpdb->get_var("
	 SELECT COUNT(meta_value) FROM $wpdb->commentmeta
	 LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
	 WHERE meta_key = 'rating'
	 AND comment_post_ID = $post->ID
	 AND comment_approved = '1'
	 AND meta_value > 0
	 ");
 
	 $rating = $wpdb->get_var("
		 SELECT SUM(meta_value) FROM $wpdb->commentmeta
		 LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		 WHERE meta_key = 'rating'
		 AND comment_post_ID = $post->ID
		 AND comment_approved = '1'
	 ");
 
	 if ( $count > 0 ) {
	 $product_id = $product->get_id();
	 $review_count = $product->get_review_count();
	 $average = number_format($rating / $count, 2);
	 $stock_sold = ( $total_sales = get_post_meta( $product_id, 'total_sales', true ) ) ? round( $total_sales ) : 0;
	 $url = home_url( '/' );
	 echo '<div class="meta-product" >';

	 echo '<div class="review" >';
 
	 echo '<span class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'onsus'), $average).'"><span style="width:'.($average*20).'%"> </span></span>';
	  if ( comments_open() ) : ?><a href="#tab-title-reviews" class="woocommerce-review-link number-reviews" rel="nofollow"><?php printf( _n( 'Review(%s)', 'Reviews(%s)', $review_count, 'onsus' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?></a><?php endif ;
	 echo '</div>';
	 
	 echo '<div class="product-sold" >';
	 echo sprintf(__("Sold: ", "onsus")) . esc_html( $stock_sold );
	 echo '</div>';

	 echo '<div class="product-view-shop" >';
	 echo '<a href="'.$url.'shop" >'.sprintf(__("View shop", "onsus")).'</a>';
	 echo '</div>';

	 echo '</div>';
	 }
 
}



// add_filter( 'woocommerce_after_single_product_summary', 'tf_product_description', 5 );
function tf_product_description() {
	echo '<div class="product-description">';
	echo '<h2>'.sprintf(__("Description: ", "onsus")).'</h2>';
	echo '<div class="product-description-content">';
	the_content();
	echo '</div>';
	echo '</div>';
	global $product;
	echo wc_display_product_attributes( $product );
	  
}

// add_filter( 'woocommerce_after_single_product_summary', 'tf_product_information', 6 );
function tf_product_information() {

	echo '<div class="product-description">';
	echo '<h2>'.sprintf(__("Product information: ", "onsus")).'</h2>';
	echo '<div class="product-description-content">';
	// do_action('woocommerce_product_additional_information');
	global $product;

    if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {
        wc_display_product_attributes( $product );
    }
	echo '</div>';
	echo '</div>';
}

// add_action( 'woocommerce_product_after_tabs', 'tf_review_button', 5 );
function tf_review_button() {
	 global $wpdb;
	 global $post;
	 global $product;
	 $count = $wpdb->get_var("
	 SELECT COUNT(meta_value) FROM $wpdb->commentmeta
	 LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
	 WHERE meta_key = 'rating'
	 AND comment_post_ID = $post->ID
	 AND comment_approved = '1'
	 AND meta_value > 0
	 ");
 
	 $rating = $wpdb->get_var("
		 SELECT SUM(meta_value) FROM $wpdb->commentmeta
		 LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		 WHERE meta_key = 'rating'
		 AND comment_post_ID = $post->ID
		 AND comment_approved = '1'
	 ");
 
	 if ( $count > 0 ) {
	 $product_id = $product->get_id();
	 $review_count = $product->get_review_count();
	 $average = number_format($rating / $count, 2);
	 $stock_sold = ( $total_sales = get_post_meta( $product_id, 'total_sales', true ) ) ? round( $total_sales ) : 0;
	 $url = home_url( '/' );
	 echo '<div class="meta-product" >';

	 echo '<div class="review" >';
	 echo '<div  class="rating-count">'.$average.'/5</div>';
	 echo '<span class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'onsus'), $average).'"><span style="width:'.($average*20).'%"> </span></span>';
	  if ( comments_open() ) : ?><a href="#tab-title-reviews" class="woocommerce-review-link number-reviews" rel="nofollow"><?php printf( _n( 'Review(%s)', 'Reviews(%s)', $review_count, 'onsus' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?></a><?php endif ;
	 echo '</div>';
	 
	 echo '</div>';
	 }
 
}

add_filter( 'woocommerce_product_tabs', '_remove_reviews_tab', 98 );
function _remove_reviews_tab( $tabs ) {
  unset( $tabs[ 'reviews' ] );
  return $tabs;
}

	
// function tf_content_single(){
// 	the_content();
// }
// add_action( 'woocommerce_after_single_product', 'tf_content_single', 10 );
 
 
// add_action( 'woocommerce_after_single_product_summary', 'tf_show_reviews', 15 );
function tf_show_reviews() {
	global $wpdb;
	global $post;
	global $product;
	$count = $wpdb->get_var("
		SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = $post->ID
		AND comment_approved = '1'
		AND meta_value > 0
	");

	$sql = $wpdb->prepare( "
		SELECT meta_value 
		FROM {$wpdb->prefix}commentmeta 
		INNER JOIN {$wpdb->prefix}comments ON {$wpdb->prefix}commentmeta.comment_id = {$wpdb->prefix}comments.comment_ID 
		WHERE comment_post_ID = %d AND meta_key = 'rating' ", get_the_ID() 
	);
	$results = $wpdb->get_results( $sql );
	$rating5 = 0;
	$rating4 = 0;
	$rating3 = 0;
	$rating2 = 0;
	$rating1 = 0;

	foreach($results as $result){
		if( $result->meta_value == '5' ) {
			$rating5++;
		} else if( $result->meta_value == '4' ) {
			$rating4++;
		} else if( $result->meta_value == '3' ) {
			$rating3++;
		} else if( $result->meta_value == '2' ) {
			$rating2++;
		} else if( $result->meta_value == '1' ) {
			$rating1++;
		}

	}
	$review_count = $product->get_review_count();
	$rating = $wpdb->get_var("
		SELECT SUM(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = $post->ID
		AND comment_approved = '1'
	");
	
	echo '<div class="product-description">';
	//echo '<h2>'.sprintf(__("Reviews ", "onsus")).'</h2>';
	echo '<div class="product-review-content"> <div class="content-review">';
	if ( $count > 0 ) {
		$product_id = $product->get_id();
		$review_count = $product->get_review_count();
		$average = number_format($rating / $count, 1);
		$stock_sold = ( $total_sales = get_post_meta( $product_id, 'total_sales', true ) ) ? round( $total_sales ) : 0;
		$url = home_url( '/' );
		echo '<div class="meta-product" >';
	
		echo '<div class="review" >';
		echo '<div  class="rating-count"><span>'.$average.'</span>/5</div>';
		echo '<span class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'onsus'), $average).'"><span style="width:'.($average*20).'%"> </span></span>';
		if ( comments_open() ) : ?><div class="number-review"><a href="#tab-title-reviews" class="woocommerce-review-link number-reviews" rel="nofollow"><?php printf( _n( 'Based on %s review', 'Based on %s reviews', $review_count, 'onsus' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?></a></div><?php endif ;
		echo '</div>';
		echo '</div>';
		
	// review table
	echo '<div class="table-review">';
	echo '<div class="row-review"><span>5 star</span><span class="proges-bar"><span class="proges" style="width:'.($rating5*100/$review_count).'%;"></span> </span>'.$rating5.' </div>';
	echo '<div class="row-review"><span>4 star</span><span class="proges-bar"><span class="proges" style="width:'.($rating4*100/$review_count).'%;"></span> </span>'.$rating4.'</div>';
	echo '<div class="row-review"><span>3 star</span><span class="proges-bar"><span class="proges" style="width:'.($rating3*100/$review_count).'%;"></span> </span>'.$rating3.'</div>';
	echo '<div class="row-review"><span>2 star</span><span class="proges-bar"><span class="proges" style="width:'.($rating2*100/$review_count).'%;"></span> </span>'.$rating2.'</div>';
	echo '<div class="row-review"><span>1 star</span><span class="proges-bar"><span class="proges" style="width:'.($rating1*100/$review_count).'%;"></span> </span>'.$rating1.'</div>';
	echo '</div>';
	}
	// Form comment 
	echo '<div class="comment-form">';
	if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'onsus' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'onsus' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'onsus' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Submit', 'onsus' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    => __( 'Name', 'onsus' ),
						'type'     => 'email',
						'placehoder'     => 'Your name',
						'value'    => $commenter['comment_author'],
						'required' => $name_email_required,
					),
					'email'  => array(
						'label'    => __( 'Email', 'onsus' ),
						'type'     => 'email',
						'placehoder'     => 'Your email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
					),
				);

				$comment_form['fields'] = array();

				foreach ( $fields as $key => $field ) {
					$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
					$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

					if ( $field['required'] ) {
						$field_html .= '&nbsp;<span class="required">*</span>';
					}

					$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" placeholder="' . esc_attr( $field['placehoder'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

					$comment_form['fields'][ $key ] = $field_html;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'onsus' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Rating:', 'onsus' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'onsus' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'onsus' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'onsus' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'onsus' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'onsus' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'onsus' ) . '</option>
					</select></div>';
				}

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Review:', 'onsus' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="Your review" required></textarea></p>';
				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'onsus' ); ?></p>
	<?php endif; 
	echo '</div></div><div class="comment-review-content">';
	
	comments_template();	
	echo '</div></div>';
	echo '</div>';
  
}

function tf_get_price($product){
	$price_html = '<div class="product-price">';
	if ( $product->get_price() > 0 ) {
		if ($product->get_price() && $product->get_regular_price()) {
			$from = $product->get_regular_price();
			$to = $product->get_price();
			$price_html .= '<del>'. ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) .'</del><ins>'.( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ) .'</ins>';
		}else{
			$to = $product->get_price();
			$price_html .= '<ins>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ) . '</ins>';
		}
	}else{
		$price_html .= '<div class="free">free</div>';
	}
	$price_html .= '</div>';
	return $price_html;
}



function ajax_filter_get_posts(  ) {

    
	
	$post_page = $_POST['post_page'];
	$taxonomy = $_POST['taxonomy'];
	$name = $_POST['name'];
    $id = $_POST['id'];
    $star = $_POST['star'];
    $min = $_POST['min'];
    $max = $_POST['max'];

    // WP Query
	wp_reset_query();

    $args = array(
		'post_type' => 'product',
		'posts_per_page' => $post_page,
	);

	$args['tax_query']['relation'] = 'AND';

	if ( (isset( $taxonomy ) && $taxonomy != '0')  ) {

		$args['tax_query'][] = array(                     
		                  
			  array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $taxonomy, 
				'cat_operator'=> 'AND'          
			  ),
		);
		
	}
	if ( (isset( $name ) && $name != '0' && !empty($name) ) || (isset( $id ) && $id != '0' && !empty($id)) ) {

		function convertNumericArrayToStringArray(array $array)
		{
		$stringArray = [];
		foreach ($array as $number) {
			$stringArray[] = strval($number);
		}

		return $stringArray;
		}

		$id = convertNumericArrayToStringArray($id);

		$arrlength = count($name);
		for($i = 0; $i < $arrlength; $i++) {
			$args['tax_query'][] = array(   
				                
				array(
					'taxonomy' => $name[$i],
					'field'    => 'term_id',
					'terms'    => $id,
					'terms_operator' => 'AND'
				),
			);
		}
		
	}

	if ( (isset( $star ) && $star != '0')  ) {
		$args['meta_query'][] = array(  
			                  
			  array(
				'key' => '_wc_average_rating',
				'value' => $star,
				'compare' => '>=',
			  )
		);
		

	}

	if ( (isset( $min ) ) || (isset( $max ))  ) {	
		if (!$min) {
			$min = 0;
		} else {
			$min = $_POST['min'];
		}
		if (!$max ) {
			$max = 999999999999;
		} else {
			$max = $_POST['max'];
		}
		
		$args['meta_query'][] = array(                   
			array(
				'key'       => '_price',
				'value'     => array( $min , $max ),
				'compare'   => 'BETWEEN',
				'type'      => 'numeric' ,
			)
		  );
		
	}

	$args['orderby']    = 'title';
	$args['order']      = 'asc';
	

	function custom_pagination() {
		global $wp_query;
		$big = 999999999;
		$pages = paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?page=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages,
			'prev_next' => false,
			'type' => 'array',
			'prev_next' => TRUE,
			'prev_text'    => '<i class="icon-monal-arrow-left"></i>',
			'next_text'    => '<i class="icon-monal-arrow-right-2"></i>',
				));
		if (is_array($pages)) {
			$current_page = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
			echo '<ul class="pagination">';
			foreach ($pages as $i => $page) {
				if ($current_page == 1 && $i == 0) {
					echo "<li class='active'>$page</li>";
				} else {
					if ($current_page != 1 && $current_page == $i) {
						echo "<li class='active'>$page</li>";
					} else {
						echo "<li>$page</li>";
					}
				}
			}
			echo '</ul>';
		}
	}

	// global $wp_query;
	$paged = $_POST['paged'];
	$args['paged'] = $paged;
    $query = new WP_Query( $args );

	$product_count = $query->found_posts;

	$query_all = new WP_Query(array(
		'post_type' => 'product',
		'post_status' => 'publish'
	  ));
	  
	$product_count_all = $query_all->found_posts;
	?>
	<script>
		(function($) {
			var text = "<?php echo 'Showing '. $product_count .' Results'; ?>";
			$('.woocommerce-result-count').text(text);
		})(jQuery);
	</script>

	<?php
	// $wp_query->max_num_pages = $query->max_num_pages;
	$output = '';
	 woocommerce_product_loop_start(); 
	 woocommerce_product_subcategories(); 
	
 
    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
	//   global $product;

	  ob_start();
	  ?>
		<?php wc_get_template_part( 'content', 'product' ); ?>
	  <?php
	  
	  

    endwhile;
	woocommerce_product_loop_end(); 

	$links = paginate_links([
		'base'    => '%_%',
		'format'  => '?paged=%#%',
		'total'   => $query->max_num_pages,
		'current' => $paged,
		'prev_text'    => '<i class="icon-monal-arrow-left"></i>',
		'next_text'    => '<i class="icon-monal-arrow-right-2"></i>',
	]);
	
	if ( $links ) {
		echo '<div class="pagination-filter">';
			echo $links;
		echo '</div>';
	}

	// custom_pagination();
	?>
	

	</div>
	<?php
	wp_reset_postdata(); 
	$output .= ob_get_clean();
	else:
      $output = '<h2>No Product found</h2>';
	  
    endif;

    // $response = json_encode($output);
	
    echo $output;

    die();
  }

add_action('wp_ajax_filter_posts', 'ajax_filter_get_posts');
add_action('wp_ajax_nopriv_filter_posts', 'ajax_filter_get_posts');



function ajax_clear_filter_get_posts(  ) {

    // Verify nonce
    // if( !isset( $_POST['afp_nonce'] ) || !wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ) )
    //   die('Permission denied');

    $taxonomy = $_POST['taxonomy'];
    $post_page = $_POST['post_page'];

    // WP Query
	wp_reset_query();
    $args = array(
		'post_type' => 'product',
		'posts_per_page' => $post_page,
	  );

	  
	//   $args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );


    // if( !$taxonomy ) {
    //   unset( $args['tag'] );
    // }
    $query = new WP_Query( $args );
		
	$output = '';
    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
	  global $product;
	  $product_id = $product->get_id();
	  $price = $product->get_price_html();
	  $image_url = get_the_post_thumbnail_url(); 

	  ob_start();
	  ?>

	  <?php wc_get_template_part( 'content', 'product' ); ?>
	  <?php
	  $output .= ob_get_clean();

    endwhile; wp_reset_postdata();  else:
      $output = '<h2>No Product found</h2>';

    endif;

    $response = json_encode($output);
    echo $response;

    die();
  }

add_action('wp_ajax_clear_filter_posts', 'ajax_clear_filter_get_posts');
add_action('wp_ajax_nopriv_clear_filter_posts', 'ajax_clear_filter_get_posts');

function ajax_tab_filter_get_postss(  ) {

    $tab_filter = $_POST['tab_filter'];
    $post_page = $_POST['post_page'];

	
    // WP Query
	wp_reset_query();
    $args = array(
		'post_type' => 'product',
		'posts_per_page' => $post_page,
	);
	
	switch(  $tab_filter ) {
		case 'sale':
			$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		break;

		case 'featured':
			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
				'operator' => 'IN',
				
			);
		break;

		case 'best_selling':
			$args['meta_key']   = 'total_sales';
			$args['orderby']    = 'meta_value_num';
			$args['order']      = 'desc';
		break;

		case 'top_rated': 
			$args['meta_key']   = '_wc_average_rating';
			$args['orderby']    = 'meta_value_num';
			$args['order']      = 'desc';          
		break;

		case 'mixed_order':
			$args['orderby']    = 'rand';
		break;

		default: 
			/* Recent */
			$args['orderby']    = 'date';
			$args['order']      = 'desc';
		break;
	}

	
	ob_start();

	$count = 0;
		
		?>
	<?php	
    $query = new WP_Query( $args );
		
	$output = '';
    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
	  global $product;
	  $product_id = $product->get_id();
	  $price = $product->get_price_html();
	  $image_url = get_the_post_thumbnail_url(); 

	  ob_start();
	  ?>

	  <?php wc_get_template_part( 'content', 'product' ); ?>
	  <?php
	  $output .= ob_get_clean();

    endwhile; wp_reset_postdata();  else:
      $output = '<h2>No Product found</h2>';

    endif;

    $response = json_encode($output);
    echo $response;

    die();
  }

//add_action('wp_ajax_tab_filter_posts', 'ajax_tab_filter_get_posts');
//add_action('wp_ajax_nopriv_tab_filter_posts', 'ajax_tab_filter_get_posts');


 /**
 * Add Progress Bar to the Cart and Checkout pages.
 */

 
add_action( 'woocommerce_before_cart', 'tf_product_bar' );
add_action( 'woocommerce_before_checkout_form', 'tf_product_bar', 5 );
add_action( 'woocommerce_before_thankyou', 'tf_product_bar', 5 );

if ( ! function_exists( 'tf_product_bar' ) ) {

	/**
	 * More product info
	 * Link to product
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function tf_product_bar() {
			?>

			<div class="checkout-wrap">
			<ul class="checkout-bar">
				<li class="active first">
					<div class="icon">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7.39995 17.8004C7.39995 18.7964 6.59595 19.6004 5.59995 19.6004C4.60395 19.6004 3.79995 18.7964 3.79995 17.8004C3.79995 16.8044 4.60395 16.0004 5.59995 16.0004C6.59595 16.0004 7.39995 16.8044 7.39995 17.8004ZM16.4 16.0004C15.404 16.0004 14.6 16.8044 14.6 17.8004C14.6 18.7964 15.404 19.6004 16.4 19.6004C17.396 19.6004 18.2 18.7964 18.2 17.8004C18.2 16.8044 17.396 16.0004 16.4 16.0004ZM6.91995 11.2004H14.924C15.644 11.2004 16.292 10.7684 16.58 10.1084L19.4 3.50839L17.744 2.80039L14.924 9.40039H7.38795L3.52395 0.400391H0.199951V2.20039H2.34795L5.62395 9.84439L4.32795 12.1004C3.63195 13.3004 4.49595 14.8004 5.88795 14.8004H18.2V13.0004H5.87595L6.91995 11.2004Z" fill="white"/>
							<path d="M11.9 4.15639L13.328 2.72839L14.6 4.00039L11 7.60039L7.39998 4.00039L8.67198 2.72839L10.1 4.15639L10.1 0.40039L11.9 0.400391L11.9 4.15639Z" fill="white"/>
						</svg>
					</div>

					<span>
						<a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>"><?php esc_html_e( 'Shopping Cart', 'onsus' ); ?></a>
					</span>
					</li>
				<li class="next">
					<div class="icon">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7.39995 17.8004C7.39995 18.7964 6.59595 19.6004 5.59995 19.6004C4.60395 19.6004 3.79995 18.7964 3.79995 17.8004C3.79995 16.8044 4.60395 16.0004 5.59995 16.0004C6.59595 16.0004 7.39995 16.8044 7.39995 17.8004ZM16.4 16.0004C15.404 16.0004 14.6 16.8044 14.6 17.8004C14.6 18.7964 15.404 19.6004 16.4 19.6004C17.396 19.6004 18.2 18.7964 18.2 17.8004C18.2 16.8044 17.396 16.0004 16.4 16.0004ZM6.91995 11.2004H14.924C15.644 11.2004 16.292 10.7684 16.58 10.1084L19.4 3.50839L17.744 2.80039L14.924 9.40039H7.38795L3.52395 0.400391H0.199951V2.20039H2.34795L5.62395 9.84439L4.32795 12.1004C3.63195 13.3004 4.49595 14.8004 5.88795 14.8004H18.2V13.0004H5.87595L6.91995 11.2004Z" fill="white"/>
							<path d="M11.9 4.15639L13.328 2.72839L14.6 4.00039L11 7.60039L7.39998 4.00039L8.67198 2.72839L10.1 4.15639L10.1 0.40039L11.9 0.400391L11.9 4.15639Z" fill="white"/>
						</svg>
					</div>
				<span>
				<a href="<?php echo get_permalink( wc_get_page_id( 'checkout' ) ); ?>"><?php esc_html_e( 'Shopping & Checkout', 'onsus' ); ?></a></span></li>
				<li class="end">
					<div class="icon">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7.39995 17.8004C7.39995 18.7964 6.59595 19.6004 5.59995 19.6004C4.60395 19.6004 3.79995 18.7964 3.79995 17.8004C3.79995 16.8044 4.60395 16.0004 5.59995 16.0004C6.59595 16.0004 7.39995 16.8044 7.39995 17.8004ZM16.4 16.0004C15.404 16.0004 14.6 16.8044 14.6 17.8004C14.6 18.7964 15.404 19.6004 16.4 19.6004C17.396 19.6004 18.2 18.7964 18.2 17.8004C18.2 16.8044 17.396 16.0004 16.4 16.0004ZM6.91995 11.2004H14.924C15.644 11.2004 16.292 10.7684 16.58 10.1084L19.4 3.50839L17.744 2.80039L14.924 9.40039H7.38795L3.52395 0.400391H0.199951V2.20039H2.34795L5.62395 9.84439L4.32795 12.1004C3.63195 13.3004 4.49595 14.8004 5.88795 14.8004H18.2V13.0004H5.87595L6.91995 11.2004Z" fill="white"/>
							<path d="M11.9 4.15639L13.328 2.72839L14.6 4.00039L11 7.60039L7.39998 4.00039L8.67198 2.72839L10.1 4.15639L10.1 0.40039L11.9 0.400391L11.9 4.15639Z" fill="white"/>
						</svg>
					</div>
					<span><?php esc_html_e( 'Confirmation', 'onsus' ); ?></span>
				</li>
			</ul>
			</div>
			
		<?php

	}
}// End if().


add_action( 'woocommerce_after_cart', 'tf_notice_product_cart', 10 );

/**
 * Custom markup around cart field.
 */
function tf_notice_product_cart() {

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
				$shipping_bar .= '<div class="tf-notice"> <svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6.5 13H4.5C4.224 13 4 12.776 4 12.5C4 12.224 4.224 12 4.5 12H6.5C6.776 12 7 12.224 7 12.5C7 12.776 6.776 13 6.5 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
				<path d="M22.7499 13H21.4999C21.2239 13 20.9999 12.776 20.9999 12.5C20.9999 12.224 21.2239 12 21.4999 12H22.3349L23.0089 8.40801C22.9999 6.57 21.4299 5 19.4999 5H16.2169L14.6259 12H17.4999C17.7759 12 17.9999 12.224 17.9999 12.5C17.9999 12.776 17.7759 13 17.4999 13H13.9999C13.8479 13 13.7039 12.931 13.6089 12.812C13.5139 12.694 13.4779 12.538 13.5119 12.39L15.3299 4.39C15.3819 4.161 15.5839 4 15.8179 4H19.4999C21.9809 4 23.9999 6.019 23.9999 8.50001L23.2409 12.592C23.1969 12.829 22.9909 13 22.7499 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
				<path d="M19.5 15C18.122 15 17 13.879 17 12.5C17 11.121 18.122 10 19.5 10C20.878 10 22 11.121 22 12.5C22 13.879 20.878 15 19.5 15ZM19.5 11C18.673 11 18 11.673 18 12.5C18 13.327 18.673 14 19.5 14C20.327 14 21 13.327 21 12.5C21 11.673 20.327 11 19.5 11Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
				<path d="M8.5 15C7.122 15 6 13.879 6 12.5C6 11.121 7.122 10 8.5 10C9.878 10 11 11.121 11 12.5C11 13.879 9.878 15 8.5 15ZM8.5 11C7.673 11 7 11.673 7 12.5C7 13.327 7.673 14 8.5 14C9.327 14 10 13.327 10 12.5C10 11.673 9.327 11 8.5 11Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
				<path d="M6.5 4.00001H2.5C2.224 4.00001 2 3.776 2 3.5C2 3.224 2.224 3 2.5 3H6.5C6.776 3 7 3.224 7 3.5C7 3.776 6.776 4.00001 6.5 4.00001Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
				<path d="M6.5 6.99999H1.5C1.224 6.99999 1 6.77599 1 6.5C1 6.224 1.224 6 1.5 6H6.5C6.776 6 7 6.224 7 6.5C7 6.77599 6.776 6.99999 6.5 6.99999Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
				<path d="M6.49999 9.99999H0.5C0.224 9.99999 0 9.77599 0 9.5C0 9.224 0.224 9 0.5 9H6.49999C6.77599 9 6.99999 9.224 6.99999 9.5C6.99999 9.77599 6.77599 9.99999 6.49999 9.99999Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
				<path d="M14 13H10.5C10.224 13 10 12.776 10 12.5C10 12.224 10.224 12 10.5 12H13.601L15.873 2H4.5C4.224 2 4 1.776 4 1.5C4 1.224 4.224 1 4.5 1H16.5C16.652 1 16.796 1.069 16.891 1.188C16.986 1.306 17.022 1.462 16.988 1.61L14.488 12.61C14.436 12.839 14.233 13 14 13Z" fill="#333E48" stroke="#333E48" stroke-width="0.5"/>
				</svg>
				' . wp_kses_post( $progress_text);
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
				</svg>
				' . wp_kses_post( $success_text ) . '</div>';
				$shipping_bar .= '</div>';
			}
			echo $shipping_bar;
		}
	}
}

// add_action( 'woocommerce_after_cart', 'tf_testimonial_cart', 15 );
// function tf_testimonial_cart() {                
// 	themesflat_dynamic_sidebar("themesflat-custom-sidebar-testimonial");
// } 

// Add image 360 gallery

add_action( 'add_meta_boxes', 'tf_media_uploader_meta_box' );
function tf_media_uploader_meta_box() {
	add_meta_box( 'tf-media-field', 'Product Image 360', 'tf_media_uploader_meta_box_func', 'product', 'normal', 'high' );
}

function tf_media_uploader_meta_box_func( $post ) {

	$banner_img = get_post_meta( $post->ID, 'tf_post_banner_img', true );
	?>
	<table cellspacing="10" cellpadding="10">
		<tr>
			<td>Product Image 360</td>
			<td>
				<?php echo tf_multi_media_uploader_field( 'tf_post_banner_img', $banner_img ); ?>
			</td>
		</tr>
	</table>
	<?php

}
function tf_multi_media_uploader_field( $name, $value = '' ) {

	$image = '">Add Media';
	$image_str = '';
	$image_size = 'full';
	$display = 'none';
	$value = explode( ',', $value );

	if ( !empty( $value ) ) {
		foreach ( $value as $values ) {
			if ( $image_attributes = wp_get_attachment_image_src( $values, $image_size ) ) {
				$image_str .= '<li data-attechment-id=' . $values . '><a href="' . $image_attributes[0] . '" target="_blank"><img src="' . $image_attributes[0] . '" /></a><i class="dashicons dashicons-no delete-img"></i></li>';
			}
		}
	}

	if($image_str){
		$display = 'inline-block';
	}
	return '<div class="tf-multi-upload-medias"><ul>' . $image_str . '</ul><a href="#" class="tf_multi_upload_image_button button' . $image . '</a><input type="hidden" class="attechments-ids ' . $name . '" name="' . $name . '" id="' . $name . '" value="' . esc_attr( implode( ',', $value ) ) . '" /><a href="#" class="tf_multi_remove_image_button button" style="display:inline-block;display:' . $display . '">Remove media</a></div>';

}

add_action( 'save_post', 'tf_meta_box_save' );

function tf_meta_box_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}
	
	if( isset( $_POST['tf_post_banner_img'] ) ){
		update_post_meta( $post_id, 'tf_post_banner_img', $_POST['tf_post_banner_img'] );
	}
}

function tf_add_admin_media_scripts() {
	wp_enqueue_style( 'admin-custom-style',  THEMESFLAT_LINK . '/css/gallery-metabox.css', false, '1.1', 'all' );
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
    wp_enqueue_script( 'admin-custom-script', THEMESFLAT_LINK .  '/js/gallery-metabox.js', array( 'jquery' ), 1.1, true );
}
add_action( 'admin_enqueue_scripts', 'tf_add_admin_media_scripts' );

// Add time Delivery

add_action('woocommerce_product_options_shipping','add_delivery_custom_field' );
function add_delivery_custom_field(){
    woocommerce_wp_text_input( array(
        'id'          => '_delivery',
        'label'       => __('Time delivery','onsus'),
        'desc_tip'    => 'true',
        'description' => __('Time delivery','onsus')
    ) ); 
}

add_action( 'woocommerce_process_product_meta', 'save_delivery_custom_field', 10, 1 );
function save_delivery_custom_field( $post_id ){
    if( isset($_POST['_delivery']) )
        update_post_meta( $post_id, '_delivery', esc_attr( $_POST['_delivery'] ) );
}

function tf_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'tf_disable_srcset' );


add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'override_woocommerce_image_size_gallery_thumbnail' );
function override_woocommerce_image_size_gallery_thumbnail( $size ) {
    return array(
        'width'  => 1000,
        'height' => 1000,
        'crop'   => 0,
    );
}


function tf_footer_shop() {
    echo  get_template_part( 'woocommerce/mobile/footer-shop' );
}

add_action('wp_footer', 'tf_footer_shop');

function tf_search_popup() {
    echo  get_template_part( 'woocommerce/mobile/popup-search' );
}

add_action('wp_footer', 'tf_search_popup');



function tf_add_to_cart_single() {
	global $product;

	ob_start();
	?>
	<div class="tf-add-to-cart">
		<?php woocommerce_template_single_add_to_cart(); ?>
	</div>
	<?php

	echo ob_get_clean();
}

add_action( 'woocommerce_after_single_product_summary', 'tf_add_to_cart_single', 11 );

function tf_form_popup() {
	if ( themesflat_get_opt('show_popup_form') == 1 ) :
		if ( is_front_page() ) :
		ob_start();
		$img_popup = themesflat_get_opt('img_popup');
		?>
    	<div class="modal modal-form-popup fade" id="tf_form_popup" tabindex="-1" role="dialog">
			<div class="modal-dialog <?php if ($img_popup != '') { echo "is-img"; }?>" role="document">
				<div class="modal-content">
					<a href="#" class="close" data-dismiss="modal" aria-label="Close"><span	aria-hidden="true"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.0673 12.1829C13.1254 12.241 13.1714 12.3099 13.2028 12.3858C13.2343 12.4617 13.2505 12.543 13.2505 12.6251C13.2505 12.7072 13.2343 12.7885 13.2028 12.8644C13.1714 12.9403 13.1254 13.0092 13.0673 13.0673C13.0092 13.1254 12.9403 13.1714 12.8644 13.2028C12.7885 13.2343 12.7072 13.2505 12.6251 13.2505C12.543 13.2505 12.4617 13.2343 12.3858 13.2028C12.3099 13.1714 12.241 13.1254 12.1829 13.0673L7.0001 7.8837L1.81729 13.0673C1.70002 13.1846 1.54096 13.2505 1.3751 13.2505C1.20925 13.2505 1.05019 13.1846 0.932916 13.0673C0.81564 12.95 0.749756 12.791 0.749756 12.6251C0.749756 12.4593 0.81564 12.3002 0.932916 12.1829L6.11651 7.0001L0.932916 1.81729C0.81564 1.70002 0.749756 1.54096 0.749756 1.3751C0.749756 1.20925 0.81564 1.05019 0.932916 0.932916C1.05019 0.81564 1.20925 0.749756 1.3751 0.749756C1.54096 0.749756 1.70002 0.81564 1.81729 0.932916L7.0001 6.11651L12.1829 0.932916C12.3002 0.81564 12.4593 0.749756 12.6251 0.749756C12.791 0.749756 12.95 0.81564 13.0673 0.932916C13.1846 1.05019 13.2505 1.20925 13.2505 1.3751C13.2505 1.54096 13.1846 1.70002 13.0673 1.81729L7.8837 7.0001L13.0673 12.1829Z" fill="#333E48"/>
					</svg></span></a>
						
					<div class="form-popup">
						<?php if ($img_popup != '') {?>
						<div class="image">
							<img src="<?php echo esc_url($img_popup); ?>" alt="Image">
						</div>
						<?php } ?>
						<div class="content-popup">
							<?php if ( themesflat_get_opt('popup_heading') != '' ) :?><div class="heading"><?php echo themesflat_get_opt('popup_heading'); endif; ?></div>
							<?php if ( themesflat_get_opt('popup_des') != '' ) :?><p class="des"><?php echo themesflat_get_opt('popup_des'); endif; ?></p>
							<?php if( themesflat_get_opt('shortcode_mailchimp') ) { echo do_shortcode( ''.themesflat_get_opt('shortcode_mailchimp').'' ); } else { printf( '' ); } ?>
						</div>
					</div>				
				</div>
			</div>
		</div>
		<?php
		echo ob_get_clean();
	endif;
	endif;
}

add_action('wp_footer', 'tf_form_popup');

// Ajax add to cart single

add_action( 'wc_ajax_add_to_cart_single', 'add_to_cart_single' );
add_action( 'wp_ajax_nopriv_add_to_cart_single',  'add_to_cart_single'  );

function add_to_cart_single(){
        
	if ( ! isset( $_POST['product_id'] ) ) {
		return;
	}

	$product_id         = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
	$product            = wc_get_product( $product_id );
	$quantity           = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( wp_unslash( $_POST['quantity'] ) );
	$variation_id       = !empty( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;
	$variations         = !empty( $_POST['variations'] ) ? array_map( 'sanitize_text_field', json_decode( stripslashes( $_POST['variations'] ), true ) ) : array();
	$passed_validation  = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations );
	$product_status     = get_post_status( $product_id );

	$cart_item_data = $_POST['productdata'];

	if ( $passed_validation && 'publish' === $product_status ) {

		if( count( $variations ) == 0 ){
			\WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations, $cart_item_data );
		}

		do_action( 'woocommerce_ajax_added_to_cart', $product_id );
		if ( 'yes' === get_option('woocommerce_cart_redirect_after_add') ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
		}
		\WC_AJAX::get_refreshed_fragments();
	} else {
		$data = array(
			'error' => true,
			'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ),
		);
		echo wp_send_json( $data );
	}
	wp_send_json_success();
	
}



// Ajax handler pagination
function handle_shop_pagination() {
           
	if (!wp_verify_nonce($_POST['nonce'], 'load_posts_nonce')) {
		wp_send_json_error('Invalid nonce');
	}

	

	$item_per_page = $_POST['item_per_page'];
	
	$paged  = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : '';
	 
	$product_cat = isset($_POST['product_cat']) ? sanitize_text_field($_POST['product_cat']) : '';
    $key_word = isset($_POST['key_word']) ? sanitize_text_field($_POST['key_word']) : '';


	$args = array(
		'posts_per_page' => $item_per_page,
		'post_type' => 'product',
		'paged' => $paged,
    );

	if (!empty($key_word)) {
        $args['s'] = $key_word; 
    }

	if (!empty($product_cat)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $product_cat, 
            ),
        ) ; 
    }

	$args['orderby'] = 'title';
	$args['order'] = 'asc';
	$output ='';
	$query = new WP_Query($args);
	if ( $query->have_posts() ) : 
		while ( $query->have_posts() ) : $query->the_post();	
		ob_start();
			wc_get_template_part( 'content', 'product' );			
			$output .= ob_get_clean();
		endwhile; 
		wp_reset_postdata(); 
	
	else:
	$output = '<h2>No posts found</h2>';
  	endif;


	echo json_encode( $output );

  	die();
}

add_action( 'wp_ajax_handle_shop_pagination', 'handle_shop_pagination' );
add_action( 'wp_ajax_nopriv_handle_shop_pagination',  'handle_shop_pagination'  );


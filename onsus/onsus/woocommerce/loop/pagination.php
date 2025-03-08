<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 9.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}

$shop_pagination = themesflat_get_opt('shop_pagination');
$shop_loadmore_text = themesflat_get_opt('shop_loadmore_text');
if (isset($_GET['pagination'])) {
	$shop_pagination = $_GET['pagination'];
}
?>

<?php if($shop_pagination == 'number') { ?>

<nav class="woocommerce-pagination">
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array( // WPCS: XSS ok.
			'base'         => $base,
			'format'       => $format,
			'add_args'     => false,
			'current'      => max( 1, $current ),
			'total'        => $total,
			'prev_text'    => '<i class="icon-monal-arrow-left"></i>',
			'next_text'    => '<i class="icon-monal-arrow-right-2"></i>',
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3,
		) ) );
	?>
</nav>
	<script>
		jQuery(document).ready(function($) {
			
			$('.woocommerce-pagination ul .page-numbers').on('click', function(e) {
				e.preventDefault();
				var totalPages = <?php echo $total; ?>;
				var currentPage = $(this).text();
				
				$('.woocommerce-pagination ul .page-numbers').removeClass('current');
				$(this).addClass('current');
				if (currentPage <= totalPages) {
					loadmore_shop(currentPage);
					currentPage++;
				}
			});

			function loadmore_shop(page) {
				let $item_per_page = <?php echo themesflat_get_opt('shop_products_per_page')?>;

				var product_cat = urlParams.get('product_cat'); 
				if(product_cat === null || product_cat.trim() === '') {
					product_cat ='';
				}	

				var key_word = urlParams.get('s');
				if(key_word === null || key_word.trim() === '') {
					key_word='';
				}	
				$.ajax({
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'POST',
					data: '&action=handle_shop_pagination&security=' + filter_var.filter_nonce + '&product_cat=' + product_cat + '&key_word=' + key_word + '&item_per_page=' + $item_per_page + '&page=' + page +'&nonce=<?php echo wp_create_nonce('load_posts_nonce'); ?>' ,
					beforeSend: function () {
						// $('.tf-listing-wrap .wrap-listing-post').append('<div class="overlay-filter-tab" > <div class="filter-loader"></div> </div>');
						$('.products-content > ul.products').addClass('loading');
					},
					success: function(response) {
						response = JSON.parse(response);
						$('.products-content > ul.products ').html(response);     
						
						$('.products-content > ul.products').removeClass('loading');
						productOptions();
						
					}
				});
			}

			var productOptions = function () { 
				$('.product-option .thumb').on('click', function (e) {

					if ($(this).hasClass('active')) {
						e.preventDefault;
					} else {
						$(this).parent().find(".thumb.active").each(function () {
							$(this).removeClass('active');
						});
						$(this).addClass('active');
						var options_img = $(this).data("src");

						$(this).closest('.inner').find('.attachment-woocommerce_thumbnail,.wp-post-image').removeClass('none animated fadeIn').fadeOut(100, function () {
							$(this).attr('src', options_img);
							$(this).addClass('animated fadeIn').fadeIn(500);
						});
						$(this).closest('.item').find('.img_thumbnail').removeClass('none animated fadeIn').fadeOut(100, function () {
							$(this).attr('src', options_img);
							$(this).addClass('animated fadeIn').fadeIn(500);
						});
					}
				});

			}
		});
	</script>
               
<?php } ?>

<?php if($shop_pagination == 'loadmore') { ?>
	<nav class="navigation paging-navigation loadmore " role="navigation">
        <div class="pagination loop-pagination text-center draw-border">
            <a class="btn btn-primary"><?php echo esc_html($shop_loadmore_text)?></a>
        </div>
    </nav>
	<script>
		jQuery(document).ready(function($) {
			var currentPage = 1;
			var totalPages = <?php echo $total; ?>;

			$('.paging-navigation.loadmore a').on('click', function(e) {
				e.preventDefault();
				currentPage++;
				loadmore_shop(currentPage);
			});

			function loadmore_shop(page) {
				let $item_per_page = <?php echo themesflat_get_opt('shop_products_per_page')?>;

				var product_cat = urlParams.get('product_cat'); 
				if(product_cat === null || product_cat.trim() === '') {
					product_cat ='';
				}	

				var key_word = urlParams.get('s');
				if(key_word === null || key_word.trim() === '') {
					key_word='';
				}	

				$.ajax({
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'POST',
					data: '&action=handle_shop_pagination&security=' + filter_var.filter_nonce + '&product_cat=' + product_cat + '&key_word=' + key_word + '&item_per_page=' + $item_per_page + '&page=' + page +'&nonce=<?php echo wp_create_nonce('load_posts_nonce'); ?>' ,
					beforeSend: function () {
						// $('.tf-listing-wrap .wrap-listing-post').append('<div class="overlay-filter-tab" > <div class="filter-loader"></div> </div>');
						$('.paging-navigation.loadmore .loop-pagination').addClass('loading');
					},
					success: function(response) {
						response = JSON.parse(response);
						$('.products-content > ul.products ').append(response);     
						
						$('.paging-navigation.loadmore .loop-pagination').removeClass('loading');
						// $('.overlay-filter-tab').remove();
						if (currentPage >= totalPages) {
							$('.paging-navigation.loadmore').hide();
						}
						productOptions();
					}
				});
			}
			var productOptions = function () { 
				$('.product-option .thumb').on('click', function (e) {

					if ($(this).hasClass('active')) {
						e.preventDefault;
					} else {
						$(this).parent().find(".thumb.active").each(function () {
							$(this).removeClass('active');
						});
						$(this).addClass('active');
						var options_img = $(this).data("src");

						$(this).closest('.inner').find('.attachment-woocommerce_thumbnail,.wp-post-image').removeClass('none animated fadeIn').fadeOut(100, function () {
							$(this).attr('src', options_img);
							$(this).addClass('animated fadeIn').fadeIn(500);
						});
						$(this).closest('.item').find('.img_thumbnail').removeClass('none animated fadeIn').fadeOut(100, function () {
							$(this).attr('src', options_img);
							$(this).addClass('animated fadeIn').fadeIn(500);
						});
					}
				});

			}
		});
	</script>
<?php } ?>

<?php if($shop_pagination == 'autoload') { ?>
	<nav class="navigation paging-navigation autoload " role="navigation">
		<div class="pagination loop-pagination ">
		</div>
	</nav>
	<script>
		jQuery(document).ready(function($) {
			var currentPage = 1;
			var totalPages = <?php echo $total; ?>;

			var container = $('.products-content > ul.products');
			var footer = $('.site-footer').height();

			
			// Autoload when scrolling
			$(window).scroll(function() {
				// if ( ($(window).scrollTop() >= ( container.scrollTop() + container.height() ))) {
				    
				//     if (currentPage > totalPages) {
				// 		$('.paging-navigation.autoload').remove();
				// 	} else {						
				// 		autoloadproduct(currentPage);
				// 	}	
				// }

				if (($(window).scrollTop() + $(window).height() + footer ) >= $(document).height()  && currentPage < totalPages) {
					if (currentPage > totalPages) {
						$('.paging-navigation.autoload').remove();
					} else {						
						currentPage++;
						autoloadproduct(currentPage);
					}
					
				}
				
			});

			function autoloadproduct(page) {
				let $item_per_page = <?php echo themesflat_get_opt('shop_products_per_page')?>;
			
				var product_cat = urlParams.get('product_cat'); 
				if(product_cat === null || product_cat.trim() === '') {
					product_cat ='';
				}	

				var key_word = urlParams.get('s');
				if(key_word === null || key_word.trim() === '') {
					key_word='';
				}	

				$.ajax({
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'POST',
					data: '&action=handle_shop_pagination&security=' + filter_var.filter_nonce + '&product_cat=' + product_cat + '&key_word=' + key_word + '&item_per_page=' + $item_per_page + '&page=' + page +'&nonce=<?php echo wp_create_nonce('load_posts_nonce'); ?>' ,
					beforeSend: function () {
						$('.paging-navigation.autoload .loop-pagination').addClass('loading');
					},
					success: function(response) {
						response = JSON.parse(response);
						$('.products-content > ul.products ').append(response);     
						$('.paging-navigation.autoload .loop-pagination').removeClass('loading');
						productOptions();
						currentPage = page;	
						// currentPage++;							
					}
				});
				
			}

			var productOptions = function () { 
				$('.product-option .thumb').on('click', function (e) {

					if ($(this).hasClass('active')) {
						e.preventDefault;
					} else {
						$(this).parent().find(".thumb.active").each(function () {
							$(this).removeClass('active');
						});
						$(this).addClass('active');
						var options_img = $(this).data("src");

						$(this).closest('.inner').find('.attachment-woocommerce_thumbnail,.wp-post-image').removeClass('none animated fadeIn').fadeOut(100, function () {
							$(this).attr('src', options_img);
							$(this).addClass('animated fadeIn').fadeIn(500);
						});
						$(this).closest('.item').find('.img_thumbnail').removeClass('none animated fadeIn').fadeOut(100, function () {
							$(this).attr('src', options_img);
							$(this).addClass('animated fadeIn').fadeIn(500);
						});
					}
				});

			}

		});
	</script>
<?php } ?>
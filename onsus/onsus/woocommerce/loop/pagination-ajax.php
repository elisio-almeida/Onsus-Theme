<?php

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
				if ( $(window).scrollTop() >= container.scrollTop() + container.height() && currentPage < totalPages) {
				    currentPage++;
				    autoloadproduct(currentPage);
				}
				// if (($(window).scrollTop() + $(window).height() + footer ) >= $(document).height()  && currentPage < totalPages) {
				// 	currentPage++;
				// 	autoloadproduct(currentPage);
				// }
				
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
						// $('.tf-listing-wrap .wrap-listing-post').append('<div class="overlay-filter-tab" > <div class="filter-loader"></div> </div>');
						$('.paging-navigation.loadmore .loop-pagination').addClass('loading');
					},
					success: function(response) {
						response = JSON.parse(response);
						$('.products-content > ul.products ').append(response);     
						
						$('.paging-navigation.loadmore .loop-pagination').removeClass('loading');
						// $('.overlay-filter-tab').remove();
						currentPage = page;
						console.log(currentPage,totalPages);

						if (currentPage >= totalPages) {
							$('.paging-navigation.autoload').hide();
						}
					}
				});
				
			}
		});
	</script>
<?php } ?>
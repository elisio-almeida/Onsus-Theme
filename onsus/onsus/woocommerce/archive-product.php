<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 8.6.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<?php get_header();?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="wrap-content-area">
			    <div id="primary" class="content-area">

		            <main id="main" class="post-wrap" role="main">

						<?php get_template_part( 'woocommerce/category-product' ); ?>

		            	<div class="content-woocommerce">
							<?php if ( have_posts() ) : ?>
								<div class="meta-wrap clearfix">
								<?php
									// woocommerce_before_shop_loop hook.
									// do_action( 'woocommerce_before_shop_loop' );
								?>
									<?php if(themesflat_get_opt('catalog_toolbar') == 1) {?>
									<div class="row">
										<div class="left-top-shop-loop col-lg-6 col-12">
											<?php
											/**
											* Add ordering select box.
											* @hooked woocommerce_catalog_ordering - 10
											*/
											if(themesflat_get_opt('catalog_view') == 1) {
											remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
											add_action('tf_woocommerce_result_count', 'woocommerce_result_count', 10);
											do_action('tf_woocommerce_result_count');
											}
											
											?>
											<span class="filter-button btn-des"><svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="margin-right:5px"><path d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"></path></svg><?php esc_html_e('Filter', 'onsus') ?></span>

										</div>
										<div class="popup-filter">
												<div class="overlay"></div>
												<div class="content-popup-filter">
													<div class="filter-header">
														<span class="heading"><?php esc_html_e('FILTER', 'onsus') ?></span>
														<span class="filter-close"></span>
													</div>
													<div class="filter-content">
														<?php dynamic_sidebar( 'shop-sidebar' ); ?>
													</div>
												</div>
											</div>
										<div class="center-top-shop-loop col-lg-6 col-md-12 col-12">
											
											<div class="wrap-toggle-products-layout">
												<span class="filter-button"><svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="margin-right:5px"><path d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"></path></svg><?php esc_html_e('Filter', 'onsus') ?></span>

												<?php if(themesflat_get_opt('catalog_btn_change') == 1) {?>
													<span class="label-toggle-products-layout"><?php esc_html_e('View as', 'onsus'); ?></span>
													<a class="onsus-icon-list toggle-products-grid-layout toggle-products-layout-button active"
														href="#" title="<?php esc_attr_e('Grid layout', 'onsus') ?>"></a>
													<a class="onsus-icon-list-2 toggle-products-list-layout toggle-products-layout-button"
														href="#" title="<?php esc_attr_e('List layout', 'onsus') ?>"></a>
												<?php } ?>
											</div>
									
											<?php
											/**
											* Add result count
											* @hooked woocommerce_result_count - 10
											*/
											if(themesflat_get_opt('catalog_sort_by') == 1) {
											add_action( 'woocommerce_before_shop_loop', 'tf_wc_products_per_page', 25 );
											remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
											add_action('tf_woocommerce_catalog_ordering', 'woocommerce_catalog_ordering', 10);
											do_action('tf_woocommerce_catalog_ordering');
											}
											?>
										</div>
									</div>
									<?php } ?>
								</div>
								
								<div class="filter-active"><span class="btn-clear-all">Clear All</span><span class="btn-clear-price"></span></div>
								<div class="products-content">
									<?php woocommerce_product_loop_start(); ?>
										<?php woocommerce_product_subcategories(); ?>
										<?php while ( have_posts() ) : the_post(); ?>
											<?php wc_get_template_part( 'content', 'product' ); ?>
										<?php endwhile; // end of the loop. ?>
									<?php woocommerce_product_loop_end(); ?>
								</div>
								<?php
									// woocommerce_after_main_content hook.
									do_action( 'woocommerce_after_shop_loop' );
								?>
							<?php else : ?>
								<p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'onsus' ); ?></p>
							<?php endif; ?>
						</div>
		            </main><!-- #main -->
				</div><!-- #primary -->
	        	
	        	<?php 
				if ( themesflat_get_opt( 'shop_layout' ) == 'sidebar-left' || themesflat_get_opt( 'shop_layout' ) == 'sidebar-right' ) :
					get_sidebar();
				endif;
				?>
			</div>
    	</div><!-- /.col-md-12 -->
	</div><!-- /.row -->
</div><!-- /.container -->
<?php get_footer(); ?>
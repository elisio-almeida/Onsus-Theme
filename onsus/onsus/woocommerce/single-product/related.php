<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (themesflat_get_opt('related_products') != 1) {
	return;
}

$number_desk  = themesflat_get_opt( 'number_related_product_desk' );
$number_tab  = themesflat_get_opt( 'number_related_product_tab' );
$number_mob  = themesflat_get_opt( 'number_related_product_mob' );
$number_mob2  = themesflat_get_opt( 'number_related_product_mob2' );

if ( $related_products ) : ?>
	<section class="related products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Recently Viewed', 'onsus' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		
		<?php //woocommerce_product_loop_start(); ?>
		<div class="related-product has-carousel"  data-column="<?php echo esc_attr($number_desk); ?>" data-column2="<?php echo esc_attr($number_tab); ?>" data-column3="<?php echo esc_attr($number_mob); ?>" data-column4="<?php echo esc_attr($number_mob2); ?>"  >
            <div class="owl-carousel"> 
			<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

			<?php endforeach; ?>
			</div>
		</div>
		<?php //woocommerce_product_loop_end(); ?>
			
	</section>
	<?php
endif;

wp_reset_postdata();

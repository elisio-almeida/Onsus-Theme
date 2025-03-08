<?php
/**
 * Single Product Social
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/share-social.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>

	<?php do_action( 'woocommerce_product_share_start' ); ?>

	<?php	if( themesflat_get_opt('show_social_share') == 1 ):
        $value = themesflat_get_json('social_links');
        $sharelink = themesflat_available_social_icons();
        ?>
        <div class="social-share-article product-share"><h6><?php echo esc_html__( 'SHARE :', 'onsus' ); ?></h6>        
            <ul class="themesflat-socials">
                <?php
                    foreach ( $value as $key => $val ) {
                        if ( $key != '__ordering__') {
                            $link = $sharelink[$key]['share_link'].get_the_permalink();
                            printf(
                                '<li class="%1$s">
                                    <a href="%2$s" target="_blank" rel="alternate" title="%1$s">
                                        <i class="icon-monal-%4$s"></i>
                                    </a>
                                </li>',
                                esc_attr( $key ),
                                esc_url( $link ),
                                esc_attr( $link ),
                                esc_attr( $key )
                            );
                        }
                    }
                ?>
            </ul>
        </div>
        <?php
    endif;
	?>

	<?php do_action( 'woocommerce_product_share_end' ); ?>

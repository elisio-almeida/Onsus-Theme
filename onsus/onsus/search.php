<?php
/**
 * The template for displaying search results pages.
 *
 * @package onsus
 */

get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">	
			<div class="wrap-content-area clearfix">
				<div id="primary" class="content-area">
					<main id="main" class="post-wrap" role="main">
					<div class="content-woocommerce">
						<?php if ( have_posts() ) : ?>
							<?php /* Start the Loop */ ?>
							<?php if ( have_posts() ) : ?>
									<div class="meta-wrap clearfix">
									<?php
										// woocommerce_before_shop_loop hook.
										do_action( 'woocommerce_before_shop_loop' );
									?>
									</div>

									<?php woocommerce_product_loop_start(); ?>
										<?php woocommerce_product_subcategories(); ?>
										<?php while ( have_posts() ) : the_post(); ?>
											<?php wc_get_template_part( 'content', 'product' ); ?>
										<?php endwhile; // end of the loop. ?>
									<?php woocommerce_product_loop_end(); ?>

									<?php
										// woocommerce_after_main_content hook.
										do_action( 'woocommerce_after_shop_loop' );
									?>
								<?php else : ?>
									<p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'onsus' ); ?></p>
								<?php endif; ?>

						<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
					</div>
					</main><!-- #main -->
					<div class="clearfix">
						<?php
							global $themesflat_paging_style, $themesflat_paging_for;
							$themesflat_paging_for = 'blog';
					        $themesflat_paging_style = themesflat_get_opt('blog_archive_pagination_style');		        
							get_template_part( 'tpl/pagination' );
						?>			
					</div>
				</div><!-- #primary -->
				<?php 
					if ( themesflat_get_opt( 'sidebar_layout' ) == 'sidebar-left' || themesflat_get_opt( 'sidebar_layout' ) == 'sidebar-right' ) :
						get_sidebar();
					endif;
				?>
			</div><!-- /.wrap-content-area -->
		</div><!-- /.col-md-12 -->
	</div>
</div>
<?php get_footer(); ?>
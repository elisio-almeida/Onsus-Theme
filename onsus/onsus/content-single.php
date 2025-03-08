<?php
/**
 * @package onsus
 */
global $themesflat_thumbnail;
$themesflat_thumbnail = 'themesflat-blog';
$show_featured_single = themesflat_get_opt('show_featured_single');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post blog-single' ); ?>>
	<!-- begin feature-post single  -->
	<?php if ( $show_featured_single == 1 ) :?>
	<?php get_template_part( 'tpl/feature-post-single'); ?> 
	<?php endif;?>
	<!-- end feature-post single-->
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<?php get_template_part( 'tpl/entry-content/entry-content-meta' ); ?>


	<div class="main-post">		
		<div class="entry-content clearfix">
			<?php the_content(); ?>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'onsus' ),
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>'
				) );
				?>
		</div><!-- .entry-content -->
	</div><!-- /.main-post -->
</article><!-- #post-## -->
<?php if( themesflat_get_opt('show_entry_footer_content') == 1 ): ?>		
	<?php themesflat_entry_footer(); ?>
<?php endif; ?>
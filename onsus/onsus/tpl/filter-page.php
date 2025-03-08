<article>
<?php
/**
 * Template name: Filter Page
 *
 */
get_header();
wp_reset_query();
$post_page = 20;
$args = array(
    'post_type' => 'product',
	'posts_per_page' => $post_page,
);

$query = new WP_Query( $args );

$tax = 'product_cat';
$terms = get_terms( $tax );
$count = count( $terms );

if ( $count > 0 ): ?>
    <div class="post-tags">
    <div class="container">
        <div class="row">
        <?php
            foreach ( $terms as $term ) {
            $term_link = get_term_link( $term, $tax );

            echo '<div class="col-3" style="margin-bottom:10px">';
            echo '<a href="' . $term_link . '" class="tax-filter" data-post='.$post_page.' title="' . $term->slug . '">' . $term->name . '</a> ';
            echo '</div>';
        }
        echo '<div class="col-3" style="margin-bottom:10px">';
            echo '<a href="#" class="clear-filter" data-post='.$post_page.'>Clear</a> ';
            echo '</div>';
        ?>
         
            <div class="col-3" style="margin-bottom:10px">
                <a href="#" class="tab-filter" data-post='<?php echo $post_page ?>' data-filter='recent'>Recent Products</a>
            </div>
            <div class="col-3" style="margin-bottom:10px">
                <a href="#" class="tab-filter" data-post='<?php echo $post_page ?>' data-filter='featured'>Featured Products</a>
            </div>
            <div class="col-3" style="margin-bottom:10px">
                <a href="#" class="tab-filter" data-post='<?php echo $post_page ?>' data-filter='best_selling'>Best Selling Products</a>
            </div>
            <div class="col-3" style="margin-bottom:10px">
                <a href="#" class="tab-filter" data-post='<?php echo $post_page ?>' data-filter='sale'>Sale Products</a>
            </div>
            <div class="col-3" style="margin-bottom:10px">
                <a href="#" class="tab-filter" data-post='<?php echo $post_page ?>' data-filter='top_rated'>Top Rated Products</a>
            </div>
            <div class="col-3" style="margin-bottom:10px">
                <a href="#" class="tab-filter" data-post='<?php echo $post_page ?>' data-filter='mixed_order'>Mixed order Products</a>
            </div>
    
<?php endif;
 
    $colors = get_terms( array(
        'taxonomy' => 'pa_color',
        'hide_empty' => false,
    ) );
    if($colors){
    ?>
        <?php
            foreach ($colors as $k => $v) {
        ?><div class="col-3" style="margin-bottom:10px">
            <a href="#" class="tax-filter" data-post='<?php echo $post_page ?>' data-variation='<?php echo $v->term_id ;?>'  > <?php echo $v->name ;?> </a> 
            </div>
        <?php } ?>
<?php }  ?>
<?php
    $brand = get_terms( array(
        'taxonomy' => 'pa_brand',
        'hide_empty' => false,
    ) );
    if($brand){
    ?>
        <?php
            foreach ($brand as $k => $v) {
        ?><div class="col-3" style="margin-bottom:10px">
            <a href="#" class="tax-filter" data-post='<?php echo $post_page ?>' data-brand='<?php echo $v->term_id ;?>'  > <?php echo $v->name ;?> </a> 
            </div>
        <?php } ?>
<?php }  ?>

<?php
    $condition = get_terms( array(
        'taxonomy' => 'pa_condition',
        'hide_empty' => false,
    ) );
    if($condition){
    ?>
        <?php
            foreach ($condition as $k => $v) {
        ?><div class="col-3" style="margin-bottom:10px">
            <a href="#" class="tax-filter" data-post='<?php echo $post_page ?>' data-condition='<?php echo $v->term_id ;?>'  > <?php echo $v->name ;?> </a> 
            </div>
        <?php } ?>
<?php }  ?>

<?php
    $deals_discounts = get_terms( array(
        'taxonomy' => 'pa_deals-discounts',
        'hide_empty' => false,
    ) );
    if($deals_discounts){
    ?>
        <?php
            foreach ($deals_discounts as $k => $v) {
        ?><div class="col-3" style="margin-bottom:10px">
            <a href="#" class="tax-filter" data-post='<?php echo $post_page ?>' data-deals_discounts='<?php echo $v->term_id ;?>'  > <?php echo $v->name ;?> </a> 
            </div>
        <?php } ?>
<?php }  ?>
</div>
</div>
</div> 

<?php

if ( $query->have_posts() ): ?>

<div class="container" style="margin-top:70px;">
	<div class="row tagged-posts">
		
    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
	<div class="col-md-3" style="margin-bottom:20px;">
    <h2><a  href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php global $product;
	  $product_id = $product->get_id();
	  $terms = get_the_terms( $product_id, 'product_cat' );
				if ( !empty($terms) ) { ?>
					<?php foreach ( $terms as $term ) {
						echo  '<a href="' . get_term_link( $term->term_id ) . '">' . $term->name . '</a>';
						// break;
					} ?>
				<?php
				}?>
    <div class="content">This powerful 900-1100-Watt kettle has convenient capacity markings on the body lets you accurately 1 year limited warranty and us-based customer support team lets you buy with confidence.</div>
	</div>
    <?php endwhile; wp_reset_postdata(); ?>

	</div>
</div>

<?php else: ?>
    <div class="tagged-posts">
        <h2>No posts found</h2>
    </div>
<?php endif;  ?>

</article>
<?php
get_footer();
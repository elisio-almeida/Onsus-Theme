<?php
$logo_site = themesflat_get_opt('site_logo_fixed');
if (!empty(themesflat_get_opt_elementor('site_logo_fixed'))) {
    if (themesflat_get_opt_elementor('site_logo_fixed')['url'] != '') {
        $logo_site = themesflat_get_opt_elementor('site_logo_fixed')['url'];
    }else {
        $logo_site = themesflat_get_opt('site_logo_fixed');
    }    
}

if ( $logo_site ) : ?>
    <div id="logo" class="logo" >                  
        <a href="<?php echo esc_url( home_url('/') ); ?>"  title="<?php bloginfo('name'); ?>">
            <?php if  (!empty($logo_site)) { ?>
                <img class="site-logo"  src="<?php echo esc_url($logo_site); ?>" alt="<?php bloginfo('name'); ?>"/>
            <?php } ?>
        </a>
    </div>
<?php else : ?>
    <div id="logo" class="logo">
    	<h1 class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>			
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>	
    </div><!-- /.site-infomation -->          
<?php endif; ?>
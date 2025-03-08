<?php 

// ADD SECTION ACTION
$wp_customize->add_section('section_action_box',array(
    'title'         => 'Action Box',
    'priority'      => 6,
    'panel'         => 'footer_panel',
));
require THEMESFLAT_DIR . "inc/customizer/footer/action-box.php";



// ADD SECTION FOOTER
$wp_customize->add_section('section_footer',array(
    'title'         => 'Footer',
    'priority'      => 4,
    'panel'         => 'footer_panel',
));
require THEMESFLAT_DIR . "inc/customizer/footer/footer.php";

// ADD SECTION BOTTOM
$wp_customize->add_section('section_bottom',array(
    'title'         => 'Bottom',
    'priority'      => 5,
    'panel'         => 'footer_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/footer/bottom.php";
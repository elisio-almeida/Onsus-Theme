<?php 
// ADD SECTION TOPBAR
$wp_customize->add_section('section_topbar',array(
    'title'         => 'Topbar',
    'priority'      => 1,
    'panel'         => 'header_panel',
));
require THEMESFLAT_DIR . "inc/customizer/header/topbar.php";

// ADD SECTION LOGO
$wp_customize->add_section('section_logo',array(
    'title'         => 'Logo',
    'priority'      => 2,
    'panel'         => 'header_panel',
));
require THEMESFLAT_DIR . "inc/customizer/header/logo.php";

// ADD SECTION NAVIGATION
$wp_customize->add_section('section_navigation',array(
    'title'         => 'Navigation',
    'priority'      => 3,
    'panel'         => 'header_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/header/navigation.php";

// ADD SECTION HEADER OPTION
$wp_customize->add_section('section_options',array(
    'title'         => 'Header Options',
    'priority'      => 4,
    'panel'         => 'header_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/header/header-options.php";

// ADD SECTION HEADER BUTTON
// $wp_customize->add_section('section_button',array(
//     'title'         => 'Button',
//     'priority'      => 5,
//     'panel'         => 'header_panel',
// )); 
// require THEMESFLAT_DIR . "inc/customizer/header/button.php";

// ADD SECTION HEADER BUTTON
// $wp_customize->add_section('section_info',array(
//     'title'         => 'Info',
//     'priority'      => 6,
//     'panel'         => 'header_panel',
// )); 
// require THEMESFLAT_DIR . "inc/customizer/header/info.php";
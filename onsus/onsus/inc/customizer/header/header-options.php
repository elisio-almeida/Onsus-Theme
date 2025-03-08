<?php 
//Header Style
$wp_customize->add_setting(
    'style_header',
    array(
        'default'           => themesflat_customize_default('style_header'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_RadioImages($wp_customize,
    'style_header',
    array (
        'type'      => 'radio-images',           
        'section'   => 'section_options',
        'priority'  => 1,
        'label'         => esc_html__('Header Style', 'onsus'),
        'choices'   => array (
            'header-default' => array (
                'tooltip'   => esc_html__( 'Header Default','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header-default.jpg'
            ),
            'header-01'=>  array (
                'tooltip'   => esc_html__( 'Header 01','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header01.jpg'
            ),
            'header-02'=>  array (
                'tooltip'   => esc_html__( 'Header 02','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header02.jpg'
            ),
            'header-03'=>  array (
                'tooltip'   => esc_html__( 'Header 03','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header03.jpg'
            ),
            'header-04'=>  array (
                'tooltip'   => esc_html__( 'Header 04','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header04.jpg'
            ),

        ),
    ))
); 

// Enable Header Absolute
// $wp_customize->add_setting(
//   'header_absolute',
//     array(
//         'sanitize_callback' => 'themesflat_sanitize_checkbox',
//         'default' => themesflat_customize_default('header_absolute'),     
//     )   
// );
// $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
//     'header_absolute',
//     array(
//         'type' => 'checkbox',
//         'label' => esc_html__('Header Absolute ( OFF | ON )', 'onsus'),
//         'section' => 'section_options',
//         'priority' => 1,
//     ))
// );

// Enable Header Sticky
$wp_customize->add_setting(
  'header_sticky',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_sticky'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_sticky',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Sticky ( OFF | ON )', 'onsus'),
        'section' => 'section_options',
        'priority' => 2,
    ))
);    

// Show search 
$wp_customize->add_setting(
  'header_search_box',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_search_box'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_search_box',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Search Box ( OFF | ON )', 'onsus'),
        'section' => 'section_options',
        'priority' => 5,
    ))
);

// Show category 
$wp_customize->add_setting(
    'header_category',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_category'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_category',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Header Category ( OFF | ON )', 'onsus'),
          'section' => 'section_options',
          'priority' => 5,
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'header-default' === $wp_customize->get_setting( 'style_header' )->value()
                ||
                'header-02' === $wp_customize->get_setting( 'style_header' )->value() 
            );
        },
      ))
);

$wp_customize->add_setting(
    'header_compare_icon',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_compare_icon'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_compare_icon',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Header Compare ( OFF | ON )', 'onsus'),
          'section' => 'section_options',
          'priority' => 5,
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'header-01' === $wp_customize->get_setting( 'style_header' )->value()
            );
        },
      ))
);

$wp_customize->add_setting(
    'header_wishlist_icon',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_wishlist_icon'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_wishlist_icon',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Header Wishlist ( OFF | ON )', 'onsus'),
          'section' => 'section_options',
          'priority' => 5,
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'header-01' === $wp_customize->get_setting( 'style_header' )->value()  
                ||
                'header-03' === $wp_customize->get_setting( 'style_header' )->value()  
                ||
                'header-02' === $wp_customize->get_setting( 'style_header' )->value()  
                ||
                'header-04' === $wp_customize->get_setting( 'style_header' )->value()              
            );
        },
      ))
);
// Show search 
// $wp_customize->add_setting(
//   'header_sidebar_toggler',
//     array(
//         'sanitize_callback' => 'themesflat_sanitize_checkbox',
//         'default' => themesflat_customize_default('header_sidebar_toggler'),     
//     )   
// );
// $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
//     'header_sidebar_toggler',
//     array(
//         'type' => 'checkbox',
//         'label' => esc_html__('Sidebar Toggler ( OFF | ON )', 'onsus'),
//         'section' => 'section_options',
//         'priority' => 5,
//     ))
// );

// Enable Header Cart
$wp_customize->add_setting(
  'header_cart_icon',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_cart_icon'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_cart_icon',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Cart ( OFF | ON )', 'onsus'),
        'section' => 'section_options',
        'priority' => 6,
    ))
);




// Button Url
$wp_customize->add_setting(
    'header_currency',
    array(
        'default' => themesflat_customize_default('header_currency'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_currency',
    array(
        'label' => esc_html__( 'Short code Currency', 'onsus' ),
        'section' => 'section_options',
        'type' => 'text',
        'priority' => 2
    )
);



$wp_customize->add_setting(
    'header_info_phone_text',
    array(
        'default' => themesflat_customize_default('header_info_phone_text'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control(
    'header_info_phone_text',
    array(
        'label' => esc_html__( 'Label Phone', 'onsus' ),
        'section' => 'section_options',
        'type' => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'header-01' === $wp_customize->get_setting( 'style_header' )->value()
            );
        },
    )
);

$wp_customize->add_setting(
    'header_info_phone_number',
    array(
        'default' => themesflat_customize_default('header_info_phone_number'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control(
    'header_info_phone_number',
    array(
        'label' => esc_html__( 'Phone Number', 'onsus' ),
        'section' => 'section_options',
        'type' => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'header-01' === $wp_customize->get_setting( 'style_header' )->value()
            );
        },
    )
);

$wp_customize->add_setting(
    'header_email_label',
    array(
        'default' => themesflat_customize_default('header_email_label'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control(
    'header_email_label',
    array(
        'label' => esc_html__( 'Label Email', 'onsus' ),
        'section' => 'section_options',
        'type' => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'header-01' === $wp_customize->get_setting( 'style_header' )->value()
            );
        },
    )
);

$wp_customize->add_setting(
    'header_email',
    array(
        'default' => themesflat_customize_default('header_email'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control(
    'header_email',
    array(
        'label' => esc_html__( 'Email', 'onsus' ),
        'section' => 'section_options',
        'type' => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'header-01' === $wp_customize->get_setting( 'style_header' )->value()
            );
        },
    )
);
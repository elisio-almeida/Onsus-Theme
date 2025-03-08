<?php 
// Top bar show
$wp_customize->add_setting( 
  'topbar_show',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('topbar_show'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'topbar_show',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Topbar ( OFF | ON )', 'onsus'),
        'section' => 'section_topbar',
        'priority' => 2,
    ))
);     

// Address Label
// $wp_customize->add_setting(
//     'topbar_address_label',
//     array(
//         'default' => themesflat_customize_default('topbar_address_label'),
//         'sanitize_callback' => 'themesflat_sanitize_text'
//     )
// );
// $wp_customize->add_control(
//     'topbar_address_label',
//     array(
//         'label' => esc_html__( 'Address Label', 'onsus' ),
//         'section' => 'section_topbar',
//         'type' => 'text',
//         'priority' => 5
//     )
// );
// Address Number
// $wp_customize->add_setting(
//     'topbar_address',
//     array(
//         'default' => themesflat_customize_default('topbar_address'),
//         'sanitize_callback' => 'themesflat_sanitize_text'
//     )
// );
// $wp_customize->add_control(
//     'topbar_address',
//     array(
//         'label' => esc_html__( 'Address', 'onsus' ),
//         'section' => 'section_topbar',
//         'type' => 'text',
//         'priority' => 6
//     )
// );

// Email Label
$wp_customize->add_setting(
    'topbar_phone_label',
    array(
        'default' => themesflat_customize_default('topbar_phone_label'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'topbar_phone_label',
    array(
        'label' => esc_html__( 'Phone Label', 'onsus' ),
        'section' => 'section_topbar',
        'type' => 'text',
        'priority' => 7
    )
);
// Email Number
$wp_customize->add_setting(
    'topbar_phone',
    array(
        'default' => themesflat_customize_default('topbar_phone'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'topbar_phone',
    array(
        'label' => esc_html__( 'Phone (Clear phone to off phone topbar)', 'onsus' ),
        'section' => 'section_topbar',
        'type' => 'text',
        'priority' => 8
    )
);

// Shipping Text
$wp_customize->add_setting(
    'topbar_ship',
    array(
        'default' => themesflat_customize_default('topbar_ship'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'topbar_ship',
    array(
        'label' => esc_html__( 'Text ship (Only WooC and setting shipping)', 'onsus' ),
        'section' => 'section_topbar',
        'type' => 'text',
        'priority' => 8
    )
);

$wp_customize->add_setting(
    'ship_topbar',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('ship_topbar'),     
      )   
);
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'ship_topbar',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Shipping ( OFF | ON )', 'onsus'),
          'section' => 'section_topbar',
          'priority' => 9,
      ))
);

// Menu Topbar
$wp_customize->add_setting(
  'menu_topbar',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('menu_topbar'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'menu_topbar',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Menu ( OFF | ON )', 'onsus'),
        'section' => 'section_topbar',
        'priority' => 9,
    ))
);

// Profile Topbar
$wp_customize->add_setting(
    'profile_topbar',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('profile_topbar'),     
      )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'profile_topbar',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Profile Dropdown ( OFF | ON )', 'onsus'),
          'section' => 'section_topbar',
          'priority' => 9,
      ))
  );

// Language Topbar
$wp_customize->add_setting(
    'language_topbar',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('language_topbar'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'language_topbar',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Language Dropdown ( OFF | ON )', 'onsus'),
          'section' => 'section_topbar',
          'priority' => 9,
      ))
);

// Currency Topbar
$wp_customize->add_setting(
    'currency_topbar',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('currency_topbar'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'currency_topbar',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Currency Dropdown ( OFF | ON )', 'onsus'),
          'section' => 'section_topbar',
          'priority' => 9,
      ))
);

// Social Topbar
// $wp_customize->add_setting(
//   'social_topbar',
//     array(
//         'sanitize_callback' => 'themesflat_sanitize_checkbox',
//         'default' => themesflat_customize_default('social_topbar'),     
//     )   
// );
// $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
//     'social_topbar',
//     array(
//         'type' => 'checkbox',
//         'label' => esc_html__('Social ( OFF | ON )', 'onsus'),
//         'section' => 'section_topbar',
//         'priority' => 9,
//     ))
// );

// Topbar Box control
$wp_customize->add_setting(
    'topbar_controls',
    array(
        'default' => themesflat_customize_default('topbar_controls'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control( new themesflat_BoxControls($wp_customize,
    'topbar_controls',
    array(
        'label' => esc_html__( 'Box Controls (px)', 'onsus' ),
        'section' => 'section_topbar',
        'type' => 'box-controls',
        'priority' => 10
    ))
);
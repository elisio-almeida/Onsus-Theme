<?php 
$wp_customize->add_setting(
    'catalog_toolbar',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('catalog_toolbar'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'catalog_toolbar',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Catalog Toolbar ( OFF | ON )', 'onsus'),
        'section' => 'section_shop_catalog',
        'priority' => 1,
    ))
);

$wp_customize->add_setting(
    'catalog_view',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('catalog_view'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'catalog_view',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Catalog View ( OFF | ON )', 'onsus'),
        'section' => 'section_shop_catalog',
        'priority' => 1,
    ))
);

$wp_customize->add_setting(
    'catalog_btn_change',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('catalog_btn_change'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'catalog_btn_change',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Catalog Button Layout ( OFF | ON )', 'onsus'),
        'section' => 'section_shop_catalog',
        'priority' => 1,
    ))
);

$wp_customize->add_setting(
    'catalog_sort_by',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('catalog_sort_by'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'catalog_sort_by',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Catalog Sort By ( OFF | ON )', 'onsus'),
        'section' => 'section_shop_catalog',
        'priority' => 1,
    ))
);

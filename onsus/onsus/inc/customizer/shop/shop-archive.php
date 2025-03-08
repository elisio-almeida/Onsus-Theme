<?php 
//Sidebar Position
$wp_customize->add_setting(
    'shop_layout',
    array(
        'default'           => themesflat_customize_default('shop_layout'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'shop_layout',
    array (
        'type'      => 'select',           
        'section'   => 'section_shop_archive',
        'priority'  => 1,
        'label'         => esc_html__('Sidebar Position', 'onsus'),
        'choices'   => array (
            'sidebar-right'     => esc_html__( 'Sidebar Right','onsus' ),
            'sidebar-left'      =>  esc_html__( 'Sidebar Left','onsus' ),
            'fullwidth'         =>   esc_html__( 'Full Width','onsus' ),
            // 'fullwidth-small'   =>   esc_html__( 'Full Width Small','onsus' ),
            // 'fullwidth-center'  =>   esc_html__( 'Full Width Center','onsus' ),
        ),
    )
);

$wp_customize->add_setting(
    'shop_style',
    array(
        'default'           => themesflat_customize_default('shop_style'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'shop_style',
    array (
        'type'      => 'select',           
        'section'   => 'section_shop_archive',
        'priority'  => 1,
        'label'         => esc_html__('Product Style', 'onsus'),
        'choices'   => array (
            'grid'     => esc_html__( 'Grid','onsus' ),
            'list'      =>  esc_html__( 'List','onsus' ),
        ),
    )
);

// Gird columns
$wp_customize->add_setting(
    'shop_columns',
    array(
        'default'           => themesflat_customize_default('shop_columns'),
        'sanitize_callback' => 'themesflat_sanitize_grid_post_related',
    )
);
$wp_customize->add_control(
    'shop_columns',
    array(
        'type'      => 'select',           
        'section'   => 'section_shop_archive',
        'priority'  => 2,
        'label'     => esc_html__('Columns', 'onsus'),
        'choices'   => array(
            2     => esc_html__( '2 Columns', 'onsus' ),
            3     => esc_html__( '3 Columns', 'onsus' ),
            4     => esc_html__( '4 Columns', 'onsus' ),
            5     => esc_html__( '5 Columns', 'onsus' ),                
        )
    )
);

// Number Posts Portfolios
$wp_customize->add_setting (
    'shop_products_per_page',
    array(
        'default' => themesflat_customize_default('shop_products_per_page'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'shop_products_per_page',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Show Number Products', 'onsus'),
        'section'   => 'section_shop_archive',
        'priority'  => 3
    )
);

$wp_customize->add_setting(
    'show_thumb',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_thumb'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_thumb',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Thumb ( OFF | ON )', 'onsus'),
        'section' => 'section_shop_archive',
        'priority' => 1,
    ))
);

$wp_customize->add_setting(
  'show_cowndown',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('show_cowndown'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_cowndown',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Cowndown ( OFF | ON )', 'onsus'),
        'section' => 'section_shop_archive',
        'priority' => 1,
    ))
);

$wp_customize->add_setting(
    'show_progress',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_progress'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'show_progress',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Show Progessbar ( OFF | ON )', 'onsus'),
          'section' => 'section_shop_archive',
          'priority' => 1,
      ))
);

$wp_customize->add_setting(
    'show_configuration',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_configuration'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_configuration',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Configuration ( OFF | ON )', 'onsus'),
        'section' => 'section_shop_archive',
        'priority' => 1,
    ))
);

$wp_customize->add_setting(
    'show_delivery',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_delivery'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_delivery',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Delivery ( OFF | ON )', 'onsus'),
        'section' => 'section_shop_archive',
        'priority' => 1,
    ))
);



$wp_customize->add_setting(
    'shop_pagination',
    array(
        'default'           => themesflat_customize_default('shop_pagination'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_control( 
    'shop_pagination',
    array (
        'type'      => 'select',           
        'section'   => 'section_shop_archive',
        'label'         => esc_html__('Pagination', 'onsus'),
        'choices'   => array (
            'number'     => esc_html__( 'Number','onsus' ),
            'loadmore'      =>  esc_html__( 'Load More','onsus' ),
            'autoload'      =>  esc_html__( 'Auto Load','onsus' ),
        ),

    )
);

$wp_customize->add_setting(
    'shop_loadmore_text',
      array(
          'sanitize_callback' => 'themesflat_sanitize_text',
          'default' => themesflat_customize_default('shop_loadmore_text'),     
      )   
);

$wp_customize->add_control( 
      'shop_loadmore_text',
      array(
          'type' => 'text',
          'label' => esc_html__('Load More Text', 'onsus'),
          'section' => 'section_shop_archive',
          'active_callback' => function() use ( $wp_customize ) {
            return ( 
                'loadmore' == $wp_customize->get_setting( 'shop_pagination' )->value()
            );
          },
      )
      
);
<?php 
$wp_customize->add_setting(
    'show_top_category',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_top_category'),     
      )   
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_top_category',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Top Category ( OFF | ON )', 'onsus'),
        'section' => 'section_shop_category',
        'priority' => 1,
    ))
);

$wp_customize->add_setting(
    'category_dek',
    array(
        'default'           => themesflat_customize_default('category_dek'),
    )
);
$wp_customize->add_control(
    'category_dek',
    array(
        'type'      => 'select',           
        'section'   => 'section_shop_category',
        'priority'  => 2,
        'label'     => esc_html__('Columns Desktop', 'onsus'),
        'choices'   => array(
            2     => esc_html__( '2 Columns', 'onsus' ),
            3     => esc_html__( '3 Columns', 'onsus' ),
            4     => esc_html__( '4 Columns', 'onsus' ),
            5     => esc_html__( '5 Columns', 'onsus' ),                
            6     => esc_html__( '6 Columns', 'onsus' ),                
            7     => esc_html__( '7 Columns', 'onsus' ),                
            8     => esc_html__( '8 Columns', 'onsus' ),                
        )
    )
);

$wp_customize->add_setting(
    'category_tab',
    array(
        'default'           => themesflat_customize_default('category_tab'),
    )
);
$wp_customize->add_control(
    'category_tab',
    array(
        'type'      => 'select',           
        'section'   => 'section_shop_category',
        'priority'  => 2,
        'label'     => esc_html__('Columns Tablet', 'onsus'),
        'choices'   => array(
            2     => esc_html__( '2 Columns', 'onsus' ),
            3     => esc_html__( '3 Columns', 'onsus' ),
            4     => esc_html__( '4 Columns', 'onsus' ),
            5     => esc_html__( '5 Columns', 'onsus' ),                
            6     => esc_html__( '6 Columns', 'onsus' ),                  
        )
    )
);$wp_customize->add_setting(
    'category_mob',
    array(
        'default'           => themesflat_customize_default('category_mob'),
    )
);
$wp_customize->add_control(
    'category_mob',
    array(
        'type'      => 'select',           
        'section'   => 'section_shop_category',
        'priority'  => 2,
        'label'     => esc_html__('Columns Mobile 1', 'onsus'),
        'choices'   => array(
            1     => esc_html__( '1 Columns', 'onsus' ),
            2     => esc_html__( '2 Columns', 'onsus' ),
            3     => esc_html__( '3 Columns', 'onsus' ),
            4     => esc_html__( '4 Columns', 'onsus' ),            
        )
    )
);$wp_customize->add_setting(
    'category_mob2',
    array(
        'default'           => themesflat_customize_default('category_mob2'),
    )
);
$wp_customize->add_control(
    'category_mob2',
    array(
        'type'      => 'select',           
        'section'   => 'section_shop_category',
        'priority'  => 2,
        'label'     => esc_html__('Columns Mobile 2', 'onsus'),
        'choices'   => array(
            1     => esc_html__( '1 Columns', 'onsus' ),
            2     => esc_html__( '2 Columns', 'onsus' ),
            3     => esc_html__( '3 Columns', 'onsus' ),              
        )
    )
);




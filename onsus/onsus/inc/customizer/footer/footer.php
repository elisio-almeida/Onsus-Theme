<?php 
// Columns Footer
$wp_customize->add_setting(
    'footer_widget_areas',
    array(
        'default'           => themesflat_customize_default('footer_widget_areas'),
        'sanitize_callback' => 'themesflat_sanitize_grid_post_related',
    )
);
$wp_customize->add_control(
    'footer_widget_areas',
    array(
        'type'      => 'select',           
        'section'   => 'section_footer',
        'priority'  => 1,
        'label'     => esc_html__('Columns Footer', 'onsus'),
        'choices'   => array(                
            1     => esc_html__( '1 Columns', 'onsus' ),
            2     => esc_html__( '2 Columns', 'onsus' ),
            3     => esc_html__( '3 Columns', 'onsus' ),
            4     => esc_html__( '4 Columns ( 3 | 2 | 4 | 3 )', 'onsus' ),
            5     => esc_html__( '4 Columns ( 3 | 3 | 3 | 3 )', 'onsus' ),                  
        )
    )
); 

// Footer Box control
$wp_customize->add_setting(
    'footer_controls',
    array(
        'default' => themesflat_customize_default('footer_controls'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control( new themesflat_BoxControls($wp_customize,
    'footer_controls',
    array(
        'label' => esc_html__( 'Footer Box Controls (px)', 'onsus' ),
        'section' => 'section_footer',
        'type' => 'box-controls',
        'priority' => 2
    ))
);


// Show Related Products
$wp_customize->add_setting (
    'show_related_products',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => 0,     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_related_products',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Related Products ( OFF | ON )', 'onsus'),
        'section'   => 'section_footer',
        'priority'  => 4
    ))
);


// Number Of Related Products
$wp_customize->add_setting (
    'number_related_product_desk',
    array(
        'default' => themesflat_customize_default('number_related_product_desk'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'number_related_product_desk',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Number Of Related Products Desktop', 'onsus'),
        'section'   => 'section_footer',
        'priority'  => 5,
    )
);


// Number Of Related Products
$wp_customize->add_setting (
    'number_related_product_tab',
    array(
        'default' => themesflat_customize_default('number_related_product_tab'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'number_related_product_tab',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Number Of Related Products Tablet', 'onsus'),
        'section'   => 'section_footer',
        'priority'  => 6,
    )
);


// Number Of Related Products
$wp_customize->add_setting (
    'number_related_product_mob',
    array(
        'default' => themesflat_customize_default('number_related_product_mob'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'number_related_product_mob',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Number Of Related Products Mobile', 'onsus'),
        'section'   => 'section_footer',
        'priority'  => 7,
    )
);
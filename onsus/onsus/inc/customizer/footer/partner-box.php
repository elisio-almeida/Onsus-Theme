<?php 
// Partner
$wp_customize->add_setting(
    'show_partner',
    array(
        'default'   => themesflat_customize_default('show_partner'),
        'sanitize_callback'  => 'themesflat_sanitize_checkbox',
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
        'show_partner',
        array(
            'type'      => 'checkbox',
            'label'     => esc_html__('Partner Box ( OFF | ON )', 'onsus'),
            'section'   => 'section_partner_box',
            'priority'  => 1
        )
    )
);    

// Partner Image
$wp_customize->add_setting(
    'img_partner',
    array(
        'default'           => themesflat_customize_default('img_partner'),
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    new themesflat_MultiImages(
        $wp_customize,
        'img_partner',
        array(
           'label'          => esc_html__( 'Upload Your Partner Image', 'onsus' ),
           'type'           => 'multi-image',
           'section'        => 'section_partner_box',
           'priority'       => 2,
        )
    )
);

// Show Number Image
$wp_customize->add_setting(
    'show_number_img_partner_desktop',
    array(
        'default'           => themesflat_customize_default('show_number_img_partner_desktop'),
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'show_number_img_partner_desktop',
    array(
       'label'          => esc_html__( 'Show Number Image (Desktop)', 'onsus' ),
       'type'           => 'number',
       'section'        => 'section_partner_box',
       'priority'       => 3,
    )
);

$wp_customize->add_setting(
    'show_number_img_partner_tablet',
    array(
        'default'           => themesflat_customize_default('show_number_img_partner_tablet'),
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'show_number_img_partner_tablet',
    array(
       'label'          => esc_html__( 'Show Number Image (Tablet)', 'onsus' ),
       'type'           => 'number',
       'section'        => 'section_partner_box',
       'priority'       => 4,
    )
);

$wp_customize->add_setting(
    'show_number_img_partner_mobile',
    array(
        'default'           => themesflat_customize_default('show_number_img_partner_mobile'),
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'show_number_img_partner_mobile',
    array(
       'label'          => esc_html__( 'Show Number Image (Mobile)', 'onsus' ),
       'type'           => 'number',
       'section'        => 'section_partner_box',
       'priority'       => 5,
    )    
);

$wp_customize->add_setting(
    'gap_img_partner',
    array(
        'default'           => themesflat_customize_default('gap_img_partner'),
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'gap_img_partner',
    array(
       'label'          => esc_html__( 'Gap Image', 'onsus' ),
       'type'           => 'number',
       'section'        => 'section_partner_box',
       'priority'       => 6,
    )
);

// Partner Box control
$wp_customize->add_setting(
    'partner_box_controls',
    array(
        'default' => themesflat_customize_default('partner_box_controls'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control( new themesflat_BoxControls($wp_customize,
    'partner_box_controls',
    array(
        'label' => esc_html__( 'Partner Box Controls (px)', 'onsus' ),
        'section' => 'section_partner_box',
        'type' => 'box-controls',
        'priority' => 7,
    ))
);

// Partner Box background color    
$wp_customize->add_setting(
    'partner_box_background_color',
    array(
        'default'           => themesflat_customize_default('partner_box_background_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    new themesflat_ColorOverlay(
        $wp_customize,
        'partner_box_background_color',
        array(
            'label'         => esc_html__('Partner Box Backgound', 'onsus'),
            'section'       => 'section_partner_box',
            'priority'      => 8
        )
    )
);
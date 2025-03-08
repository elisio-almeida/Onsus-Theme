<?php 
// Menu Background
$wp_customize->add_setting(
    'header_backgroundcolor',
    array(
        'default'           => themesflat_customize_default('header_backgroundcolor'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'header_backgroundcolor',
        array(
            'label'         => esc_html__('Header Background', 'onsus'),
            'description'   => esc_html__(' Opacity =1 for Background Color', 'onsus'),
            'section'       => 'color_header',
            'priority'      => 1
        )
    )
);

// Header Background sticky
$wp_customize->add_setting(
    'header_backgroundcolor_sticky',
    array(
        'default'           => themesflat_customize_default('header_backgroundcolor_sticky'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'header_backgroundcolor_sticky',
        array(
            'label'         => esc_html__('Sticky Header Background', 'onsus'),
            'section'       => 'color_header',
            'priority'      => 2
        )
    )
); 
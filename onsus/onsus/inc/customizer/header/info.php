<?php 
// Button Text
$wp_customize->add_setting(
    'header_info_phone_text',
    array(
        'default' => themesflat_customize_default('header_info_phone_text'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_info_phone_text',
    array(
        'label' => esc_html__( 'Text', 'onsus' ),
        'section' => 'section_info',
        'type' => 'text',
        'priority' => 1
    )
);
// Button Url
$wp_customize->add_setting(
    'header_info_phone_number',
    array(
        'default' => themesflat_customize_default('header_info_phone_number'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_info_phone_number',
    array(
        'label' => esc_html__( 'Phone Number', 'onsus' ),
        'section' => 'section_info',
        'type' => 'text',
        'priority' => 2
    )
);
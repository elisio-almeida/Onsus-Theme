<?php 
$wp_customize->add_setting(
    'show_action_box',
    array(
        'default'   => themesflat_customize_default('show_action_box'),
        'sanitize_callback'  => 'themesflat_sanitize_checkbox',
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
        'show_action_box',
        array(
            'type'      => 'checkbox',
            'label'     => esc_html__('Action Box ( OFF | ON )', 'onsus'),
            'section'   => 'section_action_box',
            'priority'  => 2
        )
    )
);

$wp_customize->add_setting(
    'heading_action_box',
    array(
        'default'   =>  themesflat_customize_default('heading_action_box'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'heading_action_box',
    array(
        'type'      =>  'textarea',
        'label'     =>  esc_html__('Heading Action Box', 'onsus'),
        'section'   =>  'section_action_box',
        'priority'  =>  3
    )
);

$wp_customize->add_setting(
    'text_action_box',
    array(
        'default'   =>  themesflat_customize_default('text_action_box'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'text_action_box',
    array(
        'type'      =>  'textarea',
        'label'     =>  esc_html__('Text Action Box', 'onsus'),
        'section'   =>  'section_action_box',
        'priority'  =>  3
    )
);

$wp_customize->add_setting(
    'text_button_action_box',
    array(
        'default'   =>  themesflat_customize_default('text_button_action_box'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'text_button_action_box',
    array(
        'type'      =>  'text',
        'section'   =>  'section_action_box',
        'label'     =>  esc_html__('Text Button Action Box', 'onsus'),
        'priority'  => 4
    )
);

// Button Url
$wp_customize->add_setting(
    'action_box_button_url',
    array(
        'default' => themesflat_customize_default('action_box_button_url'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'action_box_button_url',
    array(
        'label' => esc_html__( 'Url', 'onsus' ),
        'section' => 'section_action_box',
        'type' => 'text',
        'priority' => 2
    )
);
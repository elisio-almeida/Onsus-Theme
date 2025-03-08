<?php 
// Enable Smooth Scroll
$wp_customize->add_setting(
  'enable_smooth_scroll',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('enable_smooth_scroll'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'enable_smooth_scroll',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Smooth Scroll ( OFF | ON )', 'onsus'),
        'section' => 'general_panel',
        'priority' => 1,
    ))
);

// Enable Preload
$wp_customize->add_setting(
  'enable_preload',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('enable_preload'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'enable_preload',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Preload ( OFF | ON )', 'onsus'),
        'section' => 'general_panel',
        'priority' => 2,
    ))
);

// Preload
$wp_customize->add_setting(
    'preload',
    array(
        'default'           => themesflat_customize_default('preload'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_RadioImages($wp_customize,
    'preload',
    array (
        'type'      => 'radio-images',           
        'section'   => 'general_panel',
        'priority'  => 3,
        'label'         => esc_html__('Preload', 'onsus'),
        'choices'   => array (
            'preload-1' => array (
                'tooltip'   => esc_html__( 'Circle Loaders 1','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/preload-1.png'
            ) ,
            'preload-2'=>  array (
                'tooltip'   => esc_html__( 'Circle Loaders 2','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/preload-2.png'
            ) ,
            'preload-3'=>  array (
                'tooltip'   => esc_html__( 'Circle Loaders 3','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/preload-3.png'
            ) ,
            'preload-4'=>  array (
                'tooltip'   => esc_html__( 'Circle Loaders 4','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/preload-4.png'
            ) ,
            'preload-5'=>  array (
                'tooltip'   => esc_html__( 'Spinner Loaders','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/preload-5.png'
            ) ,
            'preload-6'=>  array (
                'tooltip'   => esc_html__( 'Pulse Loaders','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/preload-6.png'
            ) ,
            'preload-7'=>  array (
                'tooltip'   => esc_html__( 'Square Loaders','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/preload-7.png'
            ) ,
            'preload-8'=>  array (
                'tooltip'   => esc_html__( 'Line Loaders','onsus' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/preload-8.png'
            ) ,
        ),
    ))
);

//Socials
$wp_customize->add_setting(
  'social_links',
  array(
    'sanitize_callback' => 'esc_attr',
    'default' => themesflat_customize_default('social_links'),     
  )   
);
$wp_customize->add_control( new themesflat_SocialIcons($wp_customize,
    'social_links',
    array(
        'type' => 'social-icons',
        'section' => 'general_panel',
        'priority' => 4,
    ))
);

// Social Share
$wp_customize->add_setting(
  'show_social_share',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('show_social_share'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_social_share',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Social Share  ( OFF | ON )', 'onsus'),
        'description'   => esc_html__('Social share only visible on detail pages', 'onsus'),
        'section' => 'general_panel',
        'priority' => 6,
    ))
);

// Go To Button
$wp_customize->add_setting(
  'go_top',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('go_top'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'go_top',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Go To Button ( OFF | ON )', 'onsus'),
        'section' => 'general_panel',
        'priority' => 8,
    ))
);


// Go To Button
$wp_customize->add_setting(
    'show_popup_form',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_popup_form'),     
      )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_popup_form',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Popup Form ( OFF | ON )', 'onsus'),
        'section' => 'general_panel',
        'priority' => 8,
    ))
);

$wp_customize->add_setting(
    'img_popup',
    array(
        'default' => themesflat_customize_default('img_popup'),
        'sanitize_callback' => 'esc_url_raw',
    )
);   

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'img_popup',
        array(
           'label'          => esc_html__( 'Upload Image', 'onsus' ),
           'type'           => 'image',
           'section'        => 'general_panel',
           'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_popup_form' )->value()
            );
            },
        )
    )
);

$wp_customize->add_setting(
    'shortcode_mailchimp',
    array(
        'default' => themesflat_customize_default('shortcode_mailchimp'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control(
    'shortcode_mailchimp',
    array(
        'label' => esc_html__( 'Shortcode Mailchimp', 'onsus' ),
        'section' => 'general_panel',
        'type' => 'textarea',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_popup_form' )->value()
            );
        },
    )
);


$wp_customize->add_setting(
    'popup_heading',
    array(
        'default' => themesflat_customize_default('popup_heading'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control(
    'popup_heading',
    array(
        'label' => esc_html__( 'Form popup heading', 'onsus' ),
        'section' => 'general_panel',
        'type' => 'textarea',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_popup_form' )->value()
            );
            },
    )
);

$wp_customize->add_setting(
    'popup_des',
    array(
        'default' => themesflat_customize_default('popup_des'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control(
    'popup_des',
    array(
        'label' => esc_html__( 'Form popup description', 'onsus' ),
        'section' => 'general_panel',
        'type' => 'textarea',
        'active_callback' => function() use ( $wp_customize ) {
            return ( 
                1 === $wp_customize->get_setting( 'show_popup_form' )->value()
            );
            },
    )
);

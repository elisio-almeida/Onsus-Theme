<?php 
// Customize Blog Featured Title
$wp_customize->add_setting (
    'blog_featured_title',
    array(
        'default' => themesflat_customize_default('blog_featured_title'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'blog_featured_title',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Customize Blog Featured Title', 'onsus'),
        'section'   => 'section_content_blog_single',
        'priority'  => 1
    )
);   

// Show Featured Image
$wp_customize->add_setting (
    'show_featured_single',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('show_featured_single'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_featured_single',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Post Navigator ( OFF | ON )', 'onsus'),
        'section'   => 'section_content_blog_single',
        'priority'  => 2
    ))
);

// Show Post Navigator
$wp_customize->add_setting (
    'show_post_navigator',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('show_post_navigator'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_post_navigator',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Post Navigator ( OFF | ON )', 'onsus'),
        'section'   => 'section_content_blog_single',
        'priority'  => 2
    ))
);

// Enable Entry Footer Content
$wp_customize->add_setting(
  'show_entry_footer_content',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('show_entry_footer_content'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_entry_footer_content',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Entry Footer ( OFF | ON )', 'onsus'),
        'section' => 'section_content_blog_single',
        'priority' => 3,
    ))
);

// Show Related Posts
$wp_customize->add_setting (
    'show_related_post',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => 0,     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_related_post',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Related Posts ( OFF | ON )', 'onsus'),
        'section'   => 'section_content_blog_single',
        'priority'  => 4
    ))
);

//Related Posts Style
$wp_customize->add_setting(
    'related_post_style',
    array(
        'default'           => themesflat_customize_default('related_post_style'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'related_post_style',
    array(
        'type'      => 'select',           
        'section'   => 'section_content_blog_single',
        'priority'  => 5,
        'label'         => esc_html__('Related Posts Style', 'onsus'),
        'choices'   => array(
            'blog-list' => esc_html__( 'Blog List','onsus' ),
            'blog-grid'=>   esc_html__( 'Blog Grid','onsus' ),
    ))
);

// Gird columns Related Posts
$wp_customize->add_setting(
    'grid_columns_post_related',
    array(
        'default'           => themesflat_customize_default('grid_columns_post_related'),
        'sanitize_callback' => 'themesflat_sanitize_grid_post_related',
    )
);
$wp_customize->add_control(
    'grid_columns_post_related',
    array(
        'type'      => 'select',           
        'section'   => 'section_content_blog_single',
        'priority'  => 6,
        'label'     => esc_html__('Columns Of Related Posts', 'onsus'),
        'choices'   => array(                
            2     => esc_html__( '2 Columns', 'onsus' ),
            3     => esc_html__( '3 Columns', 'onsus' ),
            4     => esc_html__( '4 Columns', 'onsus' ),                
        )
    )
);

// Number Of Related Posts
$wp_customize->add_setting (
    'number_related_post',
    array(
        'default' => themesflat_customize_default('number_related_post'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'number_related_post',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Number Of Related Posts', 'onsus'),
        'section'   => 'section_content_blog_single',
        'priority'  => 7
    )
);
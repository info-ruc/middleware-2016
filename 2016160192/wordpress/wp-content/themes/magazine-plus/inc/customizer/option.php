<?php
/**
 * Theme Options.
 *
 * @package Magazine_Plus
 */

$default = magazine_plus_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
	'title'      => __( 'Theme Options', 'magazine-plus' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

// Header Section.
$wp_customize->add_section( 'section_header',
	array(
	'title'      => __( 'Header Options', 'magazine-plus' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting show_title.
$wp_customize->add_setting( 'theme_options[show_title]',
	array(
	'default'           => $default['show_title'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_plus_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_title]',
	array(
	'label'    => __( 'Show Site Title', 'magazine-plus' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting show_tagline.
$wp_customize->add_setting( 'theme_options[show_tagline]',
	array(
	'default'           => $default['show_tagline'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_plus_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_tagline]',
	array(
	'label'    => __( 'Show Tagline', 'magazine-plus' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting show_date.
$wp_customize->add_setting( 'theme_options[show_date]',
	array(
	'default'           => $default['show_date'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_plus_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_date]',
	array(
	'label'    => __( 'Show Date', 'magazine-plus' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting show_ticker.
$wp_customize->add_setting( 'theme_options[show_ticker]',
	array(
	'default'           => $default['show_ticker'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_plus_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_ticker]',
	array(
	'label'    => __( 'Show News Ticker', 'magazine-plus' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting ticker_title.
$wp_customize->add_setting( 'theme_options[ticker_title]',
	array(
		'default'           => $default['ticker_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[ticker_title]',
	array(
		'label'           => __( 'Ticker Title', 'magazine-plus' ),
		'section'         => 'section_header',
		'type'            => 'text',
		'priority'        => 100,
		'active_callback' => 'magazine_plus_is_news_ticker_active',
	)
);

// Setting ticker_category.
$wp_customize->add_setting( 'theme_options[ticker_category]',
	array(
		'default'           => $default['ticker_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new magazine_plus_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[ticker_category]',
		array(
			'label'           => __( 'Ticker Category', 'magazine-plus' ),
			'section'         => 'section_header',
			'settings'        => 'theme_options[ticker_category]',
			'priority'        => 100,
			'active_callback' => 'magazine_plus_is_news_ticker_active',
		)
	)
);

// Setting ticker_number.
$wp_customize->add_setting( 'theme_options[ticker_number]',
	array(
		'default'           => $default['ticker_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_plus_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'theme_options[ticker_number]',
	array(
		'label'           => __( 'Number of Posts', 'magazine-plus' ),
		'section'         => 'section_header',
		'type'            => 'number',
		'priority'        => 100,
		'active_callback' => 'magazine_plus_is_news_ticker_active',
		'input_attrs'     => array( 'min' => 1, 'max' => 20, 'style' => 'width: 55px;' ),
	)
);

// Setting show_social_in_header.
$wp_customize->add_setting( 'theme_options[show_social_in_header]',
	array(
	'default'           => $default['show_social_in_header'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_plus_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_social_in_header]',
	array(
	'label'    => __( 'Show Social Icons', 'magazine-plus' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Layout Section.
$wp_customize->add_section( 'section_layout',
	array(
	'title'      => __( 'Layout Options', 'magazine-plus' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting global_layout.
$wp_customize->add_setting( 'theme_options[global_layout]',
	array(
	'default'           => $default['global_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_plus_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[global_layout]',
	array(
	'label'    => __( 'Global Layout', 'magazine-plus' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => magazine_plus_get_global_layout_options(),
	'priority' => 100,
	)
);
// Setting archive_layout.
$wp_customize->add_setting( 'theme_options[archive_layout]',
	array(
	'default'           => $default['archive_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_plus_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_layout]',
	array(
	'label'    => __( 'Archive Layout', 'magazine-plus' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => magazine_plus_get_archive_layout_options(),
	'priority' => 100,
	)
);
// Setting archive_image.
$wp_customize->add_setting( 'theme_options[archive_image]',
	array(
	'default'           => $default['archive_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_plus_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_image]',
	array(
	'label'    => __( 'Image in Archive', 'magazine-plus' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => magazine_plus_get_image_sizes_options( true, array( 'disable', 'thumbnail', 'medium', 'large' ), false ),
	'priority' => 100,
	)
);
// Setting archive_image_alignment.
$wp_customize->add_setting( 'theme_options[archive_image_alignment]',
	array(
	'default'           => $default['archive_image_alignment'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_plus_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_image_alignment]',
	array(
	'label'           => __( 'Image Alignment in Archive', 'magazine-plus' ),
	'section'         => 'section_layout',
	'type'            => 'select',
	'choices'         => magazine_plus_get_image_alignment_options(),
	'priority'        => 100,
	'active_callback' => 'magazine_plus_is_image_in_archive_active',
	)
);

// Home Page Section.
$wp_customize->add_section( 'section_home_page',
	array(
	'title'      => __( 'Home Page Options', 'magazine-plus' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);
// Setting home_content_status.
$wp_customize->add_setting( 'theme_options[home_content_status]',
	array(
	'default'           => $default['home_content_status'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_plus_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[home_content_status]',
	array(
	'label'       => __( 'Show Home Content', 'magazine-plus' ),
	'description' => __( 'Check this to show page content in Home page.', 'magazine-plus' ),
	'section'     => 'section_home_page',
	'type'        => 'checkbox',
	'priority'    => 100,
	)
);

// Footer Section.
$wp_customize->add_section( 'section_footer',
	array(
	'title'      => __( 'Footer Options', 'magazine-plus' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
	'label'    => __( 'Copyright Text', 'magazine-plus' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	'priority' => 100,
	)
);

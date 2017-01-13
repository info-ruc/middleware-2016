<?php
// add any new or customised functions here
add_action( 'wp_enqueue_scripts', 'metro_pirate_enqueue_styles' );
function metro_pirate_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	// Loads our main stylesheet.
	wp_enqueue_style( 'metro_pirate-child-style', get_stylesheet_uri() );
}	

add_action( 'after_setup_theme', 'metro_pirate_setup' );
function metro_pirate_setup() {
    load_child_theme_textdomain( 'metro-pirate', get_stylesheet_directory() . '/languages' );
}
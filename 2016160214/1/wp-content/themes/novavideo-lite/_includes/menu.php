<?php

function novavideo_lite_register_my_menus() {
    register_nav_menus( array( 'top-navigation' => __( 'Top', 'novavideo-lite' ) ) );
}

add_action( 'after_setup_theme', 'novavideo_lite_register_my_menus' );
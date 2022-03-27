<?php

function register_post_formats_setup() {
    add_theme_support( 'post-formats', array( 'gallery' ) );
}

add_action( 'after_setup_theme', 'register_post_formats_setup' );
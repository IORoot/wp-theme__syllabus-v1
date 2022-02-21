<?php

//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │   Dequeue & Deregister JS Scripts    │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

function remove_all_theme_scripts() {
    global $wp_scripts;
}

add_action('wp_print_scripts', 'remove_all_theme_scripts', 100);
<?php

//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │   Dequeue & Deregister CSS Styles    │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


function remove_all_theme_styles() {
    global $wp_styles;
    
    $wp_styles->queue = [
        // 'mp-theme',
        // 'mp-account-css',
        // 'mp-signup',
        // 'mp-login-css',
        // 'mp-account',
        'default'
    ];

}
add_action('wp_print_styles', 'remove_all_theme_styles', 100);
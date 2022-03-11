<?php

//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │   Dequeue & Deregister CSS Styles    │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


function remove_all_theme_styles() {

    if (is_admin()){ return; }

    global $wp_styles;

    $wp_styles->queue = [
        // 'mp-theme',
        // 'mp-account-css',
        // 'mp-signup',
        // 'mp-login-css',
        // 'mp-account',
        'default',

        // MEMBERPRESS
        // 'mp-theme',
        'mp-account',
        // 'mp-account-css',
        // 'mp-login-css',
        // 'mp-signup',
        // 'mepr-zxcvbn-css',
    ];

}
add_action('wp_print_styles', 'remove_all_theme_styles', 100);
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

    /*
    * ┌─────────────────────────────────────────────────────────────────────────┐
    * │                                                                         │
    * │                                Memberpress                              │
    * │                                /account                                 │
    * │                                                                         │
    * └─────────────────────────────────────────────────────────────────────────┘
    */
    if (is_page([ 'account' ])){ 
        $wp_styles->queue = [
            'default',
            'mp-account',
        ];
        return;
    }

    /*
    * ┌─────────────────────────────────────────────────────────────────────────┐
    * │                                                                         │
    * │                                DEFAULT                                  │
    * │                                                                         │
    * └─────────────────────────────────────────────────────────────────────────┘
    */
    $wp_styles->queue = [
        'default',
    ];

}
add_action('wp_print_styles', 'remove_all_theme_styles', 100);
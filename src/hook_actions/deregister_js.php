<?php

//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │   Dequeue & Deregister JS Scripts    │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


function remove_all_scripts() {

    $wp_scripts = wp_scripts();

    foreach ($wp_scripts->registered as $key => $script)
    {
        wp_dequeue_script( $script->handle );
        wp_deregister_script( $script->handle );
    }

    return;
} 
add_action('wp_enqueue_scripts', 'remove_all_scripts', 10);
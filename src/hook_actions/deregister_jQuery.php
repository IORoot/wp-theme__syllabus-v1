<?php

//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │   Dequeue & Deregister jQuery        │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

// ACF needs JQuery for frontend forms.
add_action( 'wp_enqueue_scripts', 'ldnpk_deregister_jquery', 100 );


function ldnpk_deregister_jquery() {

    // Skip these pages - ACF Form on these pages and ACF needs it.
    if (is_page([
        'signup'
    ])){ return; }

    // Skip admin pages.
    if ( is_admin() ){return; };

    wp_deregister_script('jquery');

}
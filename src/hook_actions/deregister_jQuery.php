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

    //  ┌──────────────────────────────────────┐ 
    //  │                                      │░
    //  │   DO NOT Deregister ON These pages   │░
    //  │                                      │░
    //  └──────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    // Skip these PAGES (NOT A CPT) - ACF Form on these pages and ACF needs it.
    if (is_page([
        'signup',   // /signup
        'account',  // /account/
    ])){ return; }


    //  ┌──────────────────────────────────────┐ 
    //  │                                      │░
    //  │   DO NOT Deregister ON These         │░
    //  │   Memberpress Pages.                 │░
    //  │                                      │░
    //  └──────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    // Skip the memberpress product pages because
    // these are the 'signup' pages with the password strength js files
    // and password matching, etc..
    global $post;
    if ($post->post_type == "memberpressproduct"){
        return;
    }

    //  ┌──────────────────────────────────────┐ 
    //  │                                      │░
    //  │   DO NOT Deregister ON ADMIN Pages   │░
    //  │                                      │░
    //  └──────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    // Skip admin pages.
    if ( is_admin() ){return; };

    wp_deregister_script('jquery');

}
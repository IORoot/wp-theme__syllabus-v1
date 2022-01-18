<?php

//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │   Dequeue & Deregister jQuery        │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

add_action( 'wp_enqueue_scripts', 'ldnpk_deregister_jquery', 100 );


function ldnpk_deregister_jquery() {

    // stripe still works without jQuery.
    if ( !is_admin() ) wp_deregister_script('jquery');

}
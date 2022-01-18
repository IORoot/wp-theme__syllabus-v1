<?php


//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │     Dequeue & Deregister XMLRPC      │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
remove_action ('wp_head', 'rsd_link');


//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │       Remove Wordpress Version       │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
function ldnpk_remove_version() {
	return '';
}
add_filter('the_generator', 'ldnpk_remove_version');

//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │     Remove Wordpress Emoji shit      │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

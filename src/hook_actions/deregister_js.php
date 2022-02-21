<?php

//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │   Dequeue & Deregister JS Scripts    │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

function dequeue_deregister($handle){
	wp_dequeue_script($handle);
	wp_deregister_script($handle);
}

function remove_registered_scripts(){
    global $wp_scripts;

    foreach ($wp_scripts->queue as $queue_key => $queue_value)
    {
        if ($queue_value == 'i18n-react'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'wp-api'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'react'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'react-dom'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'mobx'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'mobx-state-tree'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'jquery-ui-core'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'jquery-ui-widget'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'jquery-ui-mouse'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'jquery-ui-draggable'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'jquery-ui-droppable'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'jquery-ui-sortable'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'jquery-touch-punch'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'thickbox'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'wp-api'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'devowl-wp-utils'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'vendor-devowl-wp-utils'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'media-editor'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'media-audiovideo'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'es6-shim'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'es7-shim'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'react-aiot.vendor'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'react-aiot'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'real-media-library-rml'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'wp-media-picker'){ dequeue_deregister($queue_value); }
        if ($queue_value == 'underscore'){ dequeue_deregister($queue_value); }
    } 

}

// add_action('wp_print_scripts', 'remove_registered_scripts',100);
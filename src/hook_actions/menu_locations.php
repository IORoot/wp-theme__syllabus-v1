<?php

function register_custom_theme_menus()
{
    register_nav_menus(
        array(
            'mobile' => 'Mobile',
        )
    );
}

add_action('init', 'register_custom_theme_menus');

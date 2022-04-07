<?php

    /**
     * Output the navigation
     */
    wp_nav_menu([
        'theme_location'  => 'main-right',
        'menu_id'         => 'main-right',
        'container_class' => 'ml-auto p-2 w-48',
        'menu_class'      => 'flex justify-end text-center',
        'walker'          => new SubMenu_Walker,
        'before'          => '',
        'link_before'     => '',
        'after'           => '',
    ]);
    
?>
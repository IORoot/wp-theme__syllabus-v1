<?php

    /**
     * Output the navigation
     */
    wp_nav_menu([
        'theme_location'  => 'menu-1',
        'menu_id'         => 'main-menu',
        'container_class' => 'flex-1 z-50',
        'menu_class'      => 'flex justify-center text-center',
        'walker'          => new MainMenu_Walker,
        'before'          => '',
        'link_before'     => '',
        'after'           => '',
    ]);


?>
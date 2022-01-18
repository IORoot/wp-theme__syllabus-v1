<?php

    /**
     * Output the navigation
     */
    wp_nav_menu([
        'theme_location'  => 'sub-menu',
        'menu_id'         => 'sub-menu',
        'container_class' => 'flex-1',
        'menu_class'      => 'flex justify-start text-center',
        'walker'          => new SubMenu_Walker,
        'before'          => '',
        'link_before'     => '',
        'after'           => '',
    ]);


?>
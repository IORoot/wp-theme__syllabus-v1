<?php

define( 'ANDYP_THEME_PATH', __DIR__ );
define( 'ANDYP_THEME_URL', get_template_directory_uri() );
define( 'ANDYP_THEME_FILE',  __FILE__ );

/*
 * Run all hooks
 */
require get_template_directory() . '/src/hooks/init.php';
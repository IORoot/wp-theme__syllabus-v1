<?php

/**
 * DeRegister ACF Styles
 */
require get_template_directory() . '/src/hook_actions/deregister_acf_styles.php';

/**
 * Remove Frontend Styles
 */
require get_template_directory() . '/src/hook_actions/deregister_css.php';

/**
 * Remove jquery migrate
 */
require get_template_directory() . '/src/hook_actions/deregister_jquery_migrate.php';

/**
 * Remove jQuery
 */
require get_template_directory() . '/src/hook_actions/deregister_jQuery.php';

/**
 * Remove Frontend Scripts
 */
require get_template_directory() . '/src/hook_actions/deregister_js.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/src/hook_actions/enqueue_scripts.php';

/**
 * Define the SVG action to include into footer.
 * See /src/assets/svgs/
 */
require get_template_directory() .'/src/hook_actions/footer_svgs.php';

/**
 * Add custom menu locations
 */
require get_template_directory() . '/src/hook_actions/menu_locations.php';

/**
 * Register menus
 */
require get_template_directory() . '/src/hook_actions/register_nav_menus.php';

/**
 * Remove Frontend Emojis
 */
require get_template_directory() . '/src/hook_actions/remove_emojis.php';

/**
 * Remove Frontend RSD Link
 */
require get_template_directory() . '/src/hook_actions/remove_rsd_link.php';

/**
 * Memberpress sidebar
 */
require get_template_directory() . '/src/hook_actions/memberpress_user_sidebar.php';

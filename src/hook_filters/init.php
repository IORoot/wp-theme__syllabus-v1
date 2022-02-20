<?php

/**
 * Register Sidebars and Widgets.
 */
require get_template_directory() . '/src/hook_filters/defer_all_js.php';

/**
 * Disable SSL Verify for CURL
 * This is so the REST to parkourpulse and parkourlabs work.
 */
require get_template_directory() . '/src/hook_filters/disable_curl_ssl_verify.php';

/*
 * Remove Gutenberg bullshit
 */
require get_template_directory() . '/src/hook_filters/disable_gutenberg.php';

/**
 * Disable XML-RPC
 */
require get_template_directory() . '/src/hook_filters/disable_xmlrpc.php';

/**
 * Remove Frontend Styles & Scripts
 */
require get_template_directory() . '/src/hook_filters/remove_all_thumbnail_sizes.php';

/**
 * Remove <p> tags automatically added by wordpress
 */
require get_template_directory() . '/src/hook_filters/remove_p_tags.php';

/**
 * Remove RSS generator
 */
require get_template_directory() . '/src/hook_filters/remove_rss_generator.php';

/**
 * Remove W3TC footer comment
 */
require get_template_directory() . '/src/hook_filters/remove_W3TC_footer.php';

/**
 * Custom Search form
 */
require get_template_directory() . '/src/hook_filters/search_form.php';

/**
 * Search filters
 */
require get_template_directory() . '/src/hook_filters/search.php';

/**
 * Enable SVGs to be uploaded and used.
 */
require get_template_directory() . '/src/hook_filters/svg_webp_enable.php';

/**
 * Turn off notifications for ACF and Forms Pro
 */
require get_template_directory() . '/src/hook_filters/turn_off_plugin_updates.php';

/**
 * Register the template files to use with the custom taxonomies.
 */
new andyp\theme\syllabus\hook_filters\taxonomy_templates([
    'taxonomy' => 'syllabus_category',
    'post_type' => 'syllabus'
]);

/**
 * Add filmed status to post title in sidebar.
 */
require get_template_directory() . '/src/hook_filters/sidebar_post_title.php';
/**
 * Add Add SVG Glyph to category name.
 */
require get_template_directory() . '/src/hook_filters/sidebar_cat_name.php';
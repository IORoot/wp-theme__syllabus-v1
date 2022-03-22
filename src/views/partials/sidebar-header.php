<?php

/**
 * Create the sidebar header.
 */
if (is_a($variables["current_object"], 'WP_Term'))
{
    // $sidebar_header = new andyp\theme\syllabus\lib\sidebar_term_header;
    // $sidebar_header->set_terms($variables["terms"]);
}

if (is_a($variables["current_object"], 'WP_Post'))
{
    $sidebar_header = new andyp\theme\syllabus\lib\sidebar_post_header;
    $sidebar_header->set_awardlevel($variables["acf"]["award_level_roman"]);
    $sidebar_header->set_title($variables["current_object"]->post_title);
    $sidebar_header->set_image($variables["thumbnail"]);
    $sidebar_header->set_parent_term($variables["terms_parent"]);
    $sidebar_header->set_child_term($variables["terms_child"]);
    echo $sidebar_header->output();
}


<?php

/**
 * Create the sidebar header.
 */
$sidebar_header = new andyp\theme\syllabus\lib\sidebar_header($variables);
$sidebar_header->set_awardlevel($variables["acf"]["award_level"]);
$sidebar_header->set_terms($variables["terms"]);

echo $sidebar_header->output();
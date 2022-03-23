<?php

/**
 * Create the sidebar header.
 */
$sidebar_header = new andyp\theme\syllabus\lib\sidebar_header;
$sidebar_header->set_variables($variables);
echo $sidebar_header->output();
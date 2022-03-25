<?php

    /**
     * Create the breadcrumbs.
     */
    $search = new andyp\theme\syllabus\lib\ajax_search;
    $search->set_variables($variables);
    echo $search->output();

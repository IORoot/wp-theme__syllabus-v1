<?php

    /**
     * Create the breadcrumbs.
     */
    $breadcrumbs = new andyp\theme\syllabus\lib\breadcrumbs;
    $breadcrumbs->set_variables($variables);
    echo $breadcrumbs->output();

<?php

    /**
     * Create the breadcrumbs.
     */
    $vidgrid = new andyp\theme\syllabus\lib\video_grid;
    $vidgrid->set_variables($variables);
    echo $vidgrid->output();

<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                			   PATHS INDEX                               │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>
<div id="path_index" class="flex flex-col gap-2 ">


    <div class="text-2xl p-4 font-thin">Steps</div>


    <?php

        /**
         * Create the AJAX clickable path items.
         * These will load the content on the right hand side..
         */
        $path_index = new andyp\theme\syllabus\lib\ajax_retrieve_syllabus;
        $path_index->set_variables($variables);
        echo $path_index->output();

    ?>

</div>

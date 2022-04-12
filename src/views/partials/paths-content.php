<div class="post_body content-tabs bg-zinc-700 p-10 rounded-xl">
    <?php
        /**
         * Custom filter in wp-plugin__cpt--syllabus to run parsedown
         * on content.
         * These can be controlled through the Admin > Syllabus > Settings.
         */
        echo apply_filters('cpt_syllabus_transforms', $variables['current_object']->post_content);

    ?>
</div>
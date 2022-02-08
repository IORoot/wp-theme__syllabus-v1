<div class="post_body">
<?php
    /**
     * Custom filter in wp-plugin__cpt--syllabus to run parsedown
     * on content.
     * These can be controlled through the Admin > Syllabus > Settings.
     */
    echo apply_filters('cpt_syllabus_transforms', $post->post_content);

?>
</div>
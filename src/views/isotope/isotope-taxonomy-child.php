<?php

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                Syllabus Child Taxonomy                                  │
// │                                                                         │
// │                Page Locations:                                          │
// │                    /syllabus/balancing/mounting                         │
// │                                                                         │
// │                Lists the posts rather than terms.                       │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘

?>
<div class="isotope category-listing p-8 relative">
    <div class="controls flex"></div>
    <div class="isotope-grid">

    <?php

        $index = 1;
        while (have_posts()) {

            the_post();
            $post_meta = get_fields( $post );
            $post_permalink = get_post_permalink($post);
            $post_image = get_the_post_thumbnail($post);

            ?>

            <div class="grid-item overflow-hidden pb-10 md:pr-10 inline-block w-1/5 float-left  vaulting" data-unixdate="">
                <a class="flex flex-col bg-zinc-900 text-white hover:bg-amber-500 rounded-lg overflow-hidden relative fill-zinc-50 hover:fill-zinc-900 p-4" href="<?php echo $post_permalink; ?>">
                
                    <div class="{{title:sanitize}} text-zinc-500 text-xs uppercase"><?php echo $index . '. ' . $post->post_title; ?></div>

                    <?php echo $post_image; ?>
                </a>
            </div>



        <?php
        $index++;
        }
    ?>
    </div>
</div>
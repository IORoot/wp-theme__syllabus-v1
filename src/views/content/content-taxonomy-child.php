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

<?php 
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                			    TITLE                                    │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
include(get_template_directory() . '/src/views/partials/taxonomy-child-title.php'); 
?>

<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                			    CELLS                                    │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>
<div class=" category-listingrelative">
    <div class="grid grid-cols-5 gap-4">

    <?php

        $index = 1;
        while (have_posts()) {

            the_post();
            $post_meta = get_fields( $post );
            $post_permalink = get_post_permalink($post);
            $post_image = get_the_post_thumbnail($post);

            ?>

            <div class="grid-item overflow-hidden inline-block w-full" >
                <a class="flex flex-col bg-zinc-800 hover:bg-amber-500 text-zinc-400 hover:text-zinc-800 rounded-lg overflow-hidden relative fill-zinc-900 hover:fill-zinc-50 p-4" href="<?php echo $post_permalink; ?>">
                
                    <div class="text-xs uppercase"><span class="text-emerald-500 mr-1"><?php echo $help->numberToRoman($index) . '. '?></span><?php echo $post->post_title; ?></div>

                    <?php echo $post_image; ?>
                </a>
            </div>



        <?php
        $index++;
        }
    ?>
    </div>
</div>
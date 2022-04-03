<?php

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                Syllabus Parent Taxonomy                                 │
// │                                                                         │
// │                Page Locations:                                          │
// │                    /syllabus/balancing                                  │
// │                                                                         │
// │                Lists the child terms.                                   │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>

<?php 
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                			    TITLE                                    │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
include(get_template_directory() . '/src/views/partials/taxonomy-parent-title.php'); 
?>

<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                			    CELLS                                    │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>
<div class="category-listing relative">
    
    <div class="grid grid-cols-5 gap-4">

    <?php

        foreach ($variables["terms"] as $index => $term_child){

            $term_acf = get_fields('term_'.$term_child->term_id, 'options');
            if (!$term_acf){ $term_acf = []; }
            $term_permalink = get_term_link($term_child->term_id);

            ?>

            <div class="grid-item overflow-hidden inline-block w-full">
                <a class="flex flex-col bg-zinc-800 text-white hover:bg-amber-500 rounded-lg overflow-hidden relative fill-amber-500 hover:fill-zinc-900 p-4" href="<?php echo $term_permalink; ?>">
                
                    <div class="text-zinc-500 text-xs uppercase"><?php echo $term_child->name; ?></div>

                    <?php
                        if (array_key_exists('svg_glyph', $term_acf)){
                            echo $term_acf["svg_glyph"]; 
                        }
                    ?>

                    <?php echo $graphs->bar($term_child->favourited, $term_child->count); ?>
                </a>
            </div>

        <?php
        }
        
    ?>
    </div>
</div>

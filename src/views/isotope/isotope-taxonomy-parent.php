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
// │                			CATEGORY HEADER                              │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>
<div class="h-40 w-full bg-zinc-900 rounded-xl flex flex-row fill-amber-500">

    <div class="w-40 h-40 p-4">
        <?php echo str_replace('width="170px" height="170px"' ,'', $variables["acf"]["svg_glyph"]); ?>
    </div>

    <div class="text-7xl text-zinc-50 my-11 uppercase">
        <?php echo $variables["current_object"]->name; ?>
    </div>

    <div class="text-2xl text-zinc-50 text-right">
    <?php echo $variables["current_object"]->count; ?>
    </div>

</div>

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

        $terms = get_terms([
            'taxonomy' => $variables["current_object"]->taxonomy,
            'parent' => $variables["current_object"]->term_id
        ]);

        foreach ($terms as $index => $term_child){

            
            $term_acf = get_fields('term_'.$term_child->term_id, 'options');
            if (!$term_acf){ $term_acf = []; }
            $term_permalink = get_term_link($term_child->term_id);

            ?>

            <div class="grid-item overflow-hidden inline-block w-full">
                <a class="flex flex-col bg-zinc-900 text-white hover:bg-amber-500 rounded-lg overflow-hidden relative fill-amber-500 hover:fill-zinc-900 p-4" href="<?php echo $term_permalink; ?>">
                
                    <div class="text-zinc-500 text-xs uppercase"><?php echo $term_child->name; ?></div>

                    <?php
                        if (array_key_exists('svg_glyph', $term_acf)){
                            echo $term_acf["svg_glyph"]; 
                        }
                    ?>
                </a>
            </div>

        <?php
        }
        
    ?>
    </div>
</div>

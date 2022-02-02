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

<div class="isotope category-listing p-8 relative">
    
    <div class="controls flex"></div>
    <div class="isotope-grid">

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

            <div class="grid-item overflow-hidden pb-10 md:pr-10 inline-block w-1/5 float-left  vaulting">
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
<?php

    foreach ($variables["terms"] as $term){
        if ($term->parent == 0){
            $parent_link  = get_term_link($term);
            $parent_name  = $term->name;
            $parent_glyph = $term->acf["svg_glyph"];
            continue; 
        } else {
            $child_link  = get_term_link($term);
            $child_name = $term->name;
            $child_glyph = $term->acf["svg_glyph"];

        }

    }

?>
<a href="<?php echo $parent_link; ?>" class="rounded-xl bg-zinc-900 fill-zinc-700 text-zinc-700 flex flex-row px-4 justify-center items-center hover:bg-emerald-500 hover:fill-white hover:text-white">
    <div class="h-8 w-8  inline-block"><?php echo $parent_glyph ?></div>
    <div class="">
        <?php echo $parent_name ?>
    </div>
</a>

<a href="<?php echo $child_link; ?>" class="rounded-xl bg-zinc-900 text-zinc-500 fill-zinc-500 flex flex-row px-4 justify-center items-center hover:bg-emerald-500 hover:fill-white hover:text-white">
    <div class="h-8 w-8 inline-block"><?php echo $child_glyph ?></div>
    <div class="">
        <?php echo $child_name?>
    </div>
</a>

<div class="rounded-xl bg-zinc-900 px-4 flex flex-row justify-center items-center">
    <div class="text-emerald-500 pr-1">
        <?php  echo $help->numberToRoman($variables["acf"]["award_level"]). '. ';  ?>
    </div>
    <div>
        <?php the_title(); ?>
    </div>
</div>
<?php

foreach ($variables["terms"] as $term){
    if ($term->parent == 0){ continue; }
    $svg_glyph = $term->acf["svg_glyph"];
    $term_name = $term->name;
}

?>

<div class="w-full h-full bg-zinc-800 fill-zinc-100 rounded-xl">
    <?php echo $svg_glyph; ?>
    <p class="text-center mb-4 font-thin text-lg"> <?php echo $term_name ?></p>
</div>
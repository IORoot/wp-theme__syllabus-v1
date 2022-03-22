<?php

    $parent = $variables["terms_parent"][0];
    $child  = $variables["terms_child"][0];
    $roman  = $variables["acf"]["award_level_roman"];

?>
<a href="<?php echo $parent->link; ?>" class="rounded-xl bg-zinc-900 fill-zinc-700 text-zinc-700 flex flex-row px-4 justify-center items-center hover:bg-emerald-500 hover:fill-white hover:text-white">
    <div class="h-8 w-8  inline-block"><?php echo $parent->acf["svg_glyph"] ?></div>
    <div class="">
        <?php echo $parent->name ?>
    </div>
</a>

<a href="<?php echo $child->link; ?>" class="rounded-xl bg-zinc-900 text-zinc-500 fill-zinc-500 flex flex-row px-4 justify-center items-center hover:bg-emerald-500 hover:fill-white hover:text-white">
    <div class="h-8 w-8 inline-block"><?php echo $child->acf["svg_glyph"] ?></div>
    <div class="">
        <?php echo $child->name ?>
    </div>
</a>

<div class="rounded-xl bg-zinc-900 px-4 flex flex-row justify-center items-center">
    <div class="text-emerald-500 pr-1">
        <?php  echo $roman . '. ';  ?>
    </div>
    <div>
        <?php the_title(); ?>
    </div>
</div>
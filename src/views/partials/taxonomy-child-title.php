<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                			CATEGORY HEADER                              │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>
<div class="h-40 w-full bg-zinc-900 rounded-xl flex flex-row fill-amber-500">

    <div class="w-40 h-40 p-4">
        <?php echo $variables["acf"]["svg_glyph"]; ?>
    </div>


    <div class="flex flex-col justify-center">
        <?php if (array_key_exists('parent', $variables["terms"])) { ?>
            <a href="<?php echo get_term_link($variables["terms"]["parent"]); ?>" class="flex flex-row fill-zinc-500 text-zinc-500 hover:fill-emerald-500 hover:text-emerald-500">
                <div class="h-6 w-6 "><?php echo $variables["terms"]["parent"]->acf["svg_glyph"]; ?></div>
                <div class="text-xl uppercase"><?php  echo $variables["terms"]["parent"]->name; ?></div>
            </a>
        <?php } ?>


        <div class="text-7xl text-zinc-50 uppercase">
            <?php echo $variables["current_object"]->name; ?>
        </div>

    </div>
    
    <?php include(get_template_directory() . '/src/views/partials/taxonomy-child-stats.php'); ?>

</div>
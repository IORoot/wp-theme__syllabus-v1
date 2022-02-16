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
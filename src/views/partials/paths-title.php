<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                			SINGLE PATH HEADER                           │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>
<div class="h-40 w-full bg-zinc-900 rounded-xl flex flex-row fill-amber-500 items-center pl-8">

    <div class="text-5xl text-zinc-50 my-11 uppercase">
        <?php echo $variables["current_object"]->post_title; ?>
    </div>


    <?php include(get_template_directory() . '/src/views/partials/paths-stats.php'); ?>

</div>
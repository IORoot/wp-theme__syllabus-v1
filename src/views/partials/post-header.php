<div class="w-full h-40 rounded-xl flex flex-row px-12 py-2 gap-4 bg-gradient-to-tr from-amber-500 to-yellow-500 relative">

    <div class="flex flex-col gap-4 justify-center w-full">
        <div class="flex flex-row text-5xl">
            <div class="text-black mr-2"><?php echo $variables["acf"]["award_level_roman"] . '. '?></div>
            <div><?php echo $variables["current_object"]->post_title; ?></div>
        </div>   

        <div class="flex flex-row gap-8">

            <div class="flex flex-col">
                <div class="text-amber-200 text-xs">Level</div>
                <div><?php echo $variables["acf"]["award_level"]; ?></div>
            </div>


            <div class="w-px h-full bg-amber-400"></div>


            <div class="flex flex-col">
                <div class="text-amber-200 text-xs">Technique</div>
                <a href="<?php echo $variables["terms_child"]->link; ?>" class="flex flex-row items-center hover:bg-emerald-500 rounded px-2">
                    <div class="w-5 h-5 mr-1 fill-white"><?php echo $variables["terms_child"]->acf["svg_glyph"]; ?></div>
                    <?php echo $variables["terms_child"]->name; ?>
                </a>
            </div>


            <div class="w-px h-full bg-amber-400"></div>


            <div class="flex flex-col">
                <div class="text-amber-200 text-xs">Movement</div>
                <a href="<?php echo $variables["terms_parent"]->link; ?>" class="flex flex-row items-center hover:bg-emerald-500 rounded px-2">
                    <div class="w-5 h-5 mr-1 fill-white"><?php echo $variables["terms_parent"]->acf["svg_glyph"]; ?></div>
                    <?php echo $variables["terms_parent"]->name; ?>
                </a>
            </div>


            <div class="w-px h-full bg-amber-400"></div>


            <div class="flex flex-col">
                <div class="text-amber-200 text-xs">Published</div>
                <div><?php echo $variables["current_object"]->post_date_gmt; ?></div>
            </div>


            <div class="w-px h-full bg-amber-400"></div>

            
            <div class="flex flex-col">
                <div class="text-amber-200 text-xs">Videos</div>
                <div><?php echo $variables["current_object"]->video_count; ?></div>
            </div>

        </div>

    </div>

    <div class="flex flex-col gap-4 justify-top">
        <?php include(get_template_directory() . '/src/views/partials/mycred-post-header.php'); ?>
    </div>

</div>
<?php

/**
 * foreach ($paths as $loop_index => $loop_path){}
 */
$path_acf       = $variables['paths'][$loop_index]->acf;
$path_permalink = get_post_permalink($loop_path->ID);
$path_image     = get_the_post_thumbnail($loop_path, 'large' ,['class' => 'h-full object-cover rounded-xl']);
$tw_background  = $path_acf["tailwind_background_colour"];
$tw_foreground  = $path_acf["tailwind_foreground_colour"];
$tw_secondary   = $path_acf["tailwind_secondary_colour"];
$tw_highlight   = $path_acf["tailwind_highlight_colour"];
$glyph          = $path_acf["path_glyph"];

$difficulty_list     = '';
foreach ($path_acf["difficulty"] as $difficulty_index => $difficulty){
    $difficulty_list .= '<div class="flex flex-row h-4"><div class="h-4 w-4">'.$path_acf["difficulty_icon"][$difficulty_index].'</div><div class="w-full">'.$difficulty.'</div></div>';
}

?>

<div class="grid-item overflow-hidden inline-block w-full ">
    <a class="flex flex-col group gap-4 bg-<?php echo $tw_background; ?> text-<?php echo $tw_foreground; ?> hover:bg-amber-500 rounded-lg overflow-hidden relative hover:text-zinc-900 p-4" href="<?php echo $path_permalink; ?>">
        
        <?php if (!empty($glyph)){ ?><div class="w-full"><img src="<?php echo $glyph; ?>" class="w-10 mx-auto"></div><?php } ?>

        <div class="h-60">
            <?php if ($path_image){  echo $path_image; }  ?>
        </div>

        <div class="p-4 flex flex-col gap-5">
            <div class="text-4xl text-center"><?php echo $loop_path->post_title; ?></div>
            <div class="text-<?php echo $tw_secondary; ?> group-hover:text-white font-thin text-center"><?php echo $loop_path->post_excerpt; ?></div>
            <div class="flex flex-row group-hover:text-white text-xs uppercase">
                <div class="text-<?php echo $tw_highlight; ?> fill-<?php echo $tw_highlight; ?> w-4/5"><?php echo  $difficulty_list; ?></div>
                <div class="text-<?php echo $tw_highlight; ?> w-1/5 text-right"><?php echo count($path_acf["syllabus_items"]); ?> Steps</div>
            </div>
        </div>
        
    </a>
</div>
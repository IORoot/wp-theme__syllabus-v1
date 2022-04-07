<div class="text-zinc-50 text-right ml-auto flex flex-col px-8 justify-center gap-2">
    <div class="text-7xl">
        <?php echo  ceil((100 / intval($variables["current_object"]->total_post_count)) * $variables['mycred']['favourited_posts_count']); ?>%
    </div>
    <?php echo $graphs->bar(intval($variables['mycred']['favourited_posts_count']), intval($variables["current_object"]->total_post_count)); ?>
</div>
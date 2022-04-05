<div class="text-zinc-50 text-right ml-auto flex flex-col px-8 justify-center gap-2">
    <div class="text-2xl"><?php echo $variables["current_object"]->count; ?> Techniques</div>
    <?php echo $graphs->bar($variables['mycred']['taxonomy_personal_tracking_total'], $variables["current_object"]->count, 'percentage'); ?>
</div>
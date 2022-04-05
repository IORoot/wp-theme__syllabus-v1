<div class="text-2xl text-zinc-50 text-right ml-auto flex flex-col px-8 justify-center gap-2">
    <div><?php echo count($variables['terms']); ?> Movements</div>
    <div><?php echo $variables["current_object"]->count; ?> Techniques</div>
    <div class="mt-2"><?php echo $graphs->bar($variables["mycred"]["taxonomy_personal_tracking_total"], $variables["current_object"]->count, 'percentage'); ?></div>
</div>
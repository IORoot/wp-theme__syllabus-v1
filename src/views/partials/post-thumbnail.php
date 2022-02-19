<a href="#open-thumbnail-modal" class="w-full h-auto bg-zinc-800 rounded-xl hover:bg-zinc-700">
    <?php echo get_the_post_thumbnail(); ?>
</a>

<div id="open-thumbnail-modal" class="modal-window fixed bg-neutral-500 bg-opacity-50 inset-0 invisible opacity-0 pointer-events-none flex justify-center items-center h-screen z-50 target:visible target:opacity-100 target:pointer-events-auto">
  <div class="modal-box h-5/6 w-5/6 relative p-4 bg-zinc-800 text-zinc-50">
    <a href="#" title="Close" class="modal-close absolute right-1 top-2 text-center">
      <svg role="img" aria-label="Close Icon" class="w-10 h-10 fill-zinc-50 hover:fill-amber-500"><use xlink:href="#close"></use></svg>
    </a>
    <h1 class="absolute top-2 left-6 pointer-events-none"><?php the_title(); ?></h1>
    <div class="w-full h-full"><?php echo get_the_post_thumbnail(null, null, ['class' => 'w-full h-full']); ?></div>
  </div>
</div> 
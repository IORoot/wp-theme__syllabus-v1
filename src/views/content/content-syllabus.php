<article <?php post_class('p-4 w-full flex flex-row gap-4 text-zinc-100'); ?>>


	<?php
	// ┌─────────────────────────────────────────────────────────────────────────┐
	// │                                                                         │
	// │                			Main Content                                 │
	// │                                                                         │
	// └─────────────────────────────────────────────────────────────────────────┘
	?>
	<div class="w-4/5 h-full flex flex-col gap-8">

		<?php 
			include(get_template_directory() . '/src/views/partials/post-video.php'); 
		?>
		
		<div class="content max-w-screen-sm mx-auto">
		<?php
			include(get_template_directory() . '/src/views/partials/post-title.php'); 
			include(get_template_directory() . '/src/views/partials/post-content.php'); 
		?>
		</div>
		
	</div>


	<?php
	// ┌─────────────────────────────────────────────────────────────────────────┐
	// │                                                                         │
	// │                			Right Sidebar                                │
	// │                                                                         │
	// └─────────────────────────────────────────────────────────────────────────┘
	?>
	<div class="w-1/5 h-full flex flex-col gap-4">
		<?php include(get_template_directory() . '/src/views/partials/post-taxonomy-glyph.php'); ?>
		<?php include(get_template_directory() . '/src/views/partials/post-thumbnail.php'); ?>
		<?php include(get_template_directory() . '/src/views/partials/post-side-rules.php'); ?>
	</div>

</article>
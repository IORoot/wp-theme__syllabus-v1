<article <?php post_class('w-full flex flex-row gap-4 text-zinc-100'); ?>>


	<?php
	// ┌─────────────────────────────────────────────────────────────────────────┐
	// │                                                                         │
	// │                			Main Content                                 │
	// │                                                                         │
	// └─────────────────────────────────────────────────────────────────────────┘
	?>
	<div class="w-full h-full flex flex-col gap-4">	

			
		<?php 
			// ┌─────────────────────────────────────────────────────────────────────────┐
			// │                			  HEADER                                     │
			// └─────────────────────────────────────────────────────────────────────────┘
			include(get_template_directory() . '/src/views/partials/post-header-tutorial.php'); 
		?>

		<?php 
			// ┌─────────────────────────────────────────────────────────────────────────┐
			// │                			  VIDEO                                      │
			// └─────────────────────────────────────────────────────────────────────────┘
			include(get_template_directory() . '/src/views/partials/post-video-grid.php'); 
		?>

		<div class="content max-w-screen-lg mx-auto w-full">
		<?php
			// ┌─────────────────────────────────────────────────────────────────────────┐
			// │                			  TABS                                       │
			// └─────────────────────────────────────────────────────────────────────────┘
			include(get_template_directory() . '/src/views/partials/post-tabs-tutorial.php');
		?>
		</div>
		
	</div>


</article>
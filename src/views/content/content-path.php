<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                			SINGLE PATH Content                          │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>

<article <?php post_class('w-full h-full flex flex-row text-zinc-100'); ?>>


	<?php 
	// ┌─────────────────────────────────────────────────────────────────────────┐
	// │                		  PATH LISTING SIDEBAR                           │
	// └─────────────────────────────────────────────────────────────────────────┘
	?>
	<div class=" h-full w-2/5 max-h-screen overflow-auto bg-zinc-700 p-4">

		<?php
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                			   PATHS INDEX                               │
		// └─────────────────────────────────────────────────────────────────────────┘
		?>
		<div id="path_index" class="flex flex-col gap-4">

			<a href="<?php echo $_SERVER["REDIRECT_URL"]; ?>" class="w-full rounded-xl bg-zinc-900 hover:bg-amber-500 text-zinc-100 hover:text-zinc-900 flex flex-row gap-4 p-4 cursor-pointer">
				<div class="w-1/4 overflow-hidden h-auto bg-zinc-800 rounded-xl hover:bg-zinc-700">
					<?php echo get_the_post_thumbnail(); ?>
				</div>
				<div class="w-full flex flex-col justify-center">
					<div class="text-xs text-zinc-500">OVERVIEW</div>
					<?php echo $variables["current_object"]->post_title; ?>
					<div class="text-xs text-emerald-500"><?php echo count($variables["acf"]["syllabus_items"]); ?> Steps</div>
					<div class="text-xs mt-2 text-right  font-thin"><span class="text-zinc-600 mr-1">Total duration:</span><?php echo gmdate("H:i:s", $variables["current_object"]->total_watch_seconds); ?></div>
				</div>
				
			</a>

				<?php 
				// ┌─────────────────────────────────────────────────────────────────────────┐
				// │                			    PATH INDEX                               │
				// └─────────────────────────────────────────────────────────────────────────┘
				include(get_template_directory() . '/src/views/partials/paths-index.php'); 
				?>
			

		</div>

	</div>


	<?php 
	// ┌─────────────────────────────────────────────────────────────────────────┐
	// │                		  SINGLE PATH CONTENT                            │
	// │                	AJAX TARGET path_item_content                        │
	// └─────────────────────────────────────────────────────────────────────────┘
	?>
	<div id="path_item_content"  class="w-full p-4 max-h-screen overflow-auto flex flex-col gap-4">
		<?php 
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                			  THUMBNAIL                                  │
		// └─────────────────────────────────────────────────────────────────────────┘
		include(get_template_directory() . '/src/views/partials/paths-thumbnail.php'); 
		?>			
		
		<?php 
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                			    TITLE                                    │
		// └─────────────────────────────────────────────────────────────────────────┘
		include(get_template_directory() . '/src/views/partials/paths-title.php'); 
		?>		
		
		<?php 
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                			    CONTENT                                  │
		// └─────────────────────────────────────────────────────────────────────────┘
		include(get_template_directory() . '/src/views/partials/paths-content.php'); 
		?>
	</div>



</article>
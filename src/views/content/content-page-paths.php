<article <?php post_class(); ?>>
		
	<div class="flex flex-col p-4 gap-4">
		<?php 
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                                                                         │
		// │                			    TITLE                                    │
		// │                                                                         │
		// └─────────────────────────────────────────────────────────────────────────┘
		include(get_template_directory() . '/src/views/partials/paths-page-title.php'); 
		?>

		<?php
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                                                                         │
		// │                			    GRID                                     │
		// │                                                                         │
		// └─────────────────────────────────────────────────────────────────────────┘
		?>
		<div class="grid grid-cols-5 gap-4">

		<?php

			$paths = $variables['paths'] = get_posts([
				'posts_per_page' => -1,
				'post_type' => 'paths'
			]);
			

			foreach ($paths as $loop_index => $loop_path){

				$path_acf = $variables['paths'][$loop_index]->acf = get_fields( $loop_path->ID );
				$path_permalink = get_post_permalink($loop_path->ID);
				$path_image = get_the_post_thumbnail($loop_path);

				?>

				<div class="grid-item overflow-hidden inline-block w-full">
					<a class="flex flex-col gap-4 bg-zinc-800 text-white hover:bg-amber-500 rounded-lg overflow-hidden relative fill-white hover:fill-zinc-900 hover:text-zinc-900" href="<?php echo $path_permalink; ?>">
						<?php
							if ($path_image){  echo $path_image; }
							if (!$path_image){
								?><div class="w-full h-80 bg-zinc-700"></div><?php
							}
						?>
						<div class="px-4 pb-4 flex flex-col gap-4">
							<div class=""><?php echo $loop_path->post_title; ?></div>
							<div class="text-zinc-300 font-thin"><?php echo $loop_path->post_excerpt; ?></div>
							<div class="text-zinc-500 text-xs uppercase text-right"><?php echo count($variables["paths"][0]->acf["syllabus_items"]); ?> Steps</div>
						</div>
					</a>
				</div>

			<?php
			}
			
		?>
		
		</div>
	</div>

</article>
<article <?php post_class(); ?>>
		
	<div class="flex flex-col p-4 gap-4">
		<?php 
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                                                                         │
		// │                			    TITLE                                    │
		// │                                                                         │
		// └─────────────────────────────────────────────────────────────────────────┘
		include(get_template_directory() . '/src/views/partials/syllabus-page-title.php'); 
		?>

		<?php
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                                                                         │
		// │                			    GRID                                     │
		// │                                                                         │
		// └─────────────────────────────────────────────────────────────────────────┘
		?>
		<div class="grid grid-cols-6 gap-4">

		<?php

			$terms = get_terms([
				'taxonomy' 	=> 'syllabus_category',
				'parent'    => 0,
			]);
			

			foreach ($terms as $loop_term){

				$term_acf = get_fields('term_'.$loop_term->term_id, 'options');
				if (!$term_acf){ $term_acf = []; }
				$term_permalink = get_term_link($loop_term->term_id);
				$term_favourite_score = $mycred_helpers->total_favourited_by_parent_term($loop_term);

				?>

				<div class="grid-item overflow-hidden inline-block w-full">
					<a class="flex flex-col bg-zinc-800 text-white hover:bg-amber-500 rounded-lg overflow-hidden relative fill-white hover:fill-zinc-900 p-4" href="<?php echo $term_permalink; ?>">
					
						<div class="text-zinc-500 text-base uppercase"><?php echo $loop_term->name; ?></div>
						<div class="text-zinc-300 text-xs font-thin uppercase"><?php echo $loop_term->count; ?> Movement<?php if ($loop_term->count > 1){ echo 's'; } ?></div>

						<?php
							if (array_key_exists('svg_glyph', $term_acf)){
								echo $term_acf["svg_glyph"]; 
							}
						?>

						<?php echo $graphs->bar($term_favourite_score, $loop_term->count); ?>
					</a>
				</div>

			<?php
			}
			
		?>
		</div>
	</div>

</article>
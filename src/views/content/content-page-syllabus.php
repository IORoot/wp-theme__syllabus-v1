<article <?php post_class(); ?>>
		
		<?php
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                                                                         │
		// │                			    GRID                                     │
		// │                                                                         │
		// └─────────────────────────────────────────────────────────────────────────┘
		?>
		<div class="grid grid-cols-5 gap-4 p-4">

		<?php

			$terms = get_terms([
				'taxonomy' 	=> 'syllabus_category',
				'parent'    => 0,
			]);
			

			foreach ($terms as $index => $term_child){

				$term_acf = get_fields('term_'.$term_child->term_id, 'options');
				if (!$term_acf){ $term_acf = []; }
				$term_permalink = get_term_link($term_child->term_id);
				$term_favourite_score = $mycred_helpers->get_personal_tracking_score_taxonomy($term_child);
				// $term_child_count = count(get_term_children($term_child->term_id,'syllabus_category'));
				$term_child_count = 0;

				?>

				<div class="grid-item overflow-hidden inline-block w-full">
					<a class="flex flex-col bg-zinc-800 text-white hover:bg-amber-500 rounded-lg overflow-hidden relative fill-white hover:fill-zinc-900 p-4" href="<?php echo $term_permalink; ?>">
					
						<div class="text-zinc-500 text-base uppercase"><?php echo $term_child->name; ?></div>
						<div class="text-zinc-300 text-xs font-thin uppercase"><?php echo $term_child_count; ?> Movement<?php if ($term_child_count > 1){ echo 's'; } ?></div>

						<?php
							if (array_key_exists('svg_glyph', $term_acf)){
								echo $term_acf["svg_glyph"]; 
							}
						?>

						<?php echo $graphs->bar($term_favourite_score, $term_child->count); ?>
					</a>
				</div>

			<?php
			}
			
		?>
		</div>

</article>
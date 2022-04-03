<article <?php post_class(); ?>>
	<div class="px-8 pt-8">

		
		<?php
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                                                                         │
		// │                			    GRID                                     │
		// │                                                                         │
		// └─────────────────────────────────────────────────────────────────────────┘
		?>
		<div class="category-listing relative">
			
			<div class="grid grid-cols-5 gap-4">

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

					?>

					<div class="grid-item overflow-hidden inline-block w-full">
						<a class="flex flex-col bg-zinc-800 text-white hover:bg-amber-500 rounded-lg overflow-hidden relative fill-white hover:fill-zinc-900 p-4" href="<?php echo $term_permalink; ?>">
						
							<div class="text-zinc-500 text-xs uppercase"><?php echo $term_child->name; ?></div>

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
		</div>


	</div>
</article>
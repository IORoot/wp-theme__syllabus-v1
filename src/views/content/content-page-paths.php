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
		<div class="grid grid-cols-4 gap-4">

		<?php

			foreach ($variables['paths'] as $loop_index => $loop_path){
				// ┌─────────────────────────────────────────────────────────────────────────┐
				// │                			    CARD                                     │
				// └─────────────────────────────────────────────────────────────────────────┘
				include(get_template_directory() . '/src/views/partials/paths-card.php');
			}
			
		?>
		
		</div>
	</div>

</article>
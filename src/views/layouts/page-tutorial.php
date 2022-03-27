<?php

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                Syllabus TUTORIAL Page Layout    		                 │
// │                                                                         │
// │                Page Locations:                                          │
// │                    /syllabus/balancing/mounting/slide-pull-tutorial     │
// │                                                                         │
// │               $variable is a special variable containing many           │
// │               custom data structures. (Acf, Taxonomies, terms, etc.)    │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘

get_header();

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                	        DATA COLLATION                               │
// └─────────────────────────────────────────────────────────────────────────┘
include(get_template_directory() . '/src/views/headers/header-syllabus.php'); 
?>


	<main class="flex flex-row min-h-screen <?php echo get_field('page_classes', $post); ?>">

		<?php 
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                		  SIDEBAR                                        │
		// └─────────────────────────────────────────────────────────────────────────┘
		?>
		<div class="flex flex-col w-1/5 p-2">
			<?php 
			// ┌─────────────────────────────────────────────────────────────────────────┐
			// │                	   SIDEBAR HEADER                                    │
			// └─────────────────────────────────────────────────────────────────────────┘
			include(get_template_directory() . '/src/views/partials/sidebar-header.php'); 
			?>


			<?php 
			// ┌─────────────────────────────────────────────────────────────────────────┐
			// │                    	SIDEBAR MENU                                     │
			// └─────────────────────────────────────────────────────────────────────────┘
			include(get_template_directory() . '/src/views/partials/sidebar-menu.php');
			?>
		</div>

		<?php
		// ┌─────────────────────────────────────────────────────────────────────────┐
		// │                                                                         │
		// │                			Main Content                                 │
		// │                                                                         │
		// └─────────────────────────────────────────────────────────────────────────┘
		?>
		<div class="flex flex-1 flex-col">
			
			<?php 
			// ┌─────────────────────────────────────────────────────────────────────────┐
			// │                		  SEARCHBAR                                      │
			// └─────────────────────────────────────────────────────────────────────────┘
			?>
			<div class="searchbar w-full h-12 bg-zinc-500 flex flex-row p-2 gap-2">
				<?php include(get_template_directory() . '/src/views/partials/searchbar_breadcrumbs.php'); ?>
				<?php include(get_template_directory() . '/src/views/partials/searchbar_ajax_search.php'); ?>
				<?php include(get_template_directory() . '/src/views/partials/searchbar_profile_button.php'); ?>
			</div>



			<?php 
			// ┌─────────────────────────────────────────────────────────────────────────┐
			// │                		  PAGE CONTENT                                   │
			// └─────────────────────────────────────────────────────────────────────────┘
			?>
			<div class="content w-full h-full bg-zinc-600 p-4 flex flex-col gap-4">

				<?php
					// single page
					if (is_single()) {
						include(get_template_directory() . '/src/views/content/content-tutorial.php');
					}
					
					if (is_404()){
						include(get_template_directory() . '/src/views/content/content-404.php');
					}
				?>
			</div>
		</div>

	</main>

<?php
get_footer();

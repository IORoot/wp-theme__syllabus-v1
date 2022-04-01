<?php

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                         Syllabus Single PAGE 	                         │
// │                                                                         │
// │            			Page Location:  /syllabus/               		 │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘

get_header();
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                	        DATA COLLATION                               │
// └─────────────────────────────────────────────────────────────────────────┘
include(get_template_directory() . '/src/views/headers/header-syllabus.php'); 


include(get_template_directory() . '/src/views/menus/mainmenu-'.$pagename.'.php');

?>

	<main class="flex flex-row min-h-screen">

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



			<div class="content w-full h-full bg-zinc-600">

			<?php
				if (have_posts()) {

					while (have_posts()) {

						the_post();

						$post_type = get_post_type();

						include(get_template_directory() . '/src/views/content/content-'.$post_type.'.php');

					}

					the_posts_navigation();
					
				} else {
					include(get_template_directory() . '/src/views/content/content-404.php');

				}
			?>
			</div>
		</div>

	</main>

<?php
get_footer();

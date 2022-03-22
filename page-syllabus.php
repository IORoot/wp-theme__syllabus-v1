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

		<?php echo do_shortcode('[sidebar_menu slug="sidebar_main"]'); ?>

		<div class="flex flex-1 flex-col">
			

			<div class="searchbar w-full h-16 bg-zinc-700">
				<?php include(get_template_directory() . '/src/views/search/searchbar_profile_button.php'); ?>
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

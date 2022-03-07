<?php

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                	 Template for by-location page                       │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘


get_header();

get_template_part('src/views/menus/mainmenu', $pagename);

?>

	<main class="">

		<?php
        if (have_posts()) {

            while (have_posts()) {

				the_post();
				include(get_template_directory() . '/src/views/content/content-by-location.php');
			}

			the_posts_navigation();
			
        } else {
			get_template_part( 'src/views/content/content', '404' );
			include(get_template_directory() . '/src/views/content/content-404.php');
		}
		?>

	</main>

<?php
get_footer();

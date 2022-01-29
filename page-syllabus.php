<?php

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                         Syllabus Single Page 	                         │
// │                                                                         │
// │            			Page Location:  /syllabus/               		 │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘

get_header();

get_template_part('src/views/menus/mainmenu', $pagename);

?>

	<main class="flex flex-row min-h-screen <?php echo $page_classes; ?>">

		<?php echo do_shortcode('[sidebar_menu slug="test_alpha"]'); ?>

		<div class="flex flex-1 flex-col">
			

			<div class="searchbar w-full h-16 bg-zinc-700"></div>
			<div class="content w-full h-full bg-zinc-600">

			<?php
				if (have_posts()) {

					while (have_posts()) {

						the_post();

						$post_type = get_post_type();

						get_template_part('src/views/partials/content', $post_type);

					}

					the_posts_navigation();
					
				} else {

					get_template_part( 'src/views/partials/content', '404' );

				}
			?>
			</div>
		</div>

	</main>

<?php
get_footer();

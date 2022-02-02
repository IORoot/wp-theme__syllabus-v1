<?php

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                Syllabus Generic Generic Page Layout                     │
// │                                                                         │
// │                Page Locations:                                          │
// │                    /syllabus/balancing                                  │
// │                    /syllabus/balancing/mounting                         │
// │                    /syllabus/balancing/mounting/slide-pull              │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘

get_header();
$variables = (new andyp\theme\syllabus\app\all_page_variables)->get_variables();

?>

	<main class="flex flex-row min-h-screen <?php echo $page_classes; ?>">

		<?php echo do_shortcode('[sidebar_menu slug="sidebar_main"]'); ?>

		<div class="flex flex-1 flex-col">
			

			<div class="searchbar w-full h-16 bg-zinc-700"></div>
			<div class="content w-full h-full bg-zinc-600">

			<?php
				// parent term
				if(is_tax() && $variables["current_object"]->parent == 0){
					include(get_template_directory() . '/src/views/isotope/isotope-taxonomy-parent.php');
				}

				// child term
				if (is_tax() && $variables["current_object"]->parent != 0) {
					include(get_template_directory() . '/src/views/isotope/isotope-taxonomy-child.php');
				} 

				if (is_404()){
					get_template_part( 'src/views/content/content', '404' );
				}
			?>
			</div>
		</div>

	</main>

<?php
get_footer();

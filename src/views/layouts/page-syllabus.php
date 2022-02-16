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
// │               $variable is a special variable containing many           │
// │               custom data structures. (Acf, Taxonomies, terms, etc.)    │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘

get_header();
if (is_admin()){ acf_form_head(); } // https://www.advancedcustomfields.com/resources/create-a-front-end-form/

$help = new andyp\theme\syllabus\lib\helpers;
$variables = $help->get_variables();
$access = new andyp\theme\syllabus\lib\access();
?>

	<main class="flex flex-row min-h-screen <?php echo $page_classes; ?>">

		<?php echo do_shortcode('[sidebar_menu slug="sidebar_main"]'); ?>

		<div class="flex flex-1 flex-col">
			

			<div class="searchbar w-full h-16 bg-zinc-700"></div>
			<div class="content w-full h-full bg-zinc-600 p-4 flex flex-col gap-4">

			<?php
				// parent term
				if(is_tax() && $variables["current_object"]->parent == 0){
					include(get_template_directory() . '/src/views/isotope/isotope-taxonomy-parent.php');
				}

				// child term
				if (is_tax() && $variables["current_object"]->parent != 0) {
					include(get_template_directory() . '/src/views/isotope/isotope-taxonomy-child.php');
				}

				// single page
				if (is_single()) {
					include(get_template_directory() . '/src/views/content/content-syllabus.php');
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

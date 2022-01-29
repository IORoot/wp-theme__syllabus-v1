<?php

get_header();

get_template_part('src/views/menus/mainmenu', $pagename);

?>

	<main class="<?php echo $page_classes; ?>">

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

	</main>

<?php
get_footer();

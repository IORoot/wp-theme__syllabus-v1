<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                	 Template for the /login page                        │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘

get_header();

include(get_template_directory() . '/src/views/menus/mainmenu.php');

?>

<main class="min-h-screen">

    <?php
    if (have_posts()) {

        while (have_posts()) {
            the_post();
            $post_type = get_post_type();
            include(get_template_directory() . '/src/views/content/content-memberpress-login.php');
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

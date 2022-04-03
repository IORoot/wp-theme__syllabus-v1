<?php
    /**
     * 
     * Add SVG Logos to Footer.
     * 
     */
    function footer_svgs() {

        echo '<div class="svgs">';

            if (have_rows('svg_instances')) {
                while (have_rows('svg_instances')){
                    the_row();
                    $svg = get_sub_field('svg');
                    echo $svg;
                } 
            }

            include( get_template_directory() . '/src/assets/svgs/h-logo-text.svg' );
            include( get_template_directory() . '/src/assets/svgs/home.svg' );
            include( get_template_directory() . '/src/assets/svgs/shape.svg' );
            include( get_template_directory() . '/src/assets/svgs/trophy-award.svg' );
            include( get_template_directory() . '/src/assets/svgs/text-box-outline.svg' );
            include( get_template_directory() . '/src/assets/svgs/credit-card.svg' );
            include( get_template_directory() . '/src/assets/svgs/chevron-up.svg' );
            include( get_template_directory() . '/src/assets/svgs/chevron-down.svg' );
            include( get_template_directory() . '/src/assets/svgs/map-marker-path.svg' );
            include( get_template_directory() . '/src/assets/svgs/close.svg' );
            include( get_template_directory() . '/src/assets/svgs/right-cli-triangle.svg' );
            include( get_template_directory() . '/src/assets/svgs/star.svg' );
            include( get_template_directory() . '/src/assets/svgs/star-outline.svg' );
        echo '</div>';
    }

    add_action( 'wp_footer', 'footer_svgs', 30 );
?>
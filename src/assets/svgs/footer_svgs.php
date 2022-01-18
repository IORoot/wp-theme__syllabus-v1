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

            include( __DIR__.'/h-logo-text.svg' );
        echo '</div>';
    }

    add_action( 'wp_footer', 'footer_svgs' );
?>
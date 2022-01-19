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
            include( __DIR__.'/home.svg' );
            include( __DIR__.'/shape.svg' );
            include( __DIR__.'/trophy-award.svg' );
            include( __DIR__.'/text-box-outline.svg' );
            include( __DIR__.'/credit-card.svg' );
        echo '</div>';
    }

    add_action( 'wp_footer', 'footer_svgs' );
?>
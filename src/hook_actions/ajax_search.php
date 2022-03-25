<?php

add_action('wp_ajax_data_fetch' ,      'ajax_search_data_fetch');
add_action('wp_ajax_nopriv_data_fetch','ajax_search_data_fetch');  



function ajax_search_data_fetch(){

    $the_query = new WP_Query( [ 
            'posts_per_page' => 8, 
            's'              => esc_attr( $_POST["keyword"] ), 
            'post_type'      => array('syllabus')
        ] 
    );

    if( $the_query->have_posts() ) :
        

        while( $the_query->have_posts() ){
        
            $the_query->the_post(); 
            $acf = get_fields( get_queried_object() );
            $thumbnail = get_the_post_thumbnail( get_queried_object(), null, ['class' => 'w-full h-full']);
            $terms = get_the_terms( $the_query->post ,'syllabus_category');
            ?>
                <a href="<?php echo esc_url( post_permalink() ); ?>" class="rounded-lg bg-zinc-200 flex flex-row gap-2 p-2 flex-1 max-h-28 basis-1/3 hover:bg-amber-500 hover:text-white">

                    <div class="w-40"><?php echo $thumbnail;?></div>
                    <div class="w-full m-auto text-xs flex flex-col ">
                        <?php
                            echo '<div class="text-base"><span class="text-emerald-500">' . $acf["award_level"] . '.</span> ' . $the_query->post->post_title . '</div>';

                            foreach ($terms as $term)
                            {
                                $term_acf = get_fields('term_'.$term->term_id,'options');
                                echo '<div class="ml-1 flex flex-row fill-zinc-600 text-zinc-600">';
                                    echo '<div class="w-5 h-5 mr-1">' . $term_acf['svg_glyph'] . '</div>';
                                    echo $term->name;
                                echo '</div>';
                            }
                        ?>
                    </div>
            
                </a>
                

            <?php 
        }

        wp_reset_postdata();  
    endif;

    die();
}
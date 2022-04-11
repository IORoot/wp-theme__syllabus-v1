<?php

add_action('wp_ajax_syllabus_post' ,      'ajax_syllabus_post');
add_action('wp_ajax_nopriv_syllabus_post','ajax_syllabus_post');  



function ajax_syllabus_post(){

    $the_query = new WP_Query( [ 
            'posts_per_page' => 1, 
            'p'              => esc_attr( $_POST["id"] ), 
            'post_type'      => array('syllabus')
        ] 
    );


    if( ! $the_query->have_posts() ){ die; }
        
    include(get_template_directory() . '/src/lib/variables/post_variables.php');
        
    $syllabus_variables = new andyp\theme\syllabus\lib\variables\post_variables($the_query->post);
    $variables = $syllabus_variables->get_variables();
    
    include(get_template_directory() . '/src/views/content/content-syllabus.php'); 

    wp_reset_postdata();  

    die();
}
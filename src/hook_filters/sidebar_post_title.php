<?php

// The filter callback function.
function add_filmed_status_to_title( $title, $key, $post ) {
    // (maybe) modify $string.
    $filmed = get_field('filmed', $post->ID);

    // Add 'gopro' icon to the right.
    if($filmed == 'Emerald400'){
        return '<span class="text-emerald-200">' . $title . '</span><svg class="w-4 h-4 ml-1 inline-block fill-amber-400" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20,5H15A2,2 0 0,0 13,7V12A2,2 0 0,0 15,14H20A2,2 0 0,0 22,12V7A2,2 0 0,0 20,5M17.5,12.5A3,3 0 0,1 14.5,9.5A3,3 0 0,1 17.5,6.5A3,3 0 0,1 20.5,9.5A3,3 0 0,1 17.5,12.5M17.5,11A1.5,1.5 0 0,1 16,9.5A1.5,1.5 0 0,1 17.5,8A1.5,1.5 0 0,1 19,9.5A1.5,1.5 0 0,1 17.5,11M12,15V5H4A2,2 0 0,0 2,7V17A2,2 0 0,0 4,19H20A2,2 0 0,0 22,17V15H12M10,12H4V7H10V12Z"/></svg>';
    }
    return $title ;
}

add_filter( 'sidebar_post_title', 'add_filmed_status_to_title', 10, 3 );
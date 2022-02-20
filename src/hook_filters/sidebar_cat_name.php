<?php

// The filter callback function.
function add_svg_to_category( $cat_name, $category ) {

    $meta = get_fields($category);
    return '<div class="h-6 w-6 pt-1.5 fill-zinc-300 inline-block mr-1">' . $meta["svg_glyph"] . '</div>' . $cat_name ;
}

add_filter( 'sidebar_cat_name', 'add_svg_to_category', 10, 3 );
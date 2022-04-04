<?php

namespace andyp\theme\syllabus\lib;

use andyp\theme\syllabus\lib\variables\post_variables;
use andyp\theme\syllabus\lib\variables\page_variables;
use andyp\theme\syllabus\lib\variables\taxonomy_variables;

class variables {

    public $variables;

    /**
     * Switch to the post or taxonomy variables.
     */
    public function __construct()
    {
        $queried_object = get_queried_object();

        if (is_a($queried_object,'WP_Post') && $queried_object->post_type != "page"){
            $post_or_tax = new post_variables();
        }

        if (is_a($queried_object,'WP_Post') && $queried_object->post_type == "page"){
            $post_or_tax = new page_variables();
        }

        if (is_a($queried_object,'WP_Term')){
            $post_or_tax = new taxonomy_variables();
        }

        $this->variables = $post_or_tax->get_variables();
        
    }

    /**
     * Return the array of data.
     */
    public function get_variables()
    {
        return $this->variables;
    }

}
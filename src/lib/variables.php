<?php

namespace andyp\theme\syllabus\lib;

use andyp\theme\syllabus\lib\variables\post_variables;
use andyp\theme\syllabus\lib\variables\page_paths_variables;
use andyp\theme\syllabus\lib\variables\page_syllabus_variables;
use andyp\theme\syllabus\lib\variables\taxonomy_variables;

class variables {

    public $variables;

    /**
     * Switch to the post or taxonomy variables.
     */
    public function __construct()
    {
        $queried_object = get_queried_object();

        /**
         * PATH pages and posts
         */
        if ($queried_object->post_name == 'paths' || $queried_object->post_type == "paths")
        {
            $post_or_tax = new page_paths_variables($queried_object);
            $this->variables = $post_or_tax->get_variables();
            return;
        }

        /**
         * Syllabus page
         */
        if ($queried_object->post_name == 'syllabus' && $queried_object->post_type == "page")
        {
            $post_or_tax = new page_syllabus_variables($queried_object);
            $this->variables = $post_or_tax->get_variables();
            return;
        }

        /**
         * All WP_Posts that are non-pages (posts)
         */
        if (is_a($queried_object,'WP_Post') && $queried_object->post_type != "page"){
            $post_or_tax = new post_variables($queried_object);
            $this->variables = $post_or_tax->get_variables();
            return;
        }

        /**
         * All taxonomay pages.
         */
        if (is_a($queried_object,'WP_Term')){
            $post_or_tax = new taxonomy_variables($queried_object);
            $this->variables = $post_or_tax->get_variables();
            return;
        }

        
        
    }

    /**
     * Return the array of data.
     */
    public function get_variables()
    {
        return $this->variables;
    }

}
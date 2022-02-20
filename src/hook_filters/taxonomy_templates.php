<?php

namespace andyp\theme\syllabus\hook_filters;

class taxonomy_templates
{
    public $settings;

    public function __construct($settings = null)
    {
        $this->settings = $settings;

        $this->register_filters();
    }




    public function register_filters()
    {

        /**
         * Post Type Template folder.
         * Location: /
         */
        add_filter('single_template',  [$this, 'register_cpt_template'], 99, 3);

        /**
         * Parent Taxonomy Template
         * Page Location: /syllabus_category/
         */
        add_filter('template_include', [$this, 'parent_taxonomy_template']);

        /**
         * Child Taxonomy Term Template
         * Page Location: /syllabus/swinging/lache/
         */
        add_filter('template_include', [$this, 'taxonomy_term_template']);

    }



    /**
     * single-$post_type.php
     * 
     * This is the template for all the /cpt/my-page/ pages
     * 
     * e.g.
     * /syllabus/step-vault-1-introduction/
     * 
     */
    public function register_cpt_template($template, $type, $templates) {

        global $post;

        $folder = get_template_directory() . '/src/views/layouts/';
    
        /**
         * Return if not correct post type.
         */
        if ( $post->post_type != $this->settings["post_type"] ) {
            return $template;
        }

        /**
         * single-pullups.php
         *      /src/views/layouts/single-$post_name.php
         */
        if ( file_exists( $folder . 'single-' . $post->post_name . '.php'  ) ) {
            return $folder . 'single-' . $post->post_name . '.php';
        }

        /**
         * cpt-syllabus.php
         * 
         *      /src/views/layouts/cpt-$post_type.php
         */
        if ( file_exists( $folder . 'cpt-' . $post->post_type . '.php'  ) ) {
            return $folder . 'cpt-' . $post->post_type . '.php';
        }

        /**
         * cpt.php
         * /src/views/layouts/cpt.php
         */
        if ( file_exists( $folder . 'cpt.php'  ) ) {
            return $folder . 'cpt.php';
        }        
        
        /**
         * GLOBAL
         * 
         * page-syllabus.php
         * /src/views/layouts/cpt.php
         */
        if ( file_exists( $folder . 'page-'.$post->post_type.'.php'  ) ) {
            return $folder . 'page-'.$post->post_type.'.php';
        }

        /**
         * Default templates
         */
        return $template;
    
    }




    /**
     * Defines the location of the parent taxonomy page.
     * e.g.
     * /src/views/layouts/taxonomy-syllabus_category.php
     * 
     * src/
     *  views/
     *      layouts/
     *          taxonomy-$taxonomy.php
     */
    public function parent_taxonomy_template($template) {

        global $wp_query;

        // Check the 'name' key exists in the query.
        if (!array_key_exists('name', $wp_query->query)){
            return $template;
        }

        // check if the post_Type is set.
        if (!array_key_exists('post_type', $wp_query->query)){
            return $template;
        }

        // Check the post_typee is the same.
        if ($wp_query->query["post_type"] != $this->settings["post_type"]){
            return $template;
        }

        // GLOBAL
        // page-syllabus.php
        $global_template = get_template_directory() . '/src/views/layouts/page-'.$this->settings["post_type"].'.php';
        if (file_exists($global_template)) { $template = $global_template; }
        
        // Check is page is equal to the name of the taxonomy.
        if ($wp_query->query["name"] == $this->settings["taxonomy"])
        {
            $new_template = get_template_directory() . '/src/views/layouts/taxonomy-'.$this->settings["taxonomy"].'.php';
            if (file_exists($new_template)) { $template = $new_template; }
        }

        return $template;

    }




    /**
     * Defines the location of the taxonomy terms templates.
     * 
     * Starts with a generic template:
     * /src/views/layouts/taxonomy-syllabus_category-term.php
     * 
     * Also checks for a specific template and overrides if found.
     * /src/views/layouts/term-balancing.php
     * 
     * src/
     *  views/
     *      layouts/
     *          page-$page_type.php
     *          taxonomy-$taxonomy-term.php
     *          term-$term.php
     * 
     */
    public function taxonomy_term_template($template) {

        global $wp_query;

        // Check for the taxonomy as a key
        if (!array_key_exists($this->settings["taxonomy"], $wp_query->query)){
            return $template;
        }

        // Check is page is a taxonomy page
        if (is_tax())
        {
            // GLOBAL
            // page-syllabus.php
            $global_template = get_template_directory() . '/src/views/layouts/page-'.$this->settings["post_type"].'.php';
            if (file_exists($global_template)) { $template = $global_template; }

            // GENERIC
            // syllabus_category-term-template.php
            $new_template = get_template_directory() . '/src/views/layouts/taxonomy-'.$this->settings["taxonomy"].'-term.php';
            if (file_exists($new_template)) { $template = $new_template; }

            // SPECIFIC
            // balancing-template.php
            $term_template = get_template_directory() . '/src/views/layouts/term-'.$wp_query->query["syllabus_category"].'.php';
            if (file_exists($term_template)) { $template = $term_template; }
        }

        return $template;

    }


}
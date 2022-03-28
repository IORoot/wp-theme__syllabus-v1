<?php

namespace andyp\theme\syllabus\lib;

use andyp\theme\syllabus\lib\statics;

class variables {

    public $statics;
    public $variables;

    public function __construct()
    {
        $this->statics = new statics;

        $this->get_current_object();
        $this->get_acf_fields();
        $this->get_child_count();
        $this->get_video_count();
        $this->get_tutorials_count();
        $this->get_roman_numerals();
        $this->get_taxonomies();
        $this->get_thumbnail();
        $this->get_terms();
        $this->get_tags();
        $this->get_terms_extras(); // ACF, Links, etc..
        $this->order_parent_child_terms();
    }



    /**
     * Return the array of data.
     */
    public function get_variables()
    {
        return $this->variables;
    }



    /**
     * Set the roman numeral for the award level.
     *
     * @return void
     */
    private function get_roman_numerals()
    {
        if (!isset($this->variables['acf']['award_level'])){
            return;
        }
        // $statics = ;
        $this->variables['acf']['award_level_roman'] = $this->statics::numberToRoman($this->variables['acf']['award_level']);
    }



    /**
     * Get current queried object
     *
     * @return void
     */
    private function get_current_object()
    {
        $this->variables['current_object'] = get_queried_object();
    }



    /**
     *  Get all ACF Fields
     *
     * @return void
     */
    private function get_acf_fields()
    {
        $this->variables['acf'] = get_fields( get_queried_object() );
    }



    private function get_child_count()
    {
        /**
         * WP_Term
         */
        if (is_a($this->variables['current_object'],'WP_Term')){
            $children = get_term_children( $this->variables['current_object']->term_id, $this->variables['current_object']->taxonomy );
            $this->variables['current_object']->child_count = count($children);
            return;
        }

        /**
         * WP_Post
         */
        // If media hasn't been set.
        if (!isset($this->variables["acf"]["media"])){
            $this->variables['current_object']->video_count = 0;
            return;
        }

        // If media != false
        if (!$this->variables["acf"]["media"])
        {
            $this->variables['current_object']->video_count = 0;
            return;
        }

        // Set media count.
        $this->variables['current_object']->video_count = count($this->variables["acf"]["media"]);

    }


    /**
     * Number of syllabus videos
     *
     * @return void
     */
    private function get_video_count()
    {
        /**
         * WP_Term
         */
        if (is_a($this->variables['current_object'],'WP_Term')){
            return;
        }

        /**
         * WP_Post
         */
        // If media hasn't been set.
        if (!isset($this->variables["acf"]["media"])){
            $this->variables['current_object']->video_count = 0;
            return;
        }

        // If media != false
        if (!$this->variables["acf"]["media"])
        {
            $this->variables['current_object']->video_count = 0;
            return;
        }

        // Set media count.
        $this->variables['current_object']->video_count = count($this->variables["acf"]["media"]);

    }



    /**
     * Number of tutorials videos
     *
     * @return void
     */
    private function get_tutorials_count()
    {
        /**
         * WP_Term
         */
        if (is_a($this->variables['current_object'],'WP_Term')){
            return;
        }

        /**
         * WP_Post
         */
        // If media hasn't been set.
        if (!isset($this->variables["acf"]["tutorials"])){
            $this->variables['current_object']->tutorials_count = 0;
            return;
        }

        // If media != false
        if (!$this->variables["acf"]["tutorials"])
        {
            $this->variables['current_object']->tutorials_count = 0;
            return;
        }

        // Set media count.
        $this->variables['current_object']->tutorials_count = count($this->variables["acf"]["tutorials"]);

    }



    /**
     * Get Taxonomies for the post.
     *
     * @return void
     */
    private function get_taxonomies()
    {
        /**
         * WP_Post
         */
        if (is_a($this->variables['current_object'],'WP_Post')){
            $this->variables['taxonomies'] = get_post_taxonomies($this->variables['current_object']->ID);
        }
    }  



    /**
     * Get the post thumbnail.
     *
     * @return void
     */
    private function get_thumbnail()
    {
        /**
         * WP_Post
         */
        if (is_a($this->variables['current_object'],'WP_Post')){
            $this->variables['thumbnail'] = get_the_post_thumbnail($this->variables['current_object'], null, ['class' => 'w-full h-full']);
        }
    }    
    



    /**
     *  Get Taxonomy Terms.
     *
     * @return void
     */
    private function get_terms()
    {

        $this->variables['terms'] = [];
    
        /**
         * WP_Post
         */
        if (is_a($this->variables['current_object'],'WP_Post')){
            $this->get_post_terms();
        }

        /**
         * WP_Term
         */
        if (is_a($this->variables['current_object'],'WP_Term')){
            $this->get_term_parent();
        }
    
    }


    /**
     * Get the terms associated with a post.
     * 
     * $this->variables['terms']
     *
     * @return void
     */
    private function get_post_terms()
    {
        if (empty($this->variables["taxonomies"])){
            return;
        }

        // get all terms from all taxonomies.
        foreach ($this->variables["taxonomies"] as $loop_taxonomy){

            if (!is_taxonomy_hierarchical($loop_taxonomy)){
                continue;
            }

            // get all terms
            $terms = get_the_terms($this->variables['current_object'], $loop_taxonomy);

            if ($terms){
                // add to variables.
                $this->variables['terms'] = array_merge($this->variables['terms'], $terms);
            }
        }
    }


    /**
     * Get the parent or child term of the current term
     * 
     * @return void
     */
    private function get_term_parent()
    {

        // Skip if already top.
        if ($this->variables['current_object']->parent == 0)
        {
            return;
        }

        // Get the parent term
        $this->variables['terms'][] = get_term($this->variables["current_object"]->parent);
    }


    /**
     * Get the tags associated with a post.
     * 
     * $this->variables['tag']
     *
     * @return void
     */
    private function get_tags()
    {
        if (empty($this->variables["taxonomies"])){
            return;
        }

        $this->variables['tags'] = [];

        // get all terms from all taxonomies.
        foreach ($this->variables["taxonomies"] as $loop_taxonomy){

            if (is_taxonomy_hierarchical($loop_taxonomy)){
                continue;
            }

            // get all terms
            $tags = get_the_terms($this->variables['current_object'], $loop_taxonomy);

            if ($tags){
                // add to variables.
                $this->variables['tags'] = array_merge($this->variables['tags'], $tags);
            }
        }
    }




    /**
     * Get any Term ACF fields
     *
     * @return void
     */
    private function get_terms_extras()
    {
        /**
         * Check there are terms.
         */
        if (empty($this->variables["terms"])){
            return;
        }

        foreach ($this->variables["terms"] as $term_key => $term){

            /**
             * Get ACF for each term.
             */
            $this->variables['terms'][$term_key]->acf = get_fields('term_'.$term->term_id,'options');  
            
            /**
             * Get Links for each term
             */
            $this->variables['terms'][$term_key]->link = get_term_link($term);

            /**
             * Get child count
             */
            $this->variables['terms'][$term_key]->child_count = count (get_term_children( $term->term_id, $term->taxonomy ));
        }
    }
    
    
    /**
     * order_terms will put parent first, child second.
     * 
     * Will also set:
     * $this->variables['terms_parent']
     * $this->variables['terms_child']
     *
     * @return void
     */
    private function order_parent_child_terms()
    {
        // order parents first, children last.
        $ordered = [];
        foreach ($this->variables['terms'] as $loop_terms){

            // Is it a parent term?
            if ($loop_terms->parent == 0){
                $this->variables['terms_parent'] = $loop_terms;
                array_unshift($ordered, $loop_terms);
                continue;
            }

            // Else its a child term.
            $this->variables['terms_child'] = $loop_terms;
            array_push($ordered, $loop_terms);
        }

        $this->variables['terms'] = $ordered;
    }
}
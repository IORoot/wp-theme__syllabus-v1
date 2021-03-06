<?php

namespace andyp\theme\syllabus\lib\variables;

use andyp\theme\syllabus\lib\statics;

class post_variables {

    public $statics;
    public $queried_object;
    public $variables;

    public function __construct($queried_object = null)
    {
        if (empty($queried_object)){ return; }
        $this->queried_object = $queried_object;
        
        $this->statics = new statics;

        $this->get_current_object();
        $this->get_acf_fields();
        $this->get_video_count();
        $this->get_posts_count();
        $this->get_tutorials_count();
        $this->get_roman_numerals();
        $this->get_taxonomies();
        $this->get_thumbnail();
        $this->get_post_terms();
        $this->get_tags();
        $this->get_terms_extras(); // ACF, Links, etc..
        $this->order_parent_child_terms();
        $this->get_breadcrumbs();
        $this->mycred_page_checkbox();
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
        $this->variables['current_object'] = $this->queried_object;
    }



    /**
     *  Get all ACF Fields
     *
     * @return void
     */
    private function get_acf_fields()
    {
        $this->variables['acf'] = get_fields( $this->variables['current_object'] );
    }



    /**
     * Number of syllabus videos
     *
     * @return void
     */
    private function get_video_count()
    {

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


    private function get_posts_count()
    {
        $this->variables['current_object']->total_post_count = wp_count_posts( 'syllabus' )->publish;
    }


    /**
     * Number of tutorials videos
     *
     * @return void
     */
    private function get_tutorials_count()
    {
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

        $this->variables['taxonomies'] = get_post_taxonomies($this->variables['current_object']->ID);

    }  



    /**
     * Get the post thumbnail.
     *
     * @return void
     */
    private function get_thumbnail()
    {
        $this->variables['thumbnail'] = get_the_post_thumbnail($this->variables['current_object'], null, ['class' => 'w-full h-full']);
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

        $this->variables['terms'] = [];

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
    


    /**
     * Setup Breadcrumbs array
     * 
     * Used to create the breadcrumbs at top of the page.
     *
     * @return void
     */
    private function get_breadcrumbs()
    {
        if (is_a($this->variables["current_object"], 'WP_Post')){
            $this->variables['breadcrumbs']['post']['title'] = $this->variables["current_object"]->post_title;
            $this->variables['breadcrumbs']['post']['glyph'] = '<span class="text-emerald-500 mr-1">' . $this->variables["acf"]["award_level_roman"] . '</span>';
            $this->variables['breadcrumbs']['post']['link'] =  '';
        }

        if (isset($this->variables["terms_child"])){
            $this->variables['breadcrumbs']['child_term']['title'] = $this->variables["terms_child"]->name;
            $this->variables['breadcrumbs']['child_term']['glyph'] = $this->variables["terms_child"]->acf["svg_glyph"];
            $this->variables['breadcrumbs']['child_term']['link']  = $this->variables["terms_child"]->link;
        }

        if (isset($this->variables["terms_parent"])){
            $this->variables['breadcrumbs']['parent_term']['title'] = $this->variables["terms_parent"]->name;
            $this->variables['breadcrumbs']['parent_term']['glyph'] = $this->variables["terms_parent"]->acf["svg_glyph"];
            $this->variables['breadcrumbs']['parent_term']['link']  = $this->variables["terms_parent"]->link;
        }

    }



    /**
     * Check whether the 'favourite' has been set
     *
     * @return void
     */
    private function mycred_page_checkbox()
    {
        if (!isset($GLOBALS["mycred"])){ return; }
        if (!isset($GLOBALS["current_user"]->ID)){ return; }
        if (!isset($this->variables['current_object']->ID)){ return; }

        global $wpdb;
        
        $user_ID = $GLOBALS["current_user"]->ID;
        $post_ID = $this->variables['current_object']->ID;
        $sql = 'SELECT SUM(creds) AS creds FROM wp_myCRED_log where user_id = '.$user_ID.' AND ref = '.$post_ID.' AND ctype = \'personal_tracking\'';
        $result = $wpdb->get_results($sql);

        $credits = intval($result[0]->creds);

        if ( empty($credits)){
            $this->variables['mycred']['page_checked'] = false;
        }

        if ( ! empty($credits)){
            $this->variables['mycred']['page_checked'] = true;
        }
    }


}
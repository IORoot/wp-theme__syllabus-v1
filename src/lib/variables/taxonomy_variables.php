<?php

namespace andyp\theme\syllabus\lib\variables;

use andyp\theme\syllabus\lib\statics;

class taxonomy_variables {

    public $statics;
    public $variables;

    public function __construct()
    {
        $this->statics = new statics;

        $this->get_current_object();
        $this->get_acf_fields();
        $this->get_child_count();
        $this->get_posts_count();
        $this->get_roman_numerals();
        $this->get_term_parent();
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
        $children = get_term_children( $this->variables['current_object']->term_id, $this->variables['current_object']->taxonomy );
        $this->variables['current_object']->child_count = count($children);
        return;
        
    }



    private function get_posts_count()
    {
        $this->variables['current_object']->total_post_count = wp_count_posts( 'syllabus' )->publish;
    }


    /**
     * Get the parent term of the current term
     * 
     * @return void
     */
    private function get_term_parent()
    {

        $this->variables['terms'] = [];

        // Skip if already top.
        if ($this->variables['current_object']->parent == 0)
        {
            return;
        }

        // Get the parent term
        $this->variables['terms'][] = get_term($this->variables["current_object"]->parent);
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
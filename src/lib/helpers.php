<?php

namespace andyp\theme\syllabus\lib;

class helpers {

    public $variables;

    public function __construct()
    {
        $this->get_current_object();
        $this->get_acf_fields();
        $this->get_roman_numerals();
        $this->get_taxonomies();
        $this->get_terms();
        $this->get_terms_extras(); // ACF, Links, etc..
        $this->order_terms();
    }

    /**
     * Return the array of data.
     */
    public function get_variables()
    {
        return $this->variables;
    }

    /**
    * Convert integer to roman numerals.
    * 
    * @param int $number
    * @return string
    */
    public static function numberToRoman($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }


    private function get_roman_numerals()
    {
        $this->variables['acf']['award_level_roman'] = $this::numberToRoman($this->variables['acf']['award_level']);
    }


    /**
     * Get current 
     */
    private function get_current_object()
    {
        $this->variables['current_object'] = get_queried_object();
    }

    /**
     * Get all ACF Fields.
     */
    private function get_acf_fields()
    {
        $this->variables['acf'] = get_fields( get_queried_object() );
    }

    /**
     * Get Taxonomies.
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
     * Get Terms.
     */
    private function get_terms()
    {
        $this->variables['terms'] = [];
        /**
         * Check there are taxonomies.
         */
        if (empty($this->variables["taxonomies"])){
            return;
        }
        
        /**
         * WP_Post
         */
        if (!is_a($this->variables['current_object'],'WP_Post')){
            return;
        }

        // get all terms from all taxonomies.
        foreach ($this->variables["taxonomies"] as $loop_taxonomy){

            // get all terms
            $terms = get_the_terms($this->variables['current_object'], $loop_taxonomy);

            // add to variables.
            $this->variables['terms'] = array_merge($this->variables['terms'], $terms);
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
    private function order_terms()
    {
        // order parents first, children last.
        $ordered = [];
        foreach ($this->variables['terms'] as $loop_terms){

            // Is it a parent term?
            if ($loop_terms->parent == 0){
                $this->variables['terms_parent'][] = $loop_terms;
                array_unshift($ordered, $loop_terms);
                continue;
            }

            // Else its a child term.
            $this->variables['terms_child'][] = $loop_terms;
            array_push($ordered, $loop_terms);
        }

        $this->variables['terms'] = $ordered;
    }


    /**
     * Get any Term ACF fields
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
        }
    }
    
    

}
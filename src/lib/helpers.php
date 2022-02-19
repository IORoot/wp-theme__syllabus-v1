<?php

namespace andyp\theme\syllabus\lib;

class helpers {

    public $variables;

    public function __construct()
    {
        $this->get_current_object();
        $this->get_acf_fields();
        $this->get_taxonomies();
        $this->get_terms();
        $this->get_parent_term();
        $this->get_terms_acf();
    }

    /**
     * Return the array of data.
     */
    public function get_variables()
    {
        return $this->variables;
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
        if (is_a($this->variables['current_object'],'WP_Post')){
            
            foreach ($this->variables["taxonomies"] as $taxonomy){
                $terms = get_the_terms($this->variables['current_object'], $taxonomy);
                $this->variables['terms'] = array_merge($this->variables['terms'], $terms); 
            }
        } 
        
    }

    /**
     * Get a parent term.
     */
    private function get_parent_term()
    {
        /**
         * WP_Term
         */
        if (!is_a($this->variables['current_object'],'WP_Term')){
            return;
        }

        /**
         * Has a parent.
         */
        if ($this->variables['current_object']->parent != 0){
            $this->variables['terms']['parent'] = get_term($this->variables['current_object']->parent, $this->variables["current_object"]->taxonomy);
        }
    }


    private function get_terms_acf()
    {
        /**
         * Check there are terms.
         */
        if (empty($this->variables["terms"])){
            return;
        }

        /**
         * Get ACF for each term.
         */
        foreach ($this->variables["terms"] as $term_key => $term){
            $this->variables['terms'][$term_key]->acf = get_fields('term_'.$term->term_id,'options');   
        }
    }
    

    /**
     * Convert integer to roman numerals.
     * 
    * @param int $number
    * @return string
    */
    public function numberToRoman($number) {
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



}
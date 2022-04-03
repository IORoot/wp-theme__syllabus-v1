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
        $this->get_parent_term();
        $this->get_terms();
        $this->get_breadcrumbs();
        $this->get_mycred_personal_tracking_total();
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
    private function get_parent_term()
    {
        // Skip if already top and has no parent.
        if ($this->variables['current_object']->parent == 0) { return; }

        // Get the parent term
        $term = $this->variables['terms_parent'] = get_term($this->variables["current_object"]->parent);
        $this->variables['terms_parent']->acf = get_fields('term_'.$term->term_id,'options');   // Get ACF for each term.
        $this->variables['terms_parent']->link = get_term_link($term); // Get Links for each term
        $this->variables['terms_parent']->child_count = count (get_term_children( $this->variables['terms_parent']->term_id, $this->variables['terms_parent']->taxonomy )); // Get child count
        
    }


    
    /**
     * Get the terms of the current term
     * 
     * @return void
     */
    private function get_terms()
    {

        if (!is_taxonomy_hierarchical($this->variables["current_object"]->taxonomy)){ return; }

        // get all child terms
        $this->variables['terms'] = get_terms( $this->variables["current_object"]->taxonomy, [
            'hide_empty' => 0,
            'parent' => $this->variables["current_object"]->term_id,
        ]);

        foreach ($this->variables['terms'] as $this->loop_term_key => $this->loop_term){
            $this->variables['terms'][$this->loop_term_key]->acf             = get_fields('term_'.$this->loop_term->term_id,'options');   //Get ACF for each term.
            $this->variables['terms'][$this->loop_term_key]->link            = get_term_link($this->loop_term); //Get Links for each term
            $this->variables['terms'][$this->loop_term_key]->child_count     = count(get_term_children( $this->loop_term->term_id, $this->loop_term->taxonomy )); // Get child count
            $this->variables['terms'][$this->loop_term_key]->favourited      = $this->get_mycred_personal_tracking_total($this->loop_term);
        }
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
        if (is_a($this->variables["current_object"], 'WP_Term')){
            $this->variables['breadcrumbs']['term']['title'] =  $this->variables["current_object"]->name;
            $this->variables['breadcrumbs']['term']['glyph'] =  $this->variables["acf"]["svg_glyph"];
            $this->variables['breadcrumbs']['term']['link'] =  '';
        }

        if (!empty($this->variables["terms_parent"])){
            $this->variables['breadcrumbs']['parent_term']['title'] = $this->variables["terms_parent"]->name;
            $this->variables['breadcrumbs']['parent_term']['glyph'] = $this->variables["terms_parent"]->acf["svg_glyph"];
            $this->variables['breadcrumbs']['parent_term']['link']  = $this->variables["terms_parent"]->link;
        }

    }


    /**
     * Undocumented function
     *
     * @param object $term
     * @return void
     */
    public function get_mycred_personal_tracking_total(object $term = null)
    {
        if ( ! defined( 'myCRED_VERSION' ) ) { return; }

        if (! isset($term)){ $term = $this->variables['current_object']; }

        $posts_array = get_posts([
            'posts_per_page' => -1,
            'post_type' => 'syllabus',
            'tax_query' => [
                [
                    'taxonomy' => $term->taxonomy,
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                ]
            ]
        ]);

        $results = 0;
        foreach ($posts_array as $post)
        {
            $query = new \myCRED_Query_Log( [
                'ctype'   => 'personal_tracking',
                'user_id' => $GLOBALS["current_user"]->ID,
                'ref'     => $post->ID,
                'number'  => 1,
            ] );

            if (empty($query->results)){  continue; }

            $results++;
        }

        if ($term === $this->variables['current_object']){ 
            $this->variables['mycred']['taxonomy_personal_tracking_total'] = $results;
            return;
        }

        return $results;
        
    }
}
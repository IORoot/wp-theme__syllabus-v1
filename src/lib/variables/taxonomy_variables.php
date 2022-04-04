<?php

namespace andyp\theme\syllabus\lib\variables;

use andyp\theme\syllabus\lib\statics;

class taxonomy_variables {

    public $statics;
    public $variables;

    public $term_ids_array;

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
        $this->get_terms_mycred_favourited_totals();
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
            $this->variables['terms'][$this->loop_term_key]->child_ids       = get_posts([ 
                                                                                    'posts_per_page' => -1,
                                                                                    'post_type' => 'syllabus', 
                                                                                    'tax_query' => [ 
                                                                                        [ 
                                                                                            'taxonomy' => $this->loop_term->taxonomy, 
                                                                                            'field' => 'term_id', 
                                                                                            'terms' => $this->loop_term->term_id, 
                                                                                        ] 
                                                                                    ], 
                                                                                    'fields' => 'ids' 
                                                                                ]); // get all child_ids for term.
        }
    }

    
    /**
     * Much quicker version of getting all the mycred favourites values.
     * 
     * Gets all of the syllabus posts in this term that have been
     * favourited. Also sets the count too.
     *
     * @return void
     */
    private function get_terms_mycred_favourited_totals()
    {
        if ( ! defined( 'myCRED_VERSION' ) ) { return; }

        global $wpdb;
        $user_ID = $GLOBALS["current_user"]->ID;

        foreach ($this->variables['terms'] as $this->loop_term_key => $this->loop_term){
            $post_IDS = implode(',', $this->loop_term->child_ids);
            $sql = 'SELECT ref, SUM(creds) AS credits FROM wp_myCRED_log WHERE ref IN ('.$post_IDS.') AND user_id = '.$user_ID.' AND ctype = \'personal_tracking\' GROUP BY ref HAVING credits = 1';
            $results = $wpdb->get_results($sql);

            if (! empty($results)){
                $this->variables['terms'][$this->loop_term_key]->favourited = $results;
                $this->variables['terms'][$this->loop_term_key]->favourited_count = count($results);
            }
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
     * Finds the total number of mycred favourited posts within this term.
     *
     * @param object $term
     * @return void
     */
    public function get_mycred_personal_tracking_total()
    {
        if ( ! defined( 'myCRED_VERSION' ) ) { return; }

        $posts_array = get_posts([
            'posts_per_page' => -1,
            'post_type' => 'syllabus',
            'tax_query' => [
                [
                    'taxonomy' => $this->variables['current_object']->taxonomy,
                    'field' => 'term_id',
                    'terms' => $this->variables['current_object']->term_id,
                ]
            ],
            'fields' => 'ids',
        ]);
        

        $post_list = implode(',', $posts_array);

        global $wpdb;
        $user_ID = $GLOBALS["current_user"]->ID;
        $sql = 'SELECT ref, SUM(creds) AS credits FROM wp_myCRED_log WHERE ref IN ('.$post_list.') AND user_id = '.$user_ID.' AND ctype = \'personal_tracking\' GROUP BY ref HAVING credits = 1';
        $wpdb->get_results($sql);

        $this->variables['mycred']['taxonomy_personal_tracking_total'] = $wpdb->num_rows;
        return;
        
    }
}
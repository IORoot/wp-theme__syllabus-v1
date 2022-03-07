<?php

/**
 * Return the count of how many results in taxonomy / post type.
 * 
 * # Show count of posts in post type
 * [counts 
 *      post_type="posts"
 * ]
 * 
 * # Show count of all terms in taxonomy
 * [counts 
 *      taxonomy="syllabus_category"
 * ]
 * 
 *  
 * # Show count of top-level terms in taxonomy
 * [counts 
 *      taxonomy="syllabus_category"
 *      parents="true"
 * ]
 * 
 * 
 * # Show count of all child terms (without top-level) in taxonomy
 * [counts 
 *      taxonomy="syllabus_category"
 *      parents="false"
 * ]
 */
class counts {

    public $count_terms_all;
    public $count_terms_parents;
    public $count_terms_children;

    public $result;

    public $query_type;


    /**
     * Define the shortcode
     */
    public function __construct()
    {
        add_shortcode( 'counts', [$this,'run'] );
    }


    /**
     * Kick the code off
     */
    public function run($atts = array(), $content = null)
    {
        if ($atts) {
            $this->attributes = $atts;
        }
        if ($content) {
            $this->content = $content;
        }

        $this->set_query_type();
        // echo $this->result;
        return $this->result;
    }


    /**
     * What request type is it? Taxonomy or post?
     */
    public function set_query_type()
    {
        if (array_key_exists('taxonomy', $this->attributes))
        {
            $this->run_tax_query();
            $this->get_term_result();
        }

        if (array_key_exists('post_type', $this->attributes))
        {
            $this->run_post_query();
        }
    }



    /**
     * Get the counts for the taxonomy.
     */
    public function run_tax_query()
    {

        // Get parent count.
        $this->count_terms_parents = wp_count_terms([
            'taxonomy'   => $this->attributes["taxonomy"],
            'count'      => true,
            'hide_empty' => false,
            'parent'     => 0,
        ]);
        if (!is_string($this->count_terms_parents)){ return; }

        // Get ALL count
        $this->count_terms_all = wp_count_terms([
            'taxonomy'   => $this->attributes["taxonomy"],
            'count'      => true,
            'hide_empty' => false,
        ]);
        if (!is_string($this->count_terms_all)){ return; }

        // Get Children.
        $this->count_terms_children = intval($this->count_terms_all) -  intval($this->count_terms_parents);

    }


    /**
     * Return the value we are requesting
     * All terms
     * Parent terms
     * or Child terms
     */
    public function get_term_result()
    {
        if (!array_key_exists('parents', $this->attributes))
        {
            $this->result =  $this->count_terms_all;
            return;
        }

        if ($this->attributes['parents'] == 'true')
        {
            $this->result =  $this->count_terms_parents;
            return;
        }

        $this->result = $this->count_terms_children;
    }

    /**
     * Get number of posts in Custom Post Type.
     */
    public function run_post_query()
    {
        $this->result = wp_count_posts( $this->attributes["post_type"] )->publish;
    }

}

new counts;
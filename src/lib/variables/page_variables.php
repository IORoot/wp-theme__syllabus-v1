<?php

namespace andyp\theme\syllabus\lib\variables;

use andyp\theme\syllabus\lib\statics;

class page_variables {

    public $statics;
    public $variables;

    public function __construct()
    {
        $this->statics = new statics;

        $this->get_current_object();
        $this->get_acf_fields();
        $this->get_posts_count();
        $this->get_tutorials_count();
        $this->get_breadcrumbs();
    }



    /**
     * Return the array of data.
     */
    public function get_variables()
    {
        return $this->variables;
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


}
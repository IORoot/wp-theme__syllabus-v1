<?php

namespace andyp\theme\syllabus\lib\variables;

use andyp\theme\syllabus\lib\statics;
use andyp\theme\syllabus\lib\mycred_helpers;

class page_syllabus_variables {

    public $statics;
    public $queried_object;
    public $variables;

    public function __construct($queried_object = null)
    {
        if (empty($queried_object)){ return; }
        $this->queried_object = $queried_object;

        $this->statics = new statics;
        $this->mycred  = new mycred_helpers;

        $this->get_current_object();
        $this->get_acf_fields();
        $this->get_posts_count();
        $this->get_tutorials_count();
        $this->get_breadcrumbs();
        $this->get_mycred_total_favourited();
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



    /**
     * Custom SQL to  get all the favourited posts from user ID.
     *
     * @return void
     */
    private function get_mycred_total_favourited()
    {
        /**
         * Query for all posts that are favourited for user.
         */
        global $wpdb;
        $sql = 'SELECT ref AS post_id, SUM(creds) AS credits 
            FROM wp_myCRED_log 
            WHERE user_id = '.$GLOBALS["current_user"]->ID.' AND ctype = \'personal_tracking\' 
            GROUP BY ref 
            HAVING credits = 1';
        $favourited_posts_list = $wpdb->get_results($sql);
        $this->variables['mycred']['favourited_posts'] = array_column($favourited_posts_list, 'post_id');
        $this->variables['mycred']['favourited_posts_count'] = count($this->variables['mycred']['favourited_posts']);
    }



    private function get_all_paths()
    {
        $this->variables['paths'] = get_posts([
            'posts_per_page' => -1,
            'post_type' => 'paths'
        ]);
    }


}
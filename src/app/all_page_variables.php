<?php

namespace andyp\theme\syllabus\app;

class all_page_variables {

    public $variables;

    public function __construct()
    {
        $this->get_current_object();
        $this->get_acf_fields();
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
        $this->variables['acf_fields'] = get_fields( $this->variables['current_object'] );
    }



}
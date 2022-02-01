<?php

namespace andyp\theme\syllabus\app;

class all_page_variables {

    public $variables;

    public function __construct()
    {
        $this->get_current_object();
        $this->get_page_builder_fields();
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
    private function get_page_builder_fields()
    {
        $this->variables['page_builder'] = get_fields( $this->variables['current_object'] );
    }

    /**
     * Get all ACF Fields.
     */
    private function get_acf_fields()
    {
        $this->variables['page_builder'] = get_fields( $this->variables['current_object'] );
    }



}
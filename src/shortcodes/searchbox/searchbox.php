<?php

/**
 * AJAX Based seach box.
 */
class searchbox {

    public $content;
    public $attributes;

    /**
     * Define the shortcode
     */
    public function __construct()
    {
        add_shortcode( 'searchbox', [$this,'run'] );
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

        $this->render_html();

        return $this->result;
    }


    public function render_html()
    {
        $out = '<div class="search_bar">';
        $out .= '    <form action="/" method="get" autocomplete="off">';
        $out .= '        <input type="text" name="s" placeholder="Search Code..." id="keyword" class="input_search" onkeyup="fetch()">';
        $out .= '        <button>';
        $out .= '            Search';
        $out .= '        </button>';
        $out .= '    </form>';
        $out .= '    <div class="search_result" id="datafetch">';
        $out .= '        <ul>';
        $out .= '            <li>Please wait..</li>';
        $out .= '        </ul>';
        $out .= '    </div>';
        $out .= '</div>';

        $this->result = $out;
    }
}

new searchbox;
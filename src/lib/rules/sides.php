<?php

namespace andyp\theme\syllabus\lib\rules;

use andyp\theme\syllabus\lib\rules\rulesInterface;

class sides implements rulesInterface {

    private $config;

    private $output;

    public function set_config($config){
        $this->config = $config;
    }

    public function get_output(){
        $this->remove_acf_fc_layout();
        $this->build();
        return $this->output;
    }

    private function remove_acf_fc_layout()
    {
        unset($this->config["acf_fc_layout"]);
    }

    private function build(){
        $this->output .= $this->svg();
        $this->output .= $this->sides();
        $this->output .= $this->description();
    }

    private function sides(){
        return __FUNCTION__ . ' : ' . $this->config[__FUNCTION__];
    }

    private function description(){
        return __FUNCTION__ . ' : ' . $this->config[__FUNCTION__];
    }

    private function svg(){
        return '<div class="w-10 h-10 fill-amber-500">' . $this->config[__FUNCTION__] . '</div>';
    }

}

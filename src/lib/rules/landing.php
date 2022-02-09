<?php

namespace andyp\theme\syllabus\lib\rules;

use andyp\theme\syllabus\lib\rules\rulesInterface;

class landing implements rulesInterface {

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
        $this->output .= $this->landing();
        $this->output .= $this->momentum();
        $this->output .= $this->description();
    }

    private function landing(){
        return __FUNCTION__ . ' : ' . $this->config[__FUNCTION__];
    }

    private function momentum(){
        return __FUNCTION__ . ' : ' . $this->config[__FUNCTION__];
    }

    private function description(){
        return __FUNCTION__ . ' : ' . $this->config[__FUNCTION__];
    }

    private function svg(){
        return __FUNCTION__ . ' : ' . $this->config[__FUNCTION__];
    }

}

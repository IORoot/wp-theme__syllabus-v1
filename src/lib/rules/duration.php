<?php

namespace andyp\theme\syllabus\lib\rules;

use andyp\theme\syllabus\lib\rules\rulesInterface;

class duration implements rulesInterface {

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
        $this->output .= $this->duration();
        $this->output .= $this->more_or_less();
        $this->output .= $this->description();
    }

    private function duration(){
        return __FUNCTION__ . ' : ' . $this->config[__FUNCTION__];
    }

    private function more_or_less(){
        return __FUNCTION__ . ' : ' . $this->config[__FUNCTION__];
    }

    private function description(){
        return __FUNCTION__ . ' : ' . $this->config[__FUNCTION__];
    }

    private function svg(){
        return __FUNCTION__ . ' : ' . $this->config[__FUNCTION__];
    }

}

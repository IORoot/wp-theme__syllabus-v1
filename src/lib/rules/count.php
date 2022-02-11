<?php

namespace andyp\theme\syllabus\lib\rules;

use andyp\theme\syllabus\lib\rules\rulesInterface;

class count implements rulesInterface {

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
        $this->output .= '<div class="flex flex-col gap-4 font-thin w-full">';
        $this->output .= $this->count();
        $this->output .= $this->more_or_less();
        $this->output .= $this->description();
        $this->output .= '</div>';
    }

    private function count(){
        $out = '<h5 class="capitalize text-2xl">'.__FUNCTION__.' Rule.</h5>';
            $out .= '<div class ="w-full font-light">';
                $out .= 'The '.__FUNCTION__.' must be up to <span class="text-emerald-500 font-medium">'. $this->config[__FUNCTION__] . '</span> ';
            $out .= '</div>';
        return $out;
    }

    private function more_or_less(){
        $out = '<div class="flex flex-row gap-4">';
            $out .= '<div class="w-1/4 text-amber-100">';
                $out .= '+ / -';
            $out .= '</div>';

            $out .= '<div class ="w-3/4">';
                $out .= 'The count can be '.$this->config[__FUNCTION__].' than specified.';
            $out .= '</div>';
        $out .= '</div>';
        return $out;    }

    private function description(){
        $out = '<div class="flex flex-row gap-4">';
            $out .= '<div class="w-1/4 text-amber-100">';
                $out .= 'Details';
            $out .= '</div>';

            $out .= '<div class ="w-3/4">';
                $out .= $this->config[__FUNCTION__];
            $out .= '</div>';
        $out .= '</div>';
        return $out;    }

    private function svg(){
        return '<div class="w-12 h-12 fill-amber-500">' . $this->config[__FUNCTION__] . '</div>';
    }

}

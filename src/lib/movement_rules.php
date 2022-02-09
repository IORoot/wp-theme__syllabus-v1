<?php

namespace andyp\theme\syllabus\lib;

use andyp\theme\syllabus\lib\rules\distance;

class movement_rules {

    public $rules;
    public $rule;
    public $output;

    public function set_rules($rules)
    {
        $this->rules = $rules;
    }

    public function get_html()
    {
        $this->loop_rules();
        return $this->output;
    }

    private function loop_rules()
    {
        foreach ($this->rules as $this->rule){
            $this->process_rule();
        }
    }

    private function process_rule()
    {
        $type = $this->rule["acf_fc_layout"];
        $class = "\\andyp\\theme\\syllabus\\lib\\rules\\".$type;
        $rule = new $class;

        $rule->set_config($this->rule);
        $this->output .= $rule->get_output();
    }

}
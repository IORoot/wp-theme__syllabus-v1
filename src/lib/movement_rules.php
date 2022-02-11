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
            $this->rule_wrapper_open();
            $this->process_rule();
            $this->rule_wrapper_close();
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

    private function rule_wrapper_open(){
        $this->output .= '<div class="bg-zinc-800 p-4 rounded-xl flex flex-row gap-4 w-full">';
    }

    private function rule_wrapper_close(){
        $this->output .= '</div>';
    }

}
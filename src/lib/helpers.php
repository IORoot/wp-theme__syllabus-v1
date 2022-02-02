<?php

namespace andyp\theme\syllabus\lib;

class helpers {

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
        $this->variables['acf'] = get_fields( get_queried_object() );
    }
    

    /**
    * @param int $number
    * @return string
    */
    public function numberToRoman($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }



}
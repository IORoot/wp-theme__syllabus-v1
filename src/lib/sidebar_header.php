<?php

namespace andyp\theme\syllabus\lib;

class sidebar_header {

    public $output = [];

    private $variables;


    public function __construct($variables)
    {
        $this->variables = $variables;
    }

    public function output()
    {
        $this->open_wrapper();
            $this->svg_thumbnail();
            $this->page_info();
        $this->close_wrapper();
        $this->post_modal();
        return implode('', $this->output);
    }

    public function open_wrapper()
    {
        $this->output[] = '<div class="flex flex-row p-2 gap-4 w-full bg-zinc-100 rounded-xl ">';
    }

    public function close_wrapper()
    {
        $this->output[] = '</div>';
    }

    public function svg_thumbnail()
    {
        $this->output[] = '<a href="#open-thumbnail-modal" class="block w-2/5 bg-white hover:bg-emerald-400 rounded-xl p-2">';
            $this->output[] = get_the_post_thumbnail();
        $this->output[] = '</a>';
    }

    public function page_info()
    {
        $this->output[] = '<div class="w-3/5 flex flex-col justify-center">';
            $this->page_title();
            $this->page_terms();
        $this->output[] = '</div>';
    }

    public function post_modal()    
    {
        $this->output[] = '<div data-modal id="open-thumbnail-modal" class="group z-50 fixed inset-0 items-center justify-center target:flex opacity-0 target:opacity-100 invisible target:visible transition-opacity" >';
            $this->output[] = '<div data-modal-dialog tabindex="-1" class="z-50 w-4/5 max-w-screen-sm p-4 rounded-xl bg-zinc-100 opacity-0 group-target:opacity-100">';

                $this->output[] = '<h3 class="text-xl mb-4">';
                    $this->page_title();
                $this->output[] = '</h3>';
                $this->page_terms();

                $this->output[] = '<p>';
                    $this->output[] = get_the_post_thumbnail(null, null, ['class' => 'w-full h-full']);
                $this->output[] = '</p>';

                $this->output[] = '<a href="#" class="absolute top-1 right-1">';
                    $this->output[] = '<svg class="w-6 h-6"><use xlink:href="#close"</use></svg>';
                $this->output[] = '</a>';

            $this->output[] = '</div>';

            $this->output[] = ' <a href="#" tabindex="-1" class="fixed inset-0 bg-zinc-900 opacity-70"></a>';
            
        $this->output[] = '</div>';
    }


    private function page_title()
    {   
        $this->output[] = '<div>';
            $this->output[] = '<span class="text-emerald-500">';
                $this->output[] = $this->numberToRoman($this->variables["acf"]["award_level"]) . '. ';
            $this->output[] = '</span>';
            $this->output[] = get_the_title();
        $this->output[] = '</div>';
    }

    
    private function page_terms()
    {
        foreach ($this->variables["terms"] as $this->loop_term){
            $this->term_link();
        }
    }

    private function term_link()
    {
        $link  = get_term_link($this->loop_term);
        $name  = $this->loop_term->name;
        $glyph = $this->loop_term->acf["svg_glyph"];

        $this->output[] = '<a href="' .$link .'" class="rounded-xl fill-zinc-500 text-zinc-500 bg-zinc-100 inline-flex flex-row mr-auto items-center pl-1 pr-2 hover:bg-zinc-900 hover:fill-emerald-400 hover:text-emerald-400">';
            $this->output[] = '<div class="h-4 w-4 inline-block">' . $glyph . '</div>';
            $this->output[] = '<div class="text-sm">';
                $this->output[] = $name;
            $this->output[] = '</div>';
        $this->output[] = '</a>';
    }

        /**
     * Convert integer to roman numerals.
     * 
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
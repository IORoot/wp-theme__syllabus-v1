<?php

namespace andyp\theme\syllabus\lib;

class sidebar_term_header {

    public $output = [];

    private $terms;

    /**
     * Sets the array of taxonomy terms
     *
     * @param array $terms
     * @return void
     */
    public function set_terms($terms)
    {
        $this->terms = $terms;
    }



    /**
     * Run the functions in order
     *
     * @return void
     */
    public function output()
    {
        $this->open_wrapper();
            $this->open_flex_row();
                $this->svg_thumbnail();
                $this->page_info();
            $this->close_flex_row();
            $this->open_flex_row();
                $this->page_terms();
            $this->close_flex_row();
        $this->close_wrapper();
        $this->post_modal();
        return implode('', $this->output);
    }



    /**
     * Open the outer wrapper
     *
     * @return void
     */
    public function open_wrapper()
    {
        $this->output[] = '<div class="flex flex-col p-2 w-full bg-zinc-100 rounded-xl gap-2">';
    }



    /**
     * Close the outer wrapper
    *
    * @return void
    */
    public function close_wrapper()
    {
        $this->output[] = '</div>';
    }



    /**
     * Create a new flex-row
     *
     * @return void
     */
    public function open_flex_row()
    {
        $this->output[] = '<div class="flex flex-row">';
    }



    /**
     * Close a flex row.
     *
     * @return void
     */
    public function close_flex_row()
    {
        $this->output[] = '</div>';
    }



    /**
     * Output the SVG Thumbnail
     *
     * @return void
     */
    public function svg_thumbnail()
    {
        $this->output[] = '<a href="#open-thumbnail-modal" class="block w-2/5 bg-white hover:bg-emerald-400 rounded-xl p-2">';
            $this->output[] = get_the_post_thumbnail();
        $this->output[] = '</a>';
    }



    /**
     * Wrapper around the title and terms
     *
     * @return void
     */
    public function page_info()
    {
        $this->output[] = '<div class="w-3/5 flex flex-col justify-center">';
            $this->page_title();
        $this->output[] = '</div>';
    }



    /**
     * Create a modal for the post image
     *
     * @return void
     */
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
                    $this->output[] = '<svg class="w-6 h-6"><use xlink:href="#close"></use></svg>';
                $this->output[] = '</a>';

            $this->output[] = '</div>';

            $this->output[] = ' <a href="#" tabindex="-1" class="fixed inset-0 bg-zinc-900 opacity-70"></a>';
            
        $this->output[] = '</div>';
    }


/**
 * Output the title of the page.
 *
 * @return void
 */
    private function page_title()
    {   
        $this->output[] = '<div class="m-4">';
            $this->output[] = get_the_title();
        $this->output[] = '</div>';
    }



    /**
     * Loop each page terms
     * 
     * Loop all terms and output in order.
     *
     * @return void
     */
    private function page_terms()
    {
        foreach ($this->terms as $this->loop_term){
            if ($this->loop_term->parent == 0){
                $this->parent_term = $this->loop_term;
            }            
            if ($this->loop_term->parent != 0){
                $this->child_term = $this->loop_term;
            }
        }
        $this->term_link($this->parent_term, 400, 100);
        $this->term_link($this->child_term, 300, 400);
    }



    /**
      * Create a term link.
      * 
      * Output the term as a link with a name and SVG glyph
      *
      * @param object $term
      * @param int    $bg
      * @return void
      */
    private function term_link(object $term, int $greytone, int $background)
    {
        $link  = get_term_link($term);
        $name  = $term->name;
        $glyph = $term->acf["svg_glyph"];

        $this->output[] = '<div class="bg-zinc-'.$background.'">';

            $this->output[] = '<a href="' .$link .'" class="fill-black text-black bg-zinc-'.$greytone.' flex flex-row hover:fill-emerald-400 hover:text-emerald-400">';

                $this->output[] = '<svg class="svg-inherit h-5 fill-zinc-'.$background.'" viewBox="0 0 12 24" xmlns="http://www.w3.org/2000/svg"><path d="M0 24V0L12 12L0 24Z"/></svg>';

                $this->output[] = '<div class="flex flex-row pr-2">';

                    $this->output[] = '<div class="h-5 w-5 inline">';
                        $this->output[] = $glyph ;
                    $this->output[] = '</div>';

                    $this->output[] = '<div class="text-sm">';
                        $this->output[] = $name;
                    $this->output[] = '</div>';

                $this->output[] = '</div>';

                
            $this->output[] = '</a>';

        $this->output[] = '</div>';
    }
}
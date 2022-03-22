<?php

namespace andyp\theme\syllabus\lib;

class sidebar_post_header {

    public $output = [];

    private $awardlevel;
    private $title;
    private $image;
    private $parent_term;
    private $child_term;



    /**
     * Sets the award level of current page
     *
     * @param string $awardlevel
     * @return void
     */
    public function set_awardlevel(string $awardlevel)
    {
        $this->awardlevel = $awardlevel;
    }


    
    /**
     * Set the title
     *
     * @param string $title
     * @return void
     */
    public function set_title(string $title)
    {
        $this->title = $title;
    }


    /**
     * Set the SVG image
     *
     * @param string $image
     * @return void
     */
    public function set_image(string $image)
    {
        $this->image = $image;
    }    


    /**
     * Set the parent term
     *
     * @param array $terms
     * @return void
     */
    public function set_parent_term($parent_term)
    {
        $this->parent_term = $parent_term;
    }    
    

    /**
     * Set the child term
     *
     * @param [type] $child_term
     * @return void
     */
    public function set_child_term($child_term)
    {
        $this->child_term =  $child_term;
    }



    /**
     * Run the functions in order
     *
     * @return void
     */
    public function output()
    {
        ob_start();
        $this->open_wrapper();
            $this->svg_thumbnail();
            $this->open_column();

                $this->title();

                $this->open_row();
                    $this->term_link_child();

                    $this->term_link_parent();
                    
                $this->close_row();

            $this->close_column();
        $this->close_wrapper();
        $this->post_modal();

        $this->output = ob_get_contents();
        ob_end_clean();

        return $this->output;
    }



    /**
     * Open the outer wrapper
     *
     * @return void
     */
    public function open_wrapper()
    {
        ?><div class="flex flex-row p-2 w-full bg-zinc-100 rounded-xl gap-4"><?php
    }




    /**
     * Close the outer wrapper
    *
    * @return void
    */
    public function close_wrapper()
    {
        ?></div><?php
    }



    /**
     * Open the column
     *
     * @return void
     */
    public function open_column()
    {
        ?><div class="flex flex-col w-full justify-center"><?php
    }



    /**
     * Close the column
    *
    * @return void
    */
    public function close_column()
    {
        ?></div><?php
    }




    /**
     * Open the row
     *
     * @return void
     */
    public function open_row()
    {
        ?><div class="flex flex-col w-full"><?php
    }


    /**
     * Close the outer row
    *
    * @return void
    */
    public function close_row()
    {
        ?></div><?php
    }

    /**
     * Output the SVG Thumbnail
     *
     * @return void
     */
    public function svg_thumbnail()
    {
        ?>
        <a href="#open-thumbnail-modal" class="block w-2/5 bg-white hover:bg-emerald-400 rounded-xl p-2">
            <?php echo $this->image; ?>
        </a>
        <?php
    }



/**
 * Output the title of the page.
 *
 * @return void
 */
    private function title()
    {   
        ?>
        <div class="font-thin text-lg text-black">
            <?php $this->award_level(); ?>
            <?php echo $this->title; ?>
        </div>
        <?php
    }


    private function award_level()
    {
        if (isset($this->awardlevel)){
            ?>
            <span class="text-emerald-500">
                <?php echo $this->awardlevel . '. '; ?>
            </span>
            <?php
        }

    }

    private function term_link_parent()
    {
        if (!isset($this->parent_term)){
            return;
        }
        $this->term_link($this->parent_term, 'zinc-500', '8');
    }

    private function term_link_child()
    {
        if (!isset($this->child_term)){
            return;
        }
        $this->term_link($this->child_term, 'zinc-500', '3');
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
    private function term_link(object $term, string $colour, string $paddingleft)
    {
        ?>
            <a href="<?php echo $term->link ?>" class="fill-<?php echo $colour; ?> text-<?php echo $colour; ?> pl-<?php echo $paddingleft; ?> mb-1 font-thin text-xs uppercase flex flex-row hover:fill-emerald-400 hover:text-emerald-400">
                <div class="flex flex-row pr-2">
                    <div class="h-4 w-4"> <?php echo $term->acf["svg_glyph"] ; ?></div>
                    <div> <?php echo $term->name; ?> </div>
                </div>

            </a>
        <?php
    }




    /**
     * Create a modal for the post image
     *
     * @return void
     */
    public function post_modal()    
    {
        ?>
        <div data-modal id="open-thumbnail-modal" class="group z-50 fixed inset-0 items-center justify-center target:flex opacity-0 target:opacity-100 invisible target:visible transition-opacity" >
            <div data-modal-dialog tabindex="-1" class="z-50 w-4/5 max-w-screen-sm p-4 rounded-xl bg-zinc-100 opacity-0 group-target:opacity-100">

                <h3 class="text-xl mb-4"><?php $this->title(); ?> </h3>

                <?php 
                    $this->term_link_parent();
                    $this->term_link_child();
                ?>

                <p> <?php echo $this->image; ?> </p>

                <a href="#" class="absolute top-1 right-1">
                    <svg class="w-6 h-6"><use xlink:href="#close"></use></svg>
                </a>

            </div>

            <a href="#" tabindex="-1" class="fixed inset-0 bg-zinc-900 opacity-70"></a>
            
        </div>

        <?php
    }

}
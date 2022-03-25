<?php

namespace andyp\theme\syllabus\lib;

class breadcrumbs {


    public $variables;

    public $output;


    /**
     * Set all variables.
     *
     * @param array $variables      
     * @return void
     */
    public function set_variables(array $variables)
    {
        $this->variables = $variables;
    }



    /**
     * Run the functions in order
     *
     * @return void
     */
    public function output()
    {
        ob_start();
            $this->style();
            ?><ul class="flex list-none text-white font-thin"><?php

                $this->syllabus();
                $this->parent();
                $this->child();
                $this->post_title();
                $this->term_title();

            ?></ul><?php

        $this->output = ob_get_contents();
        ob_end_clean();

        return $this->output;
    }



    public function style()
    {
        ?>
        <style>

            .chip:after {
                content: " ";
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 1rem 0 1rem 1.25rem;    
                border-color: transparent transparent transparent black;  
                position: absolute;
                top: 0;
                left: 100%;
                z-index:1;
            }

            .chip-syllabus:hover:after,
            .chip-parent:hover:after,
            .chip-child:hover:after {
                border-color: transparent transparent transparent #10b981 !important;
            }

            .chip-syllabus:after {
                border-color: transparent transparent transparent rgb(245 158 11);
            }

            .chip-parent:after {
                border-color: transparent transparent transparent #18181b;
            }

            .chip-child:after {
                border-color: transparent transparent transparent #27272a;
            }

            .chip-title:after {
                border-color: transparent transparent transparent #3f3f46;
            }


        </style>
    <?php
    }


    public function syllabus()
    {
        ?>
            <li>
                <a href="/syllabus" class="chip chip-syllabus rounded-l inline-block relative bg-amber-500 hover:bg-emerald-500 p-1.5">
                    <svg role="img" aria-label="Syllabus Icon" class="h-5 w-5 fill-white"><use xlink:href="#shape"></use></svg>
                </a>
            </li>
        <?php
    }



    public function parent()
    {
        if (!isset($this->variables["terms_parent"])) { return; }
        $item = $this->variables["terms_parent"];

        ?>
            <li>
                <a href="<?php echo $item->link; ?>" class="chip chip-parent relative bg-zinc-900 hover:bg-emerald-500 p-1 pl-8 flex flex-row justify-center items-center">
                    <div class="h-5 w-5 inline-block mr-2 fill-white"> <?php echo $this->variables["terms_parent"]->acf["svg_glyph"]; ?> </div>
                    <?php echo $item->name ?>
                </a>
            </li>
        <?php
    }



    public function child()
    {
        if (!isset($this->variables["terms_child"])) { return; }
        $item = $this->variables["terms_child"];
        ?>
            <li>
                <a href="<?php echo $item->link; ?>" class="chip chip-child relative bg-zinc-800 hover:bg-emerald-500 p-1 pl-8 flex flex-row justify-center items-center">
                    <div class="h-5 w-5 inline-block mr-2 fill-white"> <?php echo $this->variables["terms_child"]->acf["svg_glyph"]; ?> </div>
                    <?php echo $item->name ?>
                </a>
            </li>
        <?php
    }



    public function term_title()
    {
        if (!is_a($this->variables["current_object"], 'WP_Term')){ return; }
        $item = $this->variables["current_object"];
        ?>
            <li>
                <div class="chip chip-title relative bg-zinc-700 p-1 pl-8 flex flex-row justify-center items-center">
                    <div class="h-5 w-5 inline-block mr-2 fill-white">  <?php echo $this->variables["acf"]["svg_glyph"]; ?> </div>
                    <?php echo $item->name; ?>
                </div>
            </li>
        <?php   
    }



    public function post_title()
    {
        if (!is_a($this->variables["current_object"], 'WP_Post')){ return; }
        $item = $this->variables["current_object"];
        ?>
            <li>
                <div class="chip chip-title inline-block relative bg-zinc-700 p-1 pl-8">
                    <span class="text-emerald-500 mr-1"><?php echo $this->variables["acf"]["award_level_roman"] . '. '?></span>
                    <?php echo $this->variables["current_object"]->post_title; ?>
                </div>
            </li>
        <?php
    }

}              
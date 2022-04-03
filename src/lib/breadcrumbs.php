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
        if (!isset($this->variables["breadcrumbs"]["parent_term"])) { return; }
        $item = $this->variables["breadcrumbs"]["parent_term"];

        ?>
            <li>
                <a href="<?php echo $item['link']; ?>" class="chip chip-parent relative bg-zinc-900 hover:bg-emerald-500 p-1 pl-8 flex flex-row justify-center items-center">
                    <div class="h-5 w-5 inline-block mr-2 fill-white"> <?php echo $item['glyph']; ?> </div>
                    <?php echo $item['title'] ?>
                </a>
            </li>
        <?php
    }



    public function child()
    {
        if (!isset($this->variables["breadcrumbs"]["child_term"])) { return; }
        $item = $this->variables["breadcrumbs"]["child_term"];
        ?>
            <li>
                <a href="<?php echo $item['link']; ?>" class="chip chip-child relative bg-zinc-800 hover:bg-emerald-500 p-1 pl-8 flex flex-row justify-center items-center">
                    <div class="h-5 w-5 inline-block mr-2 fill-white"> <?php echo $item['glyph']; ?> </div>
                    <?php echo $item['title'] ?>
                </a>
            </li>
        <?php
    }



    public function term_title()
    {
        if (!isset($this->variables["breadcrumbs"]["term"])) { return; }
        $item = $this->variables["breadcrumbs"]["term"];
        ?>
            <li>
                <div class="chip chip-title relative bg-zinc-700 p-1 pl-8 flex flex-row justify-center items-center">
                    <div class="h-5 w-5 inline-block mr-2 fill-white">  <?php echo $item["glyph"]; ?> </div>
                    <?php echo $item['title']; ?>
                </div>
            </li>
        <?php   
    }



    public function post_title()
    {
        if (!isset($this->variables["breadcrumbs"]["post"])) { return; }
        $item = $this->variables["breadcrumbs"]["post"];
        ?>
            <li>
                <div class="chip chip-title inline-block relative bg-zinc-700 p-1 pl-8">
                    <?php echo $item["glyph"]; ?>
                    <?php echo $item["title"]; ?>
                </div>
            </li>
        <?php
    }

}              
<?php

namespace andyp\theme\syllabus\lib;

class graphs {

    private $score;
    private $max;
    private $output;
    private $type = 'ratio';



    public function bar($score, $max, $type = 'ratio')
    {
        if (!isset($score)){ $score = 0; }
        if (!isset($max)){ return; }

        $this->score = $score;
        $this->max = $max;
        if (isset($type)){ $this->type = $type; }

        $this->bar_run();

        return $this->output;
    }



    private function bar_run()
    {
        ob_start();
        $this->build_bar();
        $this->output = ob_get_contents();
        ob_end_clean();
    }


    private function build_bar()
    {
        ?>
            <div class="graph w-full flex flex-row h-3 items-center">
                <div class="w-full rounded-full bg-black p-0.5 h-full">
                    <?php $this->bar_line(); ?>
                </div>
                <div class="text-xs ml-2 font-thin">
                    <?php $this->bar_score(); ?>
                </div>
            </div>
        <?php
    }




    private function bar_line()
    {
        $length_percentage = ceil((100 / $this->max) * $this->score);
        ?>
            <div class="bg-amber-400 rounded-full h-full" style="width: <?php echo $length_percentage; ?>%; "></div>
        <?php
    }

    
    private function bar_score()
    {
        $bar_score_function = 'bar_score_' . $this->type;
        $this->$bar_score_function();
    }


    private function bar_score_ratio()
    {
        echo $this->score .'<span class="pl-0.5 text-emerald-500">/</span>'. $this->max;
    }

    private function bar_score_percentage()
    {
        $percentage = ceil((100 / $this->max) * $this->score);
        echo $percentage .'%';
    }


}
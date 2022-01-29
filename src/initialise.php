<?php

namespace andyp\theme\syllabus;

class initialise {

    public function __construct()
    {
        $this->actions();
        $this->filters();
        $this->other();
        $this->components();
        $this->shortcodes();
    }

    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                            Run all action hooks                         │
    // └─────────────────────────────────────────────────────────────────────────┘
    private function actions()
    {
        require get_template_directory() . '/src/hook_actions/init.php';
    }

    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                            Run all filter hooks                         │
    // └─────────────────────────────────────────────────────────────────────────┘
    private function filters()
    {
        require get_template_directory() . '/src/hook_filters/init.php';
    }

    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                            Run all other hooks                          │
    // └─────────────────────────────────────────────────────────────────────────┘
    private function other()
    {
        require get_template_directory() . '/src/hook_other/init.php';
    }

    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                     Initialise all components                           │
    // └─────────────────────────────────────────────────────────────────────────┘
    private function components()
    {
        require get_template_directory() . '/src/components/init.php';
    }

    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                     Initialise all shortcodes                           │
    // └─────────────────────────────────────────────────────────────────────────┘
    private function shortcodes()
    {
        require get_template_directory() . '/src/shortcodes/init.php';
    }


}

<?php

namespace andyp\theme\syllabus\lib\rules;

interface rulesInterface
{
    public function set_config($config);

    public function get_output();
}
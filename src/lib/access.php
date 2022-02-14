<?php

namespace andyp\theme\syllabus\lib;

class access {

    public $user;

    private $administrator = [
        'view_tabs'     // Syllabus Post Page Tabs.
    ];



    public function can($capability){

        $user = _wp_get_current_user();
        $roles = $user->roles;

        $result = FALSE;

        foreach ($roles as $role)
        {
            if (!property_exists($this, $role)){ continue; }

            $access_list = $this->$role;

            if (in_array($capability, $access_list)){
                $result = TRUE;
            }

            continue;
        }

        return $result;

    }

}
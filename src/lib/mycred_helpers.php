<?php

namespace andyp\theme\syllabus\lib;

use mycred;

class mycred_helpers {


    public function get_personal_tracking_score(object $post)
    {
        if ( ! defined( 'myCRED_VERSION' ) ) { return; }
        if ( ! is_a( $post, 'WP_Post') ) { return; }

        $query = new \myCRED_Query_Log( [
            'ctype'   => 'personal_tracking',
            'user_id' => $GLOBALS["current_user"]->ID,
            'ref'     => $post->ID,
            'number'  => 1,
        ] );

        if (empty($query->results)){  return false; }

        if ($query->results == '-1'){  return false; }

        return true;
        
    }

}
<?php

namespace andyp\theme\syllabus\lib;

use mycred;

class mycred_helpers {


    public function get_personal_tracking_score_post(object $post)
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

        /**
     * Undocumented function
     *
     * @param object $term
     * @return void
     */
    public function get_personal_tracking_score_taxonomy(object $term = null)
    {
        if ( ! defined( 'myCRED_VERSION' ) ) { return; }
        if (! isset($term)){ return; }

        $posts_array = get_posts([
            'posts_per_page' => -1,
            'post_type' => 'syllabus',
            'tax_query' => [
                [
                    'taxonomy' => $term->taxonomy,
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                ]
            ]
        ]);

        $results = 0;
        foreach ($posts_array as $post)
        {
            $query = new \myCRED_Query_Log( [
                'ctype'   => 'personal_tracking',
                'user_id' => $GLOBALS["current_user"]->ID,
                'ref'     => $post->ID,
                'number'  => 1,
            ] );

            if (empty($query->results)){  continue; }

            $results++;
        }

        return $results;
        
    }

}
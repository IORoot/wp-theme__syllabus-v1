<?php

namespace andyp\theme\syllabus\lib;

use mycred;

class mycred_helpers {


    public function get_personal_tracking_score_post(object $post)
    {
        if ( ! defined( 'myCRED_VERSION' ) ) { return; }
        if ( ! is_a( $post, 'WP_Post') ) { return; }

        global $wpdb;
        
        $user_ID = $GLOBALS["current_user"]->ID;
        $post_ID = $post->ID;
        $sql = 'SELECT SUM(creds) AS creds FROM wp_myCRED_log where user_id = '.$user_ID.' AND ref = '.$post_ID.' AND ctype = \'personal_tracking\'';
        $result = $wpdb->get_results($sql);

        $credits = intval($result[0]->creds);

        if ( empty($credits)){ return false; }

        return true;

    }

        /**
     * Undocumented function
     *
     * @param object $term
     * @return void
     */
    public function get_personal_tracking_score_by_parent_term(object $term = null)
    {
        if ( ! defined( 'myCRED_VERSION' ) ) { return; }
        if (! isset($term)){ return; }

        global $wpdb;

        $user_ID = $GLOBALS["current_user"]->ID;
        $term_ID =  $term->term_id;
        $sql = 'SELECT ref as post_id, SUM(creds) as credits FROM wp_myCRED_log WHERE entry REGEXP \'^{\' AND user_id = '.$user_ID.' AND entry->"$.parent" = '.$term_ID.' AND ctype = \'personal_tracking\' GROUP BY ref;';
        $sql_result = $wpdb->get_results($sql, 'ARRAY_A');
        $credits = array_map('intval', array_column($sql_result, 'credits')); // Collect all credits into single array and convert to ints.

        $result = 0;
        if ( ! empty($sql_result)){
            $result = array_sum($credits);
        }

        return $result;
    }

}
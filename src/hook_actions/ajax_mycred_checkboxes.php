<?php

add_action('wp_ajax_mycred_checkbox' ,      'ajax_search_mycred_checkbox');
add_action('wp_ajax_nopriv_mycred_checkbox','ajax_search_mycred_checkbox');  


function ajax_search_mycred_checkbox(){

    if (!isset($GLOBALS["mycred"])){ return; }
    if (!isset($GLOBALS["current_user"]->ID)){ return; }

    $state      = esc_attr( $_POST["state"]);
    $post_id    = esc_attr( $_POST["post_id"]);
    $post_title = esc_attr( $_POST["post_title"]);
    $user_ID    = $GLOBALS["current_user"]->ID;
    $mycred     = mycred('personal_tracking');
    $favourited = '';

    // Make sure user is not excluded
    if ( ! $mycred->exclude_user( $user_ID ) ) {

        // Get current credit score.
        global $wpdb;
        $sql = 'SELECT SUM(creds) AS creds FROM wp_myCRED_log where user_id = '.$user_ID.' AND ref = '.$post_id.' AND ctype = \'personal_tracking\'';
        $cred_result = $wpdb->get_results($sql);
        $credits = intval($cred_result[0]->creds);

        // build data for 'Entry' column in mycred log.
        // Include all TERMS. both parent and child - this is to
        // increase query performance when having to iterate over
        // all posts to find which ones are favourited or not. 
        // Instead, we can use this as a look-up. 
        $sql = 'SELECT term_taxonomy_id AS term_ids FROM wp_term_relationships WHERE object_id = '.$post_id;
        $term_result = $wpdb->get_results($sql,'ARRAY_A');
        $term_ids = array_column($term_result, 'term_ids');

        // determine parent and child terms.
        if ($term_ids){
            foreach ($term_ids as $term_id){
                $term = get_term($term_id);
                if ($term->parent == 0){ $data['parent'] = intval($term_id); continue; }
                $data['child'] = intval($term_id);
            }
        }

        $data['title'] = $post_title;
        $json_data = json_encode($data);

        if ( empty($credits)){
            $mycred->add_creds( $post_id, $user_ID, 1, $json_data );
            echo 'checked';
        }

        if ( ! empty($credits)){
            $mycred->add_creds( $post_id, $user_ID, -$credits, $json_data );
            echo '';
        }

    }

    wp_reset_postdata();

    die();
}
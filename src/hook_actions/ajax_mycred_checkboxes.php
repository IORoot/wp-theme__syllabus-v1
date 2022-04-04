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

        global $wpdb;
        $sql = 'SELECT SUM(creds) AS creds FROM wp_myCRED_log where user_id = '.$user_ID.' AND ref = '.$post_id.' AND ctype = \'personal_tracking\'';
        $result = $wpdb->get_results($sql);

        $credits = intval($result[0]->creds);

        if ( empty($credits)){
            $mycred->add_creds( $post_id, $user_ID, 1, $post_title );
            echo 'checked';
        }

        if ( ! empty($credits)){
            $mycred->add_creds( $post_id, $user_ID, -$credits, $post_title );
            echo '';
        }

    }

    wp_reset_postdata();

    die();
}
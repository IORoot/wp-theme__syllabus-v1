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
    $checked = '';

    // Make sure user is not excluded
    if ( ! $mycred->exclude_user( $user_ID ) ) {

        // get users balance
        $args = array(
            'ctype'   => 'personal_tracking',
            'user_id' => $user_ID,
            'ref'     => $post_id,
            'number'  => -1,
        );
        $query = new \myCRED_Query_Log( $args );

        if (empty($query->results)){
            $mycred->add_creds( $post_id, $user_ID, 1, $post_title );
            $checked = 'checked';
        }

        $first_entry = $query->results[0];

        if ($first_entry->creds == "-1"){
            $mycred->add_creds( $post_id, $user_ID, 1, $post_title );
            $checked = 'checked';
        }

        if ($first_entry->creds == "1"){
            $mycred->add_creds( $post_id, $user_ID, -1, $post_title );
            $checked = '';
        }

    }


    echo $checked;

    wp_reset_postdata();

    die();
}
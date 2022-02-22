<?php

function handle_form_submission( $form, $fields, $args ) {
    $email = af_get_field( 'email' );
}
add_action( 'af/form/submission', 'handle_form_submission', 10, 3 );
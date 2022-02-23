<?php

/**
 * For the signup form form_6213aeb19907e
 * /signup/
 */
function signup_modify_afp_field( $field ) {
    $field['label'] = 'New field label';
    echo '<p>Some extra HTML.</p>';
    return $field;
}

add_action( 'acf/render_field/name=full_name', 'signup_modify_afp_field', 10, 3 );

<?php

/**
 * For the signup form form_6213aeb19907e
 * /signup/
 */
function after_fields( $form, $args ) {
    echo '</div>';
}
add_action( 'af/form/after_fields/key=form_6213aeb19907e', 'after_fields', 10 ,2 );
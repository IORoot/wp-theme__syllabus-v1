<?php

/**
 * For the signup form form_6213aeb19907e
 * /signup/
 */
function before_fields( $form, $args ) {
    echo '<div class="flex flex-col gap-8 mb-8 text-zinc-100">';
}
add_action( 'af/form/before_fields/key=form_6213aeb19907e', 'before_fields', 10, 2 );
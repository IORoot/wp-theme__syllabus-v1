<?php

/**
 * For the signup form form_6213aeb19907e
 * /signup/
 */
function signup_submit_button( $attributes, $form, $args ) {
    $attributes['class'] .= ' relative inline-flex items-center h-10 px-5 text-zinc-900 transition-colors duration-150 bg-amber-500 rounded-lg focus:shadow-outline hover:bg-teal-400 cursor-pointer ';
    return $attributes;
}

add_filter( 'af/form/button_attributes/key=form_6213aeb19907e', 'signup_submit_button', 10, 3 );
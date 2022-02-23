<?php

/**
 * For the signup form form_6213aeb19907e
 * /signup/
 * 
 * This effects each and every field.
 */
function filter_field_attributes( $attributes, $field, $form, $args ) {
    $attributes['class'] = '';
    return $attributes;
}

add_filter( 'af/form/field_attributes/key=form_6213aeb19907e', 'filter_field_attributes', 10, 4 );
<?php

/*
* ┌─────────────────────────────────────────────────────────────────────────┐
* │                                                                         │
* │                         DATA COLLATION                                  │
* │        This file will collect all data required for the page to         │
* │        render correctly.                                                │
* │                                                                         │
* └─────────────────────────────────────────────────────────────────────────┘
*/

/**
 * Start an ACF Form
 * 
 * Used for the 'edit' part of the syllabus page.
 * only for admins.
 * https://www.advancedcustomfields.com/resources/create-a-front-end-form/
 */
if (is_admin()){ acf_form_head(); } 


/**
 * Help class 
 * Has functions in it to do various helpful things.
 */
$help = new andyp\theme\syllabus\lib\statics();


/**
 * Use the helper class to grab a load of variables
 * needed for page rendering.
 */
$variables = (new andyp\theme\syllabus\lib\variables)->get_variables();



/**
 * Functions for interacting with mycred.
 */
$mycred_helpers = new andyp\theme\syllabus\lib\mycred_helpers;


/**
 * Functions for creating graphs (bar)
 */
$graphs = new andyp\theme\syllabus\lib\graphs;
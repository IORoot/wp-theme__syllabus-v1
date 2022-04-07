<?php

function add_capabilities_for_syllabus() {
    $role = get_role( 'administrator' );
    $role->add_cap( 'syllabus_view_admin_tabs' ); 
}

add_action( 'admin_init', 'add_capabilities_for_syllabus');
<?php

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Use composer autoloader                         │
// └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/vendor/autoload.php';


// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Define Theme Constants                          │
// └─────────────────────────────────────────────────────────────────────────┘
define( 'ANDYP_THEME_PATH', __DIR__ );
define( 'ANDYP_THEME_URL', get_template_directory_uri() );
define( 'ANDYP_THEME_FILE',  __FILE__ );


// ┌─────────────────────────────────────────────────────────────────────────┐
// │                               Initialise                                │
// └─────────────────────────────────────────────────────────────────────────┘
new andyp\theme\syllabus\initialise;


function mepr_add_image_tab($user) {
    ?>
    <span class="mepr-nav-item custom-image">
      <a href="/index.php/account/?action=profile-image">Profile Image</a>
    </span>
    <?php
}
add_action('mepr_account_nav', 'mepr_add_image_tab');

function mepr_add_image_tab_content($action) {
    if($action == 'profile-image') {
   echo do_shortcode('[avatar_upload]');
    }
}
add_action('mepr_account_nav_content', 'mepr_add_image_tab_content');
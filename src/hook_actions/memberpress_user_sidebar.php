<?php

    /*
    * ┌─────────────────────────────────────────────────────────────────────────┐
    * │                                                                         │
    * │                          Add sidebar option                             │
    * │                                                                         │
    * └─────────────────────────────────────────────────────────────────────────┘
    */
    function mepr_add_image_tab($user) {
        ?>
        <div class="mepr-nav-item py-2">
            <span class="mepr-nav-item hover:text-emerald-400 font-thin">
                <a href="/index.php/account/?action=profile-image">Hello There</a>
            </span>
        </div>
        <?php
    }
    add_action('mepr_account_nav', 'mepr_add_image_tab');

    /*
    * ┌─────────────────────────────────────────────────────────────────────────┐
    * │                                                                         │
    * │                             Add content                                 │
    * │                                                                         │
    * └─────────────────────────────────────────────────────────────────────────┘
    */
    function mepr_add_image_tab_content($action) {
        if($action == 'profile-image') {
            ob_start();
                echo '<div class="pt-32 px-8">';
                echo '<H1 class="text-amber-500">Hello there.</H1>';
                echo '</div>';
            ob_get_contents();
        }
    }

    add_action('mepr_account_nav_content', 'mepr_add_image_tab_content');

?>
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
                <a href="/index.php/account/?action=profile-image">Favourites</a>
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
                ?>
                <div class="w-5/6 pt-32 px-8 text-white flex flex-col gap-4">
                    <H1 class="text-amber-500 flex flex-row"><div>Favourited Items</div>(<?php echo do_shortcode('[mycred_my_balance type="personal_tracking"]'); ?>)</H1>
                    <?php echo do_shortcode('[mycred_user_history type="personal_tracking"]'); ?>
                </div>
                <?php
            ob_get_contents();
        }
    }

    add_action('mepr_account_nav_content', 'mepr_add_image_tab_content');

?>
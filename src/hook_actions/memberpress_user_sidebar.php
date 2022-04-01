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
                <a href="/index.php/account/?action=profile-image">Points</a>
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
                <div class="pt-32 px-8 text-white">
                    <H1 class="text-amber-500">Personal_Tracking Points.</H1>
                    <p>mycred_history</p>
                    <?php echo do_shortcode('[mycred_history type="personal_tracking"]'); ?>
                    <p>mycred_my_balance personal_tracking</p>
                    <?php echo do_shortcode('[mycred_my_balance type="personal_tracking"]'); ?>
                    <p>mycred_total_points (Number in circulation)</p>
                    <?php echo do_shortcode('[mycred_total_points type="personal_tracking"]'); ?>
                </div>
                <?php
            ob_get_contents();
        }
    }

    add_action('mepr_account_nav_content', 'mepr_add_image_tab_content');

?>
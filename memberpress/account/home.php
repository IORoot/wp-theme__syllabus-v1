<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>

<?php 

  /*
  * ┌─────────────────────────────────────────────────────────────────────────┐
  * │                                                                         │
  * │                          ACCOUNT HOME PAGE                              │
  * │                          /account/?action=home                          │
  * │                                                                         │
  * └─────────────────────────────────────────────────────────────────────────┘
  */

  // Get all User Meta data
  $user_meta = get_user_meta($mepr_current_user->rec->ID);
?>

<div class="flex flex-row w-5/6">

    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                	          Main WRAPPER                                 │
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <div class="mp_wrapper flex flex-1 flex-col p-4 pt-24 text-zinc-100 w-4/5 gap-4">

      <?php include(get_template_directory() . '/memberpress/account/home-welcome.php'); ?>
      <?php include(get_template_directory() . '/memberpress/account/home-notifications.php'); ?>
      <?php include(get_template_directory() . '/memberpress/account/home-form.php'); ?>
      <?php include(get_template_directory() . '/memberpress/account/home-rightbar.php'); ?>

</div>
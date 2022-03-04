<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>


<div class="mp_wrapper w-1/2 m-auto drop-shadow-lg p-16 bg-zinc-700 text-white font-thin rounded-2xl border-8 border-black">


  <?php
  // ┌─────────────────────────────────────────────────────────────────────────┐
  //                 	               HEADER                              
  // └─────────────────────────────────────────────────────────────────────────┘
  ?>
  <h2 class="mb-4"><?php _ex('Request a Password Reset', 'ui', 'memberpress'); ?></h3>


  <form name="mepr_forgot_password_form" id="mepr_forgot_password_form" action="" method="post">
    
    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    //                 	                INPUT                              
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <div class="mp-form-row mepr_forgot_password_input">
      <label for="mepr_user_or_email"><?php _ex('Enter Your Username or Email Address', 'ui', 'memberpress'); ?></label>
      <input class="w-full p-4 text-xl text-amber-500 rounded" placeholder="Username or Email Address" type="text" name="mepr_user_or_email" id="mepr_user_or_email" value="<?php echo isset($mepr_user_or_email)?esc_html($mepr_user_or_email):''; ?>" />
    </div>

    <?php MeprHooks::do_action('mepr-forgot-password-form'); ?>
    <div class="submit">
      <input type="submit" name="wp-submit" id="wp-submit" class="button-primary mepr-share-button w-full mt-8 bg-amber-500 text-white text-xl text-center p-4 rounded-2xl hover:bg-zinc-800 hover:text-amber-500 cursor-pointer" value="<?php _ex('Request Password Reset', 'ui', 'memberpress'); ?>"/>
      <input type="hidden" name="action" value="forgot_password" />
      <input type="hidden" name="mepr_process_forgot_password_form" value="true" />
    </div>


  </form>

</div>

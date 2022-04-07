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
    <div class="mp_wrapper flex flex-1 flex-col p-4 pt-24 text-zinc-100 w-4/5">

      <?php include(get_template_directory() . '/memberpress/account/home-notifications.php'); ?>

      <?php
      // ┌─────────────────────────────────────────────────────────────────────────┐
      // │                	          Main Form                                    │
      // └─────────────────────────────────────────────────────────────────────────┘
      ?>
        <form class="mepr-account-form mepr-form p-4 flex flex-col gap-8 w-1/2 mr-auto" id="mepr_account_form" action="" method="post" enctype="multipart/form-data" novalidate>


          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          // │                	Hidden input / nonce fields                            │
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <input type="hidden" name="mepr-process-account" value="Y" />
          <?php wp_nonce_field( 'update_account', 'mepr_account_nonce' ); ?>
          <?php MeprHooks::do_action('mepr-account-home-before-name', $mepr_current_user); ?>


          <?php if($mepr_options->show_fname_lname): ?>

            <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            // │                	         FIRST Name Field                              │
            // └─────────────────────────────────────────────────────────────────────────┘
            ?>    
            <div class="mp-form-row text-zinc-500 flex flex-row gap-8 mepr_first_name">
              <div class="mp-form-label w-60 flex flex-col gap-1">
                <label for="user_first_name"><?php _ex('First Name:', 'ui', 'memberpress'); echo ($mepr_options->require_fname_lname)?'*':''; ?></label>
                <span class="cc-error mr-auto text-rose-500 text-xs inline-block" ><?php _ex('First Name Required', 'ui', 'memberpress'); ?></span>
              </div>
              <input type="text" name="user_first_name" id="user_first_name" class="mepr-form-input h-12 rounded p-2 text-zinc-800 w-full" value="<?php echo $mepr_current_user->first_name; ?>" <?php echo ($mepr_options->require_fname_lname)?'required':''; ?> />
            </div>

            <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            // │                	          LAST NAME Field                              │
            // └─────────────────────────────────────────────────────────────────────────┘
            ?>     
            <div class="mp-form-row text-zinc-500 flex flex-row gap-8 mepr_last_name">
              <div class="mp-form-label w-60 flex flex-col gap-1">
                <label for="user_last_name"><?php _ex('Last Name:', 'ui', 'memberpress'); echo ($mepr_options->require_fname_lname)?'*':''; ?></label>
                <span class="cc-error mr-auto text-rose-500  text-xs inline-block" ><?php _ex('Last Name Required', 'ui', 'memberpress'); ?></span>
              </div>
              <input type="text" id="user_last_name" name="user_last_name" class="mepr-form-input h-12 rounded p-2 text-zinc-800 w-full" value="<?php echo $mepr_current_user->last_name; ?>" <?php echo ($mepr_options->require_fname_lname)?'required':''; ?> />
            </div>

            <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            // │              Else show hidden fields with name in it.                   │
            // └─────────────────────────────────────────────────────────────────────────┘
            ?>   
          <?php else: ?>
            <input type="hidden" name="user_first_name" value="<?php echo $mepr_current_user->first_name; ?>" />
            <input type="hidden" name="user_last_name" value="<?php echo $mepr_current_user->last_name; ?>" />
          <?php endif; ?>


          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          // │                	        Email fields                                   │
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <div class="mp-form-row text-zinc-500 flex flex-row gap-8 mepr_email">
            <div class="mp-form-label w-60 flex flex-col gap-1">
              <label for="user_email"><?php _ex('Email:*', 'ui', 'memberpress');  ?></label>
              <span class="cc-error mr-auto text-rose-500  text-xs inline-block" ><?php _ex('Invalid Email', 'ui', 'memberpress'); ?></span>
            </div>
            <input type="email" id="user_email" name="user_email" class="mepr-form-input h-12 rounded p-2 text-zinc-800 w-full" value="<?php echo $mepr_current_user->user_email; ?>" required />
          </div>

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          // │                	        Custom fields                                  │
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <?php
            MeprUsersHelper::render_custom_fields(null, 'account');
            MeprHooks::do_action('mepr-account-home-fields', $mepr_current_user);
          ?>



          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          // │                	          Submit button                                │
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <input type="submit" name="mepr-account-form" value="<?php _ex('Save Profile', 'ui', 'memberpress'); ?>" class="mepr-submit mepr-share-button ml-auto px-8 py-2 bg-emerald-500 hover:bg-amber-500 rounded cursor-pointer" />

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          // │                	           Form Errors                                 │
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <?php MeprView::render('/shared/has_errors', get_defined_vars()); ?>
        </form>


        <?php MeprHooks::do_action('mepr_account_home', $mepr_current_user); ?>


    </div>


    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                	          RIGHT SIDEBAR                                │
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <div class="w-1/5 bg-emerald-500 relative">
      <?php echo do_shortcode('[isometric_random count="1" classes="absolute bottom-0 right-0"]'); ?>
    </div>

</div>
<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>

<?php 
  acf_form_head();

  // Get all User Meta data -- also includes ACF fields.
  $user_meta = get_user_meta($mepr_current_user->rec->ID);
?>

<div class="mp_wrapper flex flex-1 flex-col p-4 pt-24 text-zinc-100">

  <?php include(get_template_directory() . '/memberpress/account/home-notifications.php'); ?>

  <?php
  // ┌─────────────────────────────────────────────────────────────────────────┐
  // │                	          Main Form                                    │
  // └─────────────────────────────────────────────────────────────────────────┘
  ?>
    <form class="mepr-account-form mepr-form p-4 flex flex-col gap-8" id="mepr_account_form" action="" method="post" enctype="multipart/form-data" novalidate>


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
        // │                	            Avatar                                     │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <?php
            if (!$user_meta["avatar_image"][0]){ $avatar = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/></svg>'; }
        ?>
        <div class="w-48 h-48 rounded-full fill-zinc-50 bg-amber-500 p-2">
            <?php echo $avatar; ?>
        </div>


        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                	         FIRST Name Field                              │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>    
        <div class="mp-form-row text-zinc-500 flex flex-row gap-8 mepr_first_name">
          <div class="mp-form-label w-40 flex flex-col gap-1">
            <label for="user_first_name"><?php _ex('First Name:', 'ui', 'memberpress'); echo ($mepr_options->require_fname_lname)?'*':''; ?></label>
            <span class="cc-error mr-auto text-rose-500  text-xs inline-block" ><?php _ex('First Name Required', 'ui', 'memberpress'); ?></span>
          </div>
          <input type="text" name="user_first_name" id="user_first_name" class="mepr-form-input h-12 rounded p-2 text-zinc-800" value="<?php echo $mepr_current_user->first_name; ?>" <?php echo ($mepr_options->require_fname_lname)?'required':''; ?> />
        </div>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                	          LAST NAME Field                              │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>     
        <div class="mp-form-row text-zinc-500 flex flex-row gap-8 mepr_last_name">
          <div class="mp-form-label w-40 flex flex-col gap-1">
            <label for="user_last_name"><?php _ex('Last Name:', 'ui', 'memberpress'); echo ($mepr_options->require_fname_lname)?'*':''; ?></label>
            <span class="cc-error mr-auto text-rose-500  text-xs inline-block" ><?php _ex('Last Name Required', 'ui', 'memberpress'); ?></span>
          </div>
          <input type="text" id="user_last_name" name="user_last_name" class="mepr-form-input h-12 rounded p-2 text-zinc-800" value="<?php echo $mepr_current_user->last_name; ?>" <?php echo ($mepr_options->require_fname_lname)?'required':''; ?> />
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
        <div class="mp-form-label w-40 flex flex-col gap-1">
          <label for="user_email"><?php _ex('Email:*', 'ui', 'memberpress');  ?></label>
          <span class="cc-error mr-auto text-rose-500  text-xs inline-block" ><?php _ex('Invalid Email', 'ui', 'memberpress'); ?></span>
        </div>
        <input type="email" id="user_email" name="user_email" class="mepr-form-input h-12 rounded p-2 text-zinc-800" value="<?php echo $mepr_current_user->user_email; ?>" required />
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
      <input type="submit" name="mepr-account-form" value="<?php _ex('Save Profile', 'ui', 'memberpress'); ?>" class="mepr-submit mepr-share-button mr-auto px-8 py-2 bg-emerald-500 hover:bg-amber-500 rounded-xl" />

      <?php
      // ┌─────────────────────────────────────────────────────────────────────────┐
      // │                	           Form Errors                                 │
      // └─────────────────────────────────────────────────────────────────────────┘
      ?>
      <?php MeprView::render('/shared/has_errors', get_defined_vars()); ?>
    </form>


    <?php MeprHooks::do_action('mepr_account_home', $mepr_current_user); ?>


</div>

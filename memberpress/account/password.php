<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>

<div class="mp_wrapper flex flex-1 flex-col p-4 pt-24 text-zinc-100">

    <div class="mp_wrapper overflow-hidden rounded-lg">

      <?php MeprView::render('/shared/errors', get_defined_vars()); ?>

      <?php
      // ┌─────────────────────────────────────────────────────────────────────────┐
      // │                                FORM                                     │
      // └─────────────────────────────────────────────────────────────────────────┘
      ?>
      <form action="<?php echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>" class="mepr-newpassword-form mepr-form p-4 flex flex-col gap-4 w-1/2 mr-auto" method="post" novalidate>
        
        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                	Hidden input / nonce fields                            │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?> 
        <input type="hidden" name="plugin" value="mepr" />
        <input type="hidden" name="action" value="updatepassword" />
        <?php wp_nonce_field( 'update_password', 'mepr_account_nonce' ); ?>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                           NEW PASSWORD                                  │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <div class="mp-form-row mepr_new_password text-zinc-500 flex flex-row gap-8 mepr_first_name">
            <label class="w-60 flex flex-col gap-1" for="mepr-new-password"><?php _ex('New Password', 'ui', 'memberpress'); ?></label>
            <div class="mp-hide-pw  w-full">
              <input type="password" name="mepr-new-password" id="mepr-new-password" class="mepr-form-input mepr-new-password  h-12 rounded p-2 text-zinc-800 w-full" required />
              <button type="button" class="button mp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Show password', 'memberpress' ); ?>">
                <svg viewBox="0 0 24 24" class="h-4 fill-zinc-400" xmlns="http://www.w3.org/2000/svg"><path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z"/></svg>
              </button>
            </div>
        </div>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                           CONFIRM PASSWORD                              │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <div class="mp-form-row mepr_confirm_password text-zinc-500 flex flex-row gap-8 mepr_first_name">
          <label class="w-60 flex flex-col gap-1"  for="mepr-confirm-password"><?php _ex('Confirm New Password', 'ui', 'memberpress'); ?></label>
          <div class="mp-hide-pw w-full">
            <input type="password" name="mepr-confirm-password" id="mepr-confirm-password" class="mepr-form-input mepr-new-password-confirm  h-12 rounded p-2 text-zinc-800 w-full" required />
            <button type="button" class="button mp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Show password', 'memberpress' ); ?>">
                <svg viewBox="0 0 24 24" class="h-4 fill-zinc-400" xmlns="http://www.w3.org/2000/svg"><path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z"/></svg>
            </button>
          </div>
        </div>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                                ACTION                                   │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <div class="text-center">
        <?php MeprHooks::do_action('mepr-account-after-password-fields', $mepr_current_user); ?>
        </div>

        <div class="flex flex-row gap-4 mt-8">
            <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            // │                           SUBMIT BUTTON                                 │
            // └─────────────────────────────────────────────────────────────────────────┘
            ?>
            <input type="submit" name="new-password-submit" value="<?php _ex('Update Password', 'ui', 'memberpress'); ?>" class="mepr-submit ml-auto px-8 py-2 bg-emerald-500 hover:bg-amber-500 rounded cursor-pointer" />
            
            
            <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            // │                           CANCEL BUTTON                                 │
            // └─────────────────────────────────────────────────────────────────────────┘
            ?>
            <a class="px-8 py-2 bg-zinc-300 hover:bg-amber-500 rounded cursor-pointer text-zinc-900" href="<?php echo $mepr_options->account_page_url(); ?>"><?php _ex('Cancel', 'ui', 'memberpress'); ?></a>
            
        </div>


        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                           LOADING GIF                                   │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?> 
        <img src="<?php echo admin_url('images/loading.gif'); ?>" alt="<?php _e('Loading...', 'memberpress'); ?>" style="display: none;" class="mepr-loading-gif" />
        
        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                              ERRORS                                     │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <?php MeprView::render('/shared/has_errors', get_defined_vars()); ?>
      </form>

      <?php MeprHooks::do_action('mepr_account_password', $mepr_current_user); ?>
    </div>

</div>
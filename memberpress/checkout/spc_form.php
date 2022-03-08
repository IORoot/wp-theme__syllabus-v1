<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>

<?php
/*
* ┌─────────────────────────────────────────────────────────────────────────┐
* │                                                                         │
* │                      MEMBERPRESS REGISTER PRODUCT                       │
* │                      /register/free                                     │
* │                                                                         │
* └─────────────────────────────────────────────────────────────────────────┘
*/
$acf_svg         = get_field('svg', $product->rec->ID);
$acf_colour      = get_field('colour', $product->rec->ID);
$acf_description = get_field('description', $product->rec->ID);
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                Override the default memberpress class                   │
// └─────────────────────────────────────────────────────────────────────────┘
include(get_template_directory() . '/memberpress/helpers/MeprGroupsHelper_v2.php');
?>
<?php do_action('mepr-above-checkout-form', $product->ID); ?>



<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
//                 	         Wrapper Box LEFT/RIGHT                              
// └─────────────────────────────────────────────────────────────────────────┘
?>
<div class="flex flex-row w-2/3 m-auto drop-shadow-lg font-thin border-8 border-black rounded-2xl mb-20">


    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    //
    //                 	            LEFT                              
    //
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <div id="left" class="bg-<?php echo $acf_colour; ?> w-1/2 rounded-l-xl p-16">
      <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                 	         Blurb                              
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
      <h2 class="text-zinc-100 mb-4 font-medium text-4xl"><?php echo $product->rec->post_title ?> Account</h2>
      <p class="text-zinc-800 leading-6 text-xl mb-8"><?php echo $acf_description; ?></p>

      <?php
      // ┌─────────────────────────────────────────────────────────────────────────┐
      //                 	         Image                              
      // └─────────────────────────────────────────────────────────────────────────┘
      ?>
      <?php echo do_shortcode('[isometric_random count="1" classes="w-96 h-96 mb-10 m-auto" default="/wp-content/uploads/Syllabus/Climbing/Splat/Splats-7.svg"]' );?>
    </div>

   
    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    //
    //                 	              RIGHT                              
    //
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <div class="mp_wrapper bg-zinc-700 rounded-r-xl w-1/2 p-16 pt-8 text-white">
      <?php
      // ┌─────────────────────────────────────────────────────────────────────────┐
      //                 	         Form                              
      // └─────────────────────────────────────────────────────────────────────────┘
      ?>
      <form class="mepr-signup-form mepr-form" method="post" action="<?php echo $_SERVER['REQUEST_URI'].'#mepr_jump'; ?>" enctype="multipart/form-data" novalidate>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                 	         Hidden Inputs                              
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <input type="hidden" class="hidden" name="mepr_process_signup_form" value="<?php echo isset($_GET['mepr_process_signup_form']) ? esc_attr($_GET['mepr_process_signup_form']) : 1 ?>" />
        <input type="hidden" class="hidden" name="mepr_product_id" value="<?php echo esc_attr($product->ID); ?>" />
        <input type="hidden" class="hidden" name="mepr_transaction_id" value="<?php echo isset($_GET['mepr_transaction_id']) ? esc_attr($_GET['mepr_transaction_id']) : ""; ?>" />

        <?php if(MeprUtils::is_user_logged_in()): ?>
          <input type="hidden" class="hidden"  name="logged_in_purchase" value="1" />
          <input type="hidden" class="hidden"  name="mepr_checkout_nonce" value="<?php echo esc_attr(wp_create_nonce('logged_in_purchase')); ?>">
          <?php wp_referer_field(); ?>
        <?php endif; ?>


        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                                  GLYPH                   
        // └─────────────────────────────────────────────────────────────────────────┘ 
        ?>  
        <?php 
          echo '<div class="fill-'.$acf_colour.' mb-8">';
          echo $acf_svg;
          echo '</div>';
        ?>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                 	         Tagline                              
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <h2 class="mb-4"><?php echo $product->rec->post_title ?> Account Sign up</h2>
        <p class="text-zinc-500 mb-8">Want to see all memberships? 
          <a href="/plans/signup/" class="text-blue-400 hover:underline cursor-pointer">Explore here.</a>
        </p>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                 	         Price                              
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <?php if( ($product->register_price_action != 'hidden') && MeprHooks::apply_filters('mepr_checkout_show_terms',true,$product) ): ?>
          <div class="mp-form-row mepr_bold mepr_price flex flex-row text-2xl bg-zinc-600 py-4 px-8 rounded-xl mb-8">

            <?php
            // Free = 'Price'
            // One-time = 'Price'
            // Reoccuring = 'Terms'
            $price_label = ($product->is_one_time_payment() ? _x('Price:', 'ui', 'memberpress') : _x('Terms:', 'ui', 'memberpress')); ?>

              <div class="mepr_price_cell_label"><?php echo $price_label; ?></div>
              <div class="mepr_price_cell ml-auto">
                <?php MeprProductsHelper::display_invoice( $product, $mepr_coupon_code ); ?>
              </div>

          </div>
        <?php endif; ?>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                 	         Action                              
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <?php MeprHooks::do_action('mepr-checkout-before-name', $product->ID); ?>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                 	         FIRST / LAST NAME                              
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <?php if((!MeprUtils::is_user_logged_in() ||
                  (MeprUtils::is_user_logged_in() && $mepr_options->show_fields_logged_in_purchases)) &&
                $mepr_options->show_fname_lname): ?>
          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         FIRST NAME                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <div class="mp-form-row mepr_first_name mb-4">
            <div class="mp-form-label flex flex-row">
              <label for="user_first_name<?php echo $unique_suffix; ?>"><?php _ex('First Name:', 'ui', 'memberpress'); echo ($mepr_options->require_fname_lname)?'*':''; ?></label>
              <span class="cc-error text-red-500 ml-auto"><?php _ex('First Name Required', 'ui', 'memberpress'); ?></span>
            </div>
            <input type="text" name="user_first_name" id="user_first_name<?php echo $unique_suffix; ?>" class="mepr-form-input w-full p-4 text-xl text-<?php echo $acf_colour; ?> rounded" value="<?php echo esc_attr($first_name_value); ?>" <?php echo ($mepr_options->require_fname_lname)?'required':''; ?> />
          </div>

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         LAST NAME                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <div class="mp-form-row mepr_last_name mb-4">
            <div class="mp-form-label flex flex-row">
              <label for="user_last_name<?php echo $unique_suffix; ?>"><?php _ex('Last Name:', 'ui', 'memberpress'); echo ($mepr_options->require_fname_lname)?'*':''; ?></label>
              <span class="cc-error text-red-500 ml-auto"><?php _ex('Last Name Required', 'ui', 'memberpress'); ?></span>
            </div>
            <input type="text" name="user_last_name" id="user_last_name<?php echo $unique_suffix; ?>" class="mepr-form-input w-full p-4 text-xl text-<?php echo $acf_colour; ?> rounded" value="<?php echo esc_attr($last_name_value); ?>" <?php echo ($mepr_options->require_fname_lname)?'required':''; ?> />
          </div>

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         HIDDEN                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php else: /* this is here to avoid validation issues */ ?>
          <input type="hidden" class="hidden"  name="user_first_name" value="<?php echo esc_attr($first_name_value); ?>" />
          <input type="hidden" class="hidden"  name="user_last_name" value="<?php echo esc_attr($last_name_value); ?>" />
        <?php endif; ?>

        <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         ACTION                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php MeprHooks::do_action('mepr-checkout-before-custom-fields', $product->ID); ?>

        <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         CUSTOM FIELDS                             
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php
          if(!MeprUtils::is_user_logged_in() || (MeprUtils::is_user_logged_in() && $mepr_options->show_fields_logged_in_purchases)) {
            MeprUsersHelper::render_custom_fields($product, 'signup', $unique_suffix);
          }
        ?>

        <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         ACTION                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php MeprHooks::do_action('mepr-checkout-after-custom-fields', $product->ID); ?>

        <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         HIDDEN                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php if(MeprUtils::is_user_logged_in()): ?>
          <input type="hidden" class="hidden"  name="user_email" value="<?php echo esc_attr(stripslashes($mepr_current_user->user_email)); ?>" />
        <?php else: ?>
          <input type="hidden" class="hidden"  class="mepr-geo-country" name="mepr-geo-country" value="" />

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         USERNAME                             
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <?php if(!$mepr_options->username_is_email): ?>
            <div class="mp-form-row mepr_username mb-4">
              <div class="mp-form-label flex flex-row">
                <label for="user_login<?php echo $unique_suffix; ?>"><?php _ex('Username:*', 'ui', 'memberpress'); ?></label>
                <span class="cc-error text-red-500 ml-auto"><?php _ex('Invalid Username', 'ui', 'memberpress'); ?></span>
              </div>
              <input type="text" name="user_login" id="user_login<?php echo $unique_suffix; ?>" class="mepr-form-input w-full p-4 text-xl text-<?php echo $acf_colour; ?> rounded" value="<?php echo (isset($user_login))?esc_attr(stripslashes($user_login)):''; ?>" required />
            </div>

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         EMAIL                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <?php endif; ?>
          <div class="mp-form-row mepr_email mb-4">
            <div class="mp-form-label flex flex-row">
              <label for="user_email<?php echo $unique_suffix; ?>"><?php _ex('Email:*', 'ui', 'memberpress'); ?></label>
              <span class="cc-error text-red-500 ml-auto"><?php _ex('Invalid Email', 'ui', 'memberpress'); ?></span>
            </div>
            <input type="email" name="user_email" id="user_email<?php echo $unique_suffix; ?>" class="mepr-form-input w-full p-4 text-xl text-<?php echo $acf_colour; ?> rounded" value="<?php echo (isset($user_email))?esc_attr(stripslashes($user_email)):''; ?>" required />
          </div>

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         ACTION                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <?php MeprHooks::do_action('mepr-after-email-field'); //Deprecated ?>
          <?php MeprHooks::do_action('mepr-checkout-after-email-field', $product->ID); ?>

          <?php if($mepr_options->disable_checkout_password_fields === false): ?>

            <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            //                 	         PASSWORD                              
            // └─────────────────────────────────────────────────────────────────────────┘
            ?>
            <div class="mp-form-row mepr_password mb-10">
              <div class="mp-form-label flex flex-row">
                <label for="mepr_user_password<?php echo $unique_suffix; ?>"><?php _ex('Password:*', 'ui', 'memberpress'); ?></label>
                <span class="cc-error text-red-500 ml-auto"><?php _ex('Invalid Password', 'ui', 'memberpress'); ?></span>
              </div>
              <div class="mp-hide-pw">
                <input type="password" name="mepr_user_password" id="mepr_user_password<?php echo $unique_suffix; ?>" class="mepr-form-input w-full p-4 text-xl text-<?php echo $acf_colour; ?> rounded mepr-password" value="<?php echo (isset($mepr_user_password))?esc_attr(stripslashes($mepr_user_password)):''; ?>" required />
                <button type="button" class="button mp-hide-pw hide-if-no-js w-6 h-6 fill-zinc-500 float-right" data-toggle="0" aria-label="<?php esc_attr_e( 'Show password', 'memberpress' ); ?>">
                  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7.14,4.5 2.78,7.5 1,12C3.39,18.08 10.25,21.06 16.33,18.67C19.38,17.47 21.8,15.06 23,12C21.22,7.5 16.86,4.5 12,4.5M7,22H9V24H7V22M11,22H13V24H11V22M15,22H17V24H15V22Z"/></svg>
                </button>
              </div>
            </div>

            <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         PASSWORD CONFIRM                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
            <div class="mp-form-row mepr_password_confirm mb-4">
              <div class="mp-form-label flex flex-row">
                <label for="mepr_user_password_confirm<?php echo $unique_suffix; ?>"><?php _ex('Password Confirmation:*', 'ui', 'memberpress'); ?></label>
                <span class="cc-error text-red-500 ml-auto"><?php _ex('Passwords do not Match', 'ui', 'memberpress'); ?></span>
              </div>
              <div class="mp-hide-pw">
                <input type="password" name="mepr_user_password_confirm" id="mepr_user_password_confirm<?php echo $unique_suffix; ?>" class="mepr-form-input w-full p-4 text-xl text-<?php echo $acf_colour; ?> rounded mepr-password-confirm" value="<?php echo (isset($mepr_user_password_confirm))?esc_attr(stripslashes($mepr_user_password_confirm)):''; ?>" required />
                <button type="button" class="button mp-hide-pw hide-if-no-js w-6 h-6 fill-zinc-500 float-right" data-toggle="0" aria-label="<?php esc_attr_e( 'Show password', 'memberpress' ); ?>">
                  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7.14,4.5 2.78,7.5 1,12C3.39,18.08 10.25,21.06 16.33,18.67C19.38,17.47 21.8,15.06 23,12C21.22,7.5 16.86,4.5 12,4.5M7,22H9V24H7V22M11,22H13V24H11V22M15,22H17V24H15V22Z"/></svg>
                </button>
              </div>
            </div>

            <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            //                 	         ACTION                              
            // └─────────────────────────────────────────────────────────────────────────┘
            ?>
            <div class="text-center mb-10 ">
            <?php 
            // Strength Meter
            MeprHooks::do_action('mepr-after-password-fields'); //Deprecated ?>
            </div>
            <?php MeprHooks::do_action('mepr-checkout-after-password-fields', $product->ID); ?>
          <?php endif; ?>
        <?php endif; ?>


        <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         ACTION                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php MeprHooks::do_action('mepr-before-coupon-field'); //Deprecated ?>
        <?php MeprHooks::do_action('mepr-checkout-before-coupon-field', $product->ID); ?>


        <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         PAYMENTS                            
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php if($payment_required || !empty($product->plan_code)): ?>
          <?php if($mepr_options->coupon_field_enabled): ?>

            <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         COUPON                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
            <a class="have-coupon-link" data-prdid="<?php echo $product->ID; ?>" href="">
              <?php echo MeprCouponsHelper::show_coupon_field_link_content($mepr_coupon_code); ?>
            </a>
            <div class="mp-form-row mepr_coupon mepr_coupon_<?php echo $product->ID; ?> mepr-hidden">
              <div class="mp-form-label">
                <label for="mepr_coupon_code<?php echo $unique_suffix; ?>"><?php _ex('Coupon Code:', 'ui', 'memberpress'); ?></label>
                <span class="mepr-coupon-loader mepr-hidden">
                  <img src="<?php echo includes_url('js/thickbox/loadingAnimation.gif'); ?>" alt="<?php _e('Loading...', 'memberpress'); ?>" title="<?php _ex('Loading icon', 'ui', 'memberpress'); ?>" width="100" height="10" />
                </span>
                <span class="cc-error text-red-500"><?php _ex('Invalid Coupon', 'ui', 'memberpress'); ?></span>
              </div>
              <input type="text" id="mepr_coupon_code<?php echo $unique_suffix; ?>" class="mepr-form-input mepr-coupon-code mepr-form-input w-full p-4 text-xl text-<?php echo $acf_colour; ?> rounded" name="mepr_coupon_code" value="<?php echo (isset($mepr_coupon_code))?esc_attr(stripslashes($mepr_coupon_code)):''; ?>" data-prdid="<?php echo $product->ID; ?>" />
            </div>

            <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         HIDDEN COUPON                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <?php else: ?>
            <input type="hidden" class="hidden"  name="mepr_coupon_code" value="<?php echo (isset($mepr_coupon_code))?esc_attr(stripslashes($mepr_coupon_code)):''; ?>" />
          <?php endif; ?>


          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         INVOICE                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <?php if($mepr_options->enable_spc_invoice): ?>
            <div class="mepr-transaction-invoice-wrapper" style="padding-top:10px">
              <span class="mepr-invoice-loader mepr-hidden">
                <img src="<?php echo includes_url('js/thickbox/loadingAnimation.gif'); ?>" alt="<?php _e('Loading...', 'memberpress'); ?>" title="<?php _ex('Loading icon', 'ui', 'memberpress'); ?>" width="100" height="10" />
              </span>
              <div><?php MeprProductsHelper::display_spc_invoice( $product, $mepr_coupon_code ); ?></div>
            </div>
          <?php endif; ?>

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         PAYMENT                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <div class="mepr-payment-methods-wrapper mb-4">
            <?php if(sizeof($payment_methods) > 1): ?>
              <h3><?php _ex('Select Payment Method', 'ui', 'memberpress'); ?></h3>
            <?php endif; ?>

            <div class="mepr-payment-methods-icons">
              <?php echo MeprOptionsHelper::payment_methods_icons($payment_methods); ?>
            </div>

            <div class="mepr-payment-methods-radios<?php echo sizeof($payment_methods) === 1 ? ' mepr-hidden hidden' : ''; ?>">
              <?php echo MeprOptionsHelper::payment_methods_radios($payment_methods); ?>
            </div>

            <?php if(sizeof($payment_methods) > 1): ?>
              <hr />
            <?php endif; ?>

            <?php echo MeprOptionsHelper::payment_methods_descriptions($payment_methods); ?>
          </div>

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         HIDDEN COUPON                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php else: ?>
          <input type="hidden" class="hidden"  id="mepr_coupon_code-<?php echo $product->ID; ?>" name="mepr_coupon_code" value="<?php echo (isset($mepr_coupon_code))?esc_attr(stripslashes($mepr_coupon_code)):''; ?>" />
        <?php endif; ?>

        <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         INVOICE                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php if($mepr_options->enable_spc_invoice && $product->adjusted_price($mepr_coupon_code) <= 0.00 && false == ( isset($_GET['ca']) && class_exists('MPCA_Corporate_Account') )) { ?>
          <div class="mepr-transaction-invoice-wrapper" style="padding-top:10px">
            <span class="mepr-invoice-loader mepr-hidden">
              <img src="<?php echo includes_url('js/thickbox/loadingAnimation.gif'); ?>" alt="<?php _e('Loading...', 'memberpress'); ?>" title="<?php _ex('Loading icon', 'ui', 'memberpress'); ?>" width="100" height="10" />
            </span>
            <div>  <!-- Transaction Invoice shows up here  --> </div>
          </div>
        <?php } ?>

        <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         REQUIRE TOS                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php if($mepr_options->require_tos): ?>
          <div class="mp-form-row mepr_tos mb-4">
            <label for="mepr_agree_to_tos<?php echo $unique_suffix; ?>" class="mepr-checkbox-field mepr-form-input" required>
              <input type="checkbox" name="mepr_agree_to_tos" id="mepr_agree_to_tos<?php echo $unique_suffix; ?>" <?php checked(isset($mepr_agree_to_tos)); ?> />
              <a href="<?php echo stripslashes($mepr_options->tos_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo stripslashes($mepr_options->tos_title); ?></a>*
            </label>
          </div>
        <?php endif; ?>

        <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         REQUIRE PRIVACY POLICY                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php if($mepr_options->require_privacy_policy && $privacy_page_link = MeprAppHelper::privacy_policy_page_link()): ?>
          <div class="mp-form-row mb-4">
            <label for="mepr_agree_to_privacy_policy<?php echo $unique_suffix; ?>" class="mepr-checkbox-field mepr-form-input" required>
              <input type="checkbox" name="mepr_agree_to_privacy_policy" id="mepr_agree_to_privacy_policy<?php echo $unique_suffix; ?>" />
              <?php echo preg_replace('/%(.*)%/', '<a href="' . $privacy_page_link . '" target="_blank">$1</a>', __($mepr_options->privacy_policy_title, 'memberpress')); ?>
            </label>
          </div>
        <?php endif; ?>

        <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         ACTION                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
        <?php MeprHooks::do_action('mepr-user-signup-fields'); //Deprecated ?>
        <?php MeprHooks::do_action('mepr-checkout-before-submit', $product->ID); ?>



        <div class="mp-form-submit">
          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         HIDDEN BOT CAPTURE                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <?php // This mepr_no_val needs to be hidden in order for this to work so we do it explicitly as a style ?>
          <label for="mepr_no_val" class="mepr-visuallyhidden hidden"><?php _ex('No val', 'ui', 'memberpress'); ?></label>
          <input type="text" id="mepr_no_val" name="mepr_no_val" class="mepr-form-input mepr-visuallyhidden mepr_no_val mepr-hidden hidden" autocomplete="off" />
          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	            SUBMIT BUTTON                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <input type="submit" class="mepr-submit w-full bg-<?php echo $acf_colour; ?> text-white text-xl text-center p-4 mb-4 rounded-2xl hover:bg-zinc-800 hover:text-<?php echo $acf_colour; ?> cursor-pointer" value="<?php echo stripslashes($product->signup_button_text); ?>" />

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         LOADING ANIMATION                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <img src="<?php echo admin_url('images/loading.gif'); ?>" alt="<?php _e('Loading...', 'memberpress'); ?>" style="display: none;" class="mepr-loading-gif" title="<?php _ex('Loading icon', 'ui', 'memberpress'); ?>" />
          
          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	              ERRORS                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <?php MeprView::render('/shared/has_errors', get_defined_vars()); ?>
        </div>
      </form>
    </div>


</div>

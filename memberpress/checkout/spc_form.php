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
          <div class="mepr-payment-methods-wrapper mb-4 mt-10">
            <?php if(sizeof($payment_methods) > 1): ?>
              <h3><?php _ex('Select Payment Method', 'ui', 'memberpress'); ?></h3>
            <?php endif; ?>

            <div class="mepr-payment-methods-icons flex flex-row mb-2">
              <div class="fill-blue-700 w-10 mr-2"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Stripe</title><path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.594-7.305h.003z"/></svg></div>
              <div class="fill-yellow-800 w-10 mr-2"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Visa</title><path d="M9.112 8.262L5.97 15.758H3.92L2.374 9.775c-.094-.368-.175-.503-.461-.658C1.447 8.864.677 8.627 0 8.479l.046-.217h3.3a.904.904 0 01.894.764l.817 4.338 2.018-5.102zm8.033 5.049c.008-1.979-2.736-2.088-2.717-2.972.006-.269.262-.555.822-.628a3.66 3.66 0 011.913.336l.34-1.59a5.207 5.207 0 00-1.814-.333c-1.917 0-3.266 1.02-3.278 2.479-.012 1.079.963 1.68 1.698 2.04.756.367 1.01.603 1.006.931-.005.504-.602.725-1.16.734-.975.015-1.54-.263-1.992-.473l-.351 1.642c.453.208 1.289.39 2.156.398 2.037 0 3.37-1.006 3.377-2.564m5.061 2.447H24l-1.565-7.496h-1.656a.883.883 0 00-.826.55l-2.909 6.946h2.036l.405-1.12h2.488zm-2.163-2.656l1.02-2.815.588 2.815zm-8.16-4.84l-1.603 7.496H8.34l1.605-7.496z"/></svg></div>
              <div class="fill-red-600 w-10 mr-2"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>MasterCard</title><path d="M11.343 18.031c.058.049.12.098.181.146-1.177.783-2.59 1.238-4.107 1.238C3.32 19.416 0 16.096 0 12c0-4.095 3.32-7.416 7.416-7.416 1.518 0 2.931.456 4.105 1.238-.06.051-.12.098-.165.15C9.6 7.489 8.595 9.688 8.595 12c0 2.311 1.001 4.51 2.748 6.031zm5.241-13.447c-1.52 0-2.931.456-4.105 1.238.06.051.12.098.165.15C14.4 7.489 15.405 9.688 15.405 12c0 2.31-1.001 4.507-2.748 6.031-.058.049-.12.098-.181.146 1.177.783 2.588 1.238 4.107 1.238C20.68 19.416 24 16.096 24 12c0-4.094-3.32-7.416-7.416-7.416zM12 6.174c-.096.075-.189.15-.28.231C10.156 7.764 9.169 9.765 9.169 12c0 2.236.987 4.236 2.551 5.595.09.08.185.158.28.232.096-.074.189-.152.28-.232 1.563-1.359 2.551-3.359 2.551-5.595 0-2.235-.987-4.236-2.551-5.595-.09-.08-.184-.156-.28-.231z"/></svg></div>
              <div class="fill-cyan-600 w-10 mr-2"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>American Express</title><path d="M16.015 14.378c0-.32-.135-.496-.344-.622-.21-.12-.464-.135-.81-.135h-1.543v2.82h.675v-1.027h.72c.24 0 .39.024.478.125.12.13.104.38.104.55v.35h.66v-.555c-.002-.25-.017-.376-.108-.516-.06-.08-.18-.18-.33-.234l.02-.008c.18-.072.48-.297.48-.747zm-.87.407l-.028-.002c-.09.053-.195.058-.33.058h-.81v-.63h.824c.12 0 .24 0 .33.05.098.048.156.147.15.255 0 .12-.045.215-.134.27zM20.297 15.837H19v.6h1.304c.676 0 1.05-.278 1.05-.884 0-.28-.066-.448-.187-.582-.153-.133-.392-.193-.73-.207l-.376-.015c-.104 0-.18 0-.255-.03-.09-.03-.15-.105-.15-.21 0-.09.017-.166.09-.21.083-.046.177-.066.272-.06h1.23v-.602h-1.35c-.704 0-.958.437-.958.84 0 .9.776.855 1.407.87.104 0 .18.015.225.06.046.03.082.106.082.18 0 .077-.035.15-.08.18-.06.053-.15.07-.277.07zM0 0v10.096L.81 8.22h1.75l.225.464V8.22h2.043l.45 1.02.437-1.013h6.502c.295 0 .56.057.756.236v-.23h1.787v.23c.307-.17.686-.23 1.12-.23h2.606l.24.466v-.466h1.918l.254.465v-.466h1.858v3.948H20.87l-.36-.6v.585h-2.353l-.256-.63h-.583l-.27.614h-1.213c-.48 0-.84-.104-1.08-.24v.24h-2.89v-.884c0-.12-.03-.12-.105-.135h-.105v1.036H6.067v-.48l-.21.48H4.69l-.202-.48v.465H2.235l-.256-.624H1.4l-.256.624H0V24h23.786v-7.108c-.27.135-.613.18-.973.18H21.09v-.255c-.21.165-.57.255-.914.255H14.71v-.9c0-.12-.018-.12-.12-.12h-.075v1.022h-1.8v-1.066c-.298.136-.643.15-.928.136h-.214v.915h-2.18l-.54-.617-.57.6H4.742v-3.93h3.61l.518.602.554-.6h2.412c.28 0 .74.03.942.225v-.24h2.177c.202 0 .644.045.903.225v-.24h3.265v.24c.163-.164.508-.24.803-.24h1.89v.24c.194-.15.464-.24.84-.24h1.176V0H0zM21.156 14.955c.004.005.006.012.01.016.01.01.024.01.032.02l-.042-.035zM23.828 13.082h.065v.555h-.065zM23.865 15.03v-.005c-.03-.025-.046-.048-.075-.07-.15-.153-.39-.215-.764-.225l-.36-.012c-.12 0-.194-.007-.27-.03-.09-.03-.15-.105-.15-.21 0-.09.03-.16.09-.204.076-.045.15-.05.27-.05h1.223v-.588h-1.283c-.69 0-.96.437-.96.84 0 .9.78.855 1.41.87.104 0 .18.015.224.06.046.03.076.106.076.18 0 .07-.034.138-.09.18-.045.056-.136.07-.27.07h-1.288v.605h1.287c.42 0 .734-.118.9-.36h.03c.09-.134.135-.3.135-.523 0-.24-.045-.39-.135-.526zM18.597 14.208v-.583h-2.235V16.458h2.235v-.585h-1.57v-.57h1.533v-.584h-1.532v-.51M13.51 8.787h.685V11.6h-.684zM13.126 9.543l-.007.006c0-.314-.13-.5-.34-.624-.217-.125-.47-.135-.81-.135H10.43v2.82h.674v-1.034h.72c.24 0 .39.03.487.12.122.136.107.378.107.548v.354h.677v-.553c0-.25-.016-.375-.11-.516-.09-.107-.202-.19-.33-.237.172-.07.472-.3.472-.75zm-.855.396h-.015c-.09.054-.195.056-.33.056H11.1v-.623h.825c.12 0 .24.004.33.05.09.04.15.128.15.25s-.047.22-.134.266zM15.92 9.373h.632v-.6h-.644c-.464 0-.804.105-1.02.33-.286.3-.362.69-.362 1.11 0 .512.123.833.36 1.074.232.238.645.31.97.31h.78l.255-.627h1.39l.262.627h1.36v-2.11l1.272 2.11h.95l.002.002V8.786h-.684v1.963l-1.18-1.96h-1.02V11.4L18.11 8.744h-1.004l-.943 2.22h-.3c-.177 0-.362-.03-.468-.134-.125-.15-.186-.36-.186-.662 0-.285.08-.51.194-.63.133-.135.272-.165.516-.165zm1.668-.108l.464 1.118v.002h-.93l.466-1.12zM2.38 10.97l.254.628H4V9.393l.972 2.205h.584l.973-2.202.015 2.202h.69v-2.81H6.118l-.807 1.904-.876-1.905H3.343v2.663L2.205 8.787h-.997L.01 11.597h.72l.26-.626h1.39zm-.688-1.705l.46 1.118-.003.002h-.915l.457-1.12zM11.856 13.62H9.714l-.85.923-.825-.922H5.346v2.82H8l.855-.932.824.93h1.302v-.94h.838c.6 0 1.17-.164 1.17-.945l-.006-.003c0-.78-.598-.93-1.128-.93zM7.67 15.853l-.014-.002H6.02v-.557h1.47v-.574H6.02v-.51H7.7l.733.82-.764.824zm2.642.33l-1.03-1.147 1.03-1.108v2.253zm1.553-1.258h-.885v-.717h.885c.24 0 .42.098.42.344 0 .243-.15.372-.42.372zM9.967 9.373v-.586H7.73V11.6h2.237v-.58H8.4v-.564h1.527V9.88H8.4v-.507"/></svg></div>
              <div class="fill-orange-500 w-10 mr-2"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Discover</title><path d="M14.58 12a2.023 2.023 0 1 1-2.025-2.023h.002c1.118 0 2.023.906 2.023 2.023zm-5.2-2.001c-1.124 0-2.025.884-2.025 1.99 0 1.118.878 1.984 2.007 1.984.319 0 .593-.063.93-.221v-.873c-.296.297-.559.416-.895.416-.747 0-1.277-.542-1.277-1.312 0-.73.547-1.306 1.243-1.306.354 0 .622.126.93.428v-.873a1.898 1.898 0 0 0-.913-.233zm-3.352 1.545c-.445-.165-.576-.273-.576-.479 0-.239.233-.422.553-.422.222 0 .405.091.598.308l.388-.508a1.665 1.665 0 0 0-1.117-.422c-.673 0-1.186.467-1.186 1.089 0 .524.239.792.936 1.043.291.103.438.171.513.217a.456.456 0 0 1 .222.394c0 .308-.245.536-.576.536-.354 0-.639-.177-.809-.507l-.479.461c.342.502.752.724 1.317.724.771 0 1.311-.513 1.311-1.249-.002-.603-.252-.876-1.095-1.185zM24 10.3a.29.29 0 0 1-.288.291.29.29 0 0 1-.291-.291v-.003A.29.29 0 1 1 24 10.3zm-.059.001a.235.235 0 0 0-.231-.239.234.234 0 0 0-.232.239c0 .132.104.239.232.239a.235.235 0 0 0 .231-.239zM3.472 13.887h.742v-3.803h-.742v3.803zm12.702-1.248l-1.014-2.554h-.81l1.614 3.9h.399l1.643-3.9h-.804l-1.028 2.554zm2.166 1.248h2.104v-.644h-1.362v-1.027h1.312v-.644h-1.312v-.844h1.362v-.644H18.34v3.803zm5.409-3.557l.11.138h-.097l-.094-.13v.13h-.08v-.334h.107c.081 0 .126.036.126.103.001.046-.025.08-.072.093zm-.006-.092c0-.029-.021-.043-.06-.043h-.014v.087h.014c.039 0 .06-.014.06-.044zm-1.228 2.047l1.197 1.602H22.8l-1.027-1.528h-.097v1.528h-.741v-3.803h1.1c.855 0 1.346.411 1.346 1.123 0 .583-.308.965-.866 1.078zm.103-1.038c0-.37-.251-.563-.713-.563h-.228v1.152h.217c.473-.001.724-.207.724-.589zm-19.487.742a1.91 1.91 0 0 1-.69 1.46c-.365.303-.781.439-1.357.439H.001v-3.803H1.09c1.202 0 2.041.781 2.041 1.904zm-.764-.006c0-.364-.154-.718-.411-.947-.245-.222-.536-.308-1.015-.308H.742v2.515h.199c.479 0 .782-.092 1.015-.302.256-.228.411-.593.411-.958z"/></svg></div>
            </div>

            <div class="mepr-payment-methods-radios<?php echo sizeof($payment_methods) === 1 ? ' mepr-hidden hidden' : ''; ?>">
              <?php echo MeprOptionsHelper::payment_methods_radios($payment_methods); ?>
            </div>

            <?php if(sizeof($payment_methods) > 1): ?>
              <hr />
            <?php endif; ?>

            <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	         PAYMENT FORM                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
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

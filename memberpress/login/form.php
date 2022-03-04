<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>


<div class="mp_wrapper mp_login_form text-white">
  <?php if(MeprUtils::is_user_logged_in()): ?>


  <?php
  // ┌─────────────────────────────────────────────────────────────────────────┐
  //
  //                 	              Logged in                              
  //
  // └─────────────────────────────────────────────────────────────────────────┘
  ?>


    <?php if(!isset($_GET['mepr-unauth-page']) && (!isset($_GET['action']) || $_GET['action'] != 'mepr_unauthorized')): ?>
      <?php if(is_page($login_page_id) && isset($redirect_to) && !empty($redirect_to)): ?>
        <script type="text/javascript">
          window.location.href="<?php echo urldecode($redirect_to); ?>";
        </script>
      <?php else: ?>
        <div class="mepr-already-logged-in">
          <?php printf(_x('You\'re already logged in. %1$sLogout.%2$s', 'ui', 'memberpress'), '<a href="'. wp_logout_url(urldecode($redirect_to)) . '">', '</a>'); ?>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <?php echo $message; ?>
    <?php endif; ?>


    <?php
  // ┌─────────────────────────────────────────────────────────────────────────┐
  //
  //                 	              Register                              
  //
  // └─────────────────────────────────────────────────────────────────────────┘
  ?>
  <?php else: ?>

      <?php
      // ┌─────────────────────────────────────────────────────────────────────────┐
      //                 	         Notification Messages                              
      // └─────────────────────────────────────────────────────────────────────────┘
      ?>
      <div class="w-2/3 m-auto drop-shadow-lg"><?php echo $message; ?></div>


      <?php
      // ┌─────────────────────────────────────────────────────────────────────────┐
      //                 	         Wrapper Box LEFT/RIGHT                              
      // └─────────────────────────────────────────────────────────────────────────┘
      ?>
      <div class="flex flex-row w-2/3 m-auto drop-shadow-lg font-thin border-8 border-black rounded-2xl">





          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //
          //                 	            LEFT                              
          //
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <div id="left" class="bg-amber-500 w-1/2 rounded-l-xl p-16">
            <?php
              // ┌─────────────────────────────────────────────────────────────────────────┐
              //                 	         Blurb                              
              // └─────────────────────────────────────────────────────────────────────────┘
              ?>
            <h2 class="text-zinc-100 mb-4 font-medium text-4xl">Parkour Syllabus</h2>
            <p class="text-zinc-800 leading-5">A central online facility for parkour students to watch, practice, learn and achieve amazing things.</p>

            <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            //                 	         Image                              
            // └─────────────────────────────────────────────────────────────────────────┘
            ?>
            <?php echo do_shortcode('[isometric_random count="1" classes="w-96 h-96 m-auto" default="/wp-content/uploads/Syllabus/Climbing/Splat/Splats-7.svg"]' );?>
          </div>





          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //
          //                 	            RIGHT                           
          //
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <div id="right" class="w-1/2 p-16 bg-zinc-700 rounded-r-xl">


          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          //                 	            Form                              
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
            <!-- mp-login-form-start --> <?php //DON'T GET RID OF THIS HTML COMMENT PLEASE IT'S USEFUL FOR SOME REGEX WE'RE DOING ?>
            <form name="mepr_loginform" id="mepr_loginform" class="mepr-form" action="<?php echo $login_url; ?>" method="post">


              <?php
              // ┌─────────────────────────────────────────────────────────────────────────┐
              //                 	         Tagline                              
              // └─────────────────────────────────────────────────────────────────────────┘
              ?>
              <h2 class="mb-4">Log into your Account</h2>
              <p class="text-zinc-500">Need to sign up? 
                <a href="/plans/signup/" class="text-blue-400 hover:underline cursor-pointer">Register here.</a>
              </p>

              <?php
              // ┌─────────────────────────────────────────────────────────────────────────┐
              //                 	         Username                              
              // └─────────────────────────────────────────────────────────────────────────┘
              ?>
                <div class="mp-form-row mepr_username mt-8">

                  <div class="mp-form-label">
                    <?php $uname_or_email_str = MeprHooks::apply_filters('mepr-login-uname-or-email-str', _x('Username or E-mail', 'ui', 'memberpress')); ?>
                    <?php $uname_str = MeprHooks::apply_filters('mepr-login-uname-str', _x('Username', 'ui', 'memberpress')); ?>
                    <label for="user_login"><?php echo ($mepr_options->username_is_email)?$uname_or_email_str:$uname_str; ?></label>
                    <?php /* <span class="cc-error"><?php _ex('Username Required', 'ui', 'memberpress'); ?></span> */ ?>
                  </div>

                  <input class="w-full p-4 text-xl text-amber-500 rounded" type="text" name="log" id="user_login" placeholder="name@email.com" value="<?php echo (isset($_REQUEST['log'])?esc_html($_REQUEST['log']):''); ?>" />
                </div>

                <?php
              // ┌─────────────────────────────────────────────────────────────────────────┐
              //                 	         Password                              
              // └─────────────────────────────────────────────────────────────────────────┘
              ?>
                <div class="mp-form-row mepr_password mt-4">
                  <div class="mp-form-label flex flex-row w-full">
                    <label class="" for="user_pass"><?php _ex('Password', 'ui', 'memberpress'); ?></label>

                    <?php
                      // ┌─────────────────────────────────────────────────────────────────────────┐
                      //                 	          Forgot Password Link                              
                      // └─────────────────────────────────────────────────────────────────────────┘
                      ?>
                      <a class="ml-auto text-blue-400 hover:underline cursor-pointer" href="<?php echo $forgot_password_url; ?>"><?php _ex('Forgot Password?', 'ui', 'memberpress'); ?></a>
                  </div>

                      


                    <?php /* <span class="cc-error"><?php _ex('Password Required', 'ui', 'memberpress'); ?></span> */ ?>
                    <div class="mp-hide-pw">
                      <input class="w-full p-4 text-xl text-amber-500 rounded" type="password" name="pwd" id="user_pass" value="" />
                    </div>


                </div>

                <?php
                // ┌─────────────────────────────────────────────────────────────────────────┐
                //                 	          ACTION                              
                // └─────────────────────────────────────────────────────────────────────────┘
                ?>
                <?php MeprHooks::do_action('mepr-login-form-before-submit'); ?>

                <?php
                // ┌─────────────────────────────────────────────────────────────────────────┐
                //                 	          Remember me                              
                // └─────────────────────────────────────────────────────────────────────────┘
                ?>
                <div class="mt-4">
                  <label><input name="rememberme" type="checkbox" id="rememberme" value="forever"<?php checked(isset($_REQUEST['rememberme'])); ?> /> <?php _ex('Remember Me', 'ui', 'memberpress'); ?></label>
                </div>

                <?php
                // ┌─────────────────────────────────────────────────────────────────────────┐
                //                 	 Submit button + hidden fields                            
                // └─────────────────────────────────────────────────────────────────────────┘
                ?>
                <div class="submit mt-8">
                  <input type="submit" name="wp-submit" class="w-full bg-amber-500 text-white text-xl text-center p-4 rounded-2xl hover:bg-zinc-800 hover:text-amber-500 cursor-pointer" id="wp-submit" class="button-primary mepr-share-button " value="<?php _ex('Login', 'ui', 'memberpress'); ?>" />
                  <input type="hidden" name="redirect_to" value="<?php echo esc_html($redirect_to); ?>" />
                  <input type="hidden" name="mepr_process_login_form" value="true" />
                  <input type="hidden" name="mepr_is_login_page" value="<?php echo ($is_login_page)?'true':'false'; ?>" />
                </div>
              </form>


              <!-- mp-login-form-end --> <?php //DON'T GET RID OF THIS HTML COMMENT PLEASE IT'S USEFUL FOR SOME REGEX WE'RE DOING ?>
        </div>
      </div>

  <?php endif; ?>
</div>
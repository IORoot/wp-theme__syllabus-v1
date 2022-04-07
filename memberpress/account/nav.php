<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>

<?php
  // ┌─────────────────────────────────────────────────────────────────────────┐
  // │                	          Navigation Tabs                              │
  // └─────────────────────────────────────────────────────────────────────────┘
  ?>
<div class="mp_wrapper w-1/6 max-w-md min-h-screen min-w-fit bg-zinc-900 text-zinc-100 p-4 pt-24">

  <div id="mepr-account-nav" class="flex flex-col">

    <div class="mepr-nav-item py-2 <?php MeprAccountHelper::active_nav('home'); ?>">
      <a class="hover:text-emerald-400 font-thin" href="<?php echo MeprHooks::apply_filters('mepr-account-nav-home-link',$account_url.$delim.'action=home'); ?>" id="mepr-account-home"><?php echo MeprHooks::apply_filters('mepr-account-nav-home-label',_x('Account', 'ui', 'memberpress')); ?></a>
    </div>

    <div class="mepr-nav-item py-2 <?php MeprAccountHelper::active_nav('subscriptions'); ?>">
      <a class="hover:text-emerald-400 font-thin" href="<?php echo MeprHooks::apply_filters('mepr-account-nav-subscriptions-link',$account_url.$delim.'action=subscriptions'); ?>" id="mepr-account-subscriptions"><?php echo MeprHooks::apply_filters('mepr-account-nav-subscriptions-label',_x('Subscriptions', 'ui', 'memberpress')); ?></a>
    </div>

    <div class="mepr-nav-item py-2 <?php MeprAccountHelper::active_nav('payments'); ?>">
      <a class="hover:text-emerald-400 font-thin" href="<?php echo MeprHooks::apply_filters('mepr-account-nav-payments-link',$account_url.$delim.'action=payments'); ?>" id="mepr-account-payments"><?php echo MeprHooks::apply_filters('mepr-account-nav-payments-label',_x('Payments', 'ui', 'memberpress')); ?></a>
    </div>

    <div class="mepr-nav-item py-2 mepr-account-change-password">
      <a class="hover:text-emerald-400 font-thin" href="<?php echo $account_url.$delim.'action=newpassword'; ?>"><?php _ex('Change Password', 'ui', 'memberpress'); ?></a>
    </div>

    <?php MeprHooks::do_action('mepr_account_nav', $mepr_current_user); ?>

    <div class="mepr-nav-item py-2">
      <a class="hover:text-emerald-400 font-thin" href="<?php echo MeprUtils::logout_url(); ?>" id="mepr-account-logout"><?php _ex('Logout', 'ui', 'memberpress'); ?></a>
    </div>

  </div>
</div>

<?php
  // ┌─────────────────────────────────────────────────────────────────────────┐
  // │                	      Subscription Error Message                       │
  // └─────────────────────────────────────────────────────────────────────────┘
  ?>
<?php
if(isset($expired_subs) and !empty($expired_subs) && (empty($_GET['action']) || $_GET['action'] != 'update')) {
  $sub_label = MeprHooks::apply_filters('mepr-account-nav-subscriptions-label',_x('Subscriptions', 'ui', 'memberpress'));
  $delim = preg_match('#\?#',$account_url) ? '&' : '?';
  $errors = array(sprintf(_x('You have a problem with one or more of your %1$s. To prevent any lapses in your %1$s please visit your %2$s%3$s%4$s page to update them.', 'ui', 'memberpress'),strtolower($sub_label),'<a href="'.$account_url.$delim.'action=subscriptions">',$sub_label,'</a>'));
  MeprView::render('/shared/errors', get_defined_vars());
}
<?php
if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}

/*
* ┌─────────────────────────────────────────────────────────────────────────┐
* │                                                                         │
* │                   REPLACE THE ORIGINAL MEMBERPRESS                      │
* │                   FUNCTION WITH THIS ONE, SO WE CAN                     │
* │                   CONTROL THE CLASSES AND OUTPUT.                       │
* │                                                                         │
* └─────────────────────────────────────────────────────────────────────────┘
*/
class MeprBaseGateway_v2 {

  public $pm;

  public function add_original_pm($pm)
  {
    $this->pm = $pm;
  }

  /** Returns true if a capability exists ... false if not */
  public function can($cap) {
    return in_array(trim($cap),$this->pm->capabilities);
  }
  
  /** This displays the subscription row buttons on the user account page. Can be overridden if necessary.
    */
  public function print_user_account_subscription_row_actions($subscription) {
    global $post;

    $mepr_options = MeprOptions::fetch();
    // $subscription = new MeprSubscription($sub_id);
    $product = new MeprProduct($subscription->product_id);

    // Assume we're either on the account page or some
    // page that is using the [mepr-account-form] shortcode
    $account_url   = MeprUtils::get_current_url_without_params(); //MeprUtils::get_permalink($post->ID);
    $account_delim = ( preg_match( '~\?~', $account_url ) ? '&' : '?' );
    $user = $subscription->user();
    $hide_update_link = false;

    ?>
    <?php /* <div class="mepr-account-row-actions"> */ ?>
      <?php if( $subscription->status != MeprSubscription::$pending_str ): ?>

        <?php
          /*
          * ┌─────────────────────────────────────────────────────────────────────────┐
          * │                          UPDATE BUTTON                                  │
          * └─────────────────────────────────────────────────────────────────────────┘
          */
          ?>
        <?php if($subscription->status != MeprSubscription::$cancelled_str && !$hide_update_link): ?>
          <a href="<?php echo $this->https_url("{$account_url}{$account_delim}action=update&sub={$subscription->id}"); ?>" class="mepr-account-row-action mepr-account-update bg-zinc-600 text-zinc-400 rounded px-2 text-center hover:bg-emerald-500 hover:text-white"><?php _e('Update Card', 'memberpress'); ?></a>
        <?php endif; ?>


        <?php
          /*
          * ┌─────────────────────────────────────────────────────────────────────────┐
          * │                             NEW PLAN MODAL                              │
          * └─────────────────────────────────────────────────────────────────────────┘
          */
          ?>
        <?php if(($grp = $product->group()) && count($grp->products('ids')) > 1 && count($grp->buyable_products()) >= 1): //Can't upgrade to no other options ?>
          <div id="mepr-upgrade-sub-<?php echo $subscription->id; ?>" class="mepr-white-popup mfp-hide rounded-xl">
            <center>
              <div class="mepr-upgrade-sub-text">
                <?php _e('Please select a new plan', 'memberpress'); ?>
              </div>
              <br/>
              <div>
                <select id="mepr-upgrade-dropdown-<?php echo $subscription->id; ?>" class="mepr-upgrade-dropdown bg-zinc-200 p-4 border-r-8 border-zinc-200 rounded">
                  <?php foreach($grp->products() as $p): ?>
                    <?php if($p->can_you_buy_me()): ?>
                      <option value="<?php echo $p->url(); ?>"><?php printf('%1$s (%2$s)', $p->post_title, MeprProductsHelper::product_terms($p, $user)); ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
              <br/>
              <div class="mepr-cancel-sub-buttons flex flex-row justify-center gap-2">
                <button class="mepr-btn mepr-upgrade-buy-now px-4 py-2 " data-id="<?php echo $subscription->id; ?>"><?php _e('Select Plan', 'memberpress'); ?></button>
                <button class="mepr-btn mepr-upgrade-cancel px-4 py-2 "><?php _e('Cancel', 'memberpress'); ?></button>
              </div>
            </center>
          </div>
          <?php ob_start(); ?>

          <?php
          /*
          * ┌─────────────────────────────────────────────────────────────────────────┐
          * │                         Re-Subscribe BUTTON                             │
          * └─────────────────────────────────────────────────────────────────────────┘
          */
          ?>
          <?php
            if($product->simultaneous_subscriptions && $subscription->is_active() && $subscription->is_cancelled()) {
              MeprAccountHelper::purchase_link($product, _x('Re-Subscribe', 'ui', 'memberpress'));
            }
          ?>

          <?php
          /*
          * ┌─────────────────────────────────────────────────────────────────────────┐
          * │                     OTHER MEMBERSHIPS BUTTON                            │
          * └─────────────────────────────────────────────────────────────────────────┘
          */
          ?>
          <?php $upgrade_label = ($grp->is_upgrade_path ? __('Change Plan', 'memberpress') : __('Other Memberships', 'memberpress')); ?>
          <?php if(!$grp->disable_change_plan_popup): ?>
            <a href="#mepr-upgrade-sub-<?php echo $subscription->id; ?>" class="mepr-open-upgrade-popup mepr-account-row-action mepr-account-upgrade bg-zinc-600 text-zinc-400 rounded px-2 text-center hover:bg-amber-500 hover:text-white"><?php echo $upgrade_label; ?></a>
          <?php else: ?>
            <a href="<?php echo $grp->url(); ?>" class="mepr-account-row-action mepr-account-upgrade bg-zinc-600 text-zinc-400 rounded px-2 text-center hover:bg-amber-500 hover:text-white"><?php echo $upgrade_label; ?></a>
          <?php endif; ?>
          <?php echo MeprHooks::apply_filters('mepr_custom_upgrade_link', ob_get_clean(), $subscription); ?>
        <?php endif; ?>

        <?php
          /*
          * ┌─────────────────────────────────────────────────────────────────────────┐
          * │                          SUSPEND BUTTON                                 │
          * └─────────────────────────────────────────────────────────────────────────┘
          */
          ?>
        <?php if( $mepr_options->allow_suspend_subs and
                  $this->can('suspend-subscriptions') and
                  $subscription->status == MeprSubscription::$active_str and
                  !$subscription->in_free_trial() ): ?>

          <?php ob_start(); ?>
            <a href="<?php echo "{$account_url}{$account_delim}action=suspend&sub={$subscription->id}"; ?>" class="mepr-account-row-action mepr-account-suspend" onclick="return confirm('<?php _e('Are you sure you want to pause this subscription?', 'memberpress'); ?>');"><?php _e('Pause', 'memberpress'); ?></a>
          <?php echo MeprHooks::apply_filters('mepr_custom_pause_link', ob_get_clean(), $subscription); ?>


        <?php elseif( $mepr_options->allow_suspend_subs and
                      $this->can('suspend-subscriptions') and
                      $subscription->status==MeprSubscription::$suspended_str ): ?>
                      
          <div id="mepr-resume-sub-<?php echo $subscription->id; ?>" class="mepr-white-popup mfp-hide">
            <div class="mepr-resume-sub-text">
              <?php _e('Are you sure you want to resume this subscription?', 'memberpress'); ?>
            </div>
            <button class="mepr-btn mepr-left-margin mepr-confirm-yes" data-url="<?php echo "{$account_url}{$account_delim}action=resume&sub={$subscription->id}"; ?>"><?php _e('Yes', 'memberpress'); ?></button>
            <button class="mepr-btn mepr-confirm-no"><?php _e('No', 'memberpress'); ?></button>
          </div>

          <?php ob_start(); ?>
            <a href="#mepr-resume-sub-<?php echo $subscription->id; ?>" class="mepr-open-resume-confirm mepr-account-row-action mepr-account-resume"><?php _e('Resume', 'memberpress'); ?></a>
          <?php echo MeprHooks::apply_filters('mepr_custom_resume_link', ob_get_clean(), $subscription); ?>

        <?php endif; ?>


        <?php
          /*
          * ┌─────────────────────────────────────────────────────────────────────────┐
          * │                          CANCEL BUTTON MODAL                            │
          * └─────────────────────────────────────────────────────────────────────────┘
          */
          ?>
        <?php if($mepr_options->allow_cancel_subs and $this->can('cancel-subscriptions') && $subscription->status == MeprSubscription::$active_str): ?>
          <div id="mepr-cancel-sub-<?php echo $subscription->id; ?>" class="mepr-white-popup mfp-hide rounded bg-zinc-200">
            <div class="mepr-cancel-sub-text">
              <?php _e('Are you sure you want to cancel this subscription?', 'memberpress'); ?>
            </div>
            <div class="mepr-cancel-sub-buttons">
              <button class="mepr-btn mepr-left-margin mepr-confirm-yes bg-white hover:bg-red-500" data-url="<?php echo "{$account_url}{$account_delim}action=cancel&sub={$subscription->id}"; ?>"><?php _e('Yes', 'memberpress'); ?></button>
              <button class="mepr-btn mepr-confirm-no bg-white hover:bg-green-500"><?php _e('No', 'memberpress'); ?></button>
            </div>
          </div>
          <?php ob_start(); ?>
            <a href="#mepr-cancel-sub-<?php echo $subscription->id; ?>" class="mepr-open-cancel-confirm mepr-account-row-action mepr-account-cancel bg-zinc-600 text-zinc-400 rounded px-2 text-center hover:bg-cyan-500 hover:text-white"><?php _e('Cancel Membership', 'memberpress'); ?></a>
          <?php echo MeprHooks::apply_filters('mepr_custom_cancel_link', ob_get_clean(), $subscription); ?>
        <?php endif; ?>
      <?php endif; ?>
    <?php /* </div> */ ?>
    <?php
  }

  protected function https_url($url) {
    return true ? preg_replace('!^https?:!','https:',$url) : $url;
  }

}
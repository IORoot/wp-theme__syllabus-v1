<?php
if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}

if(!empty($payments)) {
  ?>
  <div class="mp_wrapper flex flex-1 flex-col p-4 pt-24 text-zinc-100">

      <div class="mp_wrapper overflow-hidden rounded-lg">

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                                TABLE                                    │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <table id="mepr-account-payments-table" class="mepr-account-table m-auto w-full text-left px-6 py-4">

          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          // │                             TABLE HEAD                                  │
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <thead class="bg-zinc-700 font-normal">
            <tr>
              <th class="p-4 border-zinc-600 border-r font-thin"><?php _ex('Date', 'ui', 'memberpress'); ?></th>
              <th class="p-4 border-zinc-600 border-r font-thin"><?php _ex('Total', 'ui', 'memberpress'); ?></th>
              <th class="p-4 border-zinc-600 border-r font-thin"><?php _ex('Membership', 'ui', 'memberpress'); ?></th>
              <th class="p-4 border-zinc-600 border-r font-thin"><?php _ex('Method', 'ui', 'memberpress'); ?></th>
              <th class="p-4 border-zinc-600 border-r font-thin"><?php _ex('Status', 'ui', 'memberpress'); ?></th>
              <th class="p-4 border-zinc-600 font-thin"><?php _ex('Invoice #', 'ui', 'memberpress'); ?></th>

              <?php MeprHooks::do_action('mepr_account_payments_table_header'); ?>
            </tr>
          </thead>



          <?php
          // ┌─────────────────────────────────────────────────────────────────────────┐
          // │                             TABLE BODY                                  │
          // └─────────────────────────────────────────────────────────────────────────┘
          ?>
          <tbody class="bg-zinc-900">
            <?php

              /*
              * ┌─────────────────────────────────────────────────────────────────────────┐
              * │                              PAYMENTS LOOP                              │
              * └─────────────────────────────────────────────────────────────────────────┘
              */
              foreach($payments as $payment):
                $alt    = (isset($alt) && !$alt);
                $txn    = new MeprTransaction($payment->id);
                $pm     = $txn->payment_method();
                $prd    = $txn->product();
                $svg    = get_field('svg', $prd->rec->ID);     // ACF Field
                $colour = get_field('colour', $prd->rec->ID);  // ACF Field
            ?>
                <?php
                // ┌─────────────────────────────────────────────────────────────────────────┐
                // │                                ROWS                                     │
                // └─────────────────────────────────────────────────────────────────────────┘
                ?>
                <tr class="mepr-payment-row text-xl border-t border-zinc-700 <?php echo ($alt)?'mepr-alt-row':''; ?>">

                  <?php
                  // ┌─────────────────────────────────────────────────────────────────────────┐
                  // │                            DATA : DATE                                  │
                  // └─────────────────────────────────────────────────────────────────────────┘
                  ?>
                  <td class="p-4" data-label="<?php _ex('Date', 'ui', 'memberpress'); ?>"><?php echo MeprAppHelper::format_date($payment->created_at); ?></td>
                  
                  <?php
                  // ┌─────────────────────────────────────────────────────────────────────────┐
                  // │                            DATA : TOTAL                                 │
                  // └─────────────────────────────────────────────────────────────────────────┘
                  ?>
                  <td class="p-4" data-label="<?php _ex('Total', 'ui', 'memberpress'); ?>"><?php echo MeprAppHelper::format_currency( $payment->total <= 0.00 ? $payment->amount : $payment->total ); ?></td>

                  <?php
                  // ┌─────────────────────────────────────────────────────────────────────────┐
                  // │                            DATA : MEMBERESHIP                           │
                  // └─────────────────────────────────────────────────────────────────────────┘
                  ?>
                  <?php if(isset($prd->access_url) && empty($prd->access_url)): ?>
                    <td class="p-4" data-label="<?php _ex('Membership', 'ui', 'memberpress'); ?>">
                      <a class="text-amber-500" href="<?php echo stripslashes($prd->access_url); ?>">
                        <div class="flex flex-row gap-4">
                          <div class="w-7 h-7 bg-<?php echo $colour; ?> fill-black"> <?php echo $svg; ?> </div>
                          <div class="text-<?php echo $colour; ?>"><?php echo MeprHooks::apply_filters('mepr-account-payment-product-name', $prd->post_title, $txn); ?></div>
                        </div>
                      </a>
                    </td>
                  <?php else: ?>
                    <td class="p-4" data-label="<?php _ex('Membership', 'ui', 'memberpress'); ?>">
                      <div class="flex flex-row gap-4">
                        <div class="w-7 h-7 bg-<?php echo $colour; ?> fill-black"> <?php echo $svg; ?> </div>
                        <div class="text-<?php echo $colour; ?>"><?php echo MeprHooks::apply_filters('mepr-account-payment-product-name', $prd->post_title, $txn); ?></div>
                      </div>
                      </td>
                  <?php endif; ?>

                  <?php
                  // ┌─────────────────────────────────────────────────────────────────────────┐
                  // │                            DATA : METHOD                                │
                  // └─────────────────────────────────────────────────────────────────────────┘
                  ?>
                  <td class="p-4" data-label="<?php _ex('Method', 'ui', 'memberpress'); ?>"><?php echo (is_object($pm)?$pm->label:_x('Unknown', 'ui', 'memberpress')); ?></td>
                  
                  <?php
                  // ┌─────────────────────────────────────────────────────────────────────────┐
                  // │                            DATA : STATUS                                │
                  // └─────────────────────────────────────────────────────────────────────────┘
                  ?>
                  <td class="p-4" data-label="<?php _ex('Status', 'ui', 'memberpress'); ?>"><?php echo MeprAppHelper::human_readable_status($payment->status); ?></td>
                
                  <?php
                  // ┌─────────────────────────────────────────────────────────────────────────┐
                  // │                            DATA : INVOICE #                             │
                  // └─────────────────────────────────────────────────────────────────────────┘
                  ?>
                  <td class="p-4 " data-label="<?php _ex('Invoice', 'ui', 'memberpress'); ?>"><div class="bg-zinc-500 text-zinc-300 px-2 rounded inline-block"><?php echo $payment->trans_num; ?></div></td>

                  <?php
                  // ┌─────────────────────────────────────────────────────────────────────────┐
                  // │                                ACTION                                   │
                  // └─────────────────────────────────────────────────────────────────────────┘
                  ?>
                  <?php MeprHooks::do_action('mepr_account_payments_table_row',$payment); ?>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div id="mepr-payments-paging">
          <?php if($prev_page): ?>
            <a href="<?php echo $account_url.$delim.'currpage='.$prev_page; ?>">&lt;&lt; <?php _ex('Previous Page', 'ui', 'memberpress'); ?></a>
          <?php endif; ?>
          <?php if($next_page): ?>
            <a href="<?php echo $account_url.$delim.'currpage='.$next_page; ?>" style="float:right;"><?php _ex('Next Page', 'ui', 'memberpress'); ?> &gt;&gt;</a>
          <?php endif; ?>
        </div>
        <div style="clear:both"></div>
      </div>
  </div>
  <?php
}
else {
  ?><div class="mp-wrapper mp-no-subs"><?php
    _ex('You have no completed payments to display.', 'ui', 'memberpress');
  ?></div><?php
}

MeprHooks::do_action('mepr_account_payments', $mepr_current_user);
<?php

class MeprGroupsHelper_v2 {

  public static function get_existing_products_list($group) {
    $products = $group->products();
    if(!empty($products)) {
      foreach($products as $index => $prd):
        ?>
        <li class="product-item">
          <?php self::get_products_dropdown($prd->ID); ?>
          <span class="remove-span">
            <a href="" class="remove-product-item" title="Remove Membership"><i class="mp-icon mp-icon-cancel-circled mp-16"></i></a>
          </span>
        </li>
        <?php
      endforeach;
    }
    else {
    ?>
      <li class="product-item">
        <?php self::get_products_dropdown(); ?>
        <span class="remove-span">
          <a href="" class="remove-product-item" title="Remove Membership"><i class="mp-icon mp-icon-cancel-circled mp-16"></i></a>
        </span>
      </li>
    <?php
    }
  }




  public static function theme_dropdown($selected = null) {
    $themes = MeprGroup::group_themes();
    ?>
    <select name="<?php echo MeprGroup::$group_theme_str; ?>" class="group_theme_dropdown">
      <?php
      foreach($themes as $theme) {
        $css = basename($theme);
        $name = preg_replace('#\.css$#', '', $css);
        $name = ucwords(preg_replace('#_#', ' ', $name));
        ?>
        <option value="<?php echo $css; ?>" <?php selected($css, $selected) ?>><?php echo $name; ?></option>
        <?php
      }
      ?>
      <option value="custom" <?php selected('custom', $selected) ?>><?php _e('None / Custom', 'memberpress'); ?></option>
    </select>
    <?php
  }




  public static function get_products_dropdown($chosen = null) {
    $products = MeprCptModel::all('MeprProduct');
    ?>
      <select name="<?php echo MeprGroup::$products_str; ?>[product][]" class="group_products_dropdown">
        <?php foreach($products as $p): ?>
          <option value="<?php echo $p->ID; ?>" <?php selected($p->ID, $chosen) ?>><?php echo $p->post_title; ?></option>
        <?php endforeach; ?>
      </select>
    <?php
  }




  public static function get_product_fallback_dropdown($group) {
    $products = $group->products();
    $selected = $group->fallback_membership;
    ?>
      <select name="<?php echo MeprGroup::$fallback_membership_str; ?>" class="group_theme_dropdown">
        <option value="" <?php selected('', $selected) ?>><?php echo _e('Default', 'memberpress'); ?></option>
        <?php foreach($products as $p): ?>
          <option value="<?php echo $p->ID; ?>" <?php selected($p->ID, $selected) ?>><?php echo $p->post_title; ?></option>
        <?php endforeach; ?>
      </select>
    <?php
  }




// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                          A Membership Item                              │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
  public static function group_page_item($product, $group = null, $preview = false) {
    ob_start();
    if($group === null) { $group = new MeprGroup(); }

    // ┌─────────────────────────────────────────────────────────────────────────┐
    //                                  Variables                   
    // └─────────────────────────────────────────────────────────────────────────┘    
    $user = MeprUtils::get_currentuserinfo(); //If not logged in, $user will be false
    $active = true; //Always true for now - that way users can click the button and see the custom "you don't have access" message now
    $group_classes_str = ($product->is_highlighted) ? 'highlighted' : '';
    $group_classes_str = MeprHooks::apply_filters('mepr-group-css-classes-string', $group_classes_str, $product, $group, $preview);

    ?>

    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    //                                  Item                   
    // └─────────────────────────────────────────────────────────────────────────┘ 
    ?>
    <div id="mepr-price-box-<?php echo $product->ID; ?>" class="mepr-price-box bg-zinc-200 p-4 flex-1 rounded-xl flex flex-col gap-4 <?php echo $group_classes_str; ?>">

      <?php
      // ┌─────────────────────────────────────────────────────────────────────────┐
      //                                  HEAD                   
      // └─────────────────────────────────────────────────────────────────────────┘ 
      ?>
      <div class="mepr-price-box-head text-center bg-zinc-800 text-white p-4 rounded-2xl">

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                                  GLYPH                   
        // └─────────────────────────────────────────────────────────────────────────┘ 
        ?>  
        <?php echo get_field('svg', $product->rec->ID); ?>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                                  TITLE
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <div class="mepr-price-box-title text-4xl my-4"><?php echo $product->pricing_title; ?></div>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                                  PRICE
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <?php if($preview): ?>
          <div class="mepr-price-box-price"></div>
          <span class="mepr-price-box-price-loading"><img src="<?php echo admin_url('/images/wpspin_light.gif'); ?>"/></span>
        <?php elseif($product->pricing_display!=='none'): ?>
          <div class="mepr-price-box-price font-thin text-xl block bg-zinc-700 p-2 rounded-xl mt-8">
          <?php
            if(!isset($mepr_coupon_code) || !MeprCoupon::is_valid_coupon_code($mepr_coupon_code, $product->ID)) {
              $mepr_coupon_code=null;
            }

            if($product->pricing_display == 'auto') {
              echo MeprProductsHelper::format_currency($product, true, $mepr_coupon_code, false);
            }
            else {
              echo $product->custom_price;
            }
          ?>
          </div>
        <?php endif; ?>
        <?php if(!empty($product->pricing_heading_txt)): ?>
          <div class="mepr-price-box-heading"><?php echo $product->pricing_heading_txt; ?></div>
        <?php endif; ?>
        <?php
          if(in_array($product->pricing_button_position, array('header','both'))) {
            echo self::price_box_button($user, $group, $product, $active);
          }
        ?>
      </div>

      <?php
      // ┌─────────────────────────────────────────────────────────────────────────┐
      //                               SIGN UP BUTTON                   
      // └─────────────────────────────────────────────────────────────────────────┘ 
      ?>
      <div class="mepr-price-box-foot ">
        <div class="mepr-price-box-footer"><?php echo $product->pricing_footer_txt; ?></div>
        <?php
          if(in_array($product->pricing_button_position, array('footer','both'))) {
            echo self::price_box_button($user, $group, $product, $active);
          }
        ?>
      </div>
    

      <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        //                                  Benefits                   
        // └─────────────────────────────────────────────────────────────────────────┘
        $benefits = '';
        if(!empty($product->pricing_benefits)) {
          $benefits = '<table class="mepr-price-box-benefits-list w-full font-thin text-xl"><tbody>';
          foreach($product->pricing_benefits as $index => $b) {

            $class = 'fill-emerald-500';
            $svg = '';
            // Check if string starts with ! - which means negate it and display as
            // NOT a benefit you get.
            if(str_starts_with($b, '!')){
              $b = substr($b, 1);
              $class="fill-zinc-300 text-zinc-400";
              $svg = '<div class="w-6 h-6 mr-2"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z"/></svg></div>';
            }
            if ( '' !== trim( $b ) ) {
              $benefits .= '<tr class="block py-2 '.$class.'">';
                $benefits .= '<td class="mepr-price-box-benefits-item flex flex-row">';
                    $benefits .= $svg;
                    $benefits .= MeprHooks::apply_filters('mepr_price_box_benefit',$b,$index);
                $benefits .= '</td>';

              $benefits .= '</tr>';
            }
          }
          $benefits .= '</tbody></table>';
        }
      ?>
      <div class="mepr-price-box-benefits"><?php echo $benefits; ?></div>

    </div>
    <?php
    $output = ob_get_clean();
    echo MeprHooks::apply_filters('mepr-group-page-item-output', $output, $product, $group, $preview);
  }





  public static function price_box_button_classes( $grp, $prd, $active ) {
    $bc = '';

    if( $prd->is_highlighted ) {
      $bc .= $grp->page_button_highlighted_class;
    }
    else {
      $bc .= $grp->page_button_class;
    }

    if( !$active ) {
      $bc .= " mepr-disabled {$grp->page_button_disabled_class}";
    }

    return trim( $bc );
  }




  public static function price_box_button($user, $group, $product, $active) {
    ob_start();

    ?>
    <div class="mepr-price-box-button ">
      <?php
        //All this logic is for showing a "VIEW" button instead of "Buy Now" if the member has already purchased it
        //and the membership access URL is set for that membership - and you can't buy the same membership more than once
        if( $user && !$product->simultaneous_subscriptions &&
            $user->is_already_subscribed_to($product->ID) &&
            !empty($product->access_url) ):
        ?>
          <a <?php echo 'href="'.$product->access_url.'"'; ?> class="text-center bg-green-500 py-4 rounded-lg block text-white text-2xl hover:bg-cyan-500 hover:text-zinc-50 <?php echo self::price_box_button_classes($group, $product, true); ?>">
          <svg class="w-6 h-8 pb-1 fill-white inline" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17,3H14V6H10V3H7A2,2 0 0,0 5,5V21A2,2 0 0,0 7,23H17A2,2 0 0,0 19,21V5A2,2 0 0,0 17,3M12,8A2,2 0 0,1 14,10A2,2 0 0,1 12,12A2,2 0 0,1 10,10A2,2 0 0,1 12,8M16,16H8V15C8,13.67 10.67,13 12,13C13.33,13 16,13.67 16,15V16M13,5H11V1H13V5M16,19H8V18H16V19M12,21H8V20H12V21Z"/></svg>
            <?php _e('View', 'memberpress'); ?>
          </a>
      <?php else: ?>
          <a <?php echo $active ? 'href="'.$product->url().'"' : ''; ?> class="text-center bg-green-500 py-4 rounded-lg block text-white text-2xl hover:bg-cyan-500 hover:text-zinc-50 <?php echo self::price_box_button_classes($group, $product, $active); ?>">
          <svg class="w-6 h-8 pb-1 fill-white inline" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17,3H14V6H10V3H7A2,2 0 0,0 5,5V21A2,2 0 0,0 7,23H17A2,2 0 0,0 19,21V5A2,2 0 0,0 17,3M12,8A2,2 0 0,1 14,10A2,2 0 0,1 12,12A2,2 0 0,1 10,10A2,2 0 0,1 12,8M16,16H8V15C8,13.67 10.67,13 12,13C13.33,13 16,13.67 16,15V16M13,5H11V1H13V5M16,19H8V18H16V19M12,21H8V20H12V21Z"/></svg>
            <?php echo $product->pricing_button_txt; ?>
          </a>
      <?php endif; ?>
    </div>
    <?php

    return ob_get_clean();
  }
} //End class

new MeprGroupsHelper_v2;
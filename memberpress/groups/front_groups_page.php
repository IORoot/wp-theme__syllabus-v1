<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>

<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                Override the default memberpress class                   │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
include(get_template_directory() . '/memberpress/helpers/MeprGroupsHelper_v2.php');
?>

<?php
  $products       = $group->products();
  $group_theme    = preg_replace('~\.css$~', '', (is_null($theme) ? $group->group_theme : $theme));
  $group_template = $group->group_template();
?>


<div class="mepr-price-menu m-auto mb-20 bg-zinc-700 w-3/4 p-8 rounded-xl <?php echo $group_theme; ?> <?php echo $group_template; ?> ">
  <div class="mepr-price-boxes mepr-<?php echo count($products); ?>-col flex flex-row gap-8 ">
  <?php
    if(!empty($products)) {
      foreach($products as $product) {
        MeprGroupsHelper_v2::group_page_item($product, $group);
      }
    }
  ?>
  </div>
</div>
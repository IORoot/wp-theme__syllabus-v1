<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                	        Output User Message                            │
// └─────────────────────────────────────────────────────────────────────────┘
?>

<?php if( !empty($mepr_current_user->user_message) ): ?>
    <div id="mepr-account-user-message" class="p-4 rounded-xl bg-amber-500 text-zinc-900 mb-4">
        <?php echo MeprHooks::apply_filters('mepr-user-message', wpautop(do_shortcode($mepr_current_user->user_message)), $mepr_current_user); ?>
    </div>
<?php endif; ?>

<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                 Output the /shared/errors.php file                      │
// └─────────────────────────────────────────────────────────────────────────┘
?>
<?php MeprView::render('/shared/errors', get_defined_vars()); ?>
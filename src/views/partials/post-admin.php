<?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                		        THE ACF FORM                             │
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
<div class="flex flex-wrap gap-4 bg-zinc-700 rounded-xl p-4">
<?php
    acf_form([
        'fields' => [
            'filming_location',
            'specific_location',
            'filming_notes',
            'filmed',
        ],
        'post_title' => true,
        'post_content' => true,
        'html_submit_button'  => '<input type="submit" class="acf-button bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded" value="%s" />',
        'html_before_fields' => '<div class="text-emerald-500 mb-12">',
        'html_after_fields' => '</div>',
        'form_attributes' => [
            'class' => 'acf-form w-full',
        ],
    ]);
?>
</div>

<?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                		        FORM STYLING                             │
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
<style>
    .acf-form { margin-bottom: 1rem; }

    .acf-form .acf-field { margin-bottom: 1rem; }
    
    .acf-form select,
    .acf-form textarea,
    .acf-form input[type=text] { padding: 1rem; width:100%; }
    
    .acf-form .acf-field label { color: #fbbf24}

</style>
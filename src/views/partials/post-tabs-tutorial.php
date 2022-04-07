<div class="content-tabs bg-zinc-700 p-10 rounded-xl">
	

    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                		        RADIO TABS                               │
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <input type="radio" id="tab1" name="css-tabs" class="hidden" checked>
    <input type="radio" id="tab2" name="css-tabs" class="hidden">

    <ul class="tabs flex list-none p-0 mb-10 gap-1">
        <li class="tab w-full"><label for="tab1" class="block m-0 px-2 py-2 cursor-pointer transition-all text-center font-thin border-b-2 border-b-zinc-500 hover:border-b-amber-300 hover:text-amber-300">DETAILS</label></li>

        <?php if ( current_user_can( 'syllabus_view_admin_tabs' ) ) { ?>
            <li class="tab w-full"><label for="tab2" class="block m-0 px-2 py-2 cursor-pointer transition-all text-center font-thin border-b-2 border-b-zinc-500 hover:border-b-amber-300 hover:text-amber-300">ADMIN</label></li>
        <?php } ?>
    </ul>

    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                		  TAB-CONTENT : DETAILS                          │
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <div class="tab-content hidden">
    
        <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            // │                			  CONTENT                                    │
            // └─────────────────────────────────────────────────────────────────────────┘
            include(get_template_directory() . '/src/views/partials/post-content.php'); 
        ?>
    </div>

    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                		    TAB-CONTENT : ADMIN                          │
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <div class="tab-content hidden">
        <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            // │                			  ADMIN                                      │
            // └─────────────────────────────────────────────────────────────────────────┘

            include(get_template_directory() . '/src/views/partials/post-admin.php'); 
        ?>
    </div>
    
</div>

<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                		    REQUIRED CSS FOR TABS                        │
// └─────────────────────────────────────────────────────────────────────────┘
?>
<style>
    /* As we cannot replace the numbers with variables or calls to element properties, the number of this selector parts is our tab count limit */
    .content-tabs [type="radio"]:nth-of-type(1):checked ~ .tabs .tab:nth-of-type(1) label,
    .content-tabs [type="radio"]:nth-of-type(2):checked ~ .tabs .tab:nth-of-type(2) label {
        color: #f59e0b;
        border-color: #f59e0b;
    }

    .content-tabs [type="radio"]:nth-of-type(1):checked ~ .tab-content:nth-of-type(1),
    .content-tabs [type="radio"]:nth-of-type(2):checked ~ .tab-content:nth-of-type(2) {
        display: block;
    }
</style>
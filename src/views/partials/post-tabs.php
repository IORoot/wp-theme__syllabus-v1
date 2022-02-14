
<div class="content-tabs">
	

    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                		        RADIO TABS                               │
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <input type="radio" id="tab1" name="css-tabs" class="hidden" checked>
    <input type="radio" id="tab2" name="css-tabs" class="hidden">
    <input type="radio" id="tab3" name="css-tabs" class="hidden">

    <ul class="tabs flex list-none p-0 mb-10 gap-4">
        <li class="tab w-full"><label for="tab1" class="block m-0 px-2 py-2 cursor-pointer transition-all bg-zinc-700 hover:bg-zinc-500 text-center rounded-xl font-thin">DETAILS</label></li>
        <li class="tab w-full"><label for="tab2" class="block m-0 px-2 py-2 cursor-pointer transition-all bg-zinc-700 hover:bg-zinc-500 text-center rounded-xl font-thin">RULES</label></li>

        <?php if ($access->can('view_tabs')){ ?>
            <li class="tab w-full"><label for="tab3" class="block m-0 px-2 py-2 cursor-pointer transition-all bg-zinc-700 hover:bg-zinc-500 text-center rounded-xl font-thin">ADMIN</label></li>
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
    // │                		    TAB-CONTENT : RULES                          │
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <div class="tab-content hidden">
        <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            // │                			  RULES                                      │
            // └─────────────────────────────────────────────────────────────────────────┘

            include(get_template_directory() . '/src/views/partials/post-rules.php'); 
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
    .content-tabs [type="radio"]:nth-of-type(2):checked ~ .tabs .tab:nth-of-type(2) label,
    .content-tabs [type="radio"]:nth-of-type(3):checked ~ .tabs .tab:nth-of-type(3) label {
        background: #f59e0b;
    }

    .content-tabs [type="radio"]:nth-of-type(1):checked ~ .tab-content:nth-of-type(1),
    .content-tabs [type="radio"]:nth-of-type(2):checked ~ .tab-content:nth-of-type(2),
    .content-tabs [type="radio"]:nth-of-type(3):checked ~ .tab-content:nth-of-type(3) {
        display: block;
    }
</style>
<div class="side-rules flex flex-wrap gap-4 bg-zinc-800 rounded-xl p-4">
    <div class="text-center font-thin text-lg w-full">Rules</div>

    <?php
        $rules = $variables["acf"]["variables"];
        $count = count($rules);

        foreach ($rules as $rule_index => $rule){ ?>


            <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            // │                                                                         │
            // │                			      Card                                   │
            // │                                                                         │
            // └─────────────────────────────────────────────────────────────────────────┘
            ?>
            <div class="w-1/3 flex-auto bg-zinc-900 rounded-xl text-zinc-100 fill-zinc-400 p-4 flex flex-col">

                <a href="#open-rule-modal-<?php echo $rule_index?>" class="fill-amber-500 block w-2/3 mb-8 mx-auto" title="<?php echo $rule['description']; ?>"><?php echo $rule['svg']; ?></a>

                <div class="capitalize text-xs">
                    <?php 
                        $rule_title = $rule['acf_fc_layout']; 
                        echo $rule_title;
                    ?>
                </div>
                <div class="font-thin capitalize text-xs">    
                    <?php
                        echo $rule[$rule_title];
                    ?>
                </div>

            </div>


            <?php
            // ┌─────────────────────────────────────────────────────────────────────────┐
            // │                                                                         │
            // │                			Modal                                        │
            // │                                                                         │
            // └─────────────────────────────────────────────────────────────────────────┘
            ?>
            <div id="open-rule-modal-<?php echo $rule_index?>" class="modal-window fixed bg-neutral-500 bg-opacity-50 inset-0 invisible opacity-0 pointer-events-none flex justify-center items-center h-screen z-50 target:visible target:opacity-100 target:pointer-events-auto">
                <div class="modal-box h-5/6 w-5/6 relative p-4 bg-zinc-800 text-zinc-50">
                    <a href="#" title="Close" class="modal-close absolute right-1 top-2 text-center">
                    <svg role="img" aria-label="Close Icon" class="w-10 h-10 fill-zinc-50 hover:fill-amber-500"><use xlink:href="#close"></use></svg>
                    </a>
                    <?php  
                        $rule_html = new andyp\theme\syllabus\lib\movement_rules();
                        $rule_html->set_rules([$rule]);
                        echo $rule_html ->get_html();
                    ?>
                </div>
            </div> 

        <?php }
    ?>

</div>

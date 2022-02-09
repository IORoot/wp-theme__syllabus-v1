<div class="side-rules flex flex-wrap gap-4 bg-zinc-700 rounded-xl p-4">
    <div class="text-center font-thin text-lg w-full">Guidelines</div>

    <?php
        $rules = $variables["acf"]["variables"];
        $count = count($rules);

        foreach ($rules as $rule){ ?>

            <div class="w-1/3 flex-auto bg-zinc-800 rounded-xl text-zinc-100 fill-zinc-400 p-4">

                <div class="text-center font-thin capitalize text-xs"><?php echo $rule['acf_fc_layout']; ?></div>

                <div class=""><?php echo $rule['svg']; ?></div>

            </div>

        <?php }
    ?>

</div>
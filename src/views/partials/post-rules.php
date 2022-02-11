<div class="rules flex flex-wrap gap-4 bg-zinc-700 rounded-xl p-4">

    <div class="text-center font-thin text-lg w-full">Guidelines</div>

        <?php
            $rulelist = new andyp\theme\syllabus\lib\movement_rules();

            $rulelist->set_rules($variables["acf"]["variables"]);

            echo $rulelist->get_html();

        ?>

</div>
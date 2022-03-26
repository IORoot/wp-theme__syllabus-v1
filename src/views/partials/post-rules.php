<div class="rules flex flex-wrap gap-4">

    <div class="text-6xl mb-10">Guidelines</div>

    <?php
        $rulelist = new andyp\theme\syllabus\lib\movement_rules();

        $rulelist->set_rules($variables["acf"]["variables"]);

        echo $rulelist->get_html();

    ?>

</div>
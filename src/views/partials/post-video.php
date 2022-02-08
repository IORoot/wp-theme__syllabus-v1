<?php

    /**
     * Set Default
     */
    if (empty($variables["acf"]["media"])){
        $variables["acf"]["media"][] = ['videoId' => 'stvI8vzr9rM'];
    }

    foreach ($variables["acf"]["media"] as $video){
        ?>
            <lite-youtube class="w-full h-96 bg-cover bg-center bg-no-repeat fill-amber-500 flex cursor-pointer rounded-xl overflow-hidden" id="ytplayer" videoid="<?php echo $video['videoId']; ?>" >
                
                <svg class="h-24 w-24 m-auto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10,16.5V7.5L16,12M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg>

            </lite-youtube>
        <?php
    }

?>


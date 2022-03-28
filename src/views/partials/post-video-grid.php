<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                	      OUTPUT HTML CELLS                              │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>
<div class="video-grid">

    <div class="p-2 bg-zinc-900 rounded-xl w-full grid grid-cols-4 gap-4">
        <?php
        /**
         * Set Default
         */
        if (empty($variables["acf"]["tutorials"])){
            $variables["acf"]["tutorials"][] = ['video_code' => 'stvI8vzr9rM'];
        }

        // playlist
        $playlist = '';
        foreach ($variables["acf"]["tutorials"] as $video){
            $playlist .= $video['video_code'].',';
        }

        foreach ($variables["acf"]["tutorials"] as $video){

            $deleted = $youtube_api->clear_transient($video['video_code']);
            $youtube_data = $youtube_api->get_data($video['video_code']);

            ?>
            <div class="cell w-full">
                <lite-youtube class="w-full h-60 bg-zinc-800 bg-cover bg-center bg-no-repeat fill-amber-500 flex cursor-pointer rounded-xl overflow-hidden" params="rel=0&modestbranding=1&playlist=<?php echo $playlist; ?>" id="ytplayer" videoid="<?php echo $video['video_code']; ?>" >
                    <svg class="h-24 w-24 m-auto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10,16.5V7.5L16,12M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg>
                </lite-youtube>
            </div>
            <?php
        }
        ?>
    </div>

</div>
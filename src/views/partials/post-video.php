<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                	      OUTPUT HTML CELLS                              │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>


<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                  DEFAULT - NO VIDEO SET - USE THUMBANIL                 │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘

if (!isset($variables["acf"]["media"]) || empty($variables["acf"]["media"])){ 

    ?>
    <div class="video flex flex-col gap-4">
        <div class="main-carousel p-2 bg-zinc-50 rounded-xl w-full h-96">
            <?php if (isset($variables["thumbnail"]) && !empty($variables["thumbnail"])){ echo $variables["thumbnail"]; } ?>
        </div>
    </div>
    <?php

    // skip everything else.
    return;
}
?>

    <?php
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                                                                         │
    // │                			    VIDEO                                    │
    // │                                                                         │
    // └─────────────────────────────────────────────────────────────────────────┘
    ?>
    <div class="video flex flex-col gap-4">

        <div class="main-carousel p-2 bg-zinc-900 rounded-xl w-full gap-4">
            <?php
                // playlist
                $playlist = '';
                foreach ($variables["acf"]["media"] as $video){
                    $playlist .= $video['videoId'].',';
                }

                foreach ($variables["acf"]["media"] as $video){
                    ?>
                    <div class="carousel-cell w-full">
                        <lite-youtube class="w-2/3 aspect-video m-auto bg-zinc-800 bg-cover bg-center bg-no-repeat fill-amber-500 flex cursor-pointer rounded-xl overflow-hidden" params="rel=0&modestbranding=1&playlist=<?php echo $playlist; ?>" id="ytplayer" videoid="<?php echo $video['videoId']; ?>" >
                            <svg class="h-24 w-24 m-auto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10,16.5V7.5L16,12M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg>
                        </lite-youtube>
                    </div>
                    <?php
                }
            ?>
        </div>


        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                                                                         │
        // │                			LOAD FLICIKITY                               │
        // │                                                                         │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <script> <?php include(get_template_directory() . '/src/assets/js/flickity/flickity.min.js'); ?> </script>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                                                                         │
        // │                	    CONFIGURE FLICIKITY                              │
        // │                                                                         │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <script>
            var main_element = document.querySelector('.main-carousel');
            var flickity = new Flickity( main_element, {
                cellAlign: 'left',
                contain: true,
                pageDots: false
            });    
        </script>

        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                                                                         │
        // │                	NAVIGATION CELLS & SCRIPT                            │
        // │                                                                         │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>

        <?php if ( count($variables["acf"]["media"]) > 1 ){ ?>
            <div class="nav-carousel p-2 bg-zinc-900 rounded-xl ">
                <?php foreach ($variables["acf"]["media"] as $video){ ?>
                    <div class="carousel-cell w-40 flex flex-col gap-4 mr-2 bg-zinc-800 hover:bg-zinc-700 p-4 rounded-lg">
                        <img src="https://img.youtube.com/vi/<?php echo $video['videoId']; ?>/default.jpg">
                        <div class="text-center text-xs">
                            <?php echo $video['video_title']; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <script>
                var nav_element = document.querySelector('.nav-carousel');
                var flickity = new Flickity( nav_element, {
                    asNavFor: '.main-carousel',
                    contain: true,
                    pageDots: false
                });
            </script>
            
        <?php } ?>


        <?php
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                                                                         │
        // │                	        STYLE FLICIKITY                              │
        // │                                                                         │
        // └─────────────────────────────────────────────────────────────────────────┘
        ?>
        <style>
            @media (min-width: 768px) { .flickity-page-dots { display: block; } }
            .flickity-page-dots .dot { width: 3rem; border-radius: 1rem; }
            .flickity-page-dots .dot:hover { background: #10b981 }
            .flickity-button {   }
            .flickity-button-icon { fill:#10b981; }
            .flickity-prev-next-button.previous { left: 2rem; }
            .flickity-prev-next-button.next { right: 2rem; }
        </style>

    </div>
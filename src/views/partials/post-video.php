<?php
// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                	      OUTPUT HTML CELLS                              │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
?>
<div class="video flex flex-row gap-4">

    <div class="main-carousel p-2 bg-zinc-900 rounded-xl w-full">
        <?php
        /**
         * Set Default
         */
        if (empty($variables["acf"]["media"])){
            $variables["acf"]["media"][] = ['videoId' => 'stvI8vzr9rM'];
        }

        // playlist
        $playlist = '';
        foreach ($variables["acf"]["media"] as $video){
            $playlist .= $video['videoId'].',';
        }

        foreach ($variables["acf"]["media"] as $video){
            ?>
            <div class="carousel-cell w-full">
                <lite-youtube class="w-full h-96 bg-zinc-800 bg-cover bg-center bg-no-repeat fill-amber-500 flex cursor-pointer rounded-xl overflow-hidden" params="rel=0&modestbranding=1&playlist=<?php echo $playlist; ?>" id="ytplayer" videoid="<?php echo $video['videoId']; ?>" >
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
        <div class="nav-carousel w-40 p-2 bg-zinc-900 rounded-xl flex flex-col">
            <?php foreach ($variables["acf"]["media"] as $video){ ?>
                <div class="carousel-cell w-32 h-20"><img src="https://img.youtube.com/vi/<?php echo $video['videoId']; ?>/default.jpg"></div>
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
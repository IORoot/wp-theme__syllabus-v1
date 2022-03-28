<?php

namespace andyp\theme\syllabus\lib;

use andyp\theme\syllabus\lib\youtube_api;

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                                                         │
// │                	      Grid of Videos.                                │
// │                	      Uses the YouTube API                           │
// │                                                                         │
// └─────────────────────────────────────────────────────────────────────────┘
class video_grid {


    public $output;
    public $variables;
    public $playlist;

    public $youtube_api;
    public $youtube_data;



    /**
     * Set Variables
     *
     * @param array $variables
     * @return void
     */
    public function set_variables(array $variables)
    {
        $this->variables = $variables;
    }



    /**
     * Run the functions in order
     *
     * @return void
     */
    public function output()
    {
        $this->init_youtube_api();

        ob_start();
        $this->open_container();
            $this->open_grid();
                $this->tutorials();
            $this->close_div();
        $this->close_div();

        $this->output = ob_get_contents();
        ob_end_clean();

        return $this->output;
    }



    /**
     * Initialise the youtube API class.
     *
     * @return void
     */
    private function init_youtube_api()
    {
        $this->youtube_api = new youtube_api;
    }



    /**
     * Outer wrapper
     *
     * @return void
     */
    private function open_container()
    {
        ?>
        <div class="video-grid">
        <?php
    }



    /**
     * Open the surrounding grid of cells
     *
     * @return void
     */
    private function open_grid()
    {
        ?>
        <div class="p-2 bg-zinc-900 rounded-xl w-full grid grid-cols-4 gap-4">
        <?php
    }



    /**
     * Close a DIV
     *
     * @return void
     */
    private function close_div()
    {
        ?>
        </div>
        <?php
    }



    /**
     * Check for tutorials
     *
     * @return void
     */
    private function tutorials()
    {
        if (empty($this->variables["acf"]["tutorials"])){
            $this->blank_cell();
        }
        $this->cells();
    }



    /**
     * No videos, create a blank cell.
     *
     * @return void
     */
    private function blank_cell()
    {
        ?>
            <div class="video flex flex-col gap-4">
                <div class="p-2 bg-zinc-50 rounded-xl w-full h-96"></div>
            </div>
        <?php
    }



    /**
     * Build the grid of cells
     *
     * @return void
     */
    private function cells()
    {
        $this->create_playlist();
        foreach ($this->variables["acf"]["tutorials"] as $this->loop_key => $this->loop_video){
            $this->youtube_data();
            $this->thumbnail();
            $this->modal();
        }
    }



    /**
     * Create a list for the playlist
     *
     * @return void
     */
    private function create_playlist()
    {
        $playlist = '';
        foreach ($this->variables["acf"]["tutorials"] as $video){
            $this->playlist .= $video['video_code'].',';
        }
    }



    /**
     * Get the YouTube video data
     *
     * @return void
     */
    private function youtube_data()
    {
        $this->youtube_data = $this->youtube_api->get_data($this->loop_video['video_code']);
    }



    /**
     * Thumbnail Link
     *
     * @return void
     */
    private function thumbnail()
    {
        $thumbnails = $this->youtube_data->items[0]->snippet->thumbnails;
        if (property_exists($thumbnails, 'default')){
            $image = $thumbnails->default;
        }        
        if (property_exists($thumbnails, 'high')){
            $image = $thumbnails->high;
        }
        if (property_exists($thumbnails, 'standard')){
            $image = $thumbnails->standard;
        }

        ?>
            <a href="#open-tutorial-modal-<?php echo $this->loop_key; ?>" class="w-full h-60 flex cursor-pointer rounded-xl overflow-hidden p-2 bg-black hover:bg-amber-500">
                <img class="rounded-xl overflow-hidden" src="<?php echo $image->url; ?>">
            </a>
        <?
    }



    /**
     * Create a modal for the post image
     *
     * @return void
     */
    public function modal()    
    {
        ?>
            <div data-modal id="open-tutorial-modal-<?php echo $this->loop_key; ?>" class="group z-50 p-10 fixed inset-0 items-center justify-center target:flex opacity-0 target:opacity-100 invisible target:visible transition-opacity" >
                <div data-modal-dialog tabindex="-1" class="z-50 w-4/5 max-w-screen-xl max-h-full p-4 rounded-xl bg-zinc-100 opacity-0 group-target:opacity-100 overflow-y-scroll">
                    <div class="flex flex-row gap-4">
                    <?php 
                        $this->video(); 
                        $this->details();
                    ?>
                    </div>
                    <a href="#" class="absolute top-1 right-1">
                        <svg class="w-6 h-6"><use xlink:href="#close"></use></svg>
                    </a>
                </div>
                <a href="#" tabindex="-1" class="fixed inset-0 bg-zinc-900 opacity-70"></a>
            </div>
        <?php
    }



    /**
     * Output the lite-youtube video
     *
     * @return void
     */
    private function video()
    {
        ?>
        <div class="w-1/2 flex flex-col gap-4">
            <lite-youtube class="w-full aspect-video bg-zinc-800 bg-cover bg-center bg-no-repeat fill-emerald-500 flex cursor-pointer rounded-xl overflow-hidden" params="rel=0&modestbranding=1&playlist=<?php echo $this->playlist; ?>" id="ytplayer" videoid="<?php echo $this->loop_video['video_code']; ?>" >
                <svg class="h-24 w-24 m-auto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10,16.5V7.5L16,12M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg>
            </lite-youtube>
            
            <?php $this->meta(); ?>
        </div>
        <?php
    }


    private function details()
    {
        $snippet    = $this->youtube_data->items[0]->snippet;
        $content    = $this->youtube_data->items[0]->contentDetails;

        ?>
            <div class="w-1/2 text-black bg-zinc-200 flex flex-col gap-4 p-4 rounded-xl">
                <div class="h-full overflow-y-scroll">
                    <?php 
                        print apply_filters('cpt_syllabus_transforms', $snippet->description);
                    ?>
                </div>
            </div>
        <?php
    }


    private function meta()
    {
        $snippet    = $this->youtube_data->items[0]->snippet;
        $content    = $this->youtube_data->items[0]->contentDetails;

        ?>
        <div class="w-full rounded-xl flex flex-col p-4 gap-4 justify-center bg-gradient-to-tr from-emerald-500 to-emerald-400">

            <div class="flex flex-row text-5xl mb-4">
                <div><?php echo $snippet->title ?></div>
            </div>   

            <div class="flex flex-row gap-8 mb-4">

                <div class="flex flex-col">
                    <div class="text-emerald-200 text-xs">Duration</div>
                    <div>
                        <?php 
                            $duration = str_replace('PT', '', $content->duration); 
                            $duration = str_replace('M', ':', $duration); 
                            $duration = str_replace('S', 'min', $duration); 
                            echo $duration;
                        ?>
                    </div>
                </div>

                <div class="w-px h-full bg-emerald-400"></div>
                
                <div class="flex flex-col">
                    <div class="text-emerald-200 text-xs">Published</div>
                    <div><?php echo $snippet->publishedAt; ?></div>
                </div>

                <div class="w-px h-full bg-emerald-400"></div>

                <div class="flex flex-col">
                    <div class="text-emerald-200 text-xs">Definition</div>
                    <div><?php echo $content->definition; ?></div>
                </div>

                <div class="w-px h-full bg-emerald-400"></div>

            </div>

            <div class="flex flex-wrap flex-row gap-2"> 
                <?php 
                    foreach($snippet->tags as $tag){
                        ?>
                            <div class="rounded-full px-2 py-1 bg-zinc-300 text-white text-xs"><?php echo $tag; ?></div>
                        <?php
                    }
                ?> 
            </div>

        </div>
    <?php
    }
}

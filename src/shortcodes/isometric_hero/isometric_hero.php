<?php

/**
 * Build up a hero block with random isometric images.
 */
class isometric_hero {

    public $count = 15;
    public $image_classes = 'w-96 h-96 px-10';
    public $pyramid = [1,2,3,4];
    public $exclude_ids = [
        6148, 6132, 6134, 6136, 6128, 6122, 6062, 5998, 5912, 5908, 5906, 5904, 5892, 5894, 5890, 5888, 5882, 5878, 
        5880, 5758, 5740, 5736, 5738, 5734, 5732, 5730, 5728, 5726, 5650, 5648, 5600, 5410, 5402, 5388, 5278, 5276,
        5272, 5274, 5268, 5300, 5342, 5408, 5406, 5404, 5400, 5398, 5396, 5394, 5392, 5454, 5450, 5476, 5538, 5534,
        5532, 5530, 5528, 5518, 5520, 5506, 5564, 5562, 5560, 5558, 5550, 5548, 5540, 5536];

    private $attributes;
    private $content;
    private $url = false;
    private $image;
    private $images = [];
    private $result;


    /**
     * Define the shortcode
     */
    public function __construct()
    {
        add_shortcode( 'isometric_hero', [$this,'run'] );
    }


    /**
     * Kick the code off
     */
    public function run($atts = array(), $content = null)
    {
        if ($atts) {
            $this->attributes = $atts;
        }
        if ($content) {
            $this->content = $content;
        }

        $this->build_image_list();
        $this->build_image_grid();

        ob_start();
        echo $this->result;
        return ob_get_clean();
    }


    /**
     * Loop number of images required and build an
     * array of URLs.
     */
    private function build_image_list()
    {
        for ($i = 1; $i <= $this->count; $i++) {
            $this->get_random_image();

            $this->filter_iso_images();

            $this->build_img_tag();

            $this->push_onto_image_array();

            
        }
    }


    /**
     * Return the URL of a random image in the 
     * media library.
     */
    private function get_random_image()
    {
        // get all image ids available
        $image_ids = get_posts( 
            array(
                'post_type'      => 'attachment', 
                'post_mime_type' => 'image', 
                'post_status'    => 'inherit', 
                'posts_per_page' => -1,
                'fields'         => 'ids',
                'exclude'        => $this->exclude_ids
            ) 
        );
        // based on the number of image_ids retrieved, generate a random number within bounds.
        $num_of_images = count($image_ids);
        $random_index = rand(0, $num_of_images);
        $random_image_id = $image_ids[$random_index] ?? 5436;

        // now that we have a random_image_id, lets fetch the image itself.
        $this->image = get_post($random_image_id);
    }



    /**
     * filter for only images with a number at the end.
     */
    private function filter_iso_images()
    {
        $this->url = false;
        if (preg_match('/[0-9]$/', $this->image->post_title))
        {
            $this->url = wp_get_attachment_url($this->image->ID);
        }
    }



    /**
     * Create the <img> tag for the url if not empty.
     */
    private function build_img_tag()
    {
        if ($this->url){
            $this->url = '<img class="'.$this->image_classes.'" src="'.$this->url.'">';
        }
    }


    /**
     * Push onto images[] if not empty.
     */
    private function push_onto_image_array()
    {
        if ($this->url) {
            $this->images[] = $this->url;
        }
    }

    /**
     * Build a grid of images
     */
    private function build_image_grid()
    {
        $out = '<div class="flex flex-col relative">';
        
            $out .= '<div class="flex flex-row justify-center absolute top-0 w-full animated animatedFadeInUp fadeInUp delay250">';
                $out .= $this->images[0];
                $out .= $this->images[1];
                $out .= $this->images[2];
                $out .= $this->images[3];
                $out .= $this->images[4];
            $out .= '</div>' ;  

            $out .= '<div class="flex flex-row justify-center absolute top-48 left-48 w-full animated animatedFadeInUp fadeInUp delay500">';
                $out .= $this->images[5];
                $out .= $this->images[6];
                $out .= $this->images[7];
                $out .= $this->images[8];
                $out .= $this->images[9];
            $out .= '</div>' ;
            
        $out .= '</div>' ;

        $this->result = $out;
    }

}

new isometric_hero;
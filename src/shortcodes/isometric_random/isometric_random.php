<?php

/**
 * random isometric images.
 * 
 * [isometric_random]
 * 
 * Options:
 * 
 * [isometric_random 
 *      count="2"
 *      glue=","
 *      classes="bg-zinc-500"
 *      default="/wp-content/uploads/Syllabus/Climbing/Splat/Splats-7.svg"
 * ]
 * 
 * count : number of results
 * glue : anything to place between each returned <IMG> tag.
 * classes : any classes to add to the <IMG> tag.
 * default : The fallback URL if no image is found.
 */
class isometric_random {

    public $count = 3;

    public $classes = '';

    public $glue = '';

    public $default = '';

    public $exclude_ids = [
        6148, 6132, 6134, 6136, 6128, 6122, 6062, 5998, 5912, 5908, 5906, 5904, 5892, 5894, 5890, 5888, 5882, 5878, 
        5880, 5758, 5740, 5736, 5738, 5734, 5732, 5730, 5728, 5726, 5650, 5648, 5600, 5410, 5402, 5388, 5278, 5276,
        5272, 5274, 5268, 5300, 5342, 5408, 5406, 5404, 5400, 5398, 5396, 5394, 5392, 5454, 5450, 5476, 5538, 5534,
        5532, 5530, 5528, 5518, 5520, 5506, 5564, 5562, 5560, 5558, 5550, 5548, 5540, 5536];

    private $url = false;

    private $image;
    private $images = [];

    private $result;


    /**
     * Define the shortcode
     */
    public function __construct()
    {
        add_shortcode( 'isometric_random', [$this,'run'] );
    }


    /**
     * Kick the code off
     */
    public function run($atts = array(), $content = null)
    {
        $this->set_attributes($atts);
        $this->build_image_list();
        $this->build_output();

        ob_start();
        echo $this->result;
        return ob_get_clean();
    }


    private function set_attributes($atts)
    {

        if (array_key_exists('count',$atts)){
            $this->count = $atts['count'];
        }        
        
        if (array_key_exists('glue',$atts)){
            $this->glue = $atts['glue'];
        }   

        if (array_key_exists('classes',$atts)){
            $this->classes = $atts['classes'];
        }

        if (array_key_exists('default',$atts)){
            $this->default = $atts['default'];
        }
    }

    /**
     * Loop number of images required and build an
     * array of URLs.
     */
    private function build_image_list()
    {
        for ($i = 1; $i <= $this->count; $i++) {
            $this->get_random_iso_post();

            $this->filter_iso_images();

            $this->build_img_tag();

            $this->push_onto_image_array();

            
        }
    }


    /**
     * Return the URL of a random image in the 
     * media library.
     */
    private function get_random_iso_post()
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
        } else {
            $this->url = $this->default;
        }
    }



    /**
     * Create the <img> tag for the url if not empty.
     */
    private function build_img_tag()
    {
        if ($this->url){
            $this->url = '<img class="'.$this->classes.'" src="'.$this->url.'">';
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
     * Output images
     */
    private function build_output()
    {
        $this->result = implode($this->glue, $this->images);
    }

}

new isometric_random;
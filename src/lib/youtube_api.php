<?php

namespace andyp\theme\syllabus\lib;

class youtube_api {

    private $cache_busting_version = '1.0.0';

    private $TTL = WEEK_IN_SECONDS;

    private $video_id;

    private $url;

    private $response;

    private $output;

    private $transient;


    /**
     * Entry point.
     *
     * @param string $video_id
     * @return void
     */
    public function get_data(string $video_id)
    {
        $this->video_id = $video_id;

        if ($this->check_transient()) {
            return $this->transient;
        }

        if (!defined('GOOGLE_YOUTUBE_API_KEY')){ 
            $this->error(1); return; 
        }

        $this->set_url();
        $this->api_request();
        $this->json_to_class();

        return $this->output;
    }


    /**
     * Remove the transient data for the video ID
     *
     * @param string $video_id
     * @return void
     */
    public function clear_transient(string $video_id)
    {
        return delete_transient('youtube_api_videoid_'. $video_id . '__' . $this->$cache_busting_version);
    }


    /**
     * Check if there is a cacheed copy of the data or not.
     *
     * @return void
     */
    private function check_transient()
    {
        $this->transient = json_decode(get_transient( 'youtube_api_videoid_'. $this->video_id . '__' . $this->$cache_busting_version));

        if (!empty($this->transient)){  return true; }
        
        return false;
    }

    
    /**
     * Deefine thee URL we will request data from
     *
     * @return void
     */
    private function set_url()
    {
        $this->url  = 'https://www.googleapis.com/youtube/v3/videos';
        $this->url .= '?id='  . $this->video_id;
        $this->url .= '&key=' . GOOGLE_YOUTUBE_API_KEY;
        $this->url .= '&part=snippet,contentDetails';
    }


    /**
     * Make the request using  wordpres's inbuilt function.
     *
     * @return void
     */
    private function api_request()
    {
        $this->response = wp_remote_get($this->url);
        if ($this->response["response"]["code"] != 200){ 
            $this->error(2); return; 
        }
    }


    /**
     * Convert JSON to a standard class.
     *
     * @return void
     */
    private function json_to_class()
    {
        if (!isset($this->response["body"])){ $this->output = 'No data.'; return; }

        $this->output = json_decode($this->response["body"]);

        set_transient( 'youtube_api_videoid_'. $this->video_id. '__' . $this->$cache_busting_version, $this->response["body"], $this->TTL );
    }



    /**
     * Define some error codes
     *
     * @param [type] $error_code
     * @return void
     */
    private function error($error_code)
    {
        if ($error_code == 1){
            echo 'The GOOGLE_YOUTUBE_API_KEY constant has not been defined. Please set in your wordpress wp-config file.';
            return;
        }

        if ($error_code == 2){
            echo 'The API Request is not a 200. You got '. $this->response["response"]["code"] . '. With a message of :' . $this->response["response"]["message"] . '.';
            echo 'BODY of response:' . $this->response["body"];
            return;
        }

        echo 'An unknown error has occured.';
    }

}
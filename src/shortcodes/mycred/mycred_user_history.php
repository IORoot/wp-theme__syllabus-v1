<?php

/**
 * AJAX Based seach box.
 */
class mycred_user_history {

    public $content;
    public $attributes;
    public $result;

    /**
     * Define the shortcode
     */
    public function __construct()
    {
        /**
         * Define Shortcode
         */
        add_shortcode( 'mycred_user_history', [$this,'run'] );

        /**
         * Add Javascript into footer
         */
        add_action('wp_footer', [$this, 'ajax_fetch'] );

        /**
         * Prepare AJAX functions for Javascript
         */
        add_action('wp_ajax_mycred_user_history',        [$this, 'ajax_get_favourites']);
        add_action('wp_ajax_nopriv_mycred_user_history', [$this, 'ajax_get_favourites']);  
    }


    /**
     * Start running the shortcode
     *
     * @param array   $atts
     * @param [type]  $content
     * @return string $result
     */
    public function run($atts = array(), $content = null)
    {
        if ($atts) {
            $this->attributes = $atts;
        }
        if ($content) {
            $this->content = $content;
        }

        $this->render_html();

        return $this->result;
    }


    public function render_html()
    {
        $out = '<div id="mycred_user_history">';
        $out .= 'Loading...';
        $out .= '</div>';

        $this->result = $out;
    }



    public function ajax_get_favourites()
    {

        $HTML = '';

        if (!isset($GLOBALS["mycred"])){ return; }
        if (!isset($GLOBALS["current_user"]->ID)){ return; }

        /**
         * Query for all posts that are favourited for user.
         */
        global $wpdb;
        $sql = 'SELECT ref AS post_id, SUM(creds) AS credits FROM wp_myCRED_log WHERE user_id = '.$GLOBALS["current_user"]->ID.' AND ctype = \'personal_tracking\' GROUP BY ref HAVING credits = 1';
        $favourited_posts_list = $wpdb->get_results($sql);
        $post_ids = array_column($favourited_posts_list, 'post_id');


        /**
         * Get links & thumbnails and create HTML
         */
        if ( ! empty($post_ids)){
            /**
             * Get all the syllabus posts as an array.
             */
            $posts = get_posts([
                'numberposts' => -1,
                'post_type'   => 'syllabus',
                'include'     => $post_ids,
            ]);

            $HTML = '<div class="grid grid-cols-10 gap-2 auto-cols-auto">';

                foreach ($posts as $index => $post)
                {
                    $thumbnail = get_the_post_thumbnail( $post->ID, null, ['class' => 'w-full h-full']);
                    $link = esc_url( post_permalink($post->ID) );

                    $HTML .= '<a href="'.$link.'" class="rounded-lg bg-zinc-600 hover:bg-amber-500 p-4">';
                    $HTML .=    '<div class="">'.$thumbnail.'</div>';
                    $HTML .=    '<div class="font-thin text-xs">'.$post->post_title.'</div>';
                    $HTML .= '</a>';
                }

            $HTML .= '<div>';
        }

        /**
         * Default Response.
         */
        if (empty($HTML)){
            $HTML = '<div>Nothing Favourited yet.</div>';
        }

        echo $HTML;

        wp_reset_postdata();

        die();
    }


    /**
     * Javascript to process the shortcode
     *
     * @return void
     */
    public function ajax_fetch() {
        ?>

            <script type="text/javascript">
                function mycred_user_history(){
                
                    var request = new XMLHttpRequest();
                    request.open('POST', '<?php echo admin_url("admin-ajax.php"); ?>', true);
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

                    /**
                     * Prepare onload method. (Don't run it yet)
                     */
                    request.onload = function () {
                        if (this.status >= 200 && this.status < 400) {
                            document.getElementById('mycred_user_history').innerHTML = this.response;
                        } else {
                            console.log('Cannot get favourites.' + this.response);
                        }
                    };

                    /**
                     * Prepare onerror method. (Don't run it yet)
                     */
                    request.onerror = function() {
                        console.log('on error');
                    };

                    /**
                     * Run method.
                     */
                    request.send('action=mycred_user_history');

                }

                window.onload = function() {
                    mycred_user_history();
                };      

            </script>
        
        <?php
    }



}

new mycred_user_history;